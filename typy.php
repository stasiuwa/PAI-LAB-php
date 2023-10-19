<!DOCTYPE html>
<html lang="pl-PL">
<head>
    <meta charset="UTF-8">
    <title>PAI LAB php</title>
</head>
    <body>
    <br/><br/>
    <h3><a href="index.php">powrót</a></h3>
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
    $type12 = new DateTime();
    $type12 = $type12->format("Y-m-d H:i:s");

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
        $type12                                 //11
    );
    $namesArray = array("integer1","double1","integer2","integer3","boolean1","string1(char)",
        "string2","arrayOfInt","emptyArray","arrayOfStrings","mixedArray","dateTimeObj"
    );
    function polecenieA($type) {
        echo ( is_array($type) ) ? "<br/><br/>ilosc elementow:  " . count($type) : "<br/><br/>  typ zmiennej:  " . gettype($type) . "  wartość:  $type";
    }
    function polecenieB($type, $name) {
        //( is_array($type) ) ? $name = "[" . implode(",",$type) . "]" : $name = $type;
        //echo "is_bool($type): " . is_bool($type); pokazuje "1" dla true i nic dla false
        echo "<br/>is_bool($name): "; var_dump(is_bool($type));
        echo "<br/>is_int($name): "; var_dump(is_int($type));
        echo "<br/>is_numeric($name): "; var_dump(is_numeric($type));
        echo "<br/>is_string($name): "; var_dump(is_string($type));
        echo "<br/>is_array($name): "; var_dump(is_array($type));
        echo "<br/>is_object($name): "; var_dump(is_object($type));
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
        echo "<br/><br/>ODCZYTYWANIE TABLIC <br/>print_r<br/>"; print_r($arr);
        echo "<br/><br/>ODCZYTYWANIE TABLIC <br/>var_dump<br/>"; var_dump($arr);
    }
    for ($i=0; $i<11; $i++){
        polecenieA($args[$i]);
        polecenieB($args[$i], $namesArray[$i]);
        if(is_array($args[$i])) { polecenieD($args[$i]); }
    }
    polecenieC(0,"0");

    ?>
    </body>
</html>