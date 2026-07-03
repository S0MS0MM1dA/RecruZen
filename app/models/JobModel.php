<?php

class JobModel{

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

    function deleteJob($connection, $user_id, $job_id){
        $sql = "DELETE FROM jobs WHERE id = ? AND user_id = ?";
        $stmt = $connection->prepare($sql);
        $stmt->bind_param("ii", $job_id, $user_id);
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
}

?>