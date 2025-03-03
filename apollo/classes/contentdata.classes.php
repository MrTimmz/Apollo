<?php

class contentData extends Dbh
{
    public function getContent()
    {

        if (!isset($_GET["page"])) {
            $page = "home";
        }

        else {
            $page = $_GET["page"];
        }

        $stmt = $this->connect()->prepare("SELECT * FROM `menu` WHERE `menu_title_seo` = '" . $page . "'");
        $stmt->execute();

        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $results;
    }
}
