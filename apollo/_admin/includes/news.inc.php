<?php

include "../classes/dbh.classes.php";
include "../classes/news.classes.php";
include "../classes/news-contr.classes.php";

// Check if the form is submitted
if (isset($_POST["submit"])) {
    $articlename = $_POST["title"];
    $articlenameseo = $_POST["titleseo"];
    $articlecontent = $_POST["content"];
    $articlecontentseo = $_POST["newscontentseo"];
    $articlestatus = $_POST["status"];
    $articlestype = $_POST["type"];
    $articleproject = $_POST["project"];

    // Handle the image upload
    $articleimage = ''; // Initialize the variable
    $articleimage_resized = ''; // For the resized version

    if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
        $imageName = $_FILES['image']['name'];
        $imageTmpName = $_FILES['image']['tmp_name'];
        $imageSize = $_FILES['image']['size'];
        $imageError = $_FILES['image']['error'];
        $imageType = $_FILES['image']['type'];

        // Set the allowed file extensions
        $allowed = array('jpg', 'jpeg', 'png', 'gif');
        $fileExt = explode('.', $imageName);
        $fileActualExt = strtolower(end($fileExt));

        if (in_array($fileActualExt, $allowed) && $imageSize < 5000000) {
            // Generate a unique name for the original image
            $newImageName = uniqid('', true) . "." . $fileActualExt;

            // Set the name for the resized image
            $resizedImageName = "resized_" . $newImageName;

            // Use absolute paths to ensure files go to the correct directory
            $uploadDir = $_SERVER['DOCUMENT_ROOT'] . '/apollo/uploads/news/';
            $imageDestination = $uploadDir . $newImageName;
            $resizedImageDestination = $_SERVER['DOCUMENT_ROOT'] . '/apollo/uploads/news/resize/' . $resizedImageName;

            // Move the uploaded file to the destination folder (original image)
            if (move_uploaded_file($imageTmpName, $imageDestination)) {
                echo "Image uploaded successfully.";
                $articleimage = $newImageName; // Set the filename for the original image

                // Now resize the image
                $resizedImage = resizeImage($imageDestination, 405, 228, $fileActualExt);

                // Save the resized image
                if ($resizedImage !== false) {
                    switch ($fileActualExt) {
                        case 'jpg':
                        case 'jpeg':
                            imagejpeg($resizedImage, $resizedImageDestination, 90); // Save resized image
                            break;
                        case 'png':
                            imagepng($resizedImage, $resizedImageDestination, 9);
                            break;
                        case 'gif':
                            imagegif($resizedImage, $resizedImageDestination);
                            break;
                    }
                    $articleimage_resized = $resizedImageName; // Set the filename for the resized image
                    imagedestroy($resizedImage); // Free memory
                }

            } else {
                echo "Failed to move uploaded file.";
            }
        } else {
            echo "File type not allowed or file too large.";
        }
    }

    // Instantiate controller for adding a new article
    $newNews = new newNewsContr($articlename, $articlenameseo, $articlecontent, $articlecontentseo, $articleimage, $articlestatus, $articleproject, $articlestype);

    // Add a new article
    $newNews->addnewNews();

    // Redirect after success
    header("location: ../index.php?error=none");
    exit();
}

// Check if the form is submitted for updating an existing news article
if (isset($_POST['update-news'])) {
    $news_id = $_POST['news_id'];
    $articlename = $_POST["title"];
    $articlenameseo = $_POST["titleseo"];
    $articlecontent = $_POST["content"];
    $articlecontentseo = $_POST["newscontentseo"];
    $articlestatus = $_POST["status"];
    $articlestype = $_POST["type"];
    $articleproject = $_POST["project"];

    // Handle the image upload
    $articleimage = ''; // Initialize the variable
    $articleimage_resized = ''; // For the resized version

    if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
        $imageName = $_FILES['image']['name'];
        $imageTmpName = $_FILES['image']['tmp_name'];
        $imageSize = $_FILES['image']['size'];
        $imageError = $_FILES['image']['error'];
        $imageType = $_FILES['image']['type'];

        // Set the allowed file extensions
        $allowed = array('jpg', 'jpeg', 'png', 'gif');
        $fileExt = explode('.', $imageName);
        $fileActualExt = strtolower(end($fileExt));

        if (in_array($fileActualExt, $allowed) && $imageSize < 5000000) {
            $newImageName = uniqid('', true) . "." . $fileActualExt;
            $resizedImageName = "resized_" . $newImageName;

            // Use absolute path to ensure files go to the correct directory
            $uploadDir = $_SERVER['DOCUMENT_ROOT'] . '/apollo/uploads/news/';
            $imageDestination = $uploadDir . $newImageName;
            $resizedImageDestination = $_SERVER['DOCUMENT_ROOT'] . '/apollo/uploads/news/resize/' . $resizedImageName;

            // Move the uploaded file to the destination folder (original image)
            if (move_uploaded_file($imageTmpName, $imageDestination)) {
                echo "Image uploaded successfully.";
                $articleimage = $newImageName; // Set the filename for the original image

                // Now resize the image
                $resizedImage = resizeImage($imageDestination, 405, 228, $fileActualExt);

                // Save the resized image
                if ($resizedImage !== false) {
                    switch ($fileActualExt) {
                        case 'jpg':
                        case 'jpeg':
                            imagejpeg($resizedImage, $resizedImageDestination, 90); // Save resized image
                            break;
                        case 'png':
                            imagepng($resizedImage, $resizedImageDestination, 9);
                            break;
                        case 'gif':
                            imagegif($resizedImage, $resizedImageDestination);
                            break;
                    }
                    $articleimage_resized = $resizedImageName; // Set the filename for the resized image
                    imagedestroy($resizedImage); // Free memory
                }

            } else {
                echo "Failed to move uploaded file.";
            }
        } else {
            echo "File type not allowed or file too large.";
        }
    }

    // Instantiate controller for updating the news article
    $updatenews = new newNewsContr($articlename, $articlenameseo, $articlecontent, $articlecontentseo, $articleimage, $articlestatus, $articleproject, $articlestype);

    // Update an existing news article
    $updatenews->updateNews($news_id);

    // Redirect after success
    header("location: ../index.php?updates=success");
    exit();
}

// Function to resize the image
function resizeImage($file, $targetWidth, $targetHeight, $fileExt)
{
    // Get the original dimensions
    list($width, $height) = getimagesize($file);

    // Create a new blank image with the desired dimensions
    $newImage = imagecreatetruecolor($targetWidth, $targetHeight);

    // Create image resource based on file type
    switch ($fileExt) {
        case 'jpg':
        case 'jpeg':
            $source = imagecreatefromjpeg($file);
            break;
        case 'png':
            $source = imagecreatefrompng($file);
            break;
        case 'gif':
            $source = imagecreatefromgif($file);
            break;
        default:
            return false; // Unsupported format
    }

    // Resize the image
    imagecopyresampled($newImage, $source, 0, 0, 0, 0, $targetWidth, $targetHeight, $width, $height);

    return $newImage;
}