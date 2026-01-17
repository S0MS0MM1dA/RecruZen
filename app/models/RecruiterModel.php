<?php 
class RecruiterModel{
    function recruiterProfile(
        $connection, $user_id, $company_name, $company_email, $company_phone, $company_description, 
        $company_logo, $company_website, $company_location, $company_about){
        
        $sql = "INSERT INTO recruiter_profiles (user_id, company_name, company_email, company_phone, 
                company_description, company_logo, company_website, company_location, company_about)
                VALUES ('$user_id', '$company_name', '$company_email', '$company_phone', 
                '$company_description', '$company_logo', '$company_website', '$company_location', '$company_about')";
            
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
}
?>