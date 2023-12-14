<form action="css.php" method="post">
    <textarea name="tekst"></textarea><br />
    <input type="submit" name="wyslij" value="Wyślij" />
</form>
<div>
<?php
//atak typu cross-site scripting i html injection
    if (filter_input(INPUT_POST,'wyslij'))
//    echo htmlspecialchars($_POST['tekst']);
//    echo strip_tags($_POST['tekst']);
    echo filter_input(INPUT_POST, 'tekst', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

    ?>
</div>