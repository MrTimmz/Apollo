<?php

class newProjectContr extends Projects {
    private $projectname;
    private $projectnameseo;
    private $projectcontent;
    private $release;

    public function __construct($projectname, $projectnameseo, $projectcontent, $release) {
        $this->projectname = $projectname;
        $this->projectnameseo = $projectnameseo;
        $this->projectcontent = $projectcontent;
        $this->release = $release;
    }

    public function addNewproject() {
        // Logic to insert a new record into the database
        $this->setProject($this->projectname, $this->projectnameseo, $this->projectcontent, $this->release);
    }

    public function updateProject($project_id) {
        // Logic to update an existing record in the database
        $this->updateProjects($project_id, $this->projectname, $this->projectnameseo, $this->projectcontent, $this->release );
    }
}
