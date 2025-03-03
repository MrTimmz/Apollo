<?php

//get instances using autoloader
include "../classes/dbh.classes.php";
include "../classes/invoice.classes.php";
include "../classes/invoice-contr.classes.php";

// Check if the form is submitted for adding a new Invoice
if (isset($_POST["submit"])) {
    $date = $_POST["invoice_date"];
    $duedate = $_POST["invoice_due_date"];

    $invoiceid = $_POST["invoice_refrence"];

    $invoiceclient = $_POST["id"];

    $service = $_POST["service_name"];
    $hours = $_POST["invoice_product_hour"];
    $price = $_POST["invoice_product_price"];
    $btw = $_POST["invoice_product_tax"];

    $worksubtotal = $_POST["invoice_product_sub"];

    $totaltax = $_POST["invoice_vat"];
    $subtotaal = $_POST["invoice_subtotal"];
    $total = $_POST["invoice_total"];

    $invoicecontent = $_POST["content"];

    //Instantiate Controller for adding a new Invoice
    $newinvoice = new newInvoiceContr($date, $duedate, $invoiceid, $invoiceclient, $service, $hours, $price, $btw, $worksubtotal, $subtotaal, $totaltax, $total, $invoicecontent);

    //Add a new Invoice
    $newinvoice->addnewInvoice();

    //Redirect after succes
    header("location: ../index.php?error=none");
    exit();
}

if (isset($_POST['update-invoice'])) {
    $date = $_POST["invoice_date"];
    $duedate = $_POST["invoice_due_date"];

    $invoiceid = $_POST["invoice_refrence"];

    $invoiceclient = $_POST["id"];

    $service = $_POST["service_name"];
    $hours = $_POST["invoice_product_hour"];
    $price = $_POST["invoice_product_price"];
    $btw = $_POST["invoice_product_tax"];

    $worksubtotal = $_POST["invoice_product_sub"];

    $totaltax = $_POST["invoice_vat"];
    $subtotaal = $_POST["invoice_subtotal"];
    $total = $_POST["invoice_total"];

    $service_id = $_POST['service_id'];

    $invoice_id = $_POST['invoice_id'];


    $invoicecontent = $_POST["content"];

    // Collect deleted services (adjust this based on how you track deleted rows)
    $deletedServices = $_POST['deleted_services'] ?? [];

    //Instantiate controller for updating the Invoice
    $updateInvoice = new newInvoiceContr($date, $duedate, $invoiceid, $invoiceclient, $service, $hours, $price, $btw, $worksubtotal, $subtotaal, $totaltax, $total, $invoicecontent, $service_id, $deletedServices);

    // Update the existing invoice
    $updateInvoice->updateInvoice($invoice_id);

    //redirect after succes
    header("location: ../index.php?update=succces");
    exit();
}
