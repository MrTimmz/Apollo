<?php

class loginContr extends Login {

    private $name;
    private $password;
    private $clientIp;

    public function __construct($name, $password, $clientIp) {
        $this->name = $name;
        $this->password = $password;
        $this->clientIp = $clientIp;
    }

    public function loginAdmin(){
        if($this->emptyInput() == false ){
            header("location: ../index.php?error=emptyinput");
            exit();
        }
        else {
            $this->getAdmin($this->name, $this->password, $this->clientIp);
        }
    }


        //check if any field is empty
    private function emptyInput(){
        if(empty($this->name) || empty($this->password)){
            $result = false;
        }
        else {
            $result = true;
        }

        return $result;
    }

}