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
            $sql = "INSERT INTO jobs (user_id, category_id, location_id, title, description, requirements, benefits, vacancies, deadline, 
            skills, job_type, workplace, min_salary, max_salary,status, created_at) 
            VALUES ( '$user_id', '$category_id', '$location_id', '$title', '$description', '$requirements', '$benefits', '$vacancies', 
            '$deadline', '$skills', '$job_type', '$workplace', '$salary_min', 
            '$salary_max', '$status', NOW() ) ";
            
            $result = $connection->query($sql);
            return $result;
        }

    function getJob($connection, $job_id)
    {
        $sql = "SELECT j.*,
            c.name AS category_name,
            l.name AS location_name,
            r.company_name
            FROM jobs j
            JOIN categories c ON j.category_id = c.id
            JOIN locations l ON j.location_id = l.id
            JOIN recruiter_profiles r ON j.user_id = r.user_id
            WHERE j.id = $job_id AND j.status = 'published'
            LIMIT 1";

        $result = $connection->query($sql);
        if ($result && $result->num_rows > 0) {
            return $result->fetch_assoc();
        }

        return null;
    }

    function getAllJobs($connection)
    {
        $sql = "SELECT j.*,
            c.name AS category_name,
            l.name AS location_name,
            r.company_name
            FROM jobs j
            JOIN categories c ON j.category_id = c.id
            JOIN locations l ON j.location_id = l.id
            JOIN recruiter_profiles r ON j.user_id = r.user_id
            WHERE j.status = 'published'
            ORDER BY j.created_at DESC";

        $result = $connection->query($sql);
        $jobs = [];
        if ($result && $result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $jobs[] = $row;
            }
        }

        return $jobs;
    }



    function jobseekerProfile(
        $connection, $user_id, $phone, $address, $skills, $education, $experience, $resume, $profile_image)
        {
            $sql = "INSERT INTO jobseeker_profiles (user_id, phone, address, skills, 
            education, experience, resume, profile_image)
                    VALUES ('$user_id', '$phone', '$address', '$skills', '$education', 
                    '$experience', '$resume', '$profile_image')";
            
            return $connection->query($sql);
        }

    function getJobseekerProfile($connection, $user_id){
        $sql = "SELECT u.first_name,u.last_name, u.email, js.phone, js.address, js.skills, js.education, 
            js.experience, js.resume, js.profile_image 
            FROM users u
            LEFT JOIN jobseeker_profiles js ON u.id = js.user_id
            WHERE u.id = $user_id LIMIT 1;";
        
        $result = $connection->query($sql);

        if($result && $result->num_rows >0){
            return $result -> fetch_assoc();
        }
        else{
            return [];
        }
    }


    function recruiterProfile(
        $connection, $user_id, $company_name, $company_email, $company_phone, $company_description, 
        $company_logo, $company_website, $company_location, $company_about)
        {
            $sql = "INSERT INTO recruiter_profiles (user_id, company_name, company_email, company_phone, 
                    company_description, company_logo, company_website, company_location, company_about)
                    VALUES ('$user_id', '$company_name', '$company_email', '$company_phone', 
                    '$company_description', '$company_logo', '$company_website', '$company_location', '$company_about')
                    ON DUPLICATE KEY UPDATE
                    company_name = VALUES(company_name),
                    company_email = VALUES(company_email),
                    company_phone = VALUES(company_phone),
                    company_description = VALUES(company_description),
                    company_logo = VALUES(company_logo),
                    company_website = VALUES(company_website),
                    company_location = VALUES(company_location),
                    company_about = VALUES(company_about)";
            
            return $connection->query($sql);
        }

    function getRecruiterProfile($connection, $user_id){
        $sql = "SELECT * FROM recruiter_profiles WHERE user_id = user_id";
        $result = $connection->query($sql);

        if($result && $result->num_rows >0){
            return $result -> fetch_assoc();
        }
        else{
            return [];
        }
    }



    function closeConnection($connection){
        $connection->close();
    }
}

?>