<?php

class newNewsContr extends News {
    private $articlename;
    private $articlenameseo;
    private $articlecontent;
    private $articlecontentseo;
    private $articleimage;
    private $articlestatus;
    private $articletype;
    private $articleproject;


    public function __construct($articlename, $articlenameseo, $articlecontent, $articlecontentseo, $articleimage, $articlestatus, $articleproject, $articletype) {
        $this->articlename = $articlename;
        $this->articlenameseo = $articlenameseo;
        $this->articlecontent = $articlecontent;
        $this->articlecontentseo = $articlecontentseo;
        $this->articleimage = $articleimage;
        $this->articlestatus = $articlestatus;
        $this->articleproject = $articleproject;
        $this->articletype = $articletype;
    }

    public function addnewNews(){
        // Logic to insert new record
        if (empty($this->articlename) || empty($this->articlenameseo) || empty($this->articlecontent)) {
            // You can also throw exceptions or return error messages
            echo "Title and content cannot be empty.";
            return;
        }

        // Call the setNews method from the parent class
        $this->setNews($this->articlename, $this->articlenameseo, $this->articlecontent, $this->articlecontentseo, $this->articleimage, $this->articlestatus, $this->articletype, $this->articleproject);
    }

    public function updateNews($news_id){
        // Logic to update an existing record
        if (empty($news_id) || empty($this->articlename) || empty($this->articlenameseo) || empty($this->articlecontent)) {
            echo "ID, title, and content cannot be empty.";
            return;
        }

        $this->updateNewsArticle($news_id, $this->articlename, $this->articlenameseo, $this->articlecontent, $this->articlecontentseo, $this->articleimage, $this->articlestatus, $this->articletype, $this->articleproject);
    }
}
