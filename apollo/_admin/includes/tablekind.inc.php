<?php

include "../classes/dbh.classes.php";
include "../classes/table.classes.php";
include "../classes/table-contr.classes.php";

//Check if the form is submmited for aadding a new record
if (isset($_POST["submit"])) {
    $kindof = $_POST['kindof'];

    //instantiate controller for adding a new record
    $newKind = new tableKindContr($kindof);

    //add a new record
    $newKind->addNewKindOf();

    //redirect after succes
    header("location: ../index.php?error=none");
    exit();

}
