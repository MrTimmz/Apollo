<?php

class Forms extends Dbh
{

    public function getForms()
    {
        $sql = 'SELECT * FROM forms WHERE form_deleted IS NULL ORDER BY form_order ASC ';
        $stmt = $this->connect()->query($sql);
        while ($row = $stmt->fetch()) {
            echo '<tr>';
            echo '<td>' . $row["form_title"] . '</td>';
            echo '<td>' . $row["form_order"] . '</td>';
            echo '<td>666</td>';
            echo '<td>' . $row["form_status"] . '</td>';
            echo '<td>' . $row["form_created"] . '</td>';
            echo '<td>
                    <a href="forms-list.php" class="btn btn-success btn-block">Add Lists</a>
                    <a href="forms.php?edit=' . $row["forms_id"] . '" class="btn btn-warning btn-block">Edit</a>
                    <a href="?delete=' . $row["forms_id"] . '" class="btn btn-google btn-user btn-block">Delete</a>';
            '</td>';
            echo '</tr>';
        }
    }

    public function deleteForm($id)
    {
        $sql = 'UPDATE forms SET form_deleted = NOW() WHERE forms_id = :id';
        $stmt = $this->connect()->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
    }

    public function getDeletedForms()
    {
        $sql = 'SELECT * FROM forms WHERE form_deleted IS NOT NULL';
        $stmt = $this->connect()->query($sql);
        while ($row = $stmt->fetch()) {
            echo '<tr>';
            echo '<td>' . $row["form_title"] . '</td>';
            echo '<td>' . $row["form_order"] . '</td>';
            echo '<td>' . $row["form_status"] . '</td>';
            echo '<td>' . $row["form_created"] . '</td>';
            echo '<td>
                    <a href="?return=' . $row["forms_id"] . '" class="btn btn-google btn-user btn-block chartjs-render-monitor" >Return</a>
                    <a href="?trash=' . $row["forms_id"] . '" class="btn btn-google btn-user btn-block">Trash</a>';
            '</td>';
            echo '</tr>';
        }
    }

    public function trashForm($id)
    {
        $sql = 'DELETE FROM forms  WHERE forms_id = :id';
        $stmt = $this->connect()->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();

        echo "<script>location.href='pages-deleted.php';</script>";
    }

    public function returnForm($id)
    {
        $sql = 'UPDATE forms SET form_deleted = NULL WHERE forms_id = :id';
        $stmt = $this->connect()->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();

        echo "<script>location.href='forms-overview.php';</script>";
    }

    //insert new data into table
    protected function setForm($title, $titleseo, $order, $visibility)
    {
        $stmt = $this->connect()->prepare('INSERT INTO forms ( `form_title`, `form_title_seo`,  `form_order`, `form_status`) VALUES (?, ?, ?, ?);');

        //stop running and execute error statement
        if (!$stmt->execute(array($title, $titleseo, $order, $visibility))) {
            $stmt = null;

            exit();
        }

        $stmt = null;
    }

    protected function updateForm($forms_id, $title, $titleseo, $order, $visibility)
    {

        $stmt = $this->connect()->prepare('UPDATE forms SET `form_title` = ?, `form_title_seo` = ?, `form_order` = ?, `form_status` = ? WHERE `forms_id` = ?');

        //stop running and execute error statement
        if (!$stmt->execute(array($title, $title, $titleseo, $order, $visibility, $forms_id))) {
            $stmt = null;

            exit();
        }

        $stmt = null;
        echo "<script>location.href='forms-overview.php';</script>";
    }

    //echo form
    public function echoForm()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Check if form has been submitted
            $title = $_POST["title"];
            $titleseo = $_POST["titleseo"];
            $order = $_POST["order"];
            $visibility = $_POST["status"];

            // Call setForm() with form data
            $this->setForm($title, $titleseo, $order, $visibility);
        }
