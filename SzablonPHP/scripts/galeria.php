<?php

function galery($rows, $cols): string {
    $html="";
    $counter=2;
    $html .= "<table><caption>GALERIA ZDJĘĆ</caption>";
    for($i=0; $i<$rows; $i++){
        $html .= "<tr>";
        for($j=0; $j<$cols; $j++){
            $html .= "<td><img src='src/thumbnails/obraz$counter.JPG' alt='obraz$counter' />";
            $counter++;
        }
        $html .= "</tr>";
    }
    $html .= "</table>";
    return $html;
}


$tytul = "Galeria";
$zawartosc = galery(3,3);

