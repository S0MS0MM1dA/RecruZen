<?php 
class JobSeekerModel{
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

}
?>