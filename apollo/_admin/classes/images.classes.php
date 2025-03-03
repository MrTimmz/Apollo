<?php
include 'includes/mod_config.php';


class Images extends Dbh
{

    public function getImages()
    {
        $sql = 'SELECT `images`. *, `images_category`.`image_category_title` FROM `images` JOIN `images_category` ON `images`.`image_cat_id` = `images_category`.`image_category_id`';
        $stmt = $this->connect()->query($sql);
        while ($row = $stmt->fetch()) {
            echo '<tr>';
            echo '<td> <img src=http://localhost/apollo/uploads/category/images/' . $row["image_name"] . ' width="75" height="75"></td>';
            echo '<td> ' . $row["image_name"] . '</td>';
            echo '<td>' . $row["image_category_title"] . '</td>';
            echo '<td>' . $row["image_created"] . '</td>';
            echo '<td>
                    <a href="images.php?edit=' . $row["image_id"] . '" class="btn btn-warning btn-block">Edit</a>
                    <a href="?delete=' . $row["image_id"] . '" class="btn btn-google btn-user btn-block">Delete</a>';
            '</td>';
            echo '</tr>';
        }
    }

    public function deleteImages($id)
    {
        $sql = 'UPDATE images SET images_deleted = NOW() WHERE image_id = :id';
        $stmt = $this->connect()->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
    }

    public function getDeletedImages()
    {
        $sql = 'SELECT `images`. *, `images_category`.`image_category_title` FROM `images` JOIN `images_category` ON `images`.`image_cat_id` = images_category`.`image_category_id`';
        $stmt = $this->connect()->query($sql);
        while ($row = $stmt->fetch()) {
            echo '<tr>';
            echo '<td> <img src=http://localhost/apollo/uploads/category/images/' . $row["image_name"] . ' width="75" height="75"></td>';
            echo '<td> ' . $row["image_name"] . '</td>';
            echo '<td>' . $row["image_category_title"] . '</td>';
            echo '<td>' . $row["image_created"] . '</td>';
            echo '<td>
                    <a href="?return=' . $row["image_id"] . '" class="btn btn-warning btn-block">Return</a>
                    <a href="?trash=' . $row["image_id"] . '" class="btn btn-google btn-user btn-block">Trash</a>';
            '</td>';
            echo '</tr>';
        }
    }

    public function trashImage($id)
    {
        $sql = 'DELETE FROM images  WHERE image_id = :id';
        $stmt = $this->connect()->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();

        echo "<script>location.href='images-deleted.php';</script>";
    }

    public function returnCategory($id)
    {
        $sql = 'UPDATE images SET image_deleted = NULL WHERE image_id = :id';
        $stmt = $this->connect()->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();

        echo "<script>location.href='images_overview.php';</script>";
    }

    //insert new data into table
    protected function setImage($title, $titleseo, $categoryorder, $visibility, $preview, $images)
    {
        $conn = $this->connect();
        move_uploaded_file($_FILES["image"]["tmp_name"], "../../uploads/category/preview/" . $_FILES["image"]["name"]);
        $stmt = $conn->prepare('INSERT INTO images ( `image_category_title`, `image_cartegory_title_seo`, `image_category_order`, `image_category_status`, `image_category_preview`) VALUES (?, ?, ?, ?, ?);');

        //stop running and execute error statement
        if (!$stmt->execute(array($title, $titleseo,  $categoryorder,  $visibility, $preview))) {
            $stmt = null;
            exit();
        }

        //get the last inserted id
        $image_id = $conn->lastInsertId();

        // loop through the uploaded images and insert them into the database
        foreach ($images['name'] as $key => $image_name) {
            move_uploaded_file($images["tmp_name"][$key], "../../uploads/category/images/" . $image_name);
            $stmt = $conn->prepare('INSERT INTO images (`image_name`, `image_cat_id`) VALUES (?, ?)');

            if (!$stmt->execute(array($image_name, $image_id))) {
                $stmt = null;
                exit();
            }

            $stmt = null;
        }

        $conn = null;
    }



    protected function updateImage($image_id, $title, $titleseo,  $categoryorder,  $visibility, $preview)
    {
        move_uploaded_file($_FILES["image"]["tmp_name"], "../uploads/category/preview//" . $_FILES["image"]["name"]);
        $stmt = $this->connect()->prepare('UPDATE menu SET `image_category_title` = ?, `image_cartegory_title_seo` = ?, `image_category_order` = ?, `image_category_status` = ?, `image_category_preview` = ? WHERE `image_id` = ?');

        //stop running and execute error statement
        if (!$stmt->execute(array($title, $titleseo,  $categoryorder,  $visibility, $preview, $image_id))) {
            $stmt = null;

            exit();
        }

        $stmt = null;
        echo "<script>location.href='overview-pages.php';</script>";
    }

