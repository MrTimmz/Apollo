<?php

class newPageContr extends Pages {
    private $title;
    private $titleseo;
    private $pageheading;
    private $pageheadingseo;
    private $menuorder;
    private $pagecontent;
    private $seo_keywords;
    private $visibility;
    private $style;

    public function __construct($title, $titleseo, $pageheading, $pageheadingseo, $menuorder, $pagecontent, $seo_keywords, $visibility, $style) {
        $this->title = $title;
        $this->titleseo = $titleseo;
        $this->pageheading = $pageheading;
        $this->pageheadingseo = $pageheadingseo;
        $this->menuorder = $menuorder;
        $this->pagecontent = $pagecontent;
        $this->seo_keywords = $seo_keywords;
        $this->visibility = $visibility;
        $this->style = $style;
    }

    public function addNewPage() {
        // Logic to insert a new page into the database
        $this->setPage($this->title, $this->titleseo, $this->pageheading, $this->pageheadingseo, $this->menuorder, $this->pagecontent, $this->seo_keywords, $this->visibility, $this->style);
    }

    public function updatePage($menu_id) {
        // Logic to update an existing page in the database
        $this->updatePages($menu_id, $this->title, $this->titleseo, $this->pageheading, $this->pageheadingseo, $this->menuorder, $this->pagecontent, $this->seo_keywords, $this->visibility, $this->style);
    }
}
