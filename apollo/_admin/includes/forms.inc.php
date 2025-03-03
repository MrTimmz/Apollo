<?php

if(isset ($_POST["submit"])) {
    //Grab data from users input

    $title = $_POST ["title"];
    $titleseo = $_POST ["titleseo"];

    $order = $_POST["order"];

    $visibility = $_POST["status"];

    //get instances using autoloader
    include "../classes/dbh.classes.php";
    include "../classes/forms.classes.php";
    include "../classes/forms-contr.classes.php";

    $newform = new newFormContr ($title, $titleseo, $order, $visibility);

    //run errors if we got any errors
    $newform->addnewForm();

    //continue if there are no errors
    header("location: ../index.php?error=none");
}
