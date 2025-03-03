<?php

class Projects extends Dbh
{
    public function getProjectById($project_id)
    {
        // Fetch the page by ID
        $stmt = $this->connect()->prepare('SELECT * FROM projects WHERE project_id = ?');
        $stmt->execute(array($project_id));
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getProjects()
    {
        $sql = 'SELECT * FROM projects WHERE project_deleted IS NULL ORDER BY project_logo ASC ';
        $stmt = $this->connect()->query($sql);
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $results;
    }




    protected function setProject($projectname, $projectnameseo, $projectcontent,  $release)
    {
        $stmt = $this->connect()->prepare('INSERT INTO projects ( `project_name`, `project_name_seo`, `project_desc`,  `project_release`) VALUES (?, ?, ?, ?);');

        if (!$stmt->execute(array($projectname, $projectnameseo, $projectcontent,  $release))) {
            $stmt = null;
            exit();
        }
        $stmt = null;
    }

    public function updateProjects($project_id, $projectname, $projectnameseo, $projectcontent,  $release)
    {
        $stmt = $this->connect()->prepare('UPDATE projects SET `project_name` = ?, `project_name_seo` = ?, `project_desc` = ?,  `project_release` = ? WHERE `project_id` = ?');

        // Execute the update query
        if (!$stmt->execute(array($projectname, $projectnameseo, $projectcontent,  $release, $project_id))) {
            $stmt = null;
            exit();
        }
        $stmt = null;
        echo "<script>location.href='pages-overview.php';</script>";
    }

    public function getDeletedProjects()
    {
        $sql = 'SELECT * FROM projects WHERE project_deleted IS NOT NULL';
        $stmt = $this->connect()->query($sql);
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $results;
    }

    public function deleteProject($project_id)
    {
        $sql = 'UPDATE projects SET project_deleted = NOW() WHERE project_id = :id';
        $stmt = $this->connect()->prepare($sql);
        $stmt->bindParam(':id', $project_id);
        $stmt->execute();

        echo "<script>location.href='pages-overview.php';</script>";
    }

    public function trashProject($id)
    {
        $sql = 'DELETE FROM projects  WHERE project_id = :id';
        $stmt = $this->connect()->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();

        echo "<script>location.href='pages-deleted.php';</script>";
    }

    public function returnProject($id)
    {
        $sql = 'UPDATE projects SET project_deleted = NULL WHERE project_id = :id';
        $stmt = $this->connect()->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();

        echo "<script>location.href='pages-overview.php';</script>";
    }
}
