<?php

class Subpage extends Dbh
{

    public function getSubpage()
    {
        $sql = 'SELECT menu.menu_title, sub_menu.*
        FROM menu
        INNER JOIN sub_menu ON menu.menu_id = sub_menu.submenu_parent
        WHERE sub_menu.submenu_parent = menu.menu_id';
        $stmt = $this->connect()->query($sql);
        while ($row = $stmt->fetch()) {
            echo '<tr>';
            echo '<td>' . $row["menu_title"] . '</td>';
            echo '<td>' . $row["submenu_title"] . '</td>';
            echo '<td> ' . $row["submenu_page_title"] . '</td>';
            echo '<td>' . $row["submenu_order"] . '</td>';
            echo '<td>' . $row["submenu_status"] . '</td>';
            echo '<td>' . $row["submenu_created"] . '</td>';
            echo '<td>
                    <a href="subpage.php?edit=' . $row["submenu_id"] . '" class="btn btn-warning btn-block">Edit</a>
                    <a href="?delete=' . $row["submenu_id"] . '" class="btn btn-google btn-user btn-block">Delete</a>';
            '</td>';
            echo '</tr>';
        }
    }

    public function deleteSubpage($id)
    {
        $sql = 'UPDATE sub_menu SET submenu_deleted = NOW() WHERE submenu_id = :id';
        $stmt = $this->connect()->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
    }

    public function getDeletedSubmenu()
    {
        $sql = 'SELECT menu.menu_title, sub_menu.*
        FROM menu
        INNER JOIN sub_menu ON menu.menu_id = sub_menu.submenu_parent
        WHERE sub_menu.submenu_parent = menu.menu_id WHERE submenu_created = NOT NULL';


        $stmt = $this->connect()->query($sql);
        while ($row = $stmt->fetch()) {
            echo '<tr>';
            echo '<td>' . $row["image_category_title"] . '</td>';
            echo '<td> ' . $row["image_category_order"] . '</td>';
            echo '<td>' . $row["image_category_status"] . '</td>';
            echo '<td>' . $row["count"] . '</td>';
            echo '<td>' . $row["image_category_created"] . '</td>';
            echo '<td>
                    <a href="?return=' . $row["submenu_id"] . '" class="btn btn-warning btn-block">Return</a>
                    <a href="?trash=' . $row["submenu_id"] . '" class="btn btn-google btn-user btn-block">Trash</a>';
            '</td>';
            echo '</tr>';
        }
    }

    public function trashCategory($id)
    {
        $sql = 'DELETE FROM images_category  WHERE submenu_id = :id';
        $stmt = $this->connect()->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();

        echo "<script>location.href='deleted-image_categories.php';</script>";
    }

    public function returnCategory($id)
    {
        $sql = 'UPDATE images_category SET image_category_deleted = NULL WHERE submenu_id = :id';
        $stmt = $this->connect()->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();

        echo "<script>location.href='image-categories_overview.php';</script>";
    }

    //insert new data into table
    protected function setSubpage($parent, $title, $titleseo, $pageheading, $pageheadingseo, $menuorder, $pagecontent, $visibility)
    {
        $stmt = $this->connect()->prepare('INSERT INTO sub_menu ( `submenu_parent`, `submenu_title`, `submenu_title_seo`, `submenu_page_title`, `submenu_page_title_seo`, `submenu_order`, `submenu_content`, `submenu_status`) VALUES (?, ?, ?, ?, ?, ?, ?, ?);');

        //stop running and execute error statement
        if (!$stmt->execute(array($parent, $title, $titleseo, $pageheading, $pageheadingseo, $menuorder, $pagecontent, $visibility))) {
            $stmt = null;

            exit();
        }

        $stmt = null;
    }

    protected function updateSubpage($submenu_id, $title, $titleseo, $pageheading, $pageheadingseo, $menuorder, $pagecontent, $visibility)
    {

        $stmt = $this->connect()->prepare('UPDATE sub_menu SET`submenu_parent` = ?,  `submenu_title` = ?, `submenu_title_seo` = ?, `submenu_page_title` = ?, `submenu_page_title_seo` = ?, `submenu_order` = ?, `submenu_content` = ?, `submenu_status` = ? WHERE `submenu_id` = ?');

        //stop running and execute error statement
        if (!$stmt->execute(array($title, $titleseo, $pageheading, $pageheadingseo, $menuorder, $pagecontent, $visibility, $submenu_id))) {
            $stmt = null;

            exit();
        }

        $stmt = null;
        echo "<script>location.href='overview-pages.php';</script>";
    }

