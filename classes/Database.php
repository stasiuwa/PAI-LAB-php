<?php

namespace classes;

class Database
{
    private $mysqli; // uchwyt do bazy danych
    public function __construct($server, $user, $pass, $base) {
        $this->mysqli = new \mysqli($server, $user, $pass, $base);
        //sprawdz polaczenie
        if ($this->mysqli->connect_errno){
            printf("Nie udało się nawiązać połączenia z serwerem: %s\n", $this->mysqli->connect_errno);
            exit();
        }
        //zmien kodowanie na utf8
        if ($this->mysqli->set_charset("utf8")){} //udalo sie zmienic kodowanie

    }
    function __destruct() {
        $this->mysqli->close();
    }

    /**Funkcja do wyświetlania rekordów z bazy danych
     * @param $sql string łańcuch zapytania select
     * @param $field array tablica z nazwami pól w bazie
     * @return string kod HTML z tabeli z rekordami
     */
    public function select($sql, $fields): string {
        $site="";

        if ($result = $this->mysqli->query($sql)) {
            $countFields = count($fields); //ile pól
            $countRows = $result->num_rows; // ile wierszy
            $site = "<table><tbody>"; //otwarcie tabeli
            //pętla po wyniku zapytania $results
            while ($row = $result->fetch_object()){
                $site .= "<tr>";
                for ($i=0; $i<$countFields; $i++) {
                    $field = $fields[$i];
                    $site .= "<td>" . $row->$field . "</td>";
                }
                $site .= "</tr>";
            }
            $site .= "</tbody></table>"; // zamkniecie tabeli
            $result->close(); // zwolnienie pamieci
        }
        return $site;
    }
    public function insert($sql): bool {
        return $this->mysqli->query($sql);
    }
    public function delete($sql): bool
    {
        return $this->mysqli->query($sql);
    }
    public function getMysqli(): \mysqli
    {
        return $this->mysqli;
    }

}