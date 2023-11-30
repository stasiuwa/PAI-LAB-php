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
        switch ($_POST['submit']){
            case 'register':
                $user=$form->checkUser();
                if($user === null) echo "<div>Niepoprawne dane rejestracji!</div>";
                else {
                    echo "<script>alert('ZAREJESTROWANO UŻYTKOWNIKA')</script>";
                    $user->saveToDataBase($dataBase);
                }
                break;
            case 'show':
                echo classes\User::getAllUsersFromDataBase($dataBase);
                break;
            case 'delete':
                if(filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT)){
                    $id = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);
                    if($dataBase->delete("users", "Id", $id)){
                        echo "<h2>Użytkownik został usunięty</h2><br>";
                    } else {
                        echo "<div>Wystąpił błąd podczas usuwania użytkownika</div><br>";
                    }
                    echo  classes\User::getAllUsersFromDataBase($dataBase) ;
                } else {
                    echo "<h2>Niepoprawne id uzytkownika!</h2>";
                }
                break;
            case 'clear':
                break;
            default:
                echo "Nieprawidłowe dane";
        }
    }
?>
    </body>
</html>


