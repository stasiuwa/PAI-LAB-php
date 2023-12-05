<?php
    $dataPath = "../data/data.txt";
    $questionnaireData = "../data/questionnaireData.txt";
    $techs = ["C","CPP","Java","C#","HTML","CSS","XML","PHP","JavaScript"];
    /**Funkcja zapisująca dane z formularza do pliku data.txt w postaci linijki wartości
     * nazwisko wiek kraj mail tutoriale(rozdzielone przecinkiem) płatność
     * W przypadku braku pliku data.txt stworzy go, w przypadku istnienia dopisze w następnej linijce
     * @return void
     */
    function addToFile(): void {
        global $dataPath;
        $dataFile = fopen($dataPath, "a")or die("Nie udalo sie otworzyc pliku");
        flock($dataFile, LOCK_EX);
        $data="";
        if(isset($_POST) && ($_POST!="")) {
            foreach ($_POST as $key => $value){
                if($key!="submit") {
                    if(is_array($value)) $data .= " " . implode(', ', $value) . ",";
                    else $data .= " " . $value;
                }
            }
        }
        fwrite($dataFile,$data . "\n");
        flock($dataFile,LOCK_UN);
        fclose($dataFile);
    }

    /**
     * Funkcja wyświetlająca całosć danych z pliku data.txt
     * @param $dataPath string ścieżka do pliku
     * @return void
     */
    function show($dataPath): void {
        $dataFile = fopen($dataPath, "r")or die("Nie udalo sie otworzyc pliku");
        flock($dataFile, LOCK_SH);
        echo "<div>";
        while (($line = fgets($dataFile)) !== false) {
            echo $line . "<br/>";
        }
        echo "</div>";
        flock($dataFile, LOCK_UN);
        fclose($dataFile);
    }

    /**Funkcja wyświetlająca linijki danych z pliku data.txt w których zamówiono tutorial podany jako argument np $tutorial="Java"
     * @param $tutorial string nazwa zamówionego tutoriala
     * @return void
     */
    function showFiltered(string $tutorial): void {
        global $dataPath;
        echo "<div><h4>$tutorial</h4>";
        //$tutorialPattern = preg_quote($tutorial);
        $dataFile = fopen($dataPath, "r")or die("Nie udalo sie otworzyc pliku");
        flock($dataFile, LOCK_SH);
        while (($line = fgets($dataFile)) !== false) {
            //if(preg_match("~\b$tutorial,\b~",$line)) echo $line . "<br/>"; // dla C znajduje C++ i C#
            if(str_contains($line,$tutorial . ",")) echo $line . "<br/>"; //od PHP 8
            // if(strpos($lane,$tutorial) !== false ) echo $lane . "<br/>"; dla wersji < PHP 8
        }
        echo "</div>";
        flock($dataFile, LOCK_UN);
        fclose($dataFile);
    }

