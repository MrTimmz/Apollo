<?php

if (isset($_POST["submit"])) {
    //Grab data from users input

    $companyname = $_POST["company"];
    $companystreet = $_POST["street"];

    $companyzipcode = $_POST["postal"];

    $companycity = $_POST["city"];

    $companyhandleregistry = $_POST["handle"];
    $companyvat = $_POST["vat"];
    $companybank = $_POST["bank"];

    //handle images
    $preview = $_FILES["image"]["name"];
    move_uploaded_file($_FILES["image"]["tmp_name"], "../../uploads/invoice/preview/" . $preview);

    // Handle image uploads
    $images = $_FILES["image"];
    $image_name = $images["name"];
    $image_tmp_name = $images["tmp_name"];
    move_uploaded_file($image_tmp_name, "../../uploads/invoice/images/" . $image_name);


    //get instances using autoloader
    include "../classes/dbh.classes.php";
    include "../classes/invoice.classes.php";
    include "../classes/invoice-handler-contr.classes.php";

    $invoiceSettings = new InvoiceSettingsContr($companyname, $companystreet, $companyzipcode, $companycity, $companyhandleregistry, $companyvat, $companybank, $preview, $images);

    //run errors if we got any errors
    $invoiceSettings->settingsInvoice();

    //continue if there are no errors
    header("location: ../index.php?error=none");
}
