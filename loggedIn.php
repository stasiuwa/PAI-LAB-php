<?php
include_once "classes/dataBaseMysqli.php";
include_once "classes/User.php";
include_once "classes/UserManager.php";

$dataBase = new \classes\dataBaseMysqli("localhost", "root", "", "97765");

session_start();
$sessionID = "'" . session_id() . "'";
$userID = \classes\UserManager::getLoggedInUser($dataBase, $sessionID);

if($userID >= 0) {
    $html = "<div><table style='text-align: center; padding: 2% 0 0 2%'><tbody>"
            . $dataBase->select("SELECT * FROM users WHERE Id=$userID", ['Id', 'username', 'fullname', 'email', 'date']);
    echo <<< _END
        <!DOCTYPE html>
        <html lang="pl-PL">
        <head>
            <meta charset="UTF-8">
            <title>PAI LAB php</title>
            <link rel="stylesheet" href="src/styles.css">
        </head>
        <body>
            <header>
                <h2>ZALOGOWANY 8.2</h2>             
            </header>     
                <p>DANE UŻYTKOWNIKA:</p> $html
                <form method='POST' action='processLogin.php' style="text-align: center"><input type='submit' name='submit' value='logout'></form></div>                 
            </body>
        </html>
    _END;
}
else {
    echo "<div>chuj</div>";
//    header("location:processLogin.php");
}
