<?php 

class DatabaseConnection{

    function openConnection(){
        
        $db_host = "localhost";
        $db_user = "root";
        $db_password = "";
        $db_name = "recruzen";

        $connection  = new mysqli($db_host, $db_user, $db_password, $db_name);
        if($connection->connect_error){
            die("Could not connect database ".$connection->connect_error);
        }
        return $connection;
    }

    function signUp($connection, $name, $email, $password, $role){
        $sql = "
            INSERT INTO users (name, email, password, role, status)
            VALUES ('$name', '$email', '$password', '$role', 'active')
        ";
        $result = $connection->query($sql);
        return $result;
    }
    function signin($connection, $tableName, $email, $password){
        $sql = "
            SELECT id, name, email, role, status
            FROM users
            WHERE email='$email'
            AND password='$password'
            AND status='active'
            LIMIT 1
        ";
        $result = $connection->query($sql);
        return $result;
    }


    function closeConnection($connection){
        $connection->close();
    }
}

?>