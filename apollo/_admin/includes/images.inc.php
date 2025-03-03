<?php

if (isset($_POST["submit"])) {
    // Grab data from user's input
    $title = $_POST["title"];
    $titleseo = $_POST["titleseo"];
    $categoryorder = $_POST["order"];
    $visibility = $_POST["status"];

    // Handle preview image upload
    $preview = $_FILES["image"]["name"];
    move_uploaded_file($_FILES["image"]["tmp_name"], "../../uploads/category/preview/" . $preview);

    // Handle image uploads
    $images = $_FILES["images"];
    foreach ($images["name"] as $key => $image_name) {
        $image_tmp_name = $images["tmp_name"][$key];
        move_uploaded_file($image_tmp_name, "../../uploads/category/images/" . $image_name);
    }

    // Get instances using autoloader
    include "../classes/dbh.classes.php";
    include "../classes/images.classes.php";
    include "../classes/images-contr.classes.php";

    $newcategory = new ImagesContr($title, $titleseo, $categoryorder, $visibility, $preview, $images);

    // Run errors if we got any errors
    $newcategory->addnewImages();

    // Continue if there are no errors
    header("location: ../index.php?error=none");
}
