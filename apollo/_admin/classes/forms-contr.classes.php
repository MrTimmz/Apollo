<?php

class newformListContr extends formList {
    
    private $title;
    private $titleseo;

    private $order;

    private $visibility;

    public function __construct($title, $titleseo, $order, $visibility) {
        
        $this->title = $title;
        $this->titleseo = $titleseo;

        $this->order = $order;

        $this->visibility = $visibility;
    }

    

    public function addnewformList(){
        //check for empty fields that are required
        if($this->emptyInput() == false ){
            //echo error into url
            header("location: ../index.php?error=emptyinput");
        }

        $this->setformList ($this->title, $this->titleseo, $this->order, $this->visibility);

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
