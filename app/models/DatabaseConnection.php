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

    function postJob(
        $connection, $user_id, $category_id, $location_id, $title, $description, $requirements, $benefits, $vacancies, $deadline, 
        $skills, $job_type, $workplace, $salary_min, $salary_max, $status )
        {
            $sql = " INSERT INTO jobs (user_id, category_id, location_id, title, description, requirements, benefits, vacancies, deadline, 
            skills, job_type, workplace, min_salary, max_salary,status, created_at) 
            VALUES ( '$user_id', '$category_id', '$location_id', '$title', '$description', '$requirements', '$benefits', '$vacancies', 
            '$deadline', '$skills', '$job_type', '$workplace', '$salary_min', 
            '$salary_max', '$status', NOW() ) ";
            
            return $connection->query($sql); 
        }

    function closeConnection($connection){
        $connection->close();
    }
}

?>