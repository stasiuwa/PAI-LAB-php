<!DOCTYPE html>
<html lang="pl-PL">
<head>
    <meta charset="UTF-8">
    <title>PAI LAB php</title>
    <link rel="stylesheet" href="src/styles.css">
</head>
    <body>
    <header>
        <h2>UŻYTKOWNICY 7.2</h2>
        <h3><a href="index.php">powrót</a></h3>
    </header>

<?php
include_once "classes/dataBaseMysqli.php";
include_once "classes/RegistrationForm.php";
include_once "classes/User.php";

    $dataBase = new classes\dataBaseMysqli("localhost", "root", "", "97765");
    $form = new classes\RegistrationForm();

    if(filter_input(INPUT_POST, 'submit', FILTER_SANITIZE_FULL_SPECIAL_CHARS)) {
        $user = $form->checkUser();
        if($user === null) echo "<div>Niepoprawne dane rejestracji!</div>";
        else {
            echo "<script>alert('ZAREJESTROWANO UŻYTKOWNIKA')</script>";
            $user->show();
            $user->saveToDataBase($dataBase);
            echo "<div><h4>baza użytkowników</h4>" . classes\User::getAllUsersFromDataBase($dataBase) . "</div>";

        }
    }
?>
    </body>
</html>


