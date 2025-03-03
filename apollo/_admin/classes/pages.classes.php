<?php

class Pages extends Dbh
{
    public function getPageById($menu_id)
    {
        // Fetch the page by ID
        $stmt = $this->connect()->prepare('SELECT * FROM menu WHERE menu_id = ?');
        $stmt->execute(array($menu_id));
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getPages()
    {
        $sql = 'SELECT * FROM menu WHERE menu_deleted IS NULL ORDER BY menu_order ASC ';
        $stmt = $this->connect()->query($sql);
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $results;
    }

    protected function setPage($title, $titleseo, $pageheading, $pageheadingseo, $menuorder, $pagecontent, $seo_keywords, $visibility, $style)
    {
        // Adjust the parameter order in the SQL statement and execute array
        $stmt = $this->connect()->prepare('INSERT INTO menu (`menu_title`, `menu_title_seo`, `menu_page_title`, `menu_page_title_seo`, `menu_order`, `menu_content`, `menu_content_seo`, `menu_status`, `menu_css`) VALUES (?, ? ,?, ?, ?, ?, ?, ?, ?);');

        if (!$stmt->execute(array($title, $titleseo, $pageheading, $pageheadingseo, $menuorder, $pagecontent, $seo_keywords, $visibility, $style))) {
            $stmt = null;
            exit();
        }
        $stmt = null;
    }


    public function updatePages($menu_id, $title, $titleseo, $pageheading, $pageheadingseo, $menuorder, $pagecontent, $seo_keywords, $visibility, $style)
    {
        $stmt = $this->connect()->prepare('UPDATE menu SET `menu_title` = ?, `menu_title_seo` = ?, `menu_page_title` = ?, `menu_page_title_seo` = ?, `menu_order` = ?, `menu_content` = ?, `menu_content_seo` = ?, `menu_status` = ?, `menu_css` = ? WHERE `menu_id` = ?');

        // Execute the update query
        if (!$stmt->execute(array($title, $titleseo, $pageheading, $pageheadingseo, $menuorder, $pagecontent, $seo_keywords, $visibility, $style, $menu_id))) {
            $stmt = null;
            exit();
        }
        $stmt = null;
        echo "<script>location.href='pages-overview.php';</script>";
    }

    public function getDeletedPages()
    {
        $sql = 'SELECT * FROM menu WHERE menu_deleted IS NOT NULL';
        $stmt = $this->connect()->query($sql);
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $results;
    }

    public function deletePage($menu_id)
    {
        $sql = 'UPDATE menu SET menu_deleted = NOW() WHERE menu_id = :id';
        $stmt = $this->connect()->prepare($sql);
        $stmt->bindParam(':id', $menu_id);
        $stmt->execute();

        echo "<script>location.href='pages-overview.php';</script>";
    }

    public function trashPage($id)
    {
        $sql = 'DELETE FROM menu  WHERE menu_id = :id';
        $stmt = $this->connect()->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();

        echo "<script>location.href='pages-deleted.php';</script>";
    }

    public function returnPage($id)
    {
        $sql = 'UPDATE menu SET menu_deleted = NULL WHERE menu_id = :id';
        $stmt = $this->connect()->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();

        echo "<script>location.href='pages-overview.php';</script>";
    }
}
