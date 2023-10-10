<!DOCTYPE html>
<html lang="pl-PL">
<head>
    <meta charset="UTF-8">
    <title>PAI LAB php</title>
</head>
    <body>
    <?php
//    $type1 = 1234;
//    $type2 = 567.789;
//    $type3 = 1;
//    $type4 = 0;
//    $type5 = true;
//    $type6 = "0";
//    $type7 = "Typy w PHP";
//    $type8 = [1, 2, 3, 4];
//    $type9 = [];
//    $type10 = ["zielony", "czerwony", "niebieski"];
//    $type11 = ["Agata", "Agatowska", 4.67, true];
//    $type12 = DateTime::RFC822;
    $args = array(
        1234,                                   //0
        567.789,                                //1
        1,                                      //2
        0,                                      //3
        true,                                   //4
        "0",                                    //5
        "Typy w PHP",                           //6
        [1, 2, 3, 4],                           //7
        [],                                     //8
        ["zielony", "czerwony", "niebieski"],   //9
        ["Agata", "Agatowska", 4.67, true],     //10
        DateTime::RFC822,                       //11
    );
    function polecenieA($type) { echo ( is_array($type) ) ? "<br/>ilosc elementow:  " . count($type) : "<br/>  typ zmiennej:  " . gettype($type) . "  wartość:  $type"; }
    function polecenieB($type) {
        //echo "is_bool($type): " . is_bool($type); pokazuje "1" dla true i nic dla false
        echo "<br/>is_bool($type): "; var_dump(is_bool($type));
        echo "<br/>is_int($type): "; var_dump(is_int($type));
        echo "<br/>is_numeric($type): "; var_dump(is_numeric($type));
        echo "<br/>is_string($type): "; var_dump(is_string($type));
        echo "<br/>is_array($type): "; var_dump(is_array($type));
        echo "<br/>is_object($type): "; var_dump(is_object($type));
    }
    function polecenieC($arg1, $arg2){
        echo "<br/>$arg1 == $arg2  :  "; var_dump($arg1 == $arg2); //equal
        echo "<br/>$arg1 != $arg2  :  "; var_dump($arg1 != $arg2); //not equal
        echo "<br/>$arg1 <> $arg2  :  "; var_dump($arg1 <> $arg2); //not equal
        echo "<br/>$arg1 === $arg2  :  "; var_dump($arg1 === $arg2); //identical (compares types)
        echo "<br/>$arg1 !== $arg2  :  "; var_dump($arg1 !== $arg2); //not identical
        echo "<br/>$arg1 > $arg2  :  "; var_dump($arg1 > $arg2); //greater than
        echo "<br/>$arg1 < $arg2  :  "; var_dump($arg1 < $arg2); //less than
        echo "<br/>$arg1 >= $arg2  :  "; var_dump($arg1 >= $arg2); //greater than or eq
        echo "<br/>$arg1 <= $arg2  :  "; var_dump($arg1 <= $arg2); //less than or eq
        echo "<br/>$arg1 <=> $arg2  :  "; var_dump($arg1 <=> $arg2); //spaceship??
        //An int less than, equal to, or greater than zero when $a is less than, equal to, or greater than $b, respectively.
    }
    function polecenieD($arr){
        echo "ODCZYTYWANIE TABLIC <br/>print_r<br/>"; print_r($arr);
        echo "<br/><br/>ODCZYTYWANIE TABLIC <br/>var_dump<br/>"; var_dump($arr);
    }
    ?>
    <br/><br/>
    <a href="galeria.php">GALERIA</a>
    </body>
</html>