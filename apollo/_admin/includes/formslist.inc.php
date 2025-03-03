<?php

if(isset ($_POST["submit"])) {
    //Grab data from users input

    $title = $_POST ["title"];
    $formparent = $_POST ["parent"];

    //get instances using autoloader
    include "../classes/dbh.classes.php";
    include "../classes/formslist.classes.php";
    include "../classes/formslist-contr.classes.php";

    $newformlist = new newformListContr ($title, $formparent);

    //run errors if we got any errors
    $newformlist->addnewformlist();

    //continue if there are no errors
    header("location: ../index.php?error=none");
}
