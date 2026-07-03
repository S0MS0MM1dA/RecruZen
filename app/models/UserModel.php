<?php

class UserModel{

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
}

?>