<?php
$imageCategoryObj = new ImageCategory();
$categories = $imageCategoryObj->getImageCategories();

foreach ($categories as $category) {
    echo '<div class="category">';
    echo '<h3>' . $category['image_category_title'] . '</h3>';

    $categoryImages = $imageCategoryObj->getCategoryImages($category['image_category_id']);

    // Display up to three images in the overview
    $displayedImages = array_slice($categoryImages, 0, 3);

    foreach ($displayedImages as $image) {
        echo '<div class="image" style="float:left;">';
        echo '<img src="/apollo/uploads/category/images/' . $image['image_name'] . ' " width="350px;" alt="' . $image['image_name_seo'] . '">';


        echo '<p>' . $image['image_desc'] . '</p>';
        echo '</div>';
    }

    // Provide a link to the detail page showing all images


    echo '</div>';

    echo '<div><a href="index.php?page=media&category=' . $category['image_category_id'] . '">View All</a></div>';
}
?>