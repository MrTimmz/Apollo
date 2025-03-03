<?php

class newInvoiceContr extends Invoice
{
    private $date;
    private $duedate;
    private $invoiceid;
    private $invoiceclient;

    private $service;
    private $hours;
    private $price;
    private $btw;
    private $worksubtotal;

    private $subtotaal;
    private $totaltax;
    private $total;

    private $invoicecontent;

    private $service_id;

    private $deletedServices;

    public function __construct($date, $duedate, $invoiceid, $invoiceclient, $service, $hours, $price, $btw, $worksubtotal, $subtotaal, $totaltax, $total, $invoicecontent, $service_id = null, $deletedServices = [])

    {
        $this->date = $date;
        $this->duedate = $duedate;
        $this->invoiceid = $invoiceid;
        $this->invoiceclient = $invoiceclient;
        $this->service = $service;
        $this->hours = $hours;
        $this->price = $price;
        $this->btw = $btw;
        $this->worksubtotal = $worksubtotal;
        $this->subtotaal = $subtotaal;
        $this->totaltax = $totaltax;
        $this->total = $total;
        $this->invoicecontent = $invoicecontent;
        $this->service_id = $service_id;
        $this->deletedServices = $deletedServices;
    }

    public function addnewInvoice()
    {
        // Logic to insert new record
        $this->setInvoice($this->date, $this->duedate, $this->invoiceid, $this->invoiceclient, $this->service, $this->hours, $this->price, $this->btw, $this->worksubtotal, $this->subtotaal, $this->totaltax, $this->total, $this->invoicecontent);
    }

    public function updateInvoice($invoice_id)
    {
        //logic to update excisting record
        $this->updateInvoices($invoice_id, $this->date, $this->duedate, $this->invoiceid, $this->invoiceclient, $this->service, $this->hours, $this->price, $this->btw, $this->worksubtotal, $this->subtotaal, $this->totaltax, $this->total, $this->invoicecontent, $this->service_id, $this->deletedServices);
    }
}
