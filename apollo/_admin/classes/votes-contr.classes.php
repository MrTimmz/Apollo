<?php

class neVoteContr extends Votes {

    private $fname;
    private $mname;
    private $lname;
    private $mail;
    private $pass;

    public function __construct($fname, $mname, $lname, $mail, $pass) {

        $this->fname = $fname;
        $this->mname = $mname;
        $this->lname = $lname;
        $this->mail = $mail;
        $this->pass = $pass;
    }

    public function addnewUser(){

        if($this->validateInput() === false ){
            header("location: ../index.php?error=invalidinput");
            exit();
        }

        $this->setUser ($this->fname, $this->mname, $this->lname, $this->mail, $this->pass);

        header("location: ../index.php?success=true");
        exit();
    }

    private function validateInput(){
        if(empty($this->fname) || empty($this->lname) || empty($this->mail) || empty($this->pass)){
            return false;
        }
        if(!filter_var($this->mail, FILTER_VALIDATE_EMAIL)){
            return false;
        }
        if(strlen($this->pass) < 8){
            return false;
        }
        //add any other validation rules here
        return true;
    }
}