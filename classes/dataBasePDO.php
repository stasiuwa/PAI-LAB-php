<?php

namespace classes;

class dataBasePDO
{
    private $dataBaseHook;
    public function __construct($server, $user, $pass) {
        try {
            $this->dataBaseHook = new \PDO($server, $user, $pass, [\PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"]);
        } catch (\PDOException $e) {
            print "ERROR!: " . $e->getMessage() . "<br/>"; die();
        }
    }

    function __destruct() {
        $this->dataBaseHook=null;
    }

    /**Funkcja realizuje zapytanie na bazie danych i wyświetla wyniki zaptania w pętli
     * @param $sql string zapytanie SQL
     * @return void
     */
    public function select($sql) {
        foreach ($this->dataBaseHook->query($sql) as $row) {
            print_r($row);
            echo "<br/>";
        }
    }

}