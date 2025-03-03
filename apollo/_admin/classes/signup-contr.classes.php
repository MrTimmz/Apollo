<?php

class SignupContr extends Signup {
    
    private $uid;
    private $pwd;
    private $pwdRepeat;
    private $email;

    public function __construct($uid, $pwd, $pwdRepeat, $email) {
        $this->uid = $uid;
        $this->pwd = $pwd;
        $this->pwdRepeat = $pwdRepeat;
        $this->email = $email;
    }

    public function signupUser(){

            //check for any empty
        if($this->emptyInput() == false ){
            //echo empty input
            header("location: ../index.php?error=emptyinput");
            exit();
        }
            //check if the username is valid
        if($this->invalidUid() == false ){
            //echo invalid username
            header("location: ../index.php?error=username");
            exit();
        }
        if($this->lessthenInput() == false ){
            //echo empty input
            header("location: ../index.php?error=lessthen");
            exit();
        }
            //check if the email is valid
        if($this->invalidEmail() == false ){
            //echo invalid Email
            header("location: ../index.php?error=email");
            exit();
        }
            //check if password and password repeat are the same
        if($this->pwdMatch() == false ){
            //echo invalid password
            header("location: ../index.php?error=passwordmatch");
            exit();
        }
            //print error in url user name or email is taken
        if($this->uidTakenCheck() == false ){
            //echo invalid user or username incorrect
            header("location: ../index.php?error=usernameoremailtaken");
            exit();
        }

        $this->setUser($this->uid, $this->pwd, $this->email);
    }
    
        //check if any field is empty
    private function emptyInput(){
        
        if(empty($this->uid) || empty($this->pwd) || empty($this->pwdRepeat) || empty($this->email)){
            $result = false;
        }
        else {
            $result = true;
        }

        return $result;
    }

    private function lessthenInput(){
        
        if($this->pwd  < 8){
            $result = false;
        }
        else {
            $result = true;
        }

        return $result;
    }

        //make sure to use characters
    private function invalidUid(){
        
        if(!preg_match("/^[a-zA-Z0-9]*$/", $this->uid))
        {
            $result = false;
        }
        else {
            $result = true;
        }
        return $result;
    }
        //check if the email is valid
    private function invalidEmail(){
        
        if(!filter_var($this->email, FILTER_VALIDATE_EMAIL))
        {
            $result = false;
        }
        else {
            $result = true;
        }
        return $result;
    }
        //check if the password is the same as the repeat password field
    private function pwdMatch(){
        
        if($this->pwd !== $this->pwdRepeat)
        {
            $result = false;
        }
        else {
            $result = true;
        }
        return $result;
    }

        //check if the user id is already taken
    private function uidTakenCheck(){
        
        if(!$this->checkUser ($this->uid, $this->email))
        {
            $result = false;
        }
        else {
            $result = true;
        }
        return $result;
    }

}