<div>
    <h2>DANE Z FORMULARZA: zadanie 2.3</h2>
    <h3><a href="index.php">powrót</a></h3>
    <?php
        $formDataCheckboxes = [
            'PHP' => 'php',
            'Java' => 'java',
            'C/C++' => 'c'
        ];
        /**
         * Sprawdzenie istnienia parametów w żądaniu HTTP dla formularza
         * @param $name string nazwa danych z formularza
         * @return mixed|string wartość danych z formularza | "brak danych"
         */
        function setValue($name){
            if (isset($_REQUEST[$name]) && ($_REQUEST)!="") return htmlspecialchars(trim($_REQUEST[$name]));
            else return "brak danych!";
        }

        /**
         * Sprawdzenie istnienia parametrów w żądaniu HTTP dla checkboxów z formularza
         * @param $arr array tablica asocjacyjna z wartościami i nazwami checkboxów z formularza
         * @return string konkatenacja wartości z checkboxów | "brak zamówienia"
         */
        function setLangs($arr){
            $temp = "";
            foreach ($arr as $key => $value) {
                if (isset($_REQUEST[$value]) && ($_REQUEST[$value])!=""){
                    $temp = $temp . $key . " ";
                }
            }
            if ($temp=="") $temp = "Nie złożono zamówienia na żaden język !";
            return $temp;
        }

    /**
     * Definicja zmiennych
     */
        $pay = setValue('payment');
        $surname = setValue('surname');
        $age = setValue('age');
        $country = setValue('country');
        $email = setValue('email');
        $langs = setLangs($formDataCheckboxes);

        if($pay=="") $pay="Nie wybrano formy płatności !";
    /**
     * Wyświetlenie informacji o zamowieniu i przekazanie danych o kliencie w łączu URL do pliku client.php
     */
        echo "<p>Zamówione kursy z języka: $langs <br/>Płatność: $pay</p>
            <a href='client.php?surname=$surname&age=$age&country=$country&email=$email'>Dane klienta</a>"
    ?>
</div>