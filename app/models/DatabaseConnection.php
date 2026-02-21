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

        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        $stmt = $connection->prepare("
            INSERT INTO users (first_name, last_name, email, password, role, status)
           VALUES (?, ?, ?, ?, ?, 'active')");
        $stmt->bind_param("sssss", $first_name, $last_name, $email, $hashed_password, $role);
        return $stmt->execute();
    }
    function signin($connection, $email){
        $stmt = $connection->prepare("
            SELECT id, first_name, last_name, email, password, role, status
            FROM users
            WHERE email=? AND status='active'
            LIMIT 1");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }

    function postJob(
        $connection, $user_id, $category_id, $location_id, $title, $description, $requirements, $benefits, $vacancies, $deadline, 
        $skills, $job_type, $workplace, $salary_min, $salary_max, $status )
        {
            $sql = "INSERT INTO jobs (user_id, category_id, location_id, title, description, requirements, benefits, vacancies, deadline, 
            skills, job_type, workplace, min_salary, max_salary,status, created_at) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, NOW())";
            $stmt = $connection->prepare($sql);
            $stmt->bind_param("iiissssisssiiis", $user_id, $category_id, $location_id, $title, $description, $requirements, $benefits, $vacancies, $deadline,
            $skills, $job_type, $workplace, $salary_min, $salary_max, $status);
            
            if (!$stmt->execute()) {
                error_log("Error posting job: " . $stmt->error);
                return false;
            }
            return true;
        }

    function getJob($connection, $job_id)
    {
        $sql = "SELECT j.*,
            c.name AS category_name,
            l.name AS location_name,
            r.company_name, r.company_logo
            FROM jobs j
            JOIN categories c ON j.category_id = c.id
            JOIN locations l ON j.location_id = l.id
            JOIN recruiter_profiles r ON j.user_id = r.user_id
            WHERE j.id = ? AND j.status = 'published'
            LIMIT 1";

        $stmt = $connection->prepare($sql);
        $stmt->bind_param("i", $job_id);
        $stmt->execute();
        $result = $stmt->get_result();

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
            r.company_name, r.company_logo
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
    function getRecruiterJobs($connection, $user_id)
    {
        $sql = "SELECT j.id, j.title, j.created_at, j.status,
            (SELECT COUNT(*) FROM job_applications a WHERE a.job_id = j.id) AS total_applicants
            FROM jobs j
            WHERE j.user_id = ?
            ORDER BY j.created_at DESC";

        $stmt = $connection->prepare($sql);
        $stmt->bind_param("i", $user_id);
        $stmt->execute();

        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }


    function jobseekerProfile(
        $connection, $user_id, $phone, $address, $skills, $education, $experience, $resume, $profile_image)
        {
            $sql = "INSERT INTO jobseeker_profiles (user_id, phone, address, skills, 
            education, experience, resume, profile_image)
                    VALUES (?, ?, ?, ?, ?, ?, ?, ?)
                    ON DUPLICATE KEY UPDATE
                    phone = ?,
                    address = ?,
                    skills = ?,
                    education = ?,
                    experience = ?,
                    resume = ?,
                    profile_image = ?";
            $stmt = $connection->prepare($sql);
            if (!$stmt) {
                die("Prepare failed: " . $connection->error);
            }
            $stmt->bind_param("issssssssssssss", $user_id, $phone, $address, $skills, 
                $education, $experience, $resume, $profile_image,
                $phone, $address, $skills, 
                $education, $experience, $resume, $profile_image);
            
            return $stmt->execute();
        }

    function getJobseekerProfile($connection, $user_id){
        $sql = "SELECT u.first_name,u.last_name, u.email, js.phone, js.address, js.skills, js.education, 
            js.experience, js.resume, js.profile_image 
            FROM users u
            LEFT JOIN jobseeker_profiles js ON u.id = js.user_id
            WHERE u.id = ? LIMIT 1;";
        
        $stmt = $connection->prepare($sql);
        $stmt->bind_param("i", $user_id);
        $stmt->execute();
        $result = $stmt->get_result();

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
            $sql = "INSERT INTO recruiter_profiles (
            user_id, company_name, company_email, company_phone, 
            company_description, company_logo, company_website, company_location, company_about)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)
            ON DUPLICATE KEY UPDATE
            company_name = ?,
            company_email = ?,
            company_phone = ?,
            company_description = ?,
            company_logo = ?,
            company_website = ?,
            company_location = ?,
            company_about = ?";

            
            $stmt = $connection->prepare($sql);
            if (!$stmt) {
            // Optional: helpful for debugging
                die("Prepare failed: " . $connection->error);
            }

            $stmt->bind_param("issssssssssssssss", $user_id, $company_name, $company_email, $company_phone,
                $company_description, $company_logo, $company_website, $company_location, $company_about, 
                $company_name, $company_email, $company_phone,$company_description, $company_logo, 
                $company_website, $company_location, $company_about);
            return $stmt->execute();

        }

    function getRecruiterProfile($connection, $user_id){
        $sql = "SELECT r.*, u.first_name,u.last_name 
        FROM recruiter_profiles r
        JOIN users u ON r.user_id = u.id
        WHERE r.user_id = ? LIMIT 1;";
        
        $stmt = $connection->prepare($sql);
        $stmt->bind_param("i", $user_id);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_assoc();
    }

    function jobApplication(
        $connection, $user_id, $job_id)
        {
            $sql = "INSERT INTO job_applications (user_id, job_id, status, applied_at) 
            VALUES (?, ?, 'pending', NOW())";
            $stmt = $connection->prepare($sql);
            $stmt->bind_param("ii", $user_id, $job_id);
            
            $result = $stmt->execute();
            return $result;
        }

    function getJobApplications($connection, $user_id){
       $sql = "SELECT a.*, j.title, r.company_name, a.applied_at, a.status 
                FROM job_applications a
                JOIN jobs j ON a.job_id = j.id
                JOIN recruiter_profiles r ON j.user_id = r.user_id
                WHERE a.user_id = $user_id
                ORDER BY a.applied_at DESC";

       $stmt = $connection->prepare($sql);
       $stmt->bind_param("i", $user_id);
       $stmt->execute();
       $result = $stmt->get_result();

       if($result && $result->num_rows >0){
           return $result -> fetch_all(MYSQLI_ASSOC);
       }
       else{
           return [ ];
       }
   }

   function savedJob($connection, $user_id, $job_id)
        {
            $sql = "INSERT INTO saved_jobs (job_id, jobseeker_id, saved_at) 
            VALUES(?, ?, NOW())";
            $stmt = $connection->prepare($sql);
            $stmt->bind_param("ii", $job_id, $user_id);
            
            $result = $stmt->execute();
            return $result;
        }

    function getSavedJob($connection, $user_id)
    {
        $sql = "SELECT j.*, r.company_name, r.company_logo
            FROM jobs j
            JOIN recruiter_profiles r ON j.user_id = r.user_id
            JOIN saved_jobs s ON j.id = s.job_id
            WHERE s.jobseeker_id = $user_id
            ORDER BY s.saved_at DESC";

        $stmt = $connection->prepare($sql);
        $stmt->bind_param("i", $user_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $jobs = [];
        if ($result && $result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $jobs[] = $row;
            }
        }

        return $jobs;
    }
    function getApplicants($connection, $user_id)
    {
        $sql = "SELECT u.first_name, u.last_name, u.email, js.resume, j.title AS job_title, a.applied_at
            FROM job_applications a
            JOIN users u ON a.user_id = u.id
            JOIN jobs j ON a.job_id = j.id
            LEFT JOIN jobseeker_profiles js ON u.id = js.user_id
            WHERE j.user_id = ?
            ORDER BY a.applied_at DESC";

        $stmt = $connection->prepare($sql);
        $stmt->bind_param("i", $user_id);
        $stmt->execute();

        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }


    function searchJobs($connection, $keyword, $location, $job_type, $min_salary, $max_salary){
        $sql = "SELECT j.*,
            c.name AS category_name,
            l.name AS location_name,
            r.company_name, r.company_logo
            FROM jobs j
            JOIN categories c ON j.category_id = c.id
            JOIN locations l ON j.location_id = l.id
            JOIN recruiter_profiles r ON j.user_id = r.user_id
            WHERE j.status = 'published'";

        $params = [];
        $types = "";

        if(!empty($keyword)){
            $sql .= " AND (j.title LIKE ? OR j.description LIKE ?)";
            $like_keyword = "%$keyword%";
            $params[] = $like_keyword;
            $params[] = $like_keyword;
            $types .= "ss";
        }
        if(!empty($location)){
            $sql .= " AND l.name LIKE ?";
            $like_location = "%$location%";
            $params[] = $like_location;
            $types .= "s";
        }
        if(!empty($job_type)){
            $sql .= " AND j.job_type = ?";
            $params[] = $job_type;
            $types .= "s";
        }
        if(!empty($min_salary)){
            $sql .= " AND j.min_salary >= ?";
            $params[] = $min_salary;
            $types .= "i";
        }
        if(!empty($max_salary)){
            $sql .= " AND j.max_salary <= ?";
            $params[] = $max_salary;
            $types .= "i";
        }

        $stmt = $connection->prepare($sql);      

        if(!empty($params)){
            $stmt->bind_param($types, ...$params);
        }
        
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }


    function countRecruiterJobs($connection, $user_id) {
        $sql = "SELECT COUNT(*) AS total FROM jobs WHERE user_id = ?";

        $stmt = $connection->prepare($sql);
        $stmt->bind_param("i", $user_id);
        $stmt->execute();
        
        $result = $stmt->get_result();
        return $result->fetch_assoc()['total'];
    }

    function countPendingJobs($connection, $user_id) {
    $sql = "SELECT COUNT(*) AS total 
            FROM jobs 
            WHERE user_id = ? AND status = 'pending'";

        $stmt = $connection->prepare($sql);
        $stmt->bind_param("i", $user_id);
        $stmt->execute();

        $result = $stmt->get_result();
        return $result->fetch_assoc()['total'];
    }

    function countActiveJobs($connection, $user_id) {
    $sql = "SELECT COUNT(*) AS total 
            FROM jobs 
            WHERE user_id = ? AND status = 'published'";

        $stmt = $connection->prepare($sql);
        $stmt->bind_param("i", $user_id);
        $stmt->execute();

        $result = $stmt->get_result();
        return $result->fetch_assoc()['total'];
    }

    function countTotalApplicants($connection, $user_id) {
        $sql = "SELECT COUNT(*) AS total
            FROM job_applications a
            JOIN jobs j ON a.job_id = j.id
            WHERE j.user_id = ?";

        $stmt = $connection->prepare($sql);
        $stmt->bind_param("i", $user_id);
        $stmt->execute();
        
        return $stmt->get_result()->fetch_assoc()['total'];
    }

    function countNewApplicants($connection, $user_id) {
        $sql = "SELECT COUNT(*) AS total
            FROM job_applications a
            JOIN jobs j ON a.job_id = j.id
            WHERE j.user_id = ?
            AND a.applied_at >= DATE_SUB(NOW(), INTERVAL 7 DAY)";
        $stmt = $connection->prepare($sql);
        $stmt->bind_param("i", $user_id);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc()['total'];
    }

    function deleteJob($connection, $user_id, $job_id){
        $sql = "DELETE FROM jobs WHERE id = ? AND user_id = ?";
        $stmt = $connection->prepare($sql);
        $stmt->bind_param("ii", $job_id, $user_id);
        return $stmt->execute();
    }

    function getAllUsers($connection){
        $sql = "SELECT id, first_name, last_name, email, role, status, created_at
                FROM users
                ORDER BY created_at DESC";

        $result = $connection->query($sql);
        $users = [];
        if ($result && $result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $users[] = $row;
            }
        }

        return $users;
    }
    function toggleUserStatus($connection, $user_id){
        $sql = "UPDATE users 
                SET status = CASE 
                    WHEN status = 'active' THEN 'blocked' 
                    ELSE 'active' 
                END 
                WHERE id = ?";
        
        $stmt = $connection->prepare($sql);
        $stmt->bind_param("i", $user_id);
        return $stmt->execute();
    }

    function getPendingJobs($connection){
        $sql = "SELECT j.id, j.title, j.description, j.created_at,
                   c.name AS category_name,
                   u.first_name, u.last_name
            FROM jobs j
            JOIN categories c ON j.category_id = c.id
            JOIN users u ON j.user_id = u.id
            WHERE j.status = 'pending'
            ORDER BY j.created_at DESC";

        return $connection->query($sql)->fetch_all(MYSQLI_ASSOC);
    }

    function getAllJobsAdmin($connection){
        $sql = "SELECT j.id, j.title, j.description, j.created_at, j.status,
                   c.name AS category_name,
                   u.first_name, u.last_name
            FROM jobs j
            JOIN categories c ON j.category_id = c.id
            JOIN users u ON j.user_id = u.id
            ORDER BY j.created_at DESC";

        return $connection->query($sql)->fetch_all(MYSQLI_ASSOC);
    }

    function updateJobStatus($connection, $job_id, $status){
        $sql = "UPDATE jobs SET status = ? WHERE id = ?";
        $stmt = $connection->prepare($sql);
        $stmt->bind_param("si", $status, $job_id);
        return $stmt->execute();
    }
    
    function getCategories($connection){
        $sql = "SELECT * FROM categories ORDER BY id DESC";
        return $connection->query($sql)->fetch_all(MYSQLI_ASSOC);
    }

    function addCategory($connection, $name){
        $stmt = $connection->prepare("INSERT INTO categories (name) VALUES (?)");
        $stmt->bind_param("s", $name);
        return $stmt->execute();
    }

    function deleteCategory($connection, $id){
        $stmt = $connection->prepare("DELETE FROM categories WHERE id = ?");
        $stmt->bind_param("i", $id);
        return $stmt->execute();
    }

    function getLocations($connection){
        $sql = "SELECT * FROM locations ORDER BY id DESC";
        return $connection->query($sql)->fetch_all(MYSQLI_ASSOC);
    }

    function addLocation($connection, $name){
        $stmt = $connection->prepare("INSERT INTO locations (name) VALUES (?)");
        $stmt->bind_param("s", $name);
        return $stmt->execute();
    }

    function deleteLocation($connection, $id){
        $stmt = $connection->prepare("DELETE FROM locations WHERE id = ?");
        $stmt->bind_param("i", $id);
        return $stmt->execute();
    }


    function countTotalUsers($connection){
        $sql = "SELECT COUNT(*) AS total FROM users";
        $result = $connection->query($sql);
        return $result->fetch_assoc()['total'];
    }

    function countJobseekers($connection){
        $sql = "SELECT COUNT(*) AS total FROM users WHERE role = 'jobseeker'";
        $result = $connection->query($sql);
        return $result->fetch_assoc()['total'];
    }

    function countRecruiters($connection){
        $sql = "SELECT COUNT(*) AS total FROM users WHERE role = 'recruiter'";
        $result = $connection->query($sql);
        return $result->fetch_assoc()['total'];
    }

    function countTotalJobs($connection){
        $sql = "SELECT COUNT(*) AS total FROM jobs";
        $result = $connection->query($sql);
        return $result->fetch_assoc()['total'];
    }

    function getRecentApplicationsAdmin($connection){
        $sql = "SELECT j.title,
                   r.company_name,
                   j.created_at AS posted_date,
                   j.status
            FROM jobs j
            JOIN recruiter_profiles r ON j.user_id = r.user_id
            ORDER BY j.created_at DESC
            LIMIT 5";

        $result = $connection->query($sql);
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    function countSavedJobs($connection, $user_id) {
    $sql = "SELECT COUNT(*) AS total 
            FROM saved_jobs 
            WHERE jobseeker_id = ?";
        $stmt = $connection->prepare($sql);
        $stmt->bind_param("i", $user_id);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc()['total'];
    }
    function removeSavedJob($conn, $user_id, $job_id) {
        $stmt = $conn->prepare("DELETE FROM saved_jobs WHERE jobseeker_id = ? AND job_id = ?");
        
        $stmt->bind_param("ii", $user_id, $job_id);
        return $stmt->execute();
    }


    function closeConnection($connection){
        $connection->close();
    }
}

?>