<?php

class activitylog extends Dbh {

    // Function to log user activity
    public function log_user_activity($username, $action, $link) {
        // Connect to the database
        $pdo = $this->connect();

        // Prepare and execute the query to insert user activity
        $sql = "INSERT INTO user_activity (username, action, link) VALUES (?, ?, ?)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$username, $action, $link]);
    }
}