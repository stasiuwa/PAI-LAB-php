<!DOCTYPE html>
<html lang="pl-PL">
<head>
    <meta charset="UTF-8">
    <title>PAI LAB php</title>
    <link rel="stylesheet" href="../src/styles.css">
</head>
<body>
<header>
    <h2>DANE Z FORMULARZA 2.2: </h2>
    <h3><a href="../index.php">powrót</a></h3>
</header>
<div>
        <?php
        /**
         *  Weryfikajca czy z żądaniem HTTP przesłano dane
         */
            if(isset($_REQUEST['langs']) && ($_REQUEST['langs']!="")) {
                /**
                 *  3 sposoby wyświetlenia wartości z tablicy langs[]
                 */
                echo "<p>a) foreach()<br/>Zamówiono tutorial z języka: ";
                foreach ($_REQUEST['langs'] as $key => $value) {
                    echo "$value ";
                }
                echo "</p><p>b.1) join()<br/>Zamówiono tutorial z języka: "
                . join(" , ",$_REQUEST['langs']);
                echo "</p><p>b.2) implode()<br/>Zamówiono tutorial z języka: "
                . implode(" - ",$_REQUEST['langs']);
                echo "</p><p> var_dump()<br/>";
                foreach ($_REQUEST['langs'] as $key => $value) echo "$key = $value \t" . var_dump($value) . "<br/>";
                echo "</p>";
            } else echo "<h5> ! nie przesłano danych !</h5>"
        ?>
</div>
</body>
</html>