<?php
/**Funkcja wyświetlająca wartość określonego $name z tablicy globalnej GET
 * @param $name string nazwa pola input formularza
 * @return string wartość przyporządkowana nazwie
 */
    function showData(string $name): string
    {

         //Bez sprawdzenia czy istnieje wartość o podanej nazwie ( isset() ) wywala błąd w przegladarce

        if(isset($_GET[$name]) && ($_GET[$name]!="")) return htmlspecialchars(trim($_GET[$name]));
        else return "brak danych !";

    //(isset($_GET[$name]) && ($_GET[$name]!="")) ? return htmlspecialchars(trim($_GET[$name])); : return "brak danych !"; czemu nie bangla?
    }
?>
<div>
    <h2>DANE KLIENTA: zadanie 2.4</h2>
    <h3><a href="index.php">strona główna</a></h3>
    <p>Nazwisko: <?php echo showData('surname')?> </p>
    <p>Wiek: <?php echo showData('age')?> </p>
    <p>Kraj: <?php echo showData('country')?> </p>
    <p>Adres Email: <?php echo showData('email')?> </p>
</div>
