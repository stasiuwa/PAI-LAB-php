<?php
/**Funkcja zapisująca dane z formularza do pliku data.txt w postaci linijki wartości
 * nazwisko wiek kraj mail tutoriale(rozdzielone przecinkiem) płatność
 * W przypadku braku pliku data.txt stworzy go, w przypadku istnienia dopisze w następnej linijce
 * @return void
 */
    function addToFile(): void {
        $dataFile = fopen("data.txt", "a")or die("Nie udalo sie otworzyc pliku");
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

/**Funkcja wyświetlająca całosć danych z pliku data.txt
 * @return void
 */
    function show(): void {
        $dataFile = fopen("data.txt", "r")or die("Nie udalo sie otworzyc pliku");
        flock($dataFile, LOCK_SH);
        while (($line = fgets($dataFile)) !== false) {
            echo $line . "<br/>";
        }
        flock($dataFile, LOCK_UN);
        fclose($dataFile);
    }

/**Funkcja wyświetlająca linijki danych z pliku data.txt w których zamówiono tutorial podany jako argument np $tutorial="Java"
 * @param $tutorial string nazwa zamówionego tutoriala
 * @return void
 */
    function showFiltered(string $tutorial): void {
        echo "<h4>$tutorial</h4>";
        //$tutorialPattern = preg_quote($tutorial);
        $dataFile = fopen("data.txt", "r")or die("Nie udalo sie otworzyc pliku");
        flock($dataFile, LOCK_SH);
        while (($line = fgets($dataFile)) !== false) {
            //if(preg_match("~\b$tutorial,\b~",$line)) echo $line . "<br/>"; // dla C znajduje C++ i C#
            if(str_contains($line,$tutorial . ",")) echo $line . "<br/>"; //od PHP 8
            // if(strpos($lane,$tutorial) !== false ) echo $lane . "<br/>"; dla wersji < PHP 8
        }
        flock($dataFile, LOCK_UN);
        fclose($dataFile);
    }


?>
<div>
    <h2>FORMULARZ 3.1</h2>
    <h3><a href="index.php">powrót</a></h3>
    <?php
        $langs = ['C', 'C++', 'Java', 'C#', 'HTML', 'CSS', 'XML', 'PHP', 'JavaScript'];
            echo
            '<form method="post" action="formFiles.php"><h4>Zamawiam tutorial z języka:</h4><p>';
            echo '<table>
                <tr> <td>Nazwisko: </td>
                    <td><input name="surname" size="30" id="nazwa"/><label for="nazwa"></label></td>
                    <td id="nazwa_error" class="czerwone"></td>
                </tr>
                <tr> <td>Wiek:</td>
                    <td><input name="age" size ="30" id="wiek"/><label for="wiek"></label></td>
                    <td id="wiek_error" class="czerwone"></td>
                </tr>
                <tr> <td>Państwo:</td>
                    <td><select name="country" id="kraj">
                        <option value="PL" selected="selected">Polska</option>
                        <option value="UK">Wielka Brytania</option>
                    </select><label for="kraj"></label>
                    </td>
                </tr>
                <tr> <td>Adres e-mail: </td>
                    <td><input name="email" size ="30" id="email"/><label for="email"></label></td>
                    <td id="email_error" class="czerwone"></td>
                </tr>
            </table>';
        /**
         *  Pętla do wyświetlenia checkboxów dla tablicy asocjacyjnej $langs
         */
            foreach ($langs as $value) {
            echo '<input name="langs[' . $value . ']" type="checkbox" id="' . $value. '" 
                    value="' . $value  . '"/><label for="' . $value . '">' . $value . '</label>    ';
            }
            echo '<span id="produkt_error" class="czerwone"></span></p>
                <h4>Sposób zapłaty:</h4>
                <p><input name="payment" id="euro" type="radio" value="euro"/><label for="euro">eurocard</label>
                    <input name="payment" id="visa" type="radio" value= "visa"/><label for="visa">visa</label>
                    <input name="payment" id="przelew" type="radio" value="przelew"/><label for="przelew">przelew</label><br/>
                    <span id="zaplata_error" class="czerwone"></span><br>
                    <input type="reset" value="Wyczyść"/>
                    <input type="submit" name="submit" value="Zapisz"/>
                    <input type="submit" name="submit" value="Pokaz"/>
                    <input type="submit" name="submit" value="PHP"/>
                    <input type="submit" name="submit" value="C++"/>
                    <input type="submit" name="submit" value="Java"/></p>
            </form>';

        if (isset($_REQUEST['submit'])){
            $action = $_REQUEST['submit'];
            switch ($action){
                case "Zapisz": addToFile(); break;
                case "Pokaz": show(); break;
                case "PHP": showFiltered('PHP'); break;
                case "C++": showFiltered('C++'); break;
                case "Java": showFiltered('Java'); break;
                default: echo "<p>error ? ? ? ?! !</p>";
            }
        }
    ?>
</div>
