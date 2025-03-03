<?php

class Login extends Dbh {

    protected function getAdmin($name, $password, $clientIp){

        $stmt = $this->connect()->prepare("SELECT user_id, user_password, user_role, user_fname, login_attempts, last_login_attempt FROM users WHERE `user_fname` = ? OR `user_email` = ?");

        if(!$stmt->execute(array($name, $name))){
            $stmt = null;
            $_SESSION["error_message"] = "Statement execution failed";
            header("location: ../login.php");
            exit();
        }

        if($stmt->rowCount() == 0){
            $stmt = null;
            setcookie("error_message", "User not found", time()+3600, "/");
            header("location: ../login.php");
            exit();
        }

        $userData = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $passwordHashed = $userData[0]["user_password"];
        $loginAttempts = $userData[0]["login_attempts"];
        $lastLoginAttempt = $userData[0]["last_login_attempt"];

        // Check if there have been too many failed login attempts from this IP address
        if ($loginAttempts >= 10 && (time() - strtotime($lastLoginAttempt)) < 1800) {
            $stmt = null;
            $this->blockIp($clientIp);
            setcookie("error_message", "Too many login attempts. Your IP address has been blocked", time()+3600, "/");
            header("location: ../login.php");
            exit();
        }

        if(password_verify($password, $passwordHashed)){
            $userRole = $userData[0]["user_role"];
            if ($userRole == '5' || $userRole == '6') {
                $stmt = null;
                setcookie("error_message", "Your Accont isnt activated yet, or you dont have any Role assigned. Please contact the webmaster and adress this issue.", time()+3600, "/");
                header("location: ../login.php");
                exit();
            }
            else {
                session_start();
                $_SESSION["user_id"] = $userData[0]["user_id"];
                $_SESSION["user_fname"] = $userData[0]["user_fname"];
                $_SESSION["user_role"] = $userData[0]["user_role"];
                $stmt = null;

                // Reset the login attempts counter
                $this->resetLoginAttempts($userData[0]["user_id"]);

                header("location: ../index.php");
                exit();
            }
        }
        else {
            // Increment the login attempts counter and record the timestamp
            $this->incrementLoginAttempts($userData[0]["user_id"]);

            // Insert a new failed login attempt into the database
            $this->insertFailedLoginAttempt($clientIp, $name);

            $stmt = null;
            setcookie("error_message", "Incorrect password", time()+3600, "/");
            header("location: ../login.php");
            exit();
        }
    }

    private function incrementLoginAttempts($userId) {
        $stmt = $this->connect()->prepare("UPDATE users SET login_attempts = login_attempts + 1, last_login_attempt = NOW() WHERE user_id = ?");
        $stmt->execute([$userId]);
    }

    private function resetLoginAttempts($userId) {
        $stmt = $this->connect()->prepare("UPDATE users SET login_attempts = 0, last_login_attempt = NULL WHERE user_id = ?");
        $stmt->execute([$userId]);
    }

    private function insertFailedLoginAttempt($clientIp, $name) {
        $stmt = $this->connect()->prepare("INSERT INTO failed_login_attempts (ip_address, username, attempt_time) VALUES (?, ?, NOW())");
        $stmt->execute([$clientIp, $name]);
    }

    private function blockIp($ip) {
        $stmt = $this->connect()->prepare("INSERT INTO blocked_ips (ip_address, blocked_time) VALUES (?, NOW())");
        $stmt->execute([$ip]);
    }

    private function isIpBlocked($ip) {
        $stmt = $this->connect()->prepare("SELECT * FROM blocked_ips WHERE ip_address = ? AND blocked_time >= NOW() - INTERVAL 30 MINUTE");
        $stmt->execute([$ip]);
        return $stmt->rowCount() > 0;
    }
}