<?php

include "../classes/dbh.classes.php";
include "../classes/clients.classes.php";
include "../classes/clients-contr.classes.php";

// Check if the form is submitted for adding a new record
if (isset($_POST["submit"])) {
    $clientname = $_POST["name"];
    $clientmail = $_POST["email"];
    $clientphone = $_POST["phone"];
    $clientaddress = $_POST["address"];
    $clienttown = $_POST["town"];
    $clientprovince = $_POST["province"];
    $clientzip = $_POST["postal"];
    $clientcountry = $_POST["country"];

//Instantiea controller for adding new record
    $newclient = new newClientsContr($clientname, $clientmail, $clientphone, $clientaddress, $clienttown, $clientprovince, $clientzip, $clientcountry);
    //adda  new record
    $newclient->addnewClient();
// redirect after succes
    header("location: ../index.php?error=none");
    exit();
}

//check if the form is submitted for updating an existing record
if(isset($_POST['update-client'])){
    $client_id = $_POST["client_id"];
    $clientname = $_POST["name"];
    $clientmail = $_POST["email"];
    $clientphone = $_POST["phone"];
    $clientaddress = $_POST["address"];
    $clienttown = $_POST["town"];
    $clientprovince = $_POST["province"];
    $clientzip = $_POST["postal"];
    $clientcountry = $_POST["country"];

    //Instantiate controller for updating record
    $updateclient = new newClientsContr($clientname, $clientmail, $clientphone, $clientaddress, $clienttown, $clientprovince, $clientzip, $clientcountry);

    //update an existing record
    $updateclient->updateClient($client_id);

    //Redirect after succes
    header("location: ../index.php?update=success");
    exit();

}