?>
        <form action="includes/forms.inc.php" method="post">
            <div class="row">

                <!-- form Title -->
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border-left-primary shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                        form Title:</div>
                                    <input type="text" class="title inputbox long" name="title" placeholder="Title"><br>
                                    <p style="">www.localhost/apollo/<input readonly type="text" class="title-seo" style="font-size:14px; float:left; position:absolute;" name="titleseo"></p>

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

                <!-- Form Order -->
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
                                            <input type="text" name="order" placeholder="form Order" />
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

                <!-- Page Visibility -->
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border-left-warning shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                        Visibility:</div>
                                    <select name="status">
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
            </div>

            <div class="row">   
                <div class="col-lg-2">
                    <button type="submit" name="submit" class="btn btn-primary btn-user btn-block">
                        Add Form
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

    public function editForm($forms_id = null)
    {
        $forms_id = isset($_GET['edit']) ? $_GET['edit'] : null;
        //retrieve existing data if forms_id is set
        $row = null;
        if ($forms_id) {
            $stmt = $this->connect()->prepare('SELECT * FROM form WHERE forms_id = ?');
            $stmt->execute(array($forms_id));
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
        }

        //check if form has been submitted
        if (isset($_POST['update-post'])) {
            $title = $_POST["title"];
            $titleseo = $_POST["titleseo"];
            $order = $_POST["order"];
            $visibility = $_POST["status"];

            //update existing page if forms_id is set, otherwise insert new page
            if ($forms_id) {
                $this->updateForm($forms_id, $title, $titleseo, $order, $visibility);
            } else {
                $this->setForm($title, $title, $titleseo, $order, $visibility);
            }
        }
    ?>
        <form method="post">
            <div class="row">

                <!-- form Title -->
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border-left-primary shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                        form Title:</div>
                                    <?php
                                    echo '<input type="text" class="title inputbox long" name="title" value="' . ($forms_id ? $row['form_title'] : '') . '"><br>';
                                    echo '<p style="">www.localhost/apollo/<input readonly type="text" class="title-seo" style="font-size:14px; float:left; position:absolute;" name="titleseo" value="' . ($forms_id ? $row['form_title_seo'] : '') . '"></p>'
                                    ?>

                                    <script>
                                        $(document).ready(function() {
                                            $('.title').on('change', function() {
                                                var titleValue = $(this).val();
                                                $('.title-seo').val(titleValue);
                                                var seoValue = titleValue.toLowerCase().replace(/ /g, "-");
                                                $('input[name="titleseo"]').val(seoValue);
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
                                    <?php
                                    echo '<input type="text" class="page_title" name="pagetitle" value="' . ($forms_id ? $row['form_page_title'] : '') . '">';
                                    echo '<p style="">www.localhost/apollo/<input readonly type="text" class="page_title_seo" style="font-size:14px; float:left; position:absolute;" name="pagetitleseo" value="' . ($forms_id ? $row['form_page_title_seo'] : '') . '">></p>';
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
                                            echo '<input type="text" name="order" value="' . ($forms_id ? $row['form_order'] : '') . '" />';
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

                <!-- Page Visibility -->
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border-left-warning shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                        Visibility:</div>
                                    <?php
                                    echo '<select name="status" value="' . ($forms_id ? $row['form_status'] : '') . '">';

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
                            echo '<textarea id="editor" name="content" style="min-height:400px !important;">' . ($forms_id ? $row['form_content'] : '') . '</textarea>';
                            ?>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6">

                    <!-- Default Card Example -->
                    <div class="card mb-4">
                        <div class="card-header">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                        custom CSS:</div>
                                </div>
                                <div class="col-auto">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-code-slash" viewBox="0 0 16 16">
                                        <path d="M10.478 1.647a.5.5 0 1 0-.956-.294l-4 13a.5.5 0 0 0 .956.294l4-13zM4.854 4.146a.5.5 0 0 1 0 .708L1.707 8l3.147 3.146a.5.5 0 0 1-.708.708l-3.5-3.5a.5.5 0 0 1 0-.708l3.5-3.5a.5.5 0 0 1 .708 0zm6.292 0a.5.5 0 0 0 0 .708L14.293 8l-3.147 3.146a.5.5 0 0 0 .708.708l3.5-3.5a.5.5 0 0 0 0-.708l-3.5-3.5a.5.5 0 0 0-.708 0z" />
                                    </svg>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <textarea></textarea>
                        </div>
                    </div>
                </div>
                <div class="col-lg-2">
                    <a href="forms-overview.php">
                        <button type="submit" name="update-post" value="update-post" class="btn btn-primary btn-user btn-block">
                            Update Form
                        </button>
                    </a>
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
