<?php

class Functions extends Dbh {
    // Function to log user activity
    public function log_user_activity($action, $link, $edited_record = 'No') {
        // Ensure session is started outside this method
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        // Get the username from the session or set default
        $username = $_SESSION['user_fname'] ?? 'Unknown User';

        // Connect to the database
        $pdo = $this->connect();

        // Prepare and execute the query to insert user activity
        $sql = "INSERT INTO user_activity (username, action, link, edited_record) VALUES (?, ?, ?, ?)";
        $stmt = $pdo->prepare($sql);

        try {
            $stmt->execute([$username, $action, $link, $edited_record]);
        } catch (PDOException $e) {
            error_log("Error logging user activity: " . $e->getMessage());
            return false; // Indicate failure
        }

        // Delete older records if the total count exceeds 10
        $sqlDelete = "DELETE FROM user_activity WHERE id NOT IN (
            SELECT id FROM (
                SELECT id FROM user_activity ORDER BY activity_date DESC LIMIT 10
            ) AS latest_records
        )";
        try {
            $pdo->query($sqlDelete);
        } catch (PDOException $e) {
            error_log("Error deleting old user activity records: " . $e->getMessage());
        }

        return true; // Indicate success
    }
}

// Check if the form is submitted for inserting, editing, or deleting a record
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $action = '';
    $link = $_SERVER['PHP_SELF']; // Capture the current page URL dynamically

    // Replace .inc.php with .php in the URL
    $link = str_replace('.inc.php', '-overview.php', $link); // Replace .inc.php with .php

    // Remove 'includes/' from the link to avoid redirecting to the 'includes' folder
    $link = str_replace('includes/', '', $link); // This ensures only the file name remains

    if (isset($_POST["submit"])) {
        // Log the action for inserting a new record
        $action = 'Created a new record';

        // The $link will automatically capture the current page URL (e.g., news.php, users.php, etc.)
        // No need to set this manually; it will be dynamic based on the page where the form was submitted from.

    } elseif (isset($_POST["update-post"])) {
        // Log the action for editing an existing record
        $action = 'Edited an existing record';

        // Again, $link automatically captures the current page URL.
    } elseif (isset($_POST["submit_delete"])) {
        // Log the action for deleting a record
        $action = 'Deleted a record';

        // If necessary, we can still keep $link capturing the page where the delete happened.
    }

    // Only log if there's an action and link set
    if ($action && $link) {
        $log = new Functions();
        if (!$log->log_user_activity($action, $link)) {
            // Handle logging failure if needed
            error_log("Failed to log activity: " . $action);
        }
    }

    // After logging the action, you can redirect the user to the proper page.
    // For example, if a new record is created, redirect to pages.php?id=123
    if (isset($newRecordId)) {
        // Redirect to the new record's page, assuming $newRecordId is set after a record creation.
        header("Location: " . $link . "?id=" . $newRecordId);
        exit();
    } elseif (isset($recordId)) {
        // Redirect to the updated record's page
        header("Location: " . $link . "?id=" . $recordId);
        exit();
    }
}
?>

<?php
// A simple function to extract keywords from content
function extract_keywords($content) {
    // List of common words to ignore (stop words)
    $stop_words = ['the', 'and', 'is', 'in', 'at', 'for', 'on', 'with', 'a', 'an', 'of', 'to', 'that', 'by', 'this', 'it', 'as', 'be'];

    // Convert the content to lowercase and split it into words
    $words = preg_split('/\s+/', strtolower($content));

    // Filter out stop words and non-alphabetical words
    $filtered_words = array_filter($words, function($word) use ($stop_words) {
        return !in_array($word, $stop_words) && preg_match('/^[a-zA-Z]+$/', $word);
    });

    // Count frequency of each word
    $word_count = array_count_values($filtered_words);

    // Sort words by frequency (descending)
    arsort($word_count);

    // Get the top 5 most frequent words as the keywords
    $keywords = array_slice(array_keys($word_count), 0, 5);

    // Return the keywords as a comma-separated string
    return implode(', ', $keywords);
}
?>
