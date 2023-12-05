<!DOCTYPE html>
<html lang="pl-PL">
<head>
    <meta charset="UTF-8">
    <title>PAI LAB php</title>
    <link rel="stylesheet" href="src/styles.css">
</head>
<body>
<header>
    <h2>SESJE TEST1</h2>
    <h3><a href="index.php">powrót</a> <a href="sessionTest2.php">TEST 2</a></h3>
</header>
<?php
    include "classes/User.php";
    include_once "functions.php";

    session_start();
    $user = new \classes\User("matikox69pl","matioxo","Sułtan Kosmitów", "bomba@to.gej");

    $user->show();
    $serializedUser = serialize($user);
    echo "<div><h6>Łańcuch po serializacji obiektu: </h6>$serializedUser</div>";
    $_SESSION['user'] = $serializedUser;
    echo
        '<div><h6>Wszystkie zmienne tablicy $_SESSION:</h6> ' . showArray($_SESSION) .
        '<h6>Wszystkie zmienne tablicy $_COOKIE:</h6> ' . showArray($_COOKIE) .
        "<h6>ID sesji =</h6> " . session_id() . "<br/></div>"

?>
</body>
