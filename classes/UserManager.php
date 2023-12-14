<?php

namespace classes;

class UserManager
{
    static function loginForm(): void {
        echo <<<_END
                <form method="post" action="processLogin.php" >   
                <h3 style="text-align: center">LOGOWANIE</h3>                
                    <table>
                        <tr>
                            <td><label for="username">Nazwa użytkownika: </label></td>
                            <td><input type="text" id="username" name="login"></td>
                        </tr>
                        <tr>
                            <td><label for="password">Hasło: </label></td>
                            <td><input type="password" id="password" name="passwd"></td>                            
                        </tr>                                                                           
                   </table>
                   <p style="width: 100%; text-align: right">
                        <input type="submit" name="submit" value="login">
                        <input type="reset" name="submit" value="clear">
                   </p>                                   
                </form>                
                <p>Nie masz konta? - <a href="users.php" style="color:goldenrod" >zarejestruj sie</a></p>              
        _END;
    }
    static function login(dataBaseMysqli $dataBase): int {
        $args = [
            'login' => FILTER_SANITIZE_ADD_SLASHES,
            'passwd' => FILTER_SANITIZE_ADD_SLASHES
        ];
        $data = filter_input_array(INPUT_POST, $args);
        $login = $data['login'];
        $passwd = $data['passwd'];
        $userId = $dataBase->selectUser($login, $passwd, "users");
        if($userId>=0) {
            session_start();
            $dataBase->delete("logged_in_users","userId",$userId);
            $date = new \DateTime("now");
            $date = $date->format("Y-m-d H:i:s");
            $sessionID = session_id();
            $sql = "INSERT INTO logged_in_users VALUES ('$sessionID', '$userId', '$date')";
            $dataBase->insert($sql);
        }
        return $userId;
    }

    static function logout(dataBaseMysqli $dataBase): void {
        session_start();
        $sessionID = session_id();
        if(isset( $_COOKIE[session_name()]) ) setcookie(session_name(),'', time() - 42000, '/');
        session_destroy();
        $dataBase->delete("logged_in_users", "sessionId", "'" . $sessionID . "'");
    }

    static public function getLoggedInUser(dataBaseMysqli $db, string $id){
        $sql = "SELECT userId FROM logged_in_users WHERE sessionId=$id";
        $base = $db->getMysqli();
        $result = $base->query($sql);
        if($result->num_rows == 1){
            $row = $result->fetch_object();
            return $row->userId;
        }
        return -1;
    }

}