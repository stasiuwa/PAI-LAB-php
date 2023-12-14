<?php
//if (isset($_GET['plik']))
//    include($_GET['plik'].'.txt');
// zabezpieczenie
if (isset($_GET['plik']))
{
    $plik=str_replace('\\','/',$_GET['plik']);
    $plik=str_replace('.','/',$plik);
    $filearr=explode('/',$plik);
    $plik=$filearr[count($filearr)-1];
    include($plik.'.txt');
}
else
    echo 'Nie podano pliku!';
?>