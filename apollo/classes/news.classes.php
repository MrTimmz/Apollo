<?php

class News extends Dbh
{
    public function getNewsMeta()
    {
        $stmt = $this->connect()->prepare('SELECT * FROM `news`  WHERE `news_status` = "Online" ORDER BY `news_id` DESC ');
        $stmt->execute();

        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

        foreach ($results as &$row) {

            $newsDate = strtotime($row["news_created"]);
            $row['day'] = date("d", $newsDate);
            $row['month'] = date("M", $newsDate);

            $title = $row['news_title'];
            $row['title'] = substr($title, 0, 41);

            $content = $row['news_content'];
            $limited_content = strip_tags($content);
            $row['limited_content'] = substr($limited_content, 0, 550);
        }
        return $results;
    }

    public function getNewsFP()
    {
        $stmt = $this->connect()->prepare('SELECT * FROM `news`  WHERE `news_status` = "Online" AND `news_deleted` IS NULL ORDER BY `news_id` DESC LIMIT 1 ');
        $stmt->execute();

        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

        foreach ($results as &$row) {

            $newsDate = strtotime($row["news_created"]);
            $row['day'] = date("d", $newsDate);
            $row['month'] = date("M", $newsDate);

            $title = $row['news_title'];
            $row['title'] = substr($title, 0, 41);

            $content = $row['news_content'];
            $limited_content = strip_tags($content);
            $row['limited_content'] = substr($limited_content, 0, 550);
        }
        return $results;
    }

    public function getNews_Featured()
    {
        $stmt = $this->connect()->prepare('SELECT
        n.`news_id`,
        n.`news_title`,
        n.`news_title_seo`,
        n.`news_header_image`,
        n.`news_created`,
        n.`news_content`,
        n.`news_status`,
        n.`news_type`,
        n.`news_deleted`,
        pn.`projectname_id`,
        p.`project_id`,
        p.`project_name`,
        p.`project_color`
        FROM `news` AS n
        INNER JOIN `project_news` AS pn ON n.`news_id` = pn.`news_article_id`
        INNER JOIN `projects` AS p ON pn.`projectname_id` = p.`project_id`
        WHERE `news_type` = "featured" AND  `news_deleted` IS NULL
        ORDER BY `news_id` DESC LIMIT 3
         ');

        // Execute the statement
        $stmt->execute();

        // Fetch all results
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

        foreach ($results as &$row) {
            $title = $row['news_title'];
            $row['title'] = substr($title, 0, 65);
            // Convert the date to day and month
            $newsDate = strtotime($row["news_created"]);
            $row['day'] = date("d", $newsDate);
            $row['month'] = date("M", $newsDate);
        }

        return $results;
    }


    public function getBlogNews()
    {
        // Prepare the SQL statement
        $stmt = $this->connect()->prepare(
            'SELECT
        n.`news_id`,
        n.`news_title`,
        n.`news_title_seo`,
        n.`news_header_image`,
        n.`news_created`,
        n.`news_content`,
        n.`news_status`,
        n.`news_type`,
        pn.`projectname_id`,
        p.`project_id`,
        p.`project_name`,
        p.`project_color`,
        p.`project_logo`
        FROM `news` AS n
        INNER JOIN `project_news` AS pn ON n.`news_id` = pn.`news_article_id`
        INNER JOIN `projects` AS p ON pn.`projectname_id` = p.`project_id`
        WHERE n.`news_type`= "blog" AND `news_deleted` IS NULL
        ORDER BY `news_id` DESC LIMIT 3'
        );

        // Execute the statement
        $stmt->execute();

        // Fetch all results
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

        foreach ($results as &$row) {

            $newsDate = strtotime($row["news_created"]);
            $row['day'] = date("d", $newsDate);
            $row['month'] = date("M", $newsDate);

            $title = $row['news_title'];
            $row['title'] = substr($title, 0, 50);

            $content = $row['news_content'];
            $limited_content = strip_tags($content);
            $row['limited_content'] = substr($limited_content, 0, 180);
        }

        return $results;
    }

    public function getArticleContent()
    {
        if (isset($_GET['article'])) {
            $articleId = $_GET['article'];
        }

        $stmt = $this->connect()->prepare("SELECT * FROM `news` WHERE `news_id` = '" . $articleId . "'");
        $stmt->execute();

        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $results;
    }
}
