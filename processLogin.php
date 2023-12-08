<!DOCTYPE html>
<html lang="pl-PL">
    <head>
        <meta charset="UTF-8">
        <title>PAI LAB php</title>
        <link rel="stylesheet" href="src/styles.css">
    </head>
    <body>
    <header>
        <h2>FORMULARZ LOGOWANIA 8.1</h2>
        <h3><a href="index.php">powrót</a></h3>
    </header>
    <?php
        include_once "classes/dataBaseMysqli.php";
        include_once "classes/User.php";
        include_once "classes/UserManager.php";
        include_once "classes/RegistrationForm.php";

        $dataBase = new classes\dataBaseMysqli("localhost", "root", "", "97765");

        \classes\UserManager::loginForm();

        if (filter_input(INPUT_POST, "submit")) {
            switch ($_POST['submit']){
                case 'register':
                    header("location:processLogin.php");
                    $form = new classes\RegistrationForm();
                    $user=$form->checkUser();
                    if($user === null) echo "<div>Niepoprawne dane rejestracji!</div>";
                    else {
                        echo "<script>alert('ZAREJESTROWANO UŻYTKOWNIKA')</script>";
                        $user->saveToDataBase($dataBase);
                    }
                    break;
                case 'login':
                    $id = \classes\UserManager::login($dataBase);
                    if ($id == -1) {
                        echo "<div>Niepoprawne dane logowania!</div>";
                        \classes\UserManager::login($dataBase);
                    } else {
                        header("location:loggedIn.php");
                    }
                    break;
                case 'logout':
                    echo "To narazie";
                    \classes\UserManager::logout($dataBase);
                    break;
                default:
                    echo "Nieprawidłowe dane";
            }
        }
    ?>
    </body>
</html>
