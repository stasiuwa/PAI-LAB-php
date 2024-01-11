<?php
require_once("classes/Strona.php");
$strona_akt = new Strona();

if(filter_input(INPUT_GET, 'strona')) {
    $strona = filter_input(INPUT_GET, 'strona');
    switch ($strona) {
        case 'galeria': $strona='galeria'; break;
        case 'formularz': $strona='formularz'; break;
        case 'onas': $strona='onas'; break;
        default: $strona='glowna';
    }
}
else { $strona="glowna"; }

$file = "scripts/" . $strona . ".php";
if(file_exists($file)) {
    require_once($file);
    $strona_akt->setTytul($tytul);
    $strona_akt->setZawartosc($zawartosc);
    $strona_akt->wyswietl();
}
