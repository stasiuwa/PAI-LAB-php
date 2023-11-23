<div>
    <h2>FORMULARZ Z BAZĄ DANYCH 6.2</h2>
    <h3><a href="../index.php">powrót</a></h3>
    <body>
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
             *  Pętla do wyświetlenia checkboxów dla tablicy asocjacyjnej $langs
             */
            $langs = ['CPP', 'Java', 'PHP'];
            foreach ($langs as $value) {
                echo '<input name="langs[' . $value . ']" type="radio" id="' . $value. '"
                             value="' . $value  . '"/><label for="' . $value . '">' . $value . '</label>    ';
            }
            ?>
            <span id="produkt_error" class="czerwone"></span></p>
        <h4>Sposób zapłaty:</h4>
        <p>
            <input name="payment" id="card" type="radio" value="Master Card"/><label for="card">Master Card</label>
            <input name="payment" id="visa" type="radio" value= "Visa"/><label for="visa">visa</label>
            <input name="payment" id="przelew" type="radio" value="Przelew"/><label for="przelew">przelew</label><br/>
            <span id="zaplata_error" class="czerwone"></span><br>
            <input type="reset" value="Wyczyść"/>
            <input type="submit" name="submit" value="Zapisz"/>
            <input type="submit" name="submit" value="Pokaz"/>
            <input type="submit" name="submit" value="PHP"/>
            <input type="submit" name="submit" value="CPP"/>
            <input type="submit" name="submit" value="Java"/>
        </p>
    </form>
    </body>
    <?php
    include_once "../classes/dataBaseMysqli.php";
    include_once "../classes/dataBasePDO.php";
    include_once "../functions.php";

    $dataBase = new \classes\dataBaseMysqli("localhost", "milit", "123", "phpmyadmin");
//    $dataBase = new \classes\dataBasePDO("mysql:dbname=phpmyadmin;host=127.0.0.1", "milit", "123");
    if (filter_input(INPUT_POST, "submit")){
        $action = filter_input(INPUT_POST, "submit");
        switch ($action){
            case "Zapisz": addRecord($dataBase); break;
            case "Pokaz": echo $dataBase->select("SELECT * FROM klienci", ["Nazwisko", "Email", "Zamowienie"]); break;
            case "PHP": echo $dataBase->select("SELECT Nazwisko, Zamowienie FROM klienci WHERE Zamowienie='PHP'", ["Nazwisko","Zamowienie"]); break;
            case "CPP": echo $dataBase->select("SELECT Nazwisko, Zamowienie FROM klienci WHERE Zamowienie='CPP'", ["Nazwisko","Zamowienie"]); break;
            case "Java": echo $dataBase->select("SELECT Nazwisko, Zamowienie FROM klienci WHERE Zamowienie='Java'", ["Nazwisko","Zamowienie"]); break;
            default: echo "<p>error ? ? ? ?! !</p>";
        }
        $_POST['submit'] = '';
    }
    ?>
</div>
