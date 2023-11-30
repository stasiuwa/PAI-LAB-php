<?php

namespace classes;

class dataBaseMysqli {
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
     * @param $fields array nazwy pól w bazie danych ( kolejność nie musi byc taka jak kolumn w bazie danych)
     * @return string
     */
    public function select($sql, $params): string{
        $html = "";
        if($result = $this->mysqli->query($sql)){
            $count = count($params);
            while($row = $result->fetch_object()){
                $field = $params[0];
                $id = $row->$field;
                $html .= "<tr>";
                for($i=0; $i<$count; $i++){
                    $field = $params[$i];
                    $html .= "<td>" . $row->$field . "</td>";
                }
                $html .= "<td><form action='users.php' method='post'>" .
                    "<input type='hidden' name='id' value='$id'>" .
                    "<input type='submit' name='submit' value='delete'>" .
                    "</form></td>";
                $html .= "</tr>";
            }
            $html .= "</tbody></table>";
            $result->close();
        }

        return $html;
    }
    public function insert($sql): bool{
        if( $this->mysqli->query($sql)) {
            echo "<h4>DODANO REKORD DO BAZY DANYCH</h4>";
            return true;
        }
        else {
            echo "<h4>NIE UDALO SIE DODAC REKORDU DO BAZY DANYCH</h4>";
            return false;
        }
    }
    public function delete(string $table, string $condition, string $value): bool{
        $sql = "DELETE FROM " .  $table . " WHERE " . $condition . "=" . $value . ";";
        if($this->mysqli->query($sql)) return true; else return false;
    }

    public function update(string $table, string $column, string $new_value, string $condition, string $value): bool{
        $sql = "UPDATE $table SET $column='$new_value' WHERE $condition='$value'";
        if($this->mysqli->query($sql)) return true; else return false;
    }

    public function getMysqli(): \mysqli { return $this->mysqli; }

}