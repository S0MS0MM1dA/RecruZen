<?php

class JobSeekerModel{

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
                WHERE a.user_id = ?
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
            WHERE s.jobseeker_id = ?
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

    function countSavedJobs($connection, $user_id) {
        $sql = "SELECT COUNT(*) AS total 
            FROM saved_jobs 
            WHERE jobseeker_id = ?";
        $stmt = $connection->prepare($sql);
        $stmt->bind_param("i", $user_id);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc()['total'];
    }

    function removeSavedJob($connection, $user_id, $job_id) {
        $stmt = $connection->prepare("DELETE FROM saved_jobs WHERE jobseeker_id = ? AND job_id = ?");

        $stmt->bind_param("ii", $user_id, $job_id);
        return $stmt->execute();
    }
}

?>