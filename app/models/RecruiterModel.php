<?php

class RecruiterModel{

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
}

?>