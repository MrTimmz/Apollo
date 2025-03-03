<?php

class newClientsContr extends Clients
{

    private $clientname;
    private $clientmail;

    private $clientphone;
    private $clientaddress;

    private $clienttown;
    private $clientprovince;
    private $clientzip;
    private $clientcountry;

    public function __construct($clientname, $clientmail, $clientphone, $clientaddress, $clienttown, $clientprovince, $clientzip, $clientcountry)
    {

        $this->clientname = $clientname;
        $this->clientmail = $clientmail;

        $this->clientphone = $clientphone;
        $this->clientaddress = $clientaddress;

        $this->clienttown = $clienttown;

        $this->clientprovince = $clientprovince;

        $this->clientzip = $clientzip;

        $this->clientcountry = $clientcountry;
    }



    public function addnewClient(){
        // lOGIC TO INSERT A NEW REOCRD INTO THE DATABASE
        $this->setClients($this->clientname, $this->clientmail, $this->clientphone, $this->clientaddress, $this->clienttown, $this->clientprovince, $this->clientzip, $this->clientcountry);
    }

    public function updateClient($client_id){
        //LOGIC TO UPDATE AN EXISTING RECORD IN THE DATABASE
        $this->updateClients($client_id, $this->clientname, $this->clientmail, $this->clientphone, $this->clientaddress, $this->clienttown, $this->clientprovince, $this->clientzip, $this->clientcountry);
    }
}
