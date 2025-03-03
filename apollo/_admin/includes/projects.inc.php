<?php

include "../classes/dbh.classes.php";
include "../classes/projects.classes.php";
include "../classes/projects-contr.classes.php";
include "../functions/functions.php";

// Check if the form is submitted for adding a new record
if (isset($_POST["submit"])) {
    $projectname = $_POST["projectname"];
    $projectnameseo = $_POST["projectnameseo"];
    $projectcontent = $_POST["projectcontent"];
    $release = $_POST["release"];

    // Instantiate controller for adding a new record
    $newproject = new newProjectContr($projectname, $projectnameseo, $projectcontent, $release);

    // Add a new record
    $newproject->addNewProject();

    // Redirect after success
    header("location: ../index.php?error=none");
    exit();
}

// Check if the form is submitted for updating an existing reocrd
if (isset($_POST["update-post"])) {
    $project_id = $_POST["project_id"];
    $projectname = $_POST["projectname"];
    $projectnameeseo = $_POST["projectnameseo"];
    $projectcontent = $_POST["projectcontent"];
    $release = $_POST["release"];

    // Instantiate controller for updating the record
    $updateproject = new newProjectContr($projectname, $projectnameseo, $projectcontent, $release);

    // Update an existing record
    $updateprojects->updateProjecte($project_id);

    // Redirect after success
    header("location: ../index.php?update=success");
    exit();
}
