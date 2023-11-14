<?php

namespace classes;

class User
{
    const STATUS_USER = 1, STATUS_ADMIN=2;
    protected string $username, $password, $fullname, $email;
    protected int $status;
    protected \DateTime $date;

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

        $this->date = new \DateTime('now');
    }

    function show(): void {
        $date = $this->getDate()->format('Y-m-d');
        echo <<<_END
            Nazwa użytkownika: $this->username<br/>
            Hasło: $this->password<br/>
            Imie i nazwisko: $this->fullname<br/>
            Adres e-mail: $this->email<br/>
            Data utworzenia konta: $date<br/>
            Status: $this->status<br/>
        _END;
    }
    static function getAllUsersFromJSON($file): void {
        $allUsers = json_decode(file_get_contents($file));
        foreach ($allUsers as $value) {
            echo <<< _END
                <p>$value->username<br/>
                $value->fullname<br/>
                $value->date</p>
            _END;
        }
    }
    static function getAllUsersFromXML(): void { //ścieżka do pliku relatywna wobec wywołania w users.php
        $allUsers = simplexml_load_file('data/users.xml');
        echo "<ul>";
        foreach ($allUsers as $user):
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
            "date" => $this->date->format('Y-m-d'),
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
        $xmlCopy->addChild("date", $this->date->format('Y-m-d'));
        $xml->asXML($path);

    }
    public function getUserName(): string
    {
        return $this->username;
    }

    public function setUserName(string $username): void
    {
        $this->username = $username;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): void
    {
        $this->password = $password;
    }

    public function getFullName(): string
    {
        return $this->fullname;
    }

    public function setFullName(string $fullname): void
    {
        $this->fullname = $fullname;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    public function getDate(): \DateTime
    {
        return $this->date;
    }

    public function setDate(\DateTime $date): void
    {
        $this->date = $date;
    }

    public function getStatus(): int
    {
        return $this->status;
    }

    public function setStatus(int $status): void
    {
        $this->status = $status;
    }


}