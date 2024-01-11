<?php
global $form_langs;
$langs = ['CPP', 'Java', 'PHP'];
$form_langs="";
foreach ($langs as $value) {
    $form_langs .= '<input name="langs[' . $value . ']" type="checkbox" id="' . $value. '"
                             value="' . $value  . '"/><label for="' . $value . '">' . $value . '</label>    ';
}
function drukuj_form(): string {
    global $form_langs;
    return '<div id="tresc">
        <form action="?strona=formularz" method="POST">
        <h4>Zamawiam tutorial z języka:</h4><p>
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
        </table><p>' . $form_langs . '
          
            <span id="produkt_error" class="czerwone"></span></p>
        <h4>Sposób zapłaty:</h4>
        <p>
            <input name="payment" id="card" type="radio" value="Master Card"/><label for="card">Master Card</label>
            <input name="payment" id="visa" type="radio" value= "Visa"/><label for="visa">Visa</label>
            <input name="payment" id="przelew" type="radio" value="Przelew"/><label for="przelew">Przelew</label><br/>
            <span id="zaplata_error" class="czerwone"></span><br>
            <input type="reset" value="Wyczyść"/>
            <input type="submit" name="submit" value="Dodaj"/>
            <input type="submit" name="submit" value="Pokaż"/>
        </p>
    </form>
    ';
}
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

include_once "classes/Baza.php";
$tytul = "Formularz zamówienia";
$zawartosc = drukuj_form();
$bd = new classes\Database("localhost", "root", "", "97765");

if (filter_input(INPUT_POST, "submit")) {
    $akcja = filter_input(INPUT_POST, "submit");
    switch ($akcja) {
        case "Dodaj": addClientRecord($bd); break;
        case "Pokaż": $zawartosc .= $bd->select("SELECT * FROM klienci", ["Email", "Zamowienie"]); break;
    }
}
