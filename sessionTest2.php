<!DOCTYPE html>
<html lang="pl-PL">
<head>
    <meta charset="UTF-8">
    <title>PAI LAB php</title>
    <link rel="stylesheet" href="src/styles.css">
</head>
<body>
<header>
    <h2>SESJE TEST2</h2>
    <h3><a href="sessionTest1.php">powrót</a></h3>
</header>

    <?php
    include_once "functions.php";
    include "classes/User.php";

    session_start();

    if (isset($_SESSION['user'])) {
        $userFromSession = $_SESSION['user'];
        echo "<div><h6>Wartość elementu o kluczu 'user' z sesji:</h6> $userFromSession";
        $unserializedUser = unserialize($userFromSession);
        echo "</div><div><h6>Obiekt po odtworzeniu: </h6>";
        $unserializedUser->show();
        echo "</div>";
    }
    else echo "<div>BRAK OBIEKTU W SESJI</div>";

    echo "<div>";
    echo
        '<h6>Wszystkie zmienne tablicy $_SESSION:</h6> ' . showArray($_SESSION) .
        '<h6>Wszystkie zmienne tablicy $_COOKIE:</h6> ' . showArray($_COOKIE) .
        "<h6>ID sesji =</h6> " . session_id() . "<br/>";
    echo "</div>";
    /**
     * Jeśli pożądane jest zabicie sesji, należy usunąć także
     * ciasteczko sesyjne
     * Uwaga: poniższy kod usunie sesję, nie tylko dane sesji:
     */

    if ( isset($_COOKIE[session_name()]) ) {
        setcookie(session_name(),'', time() - 42000, '/');
    }
    session_destroy();
    ?>

</body>
