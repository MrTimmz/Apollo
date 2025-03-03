<?php

class Users extends Dbh
{
    public function getUsersById($user_id)
    {
        $stmt = $this->connect()->prepare('SELECT * FROM users WHERE user_id = ?');
        $stmt->execute([$user_id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getUser()
    {
        $sql = 'SELECT u.*, r.role_title FROM users u INNER JOIN roles r ON u.user_role = r.role_id WHERE user_deleted IS NULL';
        $stmt = $this->connect()->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function userExists($email)
    {
        $stmt = $this->connect()->prepare('SELECT * FROM users WHERE user_email = ?');
        $stmt->execute([$email]);
        return $stmt->rowCount() > 0;
    }

    protected function setUser($fname, $mname, $lname, $mail, $pass)
    {
        $stmt = $this->connect()->prepare('INSERT INTO users (user_fname, user_prefix, user_lname, user_email, user_password) VALUES (?, ?, ?, ?, ?)');
        $hashedPwd = password_hash($pass, PASSWORD_DEFAULT);
        return $stmt->execute([$fname, $mname, $lname, $mail, $hashedPwd]);
    }

    public function updateUser($user_id, $fname, $mname, $lname, $mail, $pass = null)
    {
        $query = "UPDATE users SET user_fname = ?, user_prefix = ?, user_lname = ?, user_email = ?";
        $params = [$fname, $mname, $lname, $mail];

        if ($pass !== null) {
            $query .= ", user_password = ?";
            $hashedPwd = password_hash($pass, PASSWORD_DEFAULT);
            $params[] = $hashedPwd;
        }

        $query .= " WHERE user_id = ?";
        $params[] = $user_id;

        $stmt = $this->connect()->prepare($query);
        return $stmt->execute($params);
    }

    public function registerUser($fname, $mname, $lname, $mail, $pass)
    {
        if ($this->userExists($mail)) {
            return false;
        }

        if ($this->setUser($fname, $mname, $lname, $mail, $pass)) {
            $verificationCode = bin2hex(random_bytes(16));
            $this->saveVerificationCode($mail, $verificationCode);
            $this->sendWelcomeEmail($mail, $fname, $verificationCode);
            return $verificationCode;
        }

        return false;
    }

    private function sendWelcomeEmail($email, $firstName, $verificationCode)
    {
        $to = $email;
        $subject = "Welcome to Our Service! Please Verify Your Email";
        $verificationLink = "http://www.localhost/apollo/_admin/verify.php?code=" . urlencode($verificationCode);

        $message = "<html><body>";
        $message .= "<p>Welcome, $firstName!</p>";
        $message .= "<p>Click the link below to verify your email:</p>";
        $message .= "<a href=\"$verificationLink\">Verify My Email</a>";
        $message .= "</body></html>";

        $headers = 'MIME-Version: 1.0' . "\r\n";
        $headers .= 'Content-type: text/html; charset=UTF-8' . "\r\n";
        $headers .= 'From: no-reply@apollocms.com' . "\r\n";

        return mail($to, $subject, $message, $headers);
    }

    public function saveVerificationCode($email, $code)
    {
        $stmt = $this->connect()->prepare("UPDATE users SET verification_code = ? WHERE user_email = ?");
        return $stmt->execute([$code, $email]);
    }

    public function verifyUser($email, $verificationCode)
    {
        $stmt = $this->connect()->prepare("SELECT * FROM users WHERE user_email = ? AND verification_code = ?");
        $stmt->execute([$email, $verificationCode]);

        if ($stmt->fetch(PDO::FETCH_ASSOC)) {
            $stmt = $this->connect()->prepare("UPDATE users SET user_verified = 1, user_role = 6 WHERE user_email = ?");
            return $stmt->execute([$email]);
        }

        return false;
    }

    public function deleteUser($id)
    {
        $stmt = $this->connect()->prepare('UPDATE users SET user_deleted = NOW() WHERE user_id = ?');
        return $stmt->execute([$id]);
    }

    public function trashUser($id)
    {
        $stmt = $this->connect()->prepare('DELETE FROM users WHERE user_id = ?');
        return $stmt->execute([$id]);
    }

    public function returnUser($id)
    {
        $stmt = $this->connect()->prepare('UPDATE users SET user_deleted = NULL WHERE user_id = ?');
        return $stmt->execute([$id]);
    }
}