    //echo form
    public function echoForm()
    {
?>
        <form action="includes/images.inc.php" method="post" enctype="multipart/form-data">
            <div class="row">

                <!-- Image Name -->
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border-left-primary shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                        Image Name:</div>
                                    <input type="text" class="title inputbox long" name="title" placeholder="Image Name"><br>
                                </div>
                                <div class="col-auto">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-type-h1" viewBox="0 0 16 16">
                                        <path d="M8.637 13V3.669H7.379V7.62H2.758V3.67H1.5V13h1.258V8.728h4.62V13h1.259zm5.329 0V3.669h-1.244L10.5 5.316v1.265l2.16-1.565h.062V13h1.244z" />
                                    </svg>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>

                <!-- Image File -->
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border-left-info shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                        Image File (single file upload):
                                    </div>
                                    <div class="row no-gutters align-items-center">
                                        <div class="col-auto">
                                            <div class="avatar-upload">
                                                <div class="avatar-edit">
                                                    <input type="file" name="image" id="imageUpload">
                                                    <label for="imageUpload"></label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-auto">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-image-fill" viewBox="0 0 16 16">
                                        <path d="M.002 3a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v10a2 2 0 0 1-2 2h-12a2 2 0 0 1-2-2V3zm1 9v1a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V9.5l-3.777-1.947a.5.5 0 0 0-.577.093l-3.71 3.71-2.66-1.772a.5.5 0 0 0-.63.062L1.002 12zm5-6.5a1.5 1.5 0 1 0-3 0 1.5 1.5 0 0 0 3 0z" />
                                    </svg>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                <!-- Category -->
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border-left-info shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                        Image Category:
                                    </div>
                                    <div class="row no-gutters align-items-center">
                                        <div class="col-auto">
                                            <select name="loc" id='sel_city'>
                                                <option value='0'>Select Category</option>
                                                <?php


                                                ## Fetch citys
                                                $sql = ("SELECT * FROM `images_category` WHERE image_category_deleted = NULL ORDER BY image_category_id ");
                                                $stmt = $this->connect()->query($sql);
                                                $category = $stmt->fetchAll();

                                                foreach ($category as $categories) {
                                                    echo "<option value='" . $categories['image_category_id'] . "'>" . $categories['image_category_title'] . "</option>";
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-auto">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-list" viewBox="0 0 16 16">
                                        <path fill-rule="evenodd" d="M2.5 12a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5z" />
                                    </svg>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">

                <div class="col-lg-9">

                    <!-- Multi-upload -->
                    <div class="card mb-4">
                        <div class="card-header">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                        (Multi) Image Upload:</div>
                                </div>
                                <div class="col-auto">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-images" viewBox="0 0 16 16">
                                        <path d="M4.502 9a1.5 1.5 0 1 0 0-3 1.5 1.5 0 0 0 0 3z" />
                                        <path d="M14.002 13a2 2 0 0 1-2 2h-10a2 2 0 0 1-2-2V5A2 2 0 0 1 2 3a2 2 0 0 1 2-2h10a2 2 0 0 1 2 2v8a2 2 0 0 1-1.998 2zM14 2H4a1 1 0 0 0-1 1h9.002a2 2 0 0 1 2 2v7A1 1 0 0 0 15 11V3a1 1 0 0 0-1-1zM2.002 4a1 1 0 0 0-1 1v8l2.646-2.354a.5.5 0 0 1 .63-.062l2.66 1.773 3.71-3.71a.5.5 0 0 1 .577-.094l1.777 1.947V5a1 1 0 0 0-1-1h-10z" />
                                    </svg>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="images" name="images[]" multiple>
                                <label class="custom-file-label" for="images">Choose images</label>
                            </div>
                            <div id="image-preview"></div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3">

                    <!-- Category thumbnail preview -->
                    <div class="card mb-4">
                        <div class="card-header">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                        Image Preview:</div>
                                </div>
                                <div class="col-auto">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-image-fill" viewBox="0 0 16 16">
                                        <path d="M.002 3a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v10a2 2 0 0 1-2 2h-12a2 2 0 0 1-2-2V3zm1 9v1a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V9.5l-3.777-1.947a.5.5 0 0 0-.577.093l-3.71 3.71-2.66-1.772a.5.5 0 0 0-.63.062L1.002 12zm5-6.5a1.5 1.5 0 1 0-3 0 1.5 1.5 0 0 0 3 0z" />
                                    </svg>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="avatar-preview" style="height:250px; width:250px;">
                                <div id="imagePreview" style="background-image: url(http://i.pravatar.cc/500?img=7); background-size: 250px 250px; width:250px; height:250px; background-position:center; "></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-2">
                    <button type="submit" name="submit" class="btn btn-primary btn-user btn-block">
                        Add Category
                    </button>
                </div>

                <div class="col-lg-2">
                    <a href="index.html" class="btn btn-google btn-user btn-block">
                        Cancel
                    </a>
                </div>
            </div>
        </form>

    <?php
    }

    public function editForm($image_id = null)
    {
        $image_id = isset($_GET['edit']) ? $_GET['edit'] : null;
        //retrieve existing data if image_id is set
        $row = null;
        if ($image_id) {
            $stmt = $this->connect()->prepare('SELECT * FROM images WHERE image_id = ?');
            $stmt->execute(array($image_id));
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
        }

        //check if form has been submitted
        if (isset($_POST['update-post'])) {
            $imagename = $_POST["title"];
            $imageseo = $_POST["titleseo"];
            $imagecat = $_POST["status"];

            //update existing page if image_id is set, otherwise insert new page
            if ($image_id) {
                $this->updateImage($image_id, $imagename, $imageseo,  $imagecat);
            } else {
                $this->setImage($imagename, $imageseo,  $imagecat);
            }
        }
    ?>
        <form method="post" enctype="multipart/form-data">
            <div class="row">

                <!-- Image Name -->
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border-left-primary shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                        Image Name:</div>
                                    <?php
                                    echo '<input type="text" name="order" value="' . ($image_id ? $row['image_name_seo'] : '') . '" />';
                                    ?>
                                </div>
                                <div class="col-auto">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-type-h1" viewBox="0 0 16 16">
                                        <path d="M8.637 13V3.669H7.379V7.62H2.758V3.67H1.5V13h1.258V8.728h4.62V13h1.259zm5.329 0V3.669h-1.244L10.5 5.316v1.265l2.16-1.565h.062V13h1.244z" />
                                    </svg>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>

                <!-- Image File -->
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border-left-info shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                        Image File (single file upload):
                                    </div>
                                    <div class="row no-gutters align-items-center">
                                        <div class="col-auto">
                                            <div class="avatar-upload">
                                                <div class="avatar-edit">
                                                    <input type="file" name="image" id="imageUpload">
                                                    <label for="imageUpload"></label>
                                                    <?php
                                                    echo '<p>Current Image: ' . ($image_id ? $row['image_name'] : '') . '</p>';
                                                    ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-auto">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-image-fill" viewBox="0 0 16 16">
                                        <path d="M.002 3a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v10a2 2 0 0 1-2 2h-12a2 2 0 0 1-2-2V3zm1 9v1a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V9.5l-3.777-1.947a.5.5 0 0 0-.577.093l-3.71 3.71-2.66-1.772a.5.5 0 0 0-.63.062L1.002 12zm5-6.5a1.5 1.5 0 1 0-3 0 1.5 1.5 0 0 0 3 0z" />
                                    </svg>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                <!-- Category -->
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border-left-info shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                        Image Category:
                                    </div>
                                    <div class="row no-gutters align-items-center">
                                        <div class="col-auto">
                                            <!-- Select option to choose image category -->
                                            <select name="image_category_id">
                                                <option value="0">Select Category</option>
                                                <?php
                                                // Fetch image categories and the current image category
                                                $image_id = isset($_GET['edit']) ? $_GET['edit'] : null;
                                                $sql = "SELECT ic.image_category_id, ic.image_category_title, i.image_cat_id
                                                        FROM images_category ic
                                                        LEFT JOIN images i ON ic.image_category_id = i.image_cat_id AND i.image_id = $image_id
                                                        WHERE ic.image_category_deleted IS NULL";
                                                $stmt = $this->connect()->query($sql);
                                                $categories = $stmt->fetch(PDO::FETCH_ASSOC);;

                                                // Loop through categories and display them in the select option
                                                foreach ($categories as $category) {
                                                    // Set selected attribute for the current image category
                                                    $selected = ($category['image_cat_id'] == $category['image_category_id']) ? 'selected' : '';

                                                    echo "<option value='" . $category['image_category_id'] . "' $selected>" . $category['image_category_title'] . "</option>";
                                                }
                                                ?>
                                            </select>

                                        </div>
                                    </div>
                                </div>
                                <div class="col-auto">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-list" viewBox="0 0 16 16">
                                        <path fill-rule="evenodd" d="M2.5 12a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5z" />
                                    </svg>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3">

                    <!-- Category thumbnail preview -->
                    <div class="card mb-4">
                        <div class="card-header">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                        Image Preview:</div>
                                </div>
                                <div class="col-auto">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-image-fill" viewBox="0 0 16 16">
                                        <path d="M.002 3a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v10a2 2 0 0 1-2 2h-12a2 2 0 0 1-2-2V3zm1 9v1a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V9.5l-3.777-1.947a.5.5 0 0 0-.577.093l-3.71 3.71-2.66-1.772a.5.5 0 0 0-.63.062L1.002 12zm5-6.5a1.5 1.5 0 1 0-3 0 1.5 1.5 0 0 0 3 0z" />
                                    </svg>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="avatar-preview" style="height:250px; width:250px;">
                                <?php
                                echo ' <div id="imagePreview" style="background-image: url(http://localhost/apollo/uploads/category/images/' . $row["image_name"] . ' ); background-size: 250px 250px; width:250px; height:250px; background-position:center; "></div>';
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">


                <div class="col-lg-2">
                    <button type="submit" name="submit" class="btn btn-primary btn-user btn-block">
                        Update Image
                    </button>
                </div>

                <div class="col-lg-2">
                    <a href="index.html" class="btn btn-google btn-user btn-block">
                        Cancel
                    </a>
                </div>
            </div>
        </form>
<?php

    }
}
