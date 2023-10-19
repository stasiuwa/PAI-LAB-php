<div>
    <h2>DANE Z FORMULARZA: zadanie 2.2</h2>
    <h3><a href="index.php">powrót</a></h3>
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
            } else echo "<h4> ! nie przesłano danych !</h4>"
        ?>

</div>