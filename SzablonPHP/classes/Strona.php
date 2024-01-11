<?php

class Strona
{
    protected
        $zawartosc,
        $tytul = "Modułowy serwis PHP",
        $slowa_kluczowe = "narzedzia internetowe, php, formularz, galeria",
        $przyciski =
            array(
                "Kontakt" => "?strona=index",
                "Galeria" => "?strona=galeria",
                "Formularz" => "?strona=formularz",
                "O nas" => "?strona=onas"
            );

    /**
     * @param mixed $zawartosc
     */
    public function setZawartosc($zawartosc): void
    {
        $this->zawartosc = $zawartosc;
    }

    public function setTytul(string $tytul): void
    {
        $this->tytul = $tytul;
    }

    public function setSlowaKluczowe(string $slowa_kluczowe): void
    {
        $this->slowa_kluczowe = $slowa_kluczowe;
    }

    public function setPrzyciski(array $przyciski): void
    {
        $this->przyciski = $przyciski;
    }

    public function setStyle($url){
        echo '<link rel="stylesheet" href="' . $url . '" type="text/css"/>';
    }

    public function wyswietl(){
        $this->wyswietl_naglowek();
        $this->wyswietl_zawartosc();
        $this->wyswietl_stopke();
    }
    public function wyswietl_menu(){
        echo "<div id='nav'>";
        foreach ($this->przyciski as $nazwa => $url){
            echo '<a href="' . $url . '">' . $nazwa . '</a>';
        }
        echo "</div>";
    }
    public function wyswietl_naglowek(){
        ?>
        <!DOCTYPE html>
        <html>
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <?php
            $this->setStyle('src/css/style.css');
            echo "<title>" . $this->tytul . "</title></head><body>";
    }
    public function wyswietl_zawartosc() {
        echo "<div id='tresc'>";
        echo "<img src='src/img/foto.jpg' alt='foto'/></div>";
        echo "<div id='menu'>";
        $this->wyswietl_menu();
        echo "</div></div>";
        echo "<div id='main'>";
        echo "<h1>".$this->tytul."</h1>";
        echo $this->zawartosc . "</div>";
    }
    public function wyswietl_stopke() {
        echo '<div id="stopka"> &copy; BP </div>';
        echo '</body></html>';
    }
}