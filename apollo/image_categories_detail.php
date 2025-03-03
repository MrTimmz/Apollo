<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

echo '<pre>';
print_r($_GET);
echo '</pre>';

if (isset($_GET['category']) && is_numeric($_GET['category'])) {
    $categoryId = $_GET['category'];

    echo 'Category ID: ' . $categoryId . '<br>';

    $imageCategoryObj = new ImageCategory();
    $categoryImages = $imageCategoryObj->getCategoryImages($categoryId);

    foreach ($categoryImages as $image) {
        echo '<div class="image-detail">';
        echo '<img src="https://media.moddb.com/images/members/1/114/113273/farisle.png" alt="' . $image['image_alt'] . '">';
        echo '<h3>' . $image['image_title'] . '</h3>';
        echo '<p>' . $image['image_description'] . 'teststest</p>';
        echo '</div>';
    }
} else {
    echo 'Invalid category ID.';
}
?>
