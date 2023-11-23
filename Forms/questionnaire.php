<?php
include_once "../functions.php";
global $questionnaireData;
global $techs;
?>
<!DOCTYPE html>
<html lang="pl-PL">
<head>
    <meta charset="UTF-8">
    <title>PAI LAB php</title>
    <link rel="stylesheet" href="../src/styles.css">
</head>
<body>
    <header>
        <h2>ANKIETA</h2>
        <h3><a href="../index.php">powrót</a></h3>
    </header>

    <form method="post" action="questionnaire.php">
        <h4>Wybierz technologie, które znasz:</h4>
        <?php

            foreach ($techs as $tech) {
                echo '
                    <input name="techs[' . $tech . ']" type=checkbox id="' . $tech . '"
                        value="' . $tech . '"/><label for="' . $tech . '">' . $tech . '</label><br/>
                ';
            }
        ?><br/>
        <submitButtons>
            <input type="reset" value="Wyczyść"/>
            <input type="submit" name="submit" value="Przeslij"/>
            <input type="submit" name="submit" value="Wyniki"/>
        </submitButtons>
    </form>

<?php
    if (filter_input(INPUT_POST, "submit")) {
        $action = filter_input(INPUT_POST, "submit");
        switch ($action){
            case "Przeslij": sendQuestionnaireData(); break;
            case "Wyniki": show($questionnaireData); break;
            default: echo "<p>error ? ? ? ?! !</p>";
        }
        $_POST['submit'] = '';
    }
?>
</body>
</html>