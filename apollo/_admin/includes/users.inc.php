<?php

include "../classes/dbh.classes.php";
include "../classes/users.classes.php";
include "../classes/users-contr.classes.php";
include "../functions/functions.php";

// Check if the form is submitted for adding a new user
if (isset($_POST["submit"])) {
    $fname = $_POST['name'];
    $mname = $_POST['prefix'];
    $lname = $_POST['lastname'];
    $mail = $_POST['email'];
    $pass = $_POST['password'];
    $passrepeat = $_POST['passwordrpt'];

    // Ensure passwords match
    if ($pass !== $passrepeat) {
        // Redirect with error if passwords do not match
        header("Location: ../users.php?error=password_mismatch");
        exit();
    }

    // Create a new instance of UsersContr
    $newUser = new newUserContr($fname, $mname, $lname, $mail, $pass, $passrepeat);

    // Register the user
    $code = $newUser->addNewUser();

    if ($code) {
        // Redirect to the verification page with the code in the URL
        header("Location: ../verify.php");
        exit();
    } else {
        // Handle registration failure, perhaps redirect back to the form with an error message
        echo "Registration failed. Please try again.";
    }
}

// Check if the form is submitted for updating an existing user
if (isset($_POST["update-post"])) {
    $user_id = $_POST["menu_id"]; // Corrected from "user_id"
    $fname = $_POST["name"];
    $mname = $_POST["prefix"];
    $lname = $_POST["lastname"];
    $mail = $_POST["email"];

    // Initialize password variables
    $pass = isset($_POST["password"]) && !empty($_POST["password"]) ? $_POST["password"] : null;
    $passrepeat = isset($_POST["passwordrpt"]) && !empty($_POST["passwordrpt"]) ? $_POST["passwordrpt"] : null;

    // Check if passwords are provided and match
    if ($pass !== null && $pass !== $passrepeat) {
        // Redirect with error if passwords do not match
        header("Location: ../users.php?error=password_mismatch");
        exit();
    }

    // Create an instance of UsersContr
    $updateUser = new newUserContr($fname, $mname, $lname, $mail, $pass, $passrepeat);

    // Update an existing user
    $updateResult = $updateUser->updateUsers($user_id);

    if ($updateResult) {
        // Redirect after success
        header("Location: ../index.php?update=success");
    } else {
        // Handle error - Add appropriate error handling for update
        header("Location: ../index.php?error=update_failed");
    }
    exit();
}
