<?php

class newSubpageContr extends Subpage {
    
    private $parent;

    private $subtitle;
    private $subtitleseo;

    private $subheading;
    private $subheadingseo;

    private $submenuorder;

    private $subpagecontent;

    private $visibility;

    public function __construct($parent, $subtitle, $subtitleseo, $subheading, $subheadingseo, $submenuorder, $subpagecontent, $visibility) {
        
        $this->parent = $parent;

        $this->subtitle = $subtitle;
        $this->subtitleseo = $subtitleseo;

        $this->subheading = $subheading;
        $this->subheadingseo = $subheadingseo;

        $this->submenuorder = $submenuorder;

        $this->subpagecontent = $subpagecontent;

        $this->visibility = $visibility;
    }

    

    public function addnewSubpage(){
        //check for empty fields that are required
        if($this->emptyInput() == false ){
            //echo error into url
            header("location: ../index.php?error=emptyinput");
        }

        $this->setSubpage ($this->parent, $this->subtitle, $this->subtitleseo, $this->subheading, $this->subheadingseo, $this->submenuorder, $this->subpagecontent, $this->visibility);

    }

    //check if any input field is empty

    private function emptyInput(){
        if(empty($this->subtitle)){
            $result = false;
        }
        else {
            $result = true;
        }
        return $result;
    }
    
}