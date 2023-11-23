<?php
use classes\User, classes\RegistrationForm;

include "./classes/User.php";
include "./classes/RegistrationForm.php";
include "./classes/dataBaseMysqli.php";

$dataBase = new \classes\dataBaseMysqli("localhost", "milit", "123", "phpmyadmin");
?>

<!DOCTYPE html>
<html lang="pl-PL">
<head>
    <meta charset="UTF-8">
    <title>PAI LAB php</title>
</head>
    <body>
        <h3><a href="index.php">powrót</a></h3>
        <div><h4>UŻYTKOWNICY</h4>
            <?php
                echo "<h5>JSON</h5>";
                User::getAllUsersFromJSON("./data/users.json");
                echo "<h5>XML</h5>";
                User::getAllUsersFromXML("./data/users.xml");
                echo "<h5>Baza danych</h5>";
                User::getAllUsersFromDataBase($dataBase);
            ?>
        </div>
    </body>
</html>
<?php
    $user1 = new User ('koxMati69PL', 'jdpro', 'Kamil Zdun', 'kamilos@lol.xd');
    $user2 = new User ('Vanessa', 'zasilekplus', 'Iwan Bohun', 'odindwa@tri.by');
    $form = new RegistrationForm();
    if(filter_input(INPUT_POST, 'submit', FILTER_SANITIZE_FULL_SPECIAL_CHARS)) {
        $user = $form->checkUser();
        if($user === null) echo "<p>Niepoprawne dane rejestracji!</p>";
        else {
            echo "<p>Rejestracja zakońzcona pomyślnie.</p>";
            $user->show();
            $user->saveToJSON("./data/users.json");
            $user->saveToXML();
        }
    }


