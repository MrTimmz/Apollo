<?php


class imagesCategory extends Dbh
{

    public function getImageCategoryById($image_category_id)
    {
        $stmt = $this->connect()->prepare('SELECT ic.*, i.*, COUNT(*) as count FROM images_category ic INNER JOIN images i ON ic.image_category_id = i.image_cat_id WHERE ic.image_category_deleted IS NULL GROUP BY ic.image_category_id AND image_category_id = ?');
        $stmt->execute(array($image_category_id));
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getCategory()
    {
        $sql = 'SELECT ic.*, i.*, COUNT(*) as count FROM images_category ic INNER JOIN images i ON ic.image_category_id = i.image_cat_id WHERE ic.image_category_deleted IS NULL GROUP BY ic.image_category_id';
        $stmt = $this->connect()->query($sql);
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $results;
    }

    public function deleteCategory($id)
    {
        $sql = 'UPDATE images_category SET image_category_deleted = NOW() WHERE image_category_id = :id';
        $stmt = $this->connect()->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
    }

    public function getDeletedCategory()
    {
        $sql = 'SELECT ic.*, COUNT(*) as count FROM images_category ic INNER JOIN images i ON ic.image_category_id = i.image_cat_id WHERE ic.image_category_deleted IS NOT NULL GROUP BY ic.image_category_id';
        $stmt = $this->connect()->query($sql);
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $results;
    }

    public function trashCategory($id)
    {
        $sql = 'DELETE FROM images_category  WHERE image_category_id = :id';
        $stmt = $this->connect()->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();

        echo "<script>location.href='imagescategory-overview.php';</script>";
    }

    public function returnCategory($id)
    {
        $sql = 'UPDATE images_category SET image_category_deleted = NULL WHERE image_category_id = :id';
        $stmt = $this->connect()->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();

        echo "<script>location.href='imagescategory-overview.php';</script>";
    }

    //insert new data into table
    protected function setCategory($title, $titleseo, $categoryorder, $visibility, $preview, $images)
    {
        $conn = $this->connect();
        move_uploaded_file($_FILES["image"]["tmp_name"], "../../uploads/category/preview/" . $_FILES["image"]["name"]);
        $stmt = $conn->prepare('INSERT INTO images_category ( `image_category_title`, `image_cartegory_title_seo`, `image_category_order`, `image_category_status`, `image_category_preview`) VALUES (?, ?, ?, ?, ?);');

        //stop running and execute error statement
        if (!$stmt->execute(array($title, $titleseo,  $categoryorder,  $visibility, $preview))) {
            $stmt = null;
            exit();
        }

        //get the last inserted id
        $category_id = $conn->lastInsertId();

        // loop through the uploaded images and insert them into the database
        foreach ($images['name'] as $key => $image_name) {
            move_uploaded_file($images["tmp_name"][$key], "../../uploads/category/images/" . $image_name);
            $stmt = $conn->prepare('INSERT INTO images (`image_name`, `image_cat_id`) VALUES (?, ?)');

            if (!$stmt->execute(array($image_name, $category_id))) {
                $stmt = null;
                exit();
            }

            $stmt = null;
        }

        $conn = null;
    }

    protected function updateCategory($category_id, $title, $titleseo,  $categoryorder,  $visibility, $preview)
    {
        move_uploaded_file($_FILES["image"]["tmp_name"], "../uploads/category/preview//" . $_FILES["image"]["name"]);
        $stmt = $this->connect()->prepare('UPDATE menu SET `image_category_title` = ?, `image_cartegory_title_seo` = ?, `image_category_order` = ?, `image_category_status` = ?, `image_category_preview` = ? WHERE `category_id` = ?');

        //stop running and execute error statement
        if (!$stmt->execute(array($title, $titleseo,  $categoryorder,  $visibility, $preview, $category_id))) {
            $stmt = null;

            exit();
        }

        $stmt = null;
        echo "<script>location.href='overview-pages.php';</script>";
    }

    //echo form

    public function editForm($category_id = null)
    {
        $category_id = isset($_GET['edit']) ? $_GET['edit'] : null;
        //retrieve existing data if category_id is set
        $row = null;
        if ($category_id) {
            $stmt = $this->connect()->prepare('SELECT * FROM images_category WHERE image_category_id = ?');
            $stmt->execute(array($category_id));
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
        }

        //check if form has been submitted
        if (isset($_POST['update-post'])) {
            $title = $_POST["title"];
            $titleseo = $_POST["titleseo"];
            $categoryorder = $_POST["order"];
            $visibility = $_POST["status"];
            $preview = $_FILES["image_preview"];
            $images = $_FILES["images"];
            foreach ($images["name"] as $key => $image_name) {
                $image_tmp_name = $images["tmp_name"][$key];
                move_uploaded_file($image_tmp_name, "../../uploads/category/images/" . $image_name);
            }

            //update existing page if category_id is set, otherwise insert new page
            if ($category_id) {
                $this->updateCategory($category_id, $title, $titleseo,  $categoryorder,  $visibility, $preview);
            } else {
                $this->setCategory($title, $titleseo,  $categoryorder,  $visibility, $preview, $images);
            }
        }
    }
}
