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

    function closeConnection($connection){
        $connection->close();
    }
}

?>