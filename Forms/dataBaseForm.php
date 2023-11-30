<!DOCTYPE html>
<html lang="pl-PL">
<head>
    <meta charset="UTF-8">
    <title>PAI LAB php</title>
    <link rel="stylesheet" href="../src/styles.css">
</head>
<body>
    <header>
        <h2>FORMULARZ Z BAZĄ DANYCH 6.2</h2>
        <h3><a href="../index.php">powrót</a></h3>
    </header>
    <form method="post" action="dataBaseForm.php"><h4>Zamawiam tutorial z języka:</h4><p>
        <table>
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
                        <option value="Polska" selected="selected">Polska</option>
                        <option value="Wielka Brytania">Wielka Brytania</option>
                        <option value="Niemcy">Niemcy</option>
                        <option value="Czechy">Czechy</option>
                    </select><label for="kraj"></label>
                </td>
            </tr>
            <tr> <td>Adres e-mail: </td>
                <td><input name="email" size ="30" id="email"/><label for="email"></label></td>
                <td id="email_error" class="czerwone"></td>
            </tr>
        </table><p>
            <?php
            /**
             *  Pętla do wyświetlenia checkboxów w formularzu dla tablicy asocjacyjnej $langs
             */
            $langs = ['CPP', 'Java', 'PHP'];
            foreach ($langs as $value) {
                echo '<input name="langs[' . $value . ']" type="checkbox" id="' . $value. '"
                             value="' . $value  . '"/><label for="' . $value . '">' . $value . '</label>    ';
            }
            ?>
            <span id="produkt_error" class="czerwone"></span></p>
        <h4>Sposób zapłaty:</h4>
        <p>
            <input name="payment" id="card" type="radio" value="Master Card"/><label for="card">Master Card</label>
            <input name="payment" id="visa" type="radio" value= "Visa"/><label for="visa">Visa</label>
            <input name="payment" id="przelew" type="radio" value="Przelew"/><label for="przelew">Przelew</label><br/>
            <span id="zaplata_error" class="czerwone"></span><br>
            <input type="reset" value="Wyczyść"/>
            <input type="submit" name="submit" value="Zapisz"/>
            <input type="submit" name="submit" value="Pokaz"/>
            <input type="submit" name="submit" value="PHP"/>
            <input type="submit" name="submit" value="CPP"/>
            <input type="submit" name="submit" value="Java"/>
        </p>
    </form>

    <?php
    include_once "../classes/dataBaseMysqli.php";
    include_once "../classes/dataBasePDO.php";
    include_once "../functions.php";

    $dataBase = new \classes\dataBaseMysqli("localhost", "root", "", "97765");
//    $dataBase = new \classes\dataBasePDO("mysql:dbname=97765;host=127.0.0.1", "root", "");
    if (filter_input(INPUT_POST, "submit")) {
        $action = filter_input(INPUT_POST, "submit");
        switch ($action){
            case "Zapisz": addClientRecord($dataBase); break;
            case "Pokaz": echo $dataBase->select("SELECT * FROM klienci", ["Nazwisko", "Panstwo" ,"Email", "Zamowienie"]); break;
            case "PHP": echo $dataBase->select("SELECT * FROM klienci WHERE Zamowienie LIKE '%PHP%'", ["Nazwisko", "Email","Zamowienie"]); break;
            case "CPP": echo $dataBase->select("SELECT * FROM klienci WHERE Zamowienie LIKE '%CPP%'", ["Nazwisko", "Panstwo","Zamowienie"]); break;
            case "Java": echo $dataBase->select("SELECT * FROM klienci WHERE Zamowienie LIKE '%Java%'", ["Nazwisko", "Platnosc","Zamowienie"]); break;
            case 'delete':
                if(filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT)){
                    $id = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);
                    if($dataBase->delete("klienci", "Id", $id)){
                        echo "<h2>Użytkownik został usunięty</h2><br>";
                    } else {
                        echo "<div>Wystąpił błąd podczas usuwania użytkownika</div><br>";
                    }
                    echo  $dataBase->select("SELECT * FROM klienci", ["Nazwisko", "Panstwo" ,"Email", "Zamowienie"]);
                } else {
                    echo "<h2>Niepoprawne id uzytkownika!</h2>";
                }
                break;
            default: echo "<script>alert('Niepoprawa opcja z przycisku!')</script>";
        }
        $_POST['submit'] = '';
    }
    ?>
</body>
</html>