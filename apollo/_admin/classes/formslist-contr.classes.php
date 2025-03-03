<?php

class newformListContr extends formsList {
    
    private $title;
    private $formparent;

    public function __construct($title, $formparent) {
        
        $this->title = $title;
        $this->formparent = $formparent;
    }

    

    public function addnewformList(){
        //check for empty fields that are required
        if($this->emptyInput() == false ){
            //echo error into url
            header("location: ../index.php?error=emptyinput");
        }

        $this->setformList ($this->title, $this->formparent);

    }

    //check if any input field is empty

    private function emptyInput(){
        if(empty($this->title)){
            $result = false;
        }
        else {
            $result = true;
        }
        return $result;
    }
    
}
