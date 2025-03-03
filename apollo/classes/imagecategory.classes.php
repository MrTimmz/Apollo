<?php

class ImageCategory extends Dbh
{
    public function getImageCategories()
    {
        $sql = "SELECT * FROM `images_category` WHERE `image_category_status` = 'Online'";
        $stmt = $this->connect()->query($sql);
        $categories = [];

        while ($row = $stmt->fetch()) {
            $categories[] = $row;
        }

        return $categories;
    }

    public function getCategoryImages($categoryId)
    {
        $sql = "SELECT * FROM `images` WHERE `image_cat_id` = ?";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$categoryId]);
        $images = [];

        while ($row = $stmt->fetch()) {
            $images[] = $row;
        }

        return $images;
    }
}
?>
