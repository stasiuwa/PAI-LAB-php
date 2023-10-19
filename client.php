<?php
    function showData($name){
        /**
         * Bez sprawdzenia czy istnieje wartość o podanej nazwie ( isset() ) wywala błąd w przegladarce
         * dla email nie działa ????
         */
        if(isset($_GET[$name]) && ($_GET[$name]!="")) return htmlspecialchars(trim($_GET[$name]));
        else return "brak danych !";
    }
?>
<div>
    <h2>DANE KLIENTA: zadanie 2.4</h2>
    <h3><a href="index.php">powrót</a></h3>
    <p>Nazwisko: <?php echo showData('surname')?> </p>
    <p>Wiek: <?php echo showData('age')?> </p>
    <p>Kraj: <?php echo showData('country')?> </p>
    <p>Adres Email: <?php echo showData('email')?> </p>
</div>
