<!DOCTYPE html>
<html lang="pl-PL">
<head>
    <meta charset="UTF-8">
    <title>PAI LAB php</title>
</head>
    <body>
        <?php
            //echo "<img src='src/thumbnails/obraz1.JPG' alt='obraz1' /><br/><br/>";
            function galery($rows, $cols) {
                $counter=2;
                echo "<table><caption>GALERIA ZDJĘĆ</caption>";
                for($i=0; $i<$rows; $i++){
                    echo "<tr>";
                    for($j=0; $j<$cols; $j++){
                        echo "<td><img src='src/thumbnails/obraz$counter.JPG' alt='obraz$counter' />";
                        $counter++;
                        echo "<td>";
                    }
                    echo "</tr>";
                }
                echo "</table>";
            }
            galery(3,3);
        ?>
    <a href="index.php">STRONA GŁÓWNA</a>
    </body>
</html>