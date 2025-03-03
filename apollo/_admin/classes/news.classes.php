<?php

class News extends Dbh
{
    public function getNewsById($news_id)
    {
        $stmt = $this->connect()->prepare('SELECT * FROM news WHERE news_id = ?');
        $stmt->execute(array($news_id));
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getNews()
    {
        $stmt = $this->connect()->prepare('
            SELECT `news_id`, `news_title`, `news_created`, `news_status`, `news_type`, `news_deleted`, project_news.`projectname_id`, projects.`project_id`, projects.`project_name`
            FROM `news`
            INNER JOIN `project_news` ON `news`.`news_id` = `project_news`.`news_article_id`
            INNER JOIN `projects` ON `project_news`.`projectname_id` = `projects`.`project_id` WHERE `news_deleted` IS NULL
        ');
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    protected function setNews($articlename, $articlenameseo, $articlecontent, $articlecontentseo, $articleimage, $articlestatus, $articleteype, $articleproject)
    {
        $conn = $this->connect();

        // Insert the news article
        $stmt = $conn->prepare('
            INSERT INTO news (`news_title`, `news_title_seo`, `news_content`, `news_content_seo`, `news_header_image`, `news_status`, `news_type`)
            VALUES (?, ?, ?, ?, ?, ?, ?)
        ');

        if (!$stmt->execute(array($articlename, $articlenameseo, $articlecontent, $articlecontentseo, $articleimage, $articlestatus, $articleteype))) {
            exit("Error inserting news article");
        }

        // Get the last inserted news article ID
        $newsArticleId = $conn->lastInsertId();

        // Check if project exists
        $projectCheckStmt = $conn->prepare('SELECT COUNT(*) FROM projects WHERE project_id = ?');
        $projectCheckStmt->execute([$articleproject]);
        $projectExists = $projectCheckStmt->fetchColumn() > 0;

        if (!$projectExists) {
            exit("Error: Project ID does not exist");
        }

        // Insert into project_news to link the article with a project
        $stmtProject = $conn->prepare('
            INSERT INTO project_news (`projectname_id`, `news_article_id`)
            VALUES (?, ?)
        ');

        if (!$stmtProject->execute(array($articleproject, $newsArticleId))) {
            exit("Error inserting into project_news");
        }

        $stmt = null;
        $stmtProject = null;
    }

    public function updateNewsArticle($news_id, $articlename, $articlenameseo, $articlecontent, $articlecontentseo, $articleimage, $articlestatus, $articleteype, $articleproject)
    {
        // Prepare the update statement for the news table
        $stmt = $this->connect()->prepare('
            UPDATE news
            SET `news_title` = ?, `news_title_seo` = ?, `news_content` = ?, `news_content_seo` = ?, `news_header_image` = ?, `news_status` = ?, `news_type` = ?
            WHERE `news_id` = ?
        ');

        // Execute the statement with the correct values
        if (!$stmt->execute(array($articlename, $articlenameseo, $articlecontent, $articlecontentseo, $articleimage, $articlestatus, $articleteype, $news_id))) {
            $stmt = null;
            exit("Error updating news article");
        }

        // Now update the project_news table if there's a project associated
        if ($articleproject) {
            // Check if this article already has an associated project
            $projectCheckStmt = $this->connect()->prepare('SELECT COUNT(*) FROM project_news WHERE news_article_id = ?');
            $projectCheckStmt->execute([$news_id]);
            $projectExists = $projectCheckStmt->fetchColumn() > 0;

            if ($projectExists) {
                // If the project link exists, update it
                $stmtProject = $this->connect()->prepare('
                    UPDATE project_news
                    SET projectname_id = ?
                    WHERE news_article_id = ?
                ');

                if (!$stmtProject->execute(array($articleproject, $news_id))) {
                    exit("Error updating project_news");
                }
            } else {
                // If the project link doesn't exist, insert it
                $stmtProject = $this->connect()->prepare('
                    INSERT INTO project_news (projectname_id, news_article_id)
                    VALUES (?, ?)
                ');

                if (!$stmtProject->execute(array($articleproject, $news_id))) {
                    exit("Error inserting into project_news");
                }
            }
        }

        // Clean up
        $stmt = null;
        $stmtProject = null;

        // Redirect after successful update
        echo "<script>location.href='news-overview.php';</script>";
    }

    public function getDeletedNews()
    {
        $sql = 'SELECT `news_id`, `news_title`, `news_created`, `news_status`, `news_type`, `news_deleted`, project_news.`projectname_id`, projects.`project_id`, projects.`project_name`
            FROM `news`
            INNER JOIN `project_news` ON `news`.`news_id` = `project_news`.`news_article_id`
            INNER JOIN `projects` ON `project_news`.`projectname_id` = `projects`.`project_id` WHERE news_deleted IS NOT NULL';
        $stmt = $this->connect()->query($sql);
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $results;
    }

    public function deleteNews($news_id)
    {
        $stmt = $this->connect()->prepare('UPDATE news SET news_deleted = NOW() WHERE news_id = :id');
        $stmt->bindParam(':id', $news_id);
        $stmt->execute();
    }

    public function trashNews($id)
    {
        // Step 1: Delete related records in project_news (foreign key constraint issue)
        try {
            $stmtProjectNews = $this->connect()->prepare('DELETE FROM `project_news` WHERE `news_article_id` = :id');
            $stmtProjectNews->bindParam(':id', $id);
            $stmtProjectNews->execute();
            echo "Deleted related project_news records.<br>";
        } catch (PDOException $e) {
            echo "Error deleting from project_news: " . $e->getMessage() . "<br>";
            return; // Stop execution if there's an error
        }

        // Step 2: Now delete the news record
        try {
            $stmtNews = $this->connect()->prepare('DELETE FROM `news` WHERE `news_id` = :id');
            $stmtNews->bindParam(':id', $id);
            $stmtNews->execute();
            echo "Deleted news record.<br>";
        } catch (PDOException $e) {
            echo "Error deleting news record: " . $e->getMessage() . "<br>";
        }

        // Redirect after deletion
        echo "<script>location.href='news-deleted.php';</script>";
    }



    public function returnNews($id)
    {
        $stmt = $this->connect()->prepare('UPDATE `news` SET news_deleted = NULL WHERE news_id = :id');
        $stmt->bindParam(':id', $id);
        $stmt->execute();

        echo "<script>location.href='news-overview.php';</script>";
    }

    public function getProjects()
    {
        $stmt = $this->connect()->prepare('SELECT `project_id`, `project_name` FROM projects');
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getProjectForNews($news_id)
    {
        $stmt = $this->connect()->prepare('SELECT projectname_id FROM project_news WHERE news_article_id = ?');
        $stmt->execute([$news_id]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        return $result ? $result['projectname_id'] : null;
    }
}
