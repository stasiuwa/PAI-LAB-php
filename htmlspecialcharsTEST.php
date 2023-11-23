<!DOCTYPE html>
<html lang="pl-PL">
<head>
    <meta charset="UTF-8">
    <title>PAI LAB php</title>
    <link rel="stylesheet" href="src/styles.css">
</head>
<body>
<header>
    <h2>htmlSpecialChars</h2>
    <h3><a href="index.php">strona główna</a></h3>
</header>
<?php
    //skrypt generuje formularz i jednoczesnie
    //odbiera dane z niego wysłane
    if (isset($_POST['tekst'])) //przesłano żądanie z parametrem 'tekst'
    { $tekst=htmlspecialchars(trim($_POST['tekst']));
        print "Wpisano: $tekst <br/>";
        print "<a href='htmlspecialcharsTEST.php'> Powrót do formularza</a>";
    }
    else //nie przesłano danych z formularza - w żądaniu nie
        //ma parametru o kluczu 'tekst' - wyswietl formularz
    { print "Podaj tekst :<form method='post' action='htmlspecialcharsTEST.php'>";
        print "<input type='text' name='tekst' size='30' />";
        print "<input type='submit' value='Wyślij' />";
        print "</form>";
    }
?>
</body>
</html>
