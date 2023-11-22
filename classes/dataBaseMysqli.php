<?php

namespace classes;

class dataBaseMysqli
{
    private $mysqli;
    public function __construct($server, $user, $pass, $dataBase){
        $this->mysqli = new \mysqli($server, $user, $pass, $dataBase);
        // Sprawdz polaczenie z serwerem
        if($this->mysqli->connect_errno){
            printf("Nie udalo sie nawiazac polaczenia z serwerem %s\n", $this->mysqli->connect_error);
            exit();
        }
        //zmien kodowanie na utf8
        if($this->mysqli->set_charset("utf8")) {}
    }
    function __destruct() { $this->mysqli->close(); }

    /**Funkcja zwracająca wszystkie rekordy z tabeli bazy danych z określonych pól w tabeli
     * @param $sql string zapytanie SQL do bazy
     * @param $fields array nazwy pól w bazie danych
     * @return string
     */
    public function select($sql, $fields): string {
        $text="";
        if ($result=$this->mysqli->query($sql)){
            $text.="<table><tbody>";
            while ($row = $result->fetch_object()){
                // pętla obraca dopóki jest zwracana wartość z fetch_object() - wiersze z tabeli
                $text .= "<tr>";
                for ($i=0; $i<count($fields); $i++){
                    $f = $fields[$i];
                    $text .= "<td>" . $row->$f . "</td>";
                }
                $text .= "</tr>";
            }
            $text .= "</tbody></table>";
            $result->close();
        }
        return $text;
    }
    public function insert($sql){
        if( $this->mysqli->query($sql)) echo "<h4>DODANO DO BAZY DANYCH</h4>"; else echo "<h4>NIE DODANO DO BAZY DANYCH</h4>";
    }
    public function getMysqli(): \mysqli { return $this->mysqli; }

}