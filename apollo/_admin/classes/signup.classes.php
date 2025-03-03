<?php

class Signup extends Dbh {
    protected function setUser($uid, $pwd, $email) {
        // Use server-side validation to check for empty fields and format errors
        if (empty($uid) || empty($pwd) || empty($email)) {
            header("location: ../index.php?error=emptyfields");
            exit();
        }
        elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            header("location: ../index.php?error=invalidemail");
            exit();
        }
        elseif (!preg_match("/^[a-zA-Z0-9]*$/", $uid)) {
            header("location: ../index.php?error=invalidusername");
            exit();
        }
        // Use strong password requirements to check if password is secure
        elseif (!preg_match('/^(?=.*[A-Za-z])(?=.*\d)(?=.*[@$!%*#?&])[A-Za-z\d@$!%*#?&]{8,}$/', $pwd)) {
            header("location: ../index.php?error=weakpassword");
            exit();
        }

        // Check if email already exists to prevent duplicate accounts
        if (!$this->checkUser($email)) {
            header("location: ../index.php?error=emailtaken");
            exit();
        }
        // Implement CAPTCHA to prevent bots from registering

        // Insert user data into table
        $stmt = $this->connect()->prepare('INSERT INTO users ( `user_fname`, `users_pwd`, `users_email`) VALUES (?, ?, ?);');
        // Hash the password from plain text to random characters
        $hashedPwd = password_hash($pwd, PASSWORD_DEFAULT);

        // If insert fails, stop running code
        if (!$stmt->execute(array($uid, $hashedPwd, $email))) {
            $stmt = null;
            header("location: ../index.php?error=stmtinsertfailed");
            exit();
        }
        $stmt = null;
    }
    // Check if email already exists and give error
    protected function checkUser($email) {
        $stmt = $this->connect()->prepare('SELECT `users_email` FROM `users` WHERE `users_email` = ?');
        // If select fails, stop running code
        if (!$stmt->execute(array($email))) {
            $stmt = null;
            header("location: ../index.php?error=stmtselectfailed");
            exit();
        }
        // Check how many rows are returned from this query
        if ($stmt->rowCount() > 0) {
            $resultCheck = false;
        } else {
            $resultCheck = true;
        }
        return $resultCheck;
    }
}