<?php

class Projects extends Dbh
{
    public function getProjects()
    {
        $stmt = $this->connect()->prepare('SELECT * FROM `projects` WHERE project_deleted IS NULL ORDER BY project_id');
        $stmt->execute();

        // Fetch all results into an associative array
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Return all results (not inside the loop)
        return $results;
    }

    public function getProjectsOverview()
    {
        $stmt = $this->connect()->prepare('SELECT * FROM `projects`  ORDER BY `project_id` ASC ');
        $stmt->execute();

        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

        foreach ($results as &$row) {


            $title = $row['project_name'];
            $row['project_name'] = substr($title, 0, 41);

            $content = $row['project_desc'];
            $desc = strip_tags($content);
            $row['desc'] = substr($desc, 0, 1500);
        }
        return $results;
    }

    public function getProjectContent()
    {
        if (isset($_GET['projects'])) {
            $projectid = $_GET['projects'];
        }

        $stmt = $this->connect()->prepare("SELECT * FROM `projects` WHERE `project_id` = '" . $projectid . "'");
        $stmt->execute();

        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $results;
    }
}
?>
