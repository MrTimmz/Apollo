<?php

if (isset($_POST["submit"]))
{
    //Grab data from field list
    $uid        = $_POST["uid"];
    $pwd        = $_POST["pwd"];
    $pwdRepeat  = $_POST["pwdrepeat"];
    $email      = $_POST["email"];

    //instantiate signup controller class
    include "../classes/dbh.classes.php";
    include "../classes/signup.classes.php";
    include "../classes/signup-contr.classes.php";
    $signup = new SignupContr($uid, $pwd, $pwdRepeat, $email);

    //running error handlers and user signup
    $signup->signupUser();

    //going back to the frontpage
    header("location: ../index.php?error=none");
}