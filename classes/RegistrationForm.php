<?php

namespace classes;
include_once "User.php";
class RegistrationForm
{
    protected ?User $user;
    // po PHP 8.0 ? powoduje ze zmienna $user moze przyjmować wartości typu User i null

    /**
     * Formularz rejestracji w konstruktorze
     */
    public function __construct()
    { // action=users.php błąd o złej sciezce zignorowac poniewaz formularz jest wywolywany "z perspektywy" users.php
        echo <<<_END
            <div>
                <h3>REJESTRACJA UŻYTKOWNIKA</h3>
                <form method="post" action="users.php" >                   
                    <table>
                        <tr>
                            <td><label for="username">Nazwa użytkownika: </label></td>
                            <td><input type="text" id="username" name="username"></td>
                        </tr>
                        <tr>
                            <td><label for="password">Hasło: </label></td>
                            <td><input type="password" id="password" name="password"></td>                            
                        </tr>
                        <tr>
                            <td><label for="email">Adres E-mail: </label></td>
                            <td><input type="email" id="email" name="email"></td>                            
                        </tr>                      
                        <tr>
                            <td><label for="fullname">Imie i nazwisko: </label></td>
                            <td><input type="text" id="fullname" name="fullname"></td>                            
                        </tr>                       
                    </table>
                    <tr>
                        <input type="submit" name="submit" value="Zarejestruj się">
                        <input type="reset" name="submit" value="Anuluj">                     
                    </tr>
                </form>
            </div>
        _END;

    }

    /**Walidacja danych z formularza, jeśli poprawne ustawia pole klasy na wartości z formularza
     * jeśli niepoprawe, ustawia null i zwraca pole $user typu User
     * @return User
     */

    function checkUser(): User {

        $check = false;
        $args = [
            'username' =>  [
                'filter' => FILTER_VALIDATE_REGEXP,
                'options' => ['regexp' => '/^[0-9A-Za-ząęłńśćźżó_-]{2,25}$/']
            ],
            'password' => [
                'filter' => FILTER_VALIDATE_REGEXP,
                'options' => ['regexp' => '/.{6,25}/']
            ],
            'email' => FILTER_VALIDATE_EMAIL,
            'fullname' => [
                'filter' => FILTER_VALIDATE_REGEXP,
                'options' => ['regexp' => '/^[0-9A-Za-ząęłńśćźżóŁŻŹŚĆ_-]{2,25} [0-9A-Za-ząęłńśćźżóŁŻŹŚĆ_-]{2,25}/']
            ],
        ];
        //filtracja danych z POST zgodnie z $args
        $data = filter_input_array(INPUT_POST, $args);
        var_dump($data);
        $errors = "";

        foreach ($data as $key => $value) {
            if($value === false or $value === NULL) {
                $errors .= $key . ", ";
            }
        }
        if ($errors === "") {
            $this->user = new User($data['username'], $data['password'], $data['fullname'], $data['email']);
        } else {
            echo "<br/>Niepoprawne dane: " . $errors;
            $this->user = null;
        }
        return $this->user;
    }

}