    //echo form
    public function echoForm()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Check if form has been submitted
            $parent = $_POST['menu_parent'];
            $title = $_POST['menu_title'];
            $titleseo = $_POST['menu_title_seo'];
            $pageheading = $_POST['menu_page_title'];
            $pageheadingseo = $_POST['menu_page_title_seo'];
            $menuorder = $_POST['menu_order'];
            $pagecontent = $_POST['menu_content'];
            $visibility = $_POST['menu_status'];

            // Call setSubPage() with form data
            $this->setSubpage($parent, $title, $titleseo, $pageheading, $pageheadingseo, $menuorder, $pagecontent, $visibility);
        }
?>
        <form action="includes/subpage.inc.php" method="post">
            <div class="row">

                <!-- Main Menu -->
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border-left-success shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                        Main Menu:</div>
                                    <select name="mainmenu">
                                        <option value="0">Select Main Menu:</option>
                                        <?php
                                        // Fetch Main Menu
                                        $sql = "SELECT * FROM `menu`";
                                        $stmt = $this->connect()->query($sql);
                                        $mainMenu = $stmt->fetchall(PDO::FETCH_ASSOC);

                                        // Loop through Main Menu and display them in the select option
                                        foreach ($mainMenu as $menu) {
                                            // Set selected attribute for the current sub menu
                                            echo "<option value='" . $menu['menu_id'] . "'>" . $menu['menu_title'] . "</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="col-auto">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-menu-up" viewBox="0 0 16 16">
                                        <path d="M7.646 15.854a.5.5 0 0 0 .708 0L10.207 14H14a2 2 0 0 0 2-2V3a2 2 0 0 0-2-2H2a2 2 0 0 0-2 2v9a2 2 0 0 0 2 2h3.793l1.853 1.854zM1 9V6h14v3H1zm14 1v2a1 1 0 0 1-1 1h-3.793a1 1 0 0 0-.707.293l-1.5 1.5-1.5-1.5A1 1 0 0 0 5.793 13H2a1 1 0 0 1-1-1v-2h14zm0-5H1V3a1 1 0 0 1 1-1h12a1 1 0 0 1 1 1v2zM2 11.5a.5.5 0 0 0 .5.5h8a.5.5 0 0 0 0-1h-8a.5.5 0 0 0-.5.5zm0-4a.5.5 0 0 0 .5.5h11a.5.5 0 0 0 0-1h-11a.5.5 0 0 0-.5.5zm0-4a.5.5 0 0 0 .5.5h6a.5.5 0 0 0 0-1h-6a.5.5 0 0 0-.5.5z" />
                                    </svg>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Sub Menu Title -->
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border-left-primary shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                        Sub Menu Title:</div>
                                    <input type="text" class="title inputbox long" name="subtitle" placeholder="Title"><br>
                                    <input readonly type="text" class="title-seo" style="font-size:14px; float:left; position:absolute;" name="subtitleseo">


                                    <script>
                                        $(document).ready(function() {
                                            $('.title').on('change', function() {
                                                var titleValue = $(this).val();
                                                $('.title-seo').val(titleValue);
                                                var seoValue = titleValue.toLowerCase().replace(/ /g, "-");
                                                $('input[name="titleseo"]').val(seoValue);
                                                $('.page_title').val(titleValue); // set page_title to same value as title
                                                var pageSeoValue = seoValue; // use the same hyphenated value for page_title_seo
                                                $('input[name="pagetitleseo"]').val(pageSeoValue);
                                            });

                                            $('.page_title').on('change', function() {
                                                var pageValue = $(this).val();
                                                $('.page_title_seo').val(pageValue);
                                                var seoValue = pageValue.toLowerCase().replace(/ /g, "-");
                                                $('input[name="pagetitleseo"]').val(seoValue);
                                            });

                                            $('.page_title').on('change', function() {
                                                var pageValue = $(this).val();
                                                $('.page_title_seo').val(pageValue);
                                                var seoValue = pageValue.toLowerCase().replace(/ /g, "-");
                                                $('input[name="pagetitleseo"]').val(seoValue);
                                            });
                                        });
                                    </script>
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

                <!-- Page Heading -->
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border-left-success shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                        Page Heading:</div>
                                    <input type="text" class="page_title" name="subpagetitle" placeholder="Page Header" />
                                    <input readonly type="text" class="page_title_seo" style="visibility:hidden; font-size:14px; float:left; position:absolute;" name="pagetitleseo">

                                </div>
                                <div class="col-auto">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-type-h2" viewBox="0 0 16 16">
                                        <path d="M7.638 13V3.669H6.38V7.62H1.759V3.67H.5V13h1.258V8.728h4.62V13h1.259zm3.022-6.733v-.048c0-.889.63-1.668 1.716-1.668.957 0 1.675.608 1.675 1.572 0 .855-.554 1.504-1.067 2.085l-3.513 3.999V13H15.5v-1.094h-4.245v-.075l2.481-2.844c.875-.998 1.586-1.784 1.586-2.953 0-1.463-1.155-2.556-2.919-2.556-1.941 0-2.966 1.326-2.966 2.74v.049h1.223z" />
                                    </svg>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Page Order -->
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border-left-info shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                        Sub Page Order:
                                    </div>
                                    <div class="row no-gutters align-items-center">
                                        <div class="col-auto">
                                            <input type="text" name="subpageorder" placeholder="Menu Order" />
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

                <div class="col-lg-6">

                    <!-- FCKEDITOR WYSIWYG -->
                    <div class="card mb-4">
                        <div class="card-header">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                        Page content:</div>
                                </div>
                                <div class="col-auto">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-card-text" viewBox="0 0 16 16">
                                        <path d="M14.5 3a.5.5 0 0 1 .5.5v9a.5.5 0 0 1-.5.5h-13a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5h13zm-13-1A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h13a1.5 1.5 0 0 0 1.5-1.5v-9A1.5 1.5 0 0 0 14.5 2h-13z" />
                                        <path d="M3 5.5a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1-.5-.5zM3 8a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9A.5.5 0 0 1 3 8zm0 2.5a.5.5 0 0 1 .5-.5h6a.5.5 0 0 1 0 1h-6a.5.5 0 0 1-.5-.5z" />
                                    </svg>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <textarea id="editor" name="subpagecontent" style="min-height:400px !important;">
                                <!-- FCK EDITOR CONTENT -->
                            </textarea>
                        </div>
                    </div>
                </div>

                <!-- Page Visibility -->
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border-left-warning shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                        Visibility:</div>
                                    <select name="subpagestatus">
                                        <option value="Online">Online</option>
                                        <option value="Offline">Offline</option>
                                        <option value="Hidden">Hidden</option>
                                    </select>
                                </div>
                                <div class="col-auto">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye" viewBox="0 0 16 16">
                                        <path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM1.173 8a13.133 13.133 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.133 13.133 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5c-2.12 0-3.879-1.168-5.168-2.457A13.134 13.134 0 0 1 1.172 8z" />
                                        <path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5zM4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0z" />
                                    </svg>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Custom CSS -->
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border-left-success shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                        Custom CSS:</div>
                                    <textarea></textarea>

                                </div>
                                <div class="col-auto">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-type-h2" viewBox="0 0 16 16">
                                        <path d="M7.638 13V3.669H6.38V7.62H1.759V3.67H.5V13h1.258V8.728h4.62V13h1.259zm3.022-6.733v-.048c0-.889.63-1.668 1.716-1.668.957 0 1.675.608 1.675 1.572 0 .855-.554 1.504-1.067 2.085l-3.513 3.999V13H15.5v-1.094h-4.245v-.075l2.481-2.844c.875-.998 1.586-1.784 1.586-2.953 0-1.463-1.155-2.556-2.919-2.556-1.941 0-2.966 1.326-2.966 2.74v.049h1.223z" />
                                    </svg>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>



                <div class="col-lg-2">
                    <button type="submit" name="submit" class="btn btn-primary btn-user btn-block">
                        Add Subpage
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

    public function editForm($submenu_id = null)
    {
        $submenu_id = isset($_GET['edit']) ? $_GET['edit'] : null;
        //retrieve existing data if menu_id is set
        $row = null;
        if ($submenu_id) {
            $stmt = $this->connect()->prepare('SELECT * FROM sub_menu WHERE submenu_id = ?');
            $stmt->execute(array($submenu_id));
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
        }

        //check if form has been submitted
        if (isset($_POST['update-post'])) {
            $parent = $_POST['menu_parent'];
            $title = $_POST['menu_title'];
            $titleseo = $_POST['menu_title_seo'];
            $pageheading = $_POST['menu_page_title'];
            $pageheadingseo = $_POST['menu_page_title_seo'];
            $menuorder = $_POST['menu_order'];
            $pagecontent = $_POST['menu_content'];
            $visibility = $_POST['menu_status'];

            //update existing page if menu_id is set, otherwise insert new page
            if ($submenu_id) {
                $this->updateSubpage($submenu_id, $parent, $title, $titleseo, $pageheading, $pageheadingseo, $menuorder, $pagecontent, $visibility);
            } else {
                $this->setSubpage($parent, $title, $titleseo, $pageheading, $pageheadingseo, $menuorder, $pagecontent, $visibility);
            }
        }
    ?>
        <form method="post">
            <div class="row">

                <!-- Main Menu -->
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border-left-success shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                        Main Menu:</div>
                                    <select name="mainmenu">
                                        <option value="0">Select Main Menu:</option>
                                        <?php
                                        // Fetch Main Menu
                                        $sql = "SELECT * FROM `menu`";
                                        $stmt = $this->connect()->query($sql);
                                        $mainMenu = $stmt->fetchall(PDO::FETCH_ASSOC);

                                        // Loop through Main Menu and display them in the select option
                                        foreach ($mainMenu as $menu) {
                                            // Set selected attribute for the current sub menu
                                            echo "<option value='" . $menu['menu_id'] . "'>" . $menu['menu_title'] . "</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="col-auto">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-menu-up" viewBox="0 0 16 16">
                                        <path d="M7.646 15.854a.5.5 0 0 0 .708 0L10.207 14H14a2 2 0 0 0 2-2V3a2 2 0 0 0-2-2H2a2 2 0 0 0-2 2v9a2 2 0 0 0 2 2h3.793l1.853 1.854zM1 9V6h14v3H1zm14 1v2a1 1 0 0 1-1 1h-3.793a1 1 0 0 0-.707.293l-1.5 1.5-1.5-1.5A1 1 0 0 0 5.793 13H2a1 1 0 0 1-1-1v-2h14zm0-5H1V3a1 1 0 0 1 1-1h12a1 1 0 0 1 1 1v2zM2 11.5a.5.5 0 0 0 .5.5h8a.5.5 0 0 0 0-1h-8a.5.5 0 0 0-.5.5zm0-4a.5.5 0 0 0 .5.5h11a.5.5 0 0 0 0-1h-11a.5.5 0 0 0-.5.5zm0-4a.5.5 0 0 0 .5.5h6a.5.5 0 0 0 0-1h-6a.5.5 0 0 0-.5.5z" />
                                    </svg>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Sub Menu Title -->
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border-left-primary shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                        Sub Menu Title:</div>
                                    <?php
                                    echo '<input type="text" name="subtitle" value="' . ($submenu_id ? $row['submenu_title'] : '') . '" />';
                                    ?>
                                    <?php
                                    echo '<input readonly style="font-size:14px; float:left; position:absolute; visibility:hidden;" type="text" class="title-seo" name="subtitleseo" value="' . ($submenu_id ? $row['submenu_title'] : '') . '" />';
                                    ?>


                                    <script>
                                        $(document).ready(function() {
                                            $('.title').on('change', function() {
                                                var titleValue = $(this).val();
                                                $('.title-seo').val(titleValue);
                                                var seoValue = titleValue.toLowerCase().replace(/ /g, "-");
                                                $('input[name="titleseo"]').val(seoValue);
                                                $('.page_title').val(titleValue); // set page_title to same value as title
                                                var pageSeoValue = seoValue; // use the same hyphenated value for page_title_seo
                                                $('input[name="pagetitleseo"]').val(pageSeoValue);
                                            });
                                        });
                                    </script>
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

                <!-- Page Heading -->
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border-left-success shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                        Page Heading:</div>
                                    <?php
                                    echo '<input type="text" class="page_title" name="pagetitle" value="' . ($submenu_id ? $row['submenu_page_title'] : '') . '">';
                                    echo '<input readonly type="text" class="page_title_seo" style="font-size:14px; float:left; position:absolute; visibility:hidden;" name="pagetitleseo" value="' . ($submenu_id ? $row['submenu_page_title_seo'] : '') . '">';
                                    ?>
                                </div>
                                <div class="col-auto">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-type-h2" viewBox="0 0 16 16">
                                        <path d="M7.638 13V3.669H6.38V7.62H1.759V3.67H.5V13h1.258V8.728h4.62V13h1.259zm3.022-6.733v-.048c0-.889.63-1.668 1.716-1.668.957 0 1.675.608 1.675 1.572 0 .855-.554 1.504-1.067 2.085l-3.513 3.999V13H15.5v-1.094h-4.245v-.075l2.481-2.844c.875-.998 1.586-1.784 1.586-2.953 0-1.463-1.155-2.556-2.919-2.556-1.941 0-2.966 1.326-2.966 2.74v.049h1.223z" />
                                    </svg>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Page Order -->
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border-left-info shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                        Page order:
                                    </div>
                                    <div class="row no-gutters align-items-center">
                                        <div class="col-auto">
                                            <?php
                                            echo '<input type="text" name="order" value="' . ($submenu_id ? $row['submenu_order'] : '') . '" />';
                                            ?>
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
                <div class="row">
                    <div class="col-lg-6">
                        <!-- FCKEDITOR WYSIWYG -->
                        <div class="card mb-4">
                            <div class="card-header">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                            Page content:</div>
                                    </div>
                                    <div class="col-auto">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-card-text" viewBox="0 0 16 16">
                                            <path d="M14.5 3a.5.5 0 0 1 .5.5v9a.5.5 0 0 1-.5.5h-13a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5h13zm-13-1A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h13a1.5 1.5 0 0 0 1.5-1.5v-9A1.5 1.5 0 0 0 14.5 2h-13z" />
                                            <path d="M3 5.5a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1-.5-.5zM3 8a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9A.5.5 0 0 1 3 8zm0 2.5a.5.5 0 0 1 .5-.5h6a.5.5 0 0 1 0 1h-6a.5.5 0 0 1-.5-.5z" />
                                        </svg>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">

                                <?php
                                echo '<textarea id="editor" name="content" style="min-height:400px !important;">' . ($submenu_id ? $row['submenu_content'] : '') . '</textarea>';
                                ?>
                            </div>
                        </div>
                    </div>

                    <!-- Page Visibility -->
                    <div class="col-xl-3 col-md-6 mb-4">
                        <div class="card border-left-warning shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                            Visibility:</div>
                                        <?php
                                            echo '<select name="status" value="' . ($submenu_id ? $row['submenu_status'] : '') . '">';
                                        ?>
                                            <option value="Online">Online</option>
                                            <option value="Offline">Offline</option>
                                            <option value="Hidden">Hidden</option>
                                        </select>
                                    </div>
                                    <div class="col-auto">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye" viewBox="0 0 16 16">
                                            <path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM1.173 8a13.133 13.133 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.133 13.133 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5c-2.12 0-3.879-1.168-5.168-2.457A13.134 13.134 0 0 1 1.172 8z" />
                                            <path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5zM4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0z" />
                                        </svg>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Custom CSS -->
                    <div class="col-xl-3 col-md-6 mb-4">
                        <div class="card border-left-success shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                            Custom CSS:</div>
                                        <textarea></textarea>

                                    </div>
                                    <div class="col-auto">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-type-h2" viewBox="0 0 16 16">
                                            <path d="M7.638 13V3.669H6.38V7.62H1.759V3.67H.5V13h1.258V8.728h4.62V13h1.259zm3.022-6.733v-.048c0-.889.63-1.668 1.716-1.668.957 0 1.675.608 1.675 1.572 0 .855-.554 1.504-1.067 2.085l-3.513 3.999V13H15.5v-1.094h-4.245v-.075l2.481-2.844c.875-.998 1.586-1.784 1.586-2.953 0-1.463-1.155-2.556-2.919-2.556-1.941 0-2.966 1.326-2.966 2.74v.049h1.223z" />
                                        </svg>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">                  
                <div class="col-lg-2">
                    <button type="submit" name="submit" class="btn btn-primary btn-user btn-block">
                        Update Submenu
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
