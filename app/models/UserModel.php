<?php 

class UserModel{
    function signUp($connection, $first_name, $last_name, $email, $password, $role){
        $sql = "
            INSERT INTO users (first_name, last_name, email, password, role, status)
            VALUES ('$first_name','$last_name', '$email', '$password', '$role', 'active')
        ";
        $result = $connection->query($sql);
        return $result;
    }
    function signin($connection, $email, $password){
        $sql = "
            SELECT id, first_name, last_name, email, role, status
            FROM users
            WHERE email='$email'
            AND password='$password'
            AND status='active'
            LIMIT 1
        ";
        $result = $connection->query($sql);
        return $result;
    }
}
?>