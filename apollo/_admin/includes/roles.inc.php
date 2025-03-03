<?php

if (isset($_POST["submit"])) {
    //Grab data from users input

    $title = $_POST["title"];

    //get instances using autoloader
    include "../classes/dbh.classes.php";
    include "../classes/roles.classes.php";
    include "../classes/roles-contr.classes.php";

    $newRole = new RolesContr($title);

    //run errors if we got any errors
    $newRole->addnewRole();
}
