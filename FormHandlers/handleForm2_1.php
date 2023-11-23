<!DOCTYPE html>
<html lang="pl-PL">
<head>
    <meta charset="UTF-8">
    <title>PAI LAB php</title>
    <link rel="stylesheet" href="../src/styles.css">
</head>
<body>
<header>
    <h2>DANE Z FORMULARZA: </h2>
    <h3><a href="../index.php">powrót</a></h3>
</header>
<div>
    <?php
    /**
     * Tablica asocjacyjna do odebrania danych z formularza
     */
        $formData = [
            'Nazwisko' => 'surname',
            'Wiek' => 'age',
            'Państwo' => 'country',
            'Adres Email' => 'email',
            'Płatność' => 'payment'
        ];
    /**
     * Tablica asocjacyjna do odebrania danych z checkboxów formularza
     */
        $formDataCheckboxes = [
            'PHP' => 'php',
            'Java' => 'java',
            'C/C++' => 'c'
        ];
    /**
     * Sprawdzenie istnienia parametru w żądaniu HTTP
     * - jeśli istnieja wypisanie na stronie
     * - jeśli nie istnieja wyświetli odpowiedni komunikat
     * @param $data string wartość danych z formularza
     * @param $name string nazwa danych z formularza
     * @return void
     */
        function validateData($data, $name) {
            if(isset($_POST[$data]) && ($_POST[$data]!="")) {
                $temp = htmlspecialchars(trim($_POST[$data]));
                echo "<p>$name: $temp</p>";
            } else echo "<p>Brak danych!</p>";
        }

    /**
     * Sprawdzenie istnienia parametru w żądaniu HTTP dla checkboxów,
     * nie wyświetla komunikatu o błędnych danych w przypadku ich braku
     * @param $data string wartość danych z formularza
     * @param $name string nazwa danych z formularza
     */
        function validateCheckbox($data,$name) {
            if(isset($_POST[$data]) && ($_POST[$data]!="")) {
                echo " $name ";
            }
        }
        foreach ($formData as $key => $value) validateData($value,$key);
        echo "<p>Zamówiono tutorial z języka: ";
        foreach ($formDataCheckboxes as $key => $value) validateCheckbox($value,$key);
        echo "</p>";
        echo "<p><h3>PODPUNKT c,d,e</h3>";
        foreach ($_REQUEST as $key => $value) echo "$key = $value \t" . var_dump($value) . "<br/>";
        echo "</p>";
    ?>
</div>
</body>
</html>