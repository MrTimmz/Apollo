<?php

if (isset($_POST["login"]))
{
    //Grab data from field list
    $name       = $_POST["name"];   
    $password   = $_POST["password"];
    $clientIp   = $_SERVER['REMOTE_ADDR']; // get the client's IP address

    //instantiate login controller class
    include "../classes/dbh.classes.php";
    include "../classes/login.classes.php";
    include "../classes/login-contr.classes.php";
    $login = new LoginContr($name, $password, $clientIp);

    //running error handlers and Admin signup
    $login->loginAdmin();
    if ($error) {
        echo "Error: " . $error;
    } else {
        header("location: ../index.php?error=none");
    }
}