/**Walidacja danych w formularzu
 * @return bool
 */
    function validate(): bool{

        $args = [
            'surname' => [
                'filter' => FILTER_VALIDATE_REGEXP,
                'options' => ['regexp' => '/[a-ząęłńśćźżó-]{1,25}$/']
            ],
            'country' => FILTER_SANITIZE_SPECIAL_CHARS,
            'langs' => ['filter' => FILTER_SANITIZE_FULL_SPECIAL_CHARS, 'flags' => FILTER_REQUIRE_ARRAY],
            'payment' => FILTER_SANITIZE_FULL_SPECIAL_CHARS,
            'submit' => FILTER_SANITIZE_FULL_SPECIAL_CHARS
            ];
        //filtracja danych z POST zgodnie z $args
        $data = filter_input_array(INPUT_POST,$args);
        //wyniki filtracji

//        var_dump($data);

        $errors = "";
        foreach ($data as $key => $value) {
            if($value === false or $value === NULL) {
                $errors .= $key . ", ";
            }
        }
        if ($errors === "") {
            return true;
        } else {
            echo "<div>Niepoprawne dane: " . $errors;
            echo "</div>";
            return false;
        }
    }
    function saveData(): void{
        global $dataPath;
        echo "<h2>Dodawnaie do pliku: </h2>";
        if(validate()) {
            saveToFile($dataPath, $_POST);
        } else {
            echo "<div>DODAWANIE NIE POWIODLO SIE</div>";
        }
    }
    function saveToFile($fileName, $dataArray): void {
        $data = PHP_EOL;
        foreach ($dataArray as $key => $value){
            if($key!="submit") {
                if(is_array($value)) $data .= implode(', ', $value) . " ";
                else $data .= $value . " ";
            }
        }
        $file = fopen($fileName, "a")or die("Nie udalo sie otworzyc pliku!");
        flock($file, LOCK_EX);
        fwrite($file, $data)or die("nie udalo sie zapisac!");
        flock($file, LOCK_UN);
        fclose($file);
        echo "<p>Zapisano: <br/> $data </p>";
    }
    function showStats(): void {
        global $dataPath;
        $lineCounter=0; $malolaty=0; $dziady=0;
//        $ageArr = [
//            '<18' => 0,
//            '>=50' => 0
//        ];
        $file = fopen($dataPath, "r")or die("Nie udalo sie otworzyc pliku");
        flock($file, LOCK_SH);
        while (!feof($file)) {
            $data = "";
            $line = fgets($file);
            if ($line!==false && $line!=" "){
                $lineCounter++;
                $data = explode(' ', $line, 3);
            }
//            ($data[1]<18) ? $ageArr['<18']++ : $ageArr['>=50']++;
            if($data[1]<18) $malolaty++;
            elseif ($data[1]>=50) $dziady++;
        }
        echo "
            <div>
                <p>Liczba wszystkich zamówień: $lineCounter</p>
                <p>Liczba zamówień od osób <18lat : $malolaty</p>
                <p>Liczba zamówień od osób >=50 : $dziady</p>               
            </div>  
        ";

    }

/**Dopisywanie ilości zamówionych tutoriali z kwestionariusza. Pobiera wartości z pliku, czyści go, dodaje
 * te z aktualnego kwestionariusza i zapisuje od nowa
 * @return void
 */
    function sendQuestionnaireData(): void {
        global $questionnaireData;
        global $techs;
        if(isset($_POST['techs']) && ($_POST['techs']!="")) {
            $techsCounter = [];
            foreach ($techs as $tech){
                $techsCounter[$tech] = 0;
            }
            $data = $_POST['techs'];
            $file = fopen($questionnaireData, "r")or die("nie udalo sie otworzyc $questionnaireData");
            foreach ($data as $item) {
                $techsCounter[$item]++;
            }
            $data="";
            while (!feof($file)) {
                $line = fgets($file);
                $parts = explode(":",$line);
                $parts[1] = $techsCounter[$parts[0]] + intval($parts[1]);
                $data .= "$parts[0]:$parts[1]\n";
            }
            fclose($file);
            file_put_contents($questionnaireData, rtrim($data,"\n"));
            //print_r($techsCounter);
        }
        show($questionnaireData);
    }
    function addClientRecord($dataBase): void {
        if (validate()) {
            $sql =
                "INSERT INTO klienci VALUES (NULL, '" .
                $_POST['surname'] . "', " .
                $_POST['age'] . ", '" .
                $_POST['country'] . "', '" .
                $_POST['email'] . "', '" .
                implode(",",$_POST['langs']) . "', '" .
                $_POST['payment'] . "')";
            $dataBase->insert($sql);
        } else {
            echo "<h4>DODAWANIE DO BAZY NIE POWIODLO SIE</h4>";
        }
    }
    function showArray($arr): string {
        $text="";
        if($arr === null) {
            return "pusta tablica";
        }
        foreach ($arr as $item) {
            $text .= "$item <br/>";
        }
        return $text;
    }