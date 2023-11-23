<?php

namespace classes;

include_once "dataBaseMysqli.php";
class User
{
    const STATUS_USER = 1, STATUS_ADMIN=2;
    protected string $username, $password, $fullname, $email, $date;
    protected int $status;
    //protected \DateTime $date;

    /**
     * @param $username string nazwa użytkownika
     * @param $password string hasło
     * @param $fullname string imie i nazwisko
     * @param $email string email
     */
    public function __construct($username, $password, $fullname, $email)
    {
        $this->status=User::STATUS_USER;

        $this->username = $username;
        $this->password = password_hash($password, PASSWORD_DEFAULT);
        $this->fullname = $fullname;
        $this->email = $email;
        $date = new \DateTime('now');
        $this->date = $date->format('Y-m-d H:i:s');
    }

    function show(): void {
        //$date = $this->getDate()->format('Y-m-d');
        echo <<<_END
            <div>
            Nazwa użytkownika: $this->username<br/>
            Hasło: $this->password<br/>
            Imie i nazwisko: $this->fullname<br/>
            Adres e-mail: $this->email<br/>
            Data utworzenia konta: $this->date<br/>
            Status: $this->status<br/>
            </div>
        _END;
    }
    static function getAllUsersFromJSON($file): void {
        $allUsers = json_decode(file_get_contents($file));
        echo "<div>";
        foreach ($allUsers as $value) {
            echo <<< _END
                <p>$value->username<br/>
                $value->fullname<br/>
                $value->date</p>
            _END;
        }
        echo "</div>";
    }
    static function getAllUsersFromXML($path): void { //ścieżka do pliku relatywna wobec wywołania w users.php
        $file = simplexml_load_file($path);
        echo "<ul>";
        foreach ($file as $user):
            $userName=$user->userName;
            $date=$user->date;
            echo "<li>$userName, $date, itd... </li>";
        endforeach;
        echo "</ul>";
    }
    function toArray(): array {
        return [
            "username" => $this->username,
            "password" => $this->password,
            "fullname" => $this->fullname,
            "email" => $this->email,
            "date" => $this->date,  //->format('Y-m-d'),
            "status" => $this->status
        ];
    }
    function saveToJSON($file): void {
        $arr = json_decode(file_get_contents($file),true);
        array_push($arr,$this->toArray());
        file_put_contents($file, json_encode($arr));

    }
    function saveToXML(): void { //ścieżka do pliku relatywna wobec wywołania w users.php
        $path = 'data/users.xml';
        $xml = simplexml_load_file($path);
        $xmlCopy = $xml->addChild("user");
        $xmlCopy->addChild("userName", $this->username);
        $xmlCopy->addChild("email", $this->email);
        $xmlCopy->addChild("date", $this->date);    //->format('Y-m-d'));
        $xml->asXML($path);

    }
    //LAB 7
    function saveToDataBase($dataBase): void {
        if (true) {
            $sql =
                "INSERT INTO users VALUES (NULL, '" .
                $this->username . "', '" .
                $this->fullname . "', '" .
                $this->email . "', '" .
                $this->password . "', '" .
                $this->status . "', '" .
                $this->date . "')";
            $dataBase->insert($sql);
        } else {
            echo "<h2>DODAWANIE DO BAZY NIE POWIODLO SIE</h2>";
        }
    }
    static function getAllUsersFromDataBase($dataBase): string {
        return $dataBase->select('SELECT username, date FROM users' ,["username", "date"]);
    }

}