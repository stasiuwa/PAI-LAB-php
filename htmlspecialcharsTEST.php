<body>
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
{ print "Podaj tekst :<form method='post'
action='htmlspecialcharsTEST.php'>";
    print "<input type='text' name='tekst' size='30' />";
    print "<input type='submit' value='Wyślij' />";
    print "</form>";
}
?> </body>
