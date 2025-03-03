<?php


// Check if the user is trying to access the login page while already logged in
if (isset($_SESSION["user_fname"]) && basename($_SERVER['PHP_SELF']) == 'login.php') {
    // Redirect them to a protected page (e.g., dashboard or home page)
    header("Location: index.php"); // Adjust this to where you want users to go after login
    exit();
}

// If the user is not logged in, redirect them to the login page
if (!isset($_SESSION["user_fname"])) {
    header("Location: login.php");
    exit();
}
?>
