<?php

class imagesCategoryContr extends imagesCategory {
    
    private $title;
    private $titleseo;

    private $categoryorder;

    private $visibility;

    private $preview;
    private $images;

    public function __construct($title, $titleseo, $categoryorder, $visibility, $preview, $images) {
        
        $this->title = $title;
        $this->titleseo = $titleseo;

        $this->categoryorder = $categoryorder;

        $this->visibility = $visibility;

        $this->preview = $preview;
        $this->images = $images;
    }

    

    public function addimageCategory(){
        //check for empty fields that are required
        if($this->emptyInput() == false ){
            //echo error into url
            header("location: ../index.php?error=emptyinput");
        }
    
        $this->setCategory($this->title, $this->titleseo, $this->categoryorder, $this->visibility, $this->preview, $this->images);
    
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