<?php 

class JobModel{
    
    function postJob(
    $connection, $user_id, $category_id, $location_id, $title, $description, $requirements, $benefits, $vacancies, $deadline, 
    $skills, $job_type, $workplace, $salary_min, $salary_max, $status )
    {
        $sql = "INSERT INTO jobs (user_id, category_id, location_id, title, description, requirements, benefits, vacancies, deadline, 
            skills, job_type, workplace, min_salary, max_salary,status, created_at) 
            VALUES ( '$user_id', '$category_id', '$location_id', '$title', '$description', '$requirements', '$benefits', '$vacancies', 
            '$deadline', '$skills', '$job_type', '$workplace', '$salary_min', 
            '$salary_max', '$status', NOW() ) ";
            
        return $connection->query($sql); 
    }
}

?>