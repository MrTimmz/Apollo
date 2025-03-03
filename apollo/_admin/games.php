<?php include "header.php"; ?>

<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <?php
        $project_id = isset($_GET['edit']) ? $_GET['edit'] : null;

        if ($project_id !== null) {
            echo '<h1 class="h3 mb-0 text-gray-800">Update Project</h1>';
        } else {
            echo '<h1 class="h3 mb-0 text-gray-800">Add New Project</h1>';
        }
        ?>
    </div>

    <?php
    $project = new Projects();

    $row = null;
    if ($project_id !== null) {
        $row = $project->getProjectById($project_id);
    }
    ?>
    <form action="includes/projects.inc.php" method="post">
        <div class="row">

            <!-- Project Title -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                    Project Title:
                                </div>

                                <input type="text" class="projects inputbox long" name="projectname" value="<?= $row['project_name'] ?? '' ?>" placeholder="Project Title"><br>

                                <p style="">www.localhost/apollo/
                                    <input readonly type="text" class="projects-seo" style="font-size:14px; float:left; position:absolute;" name="projectnameseo" value="<?= $row['project_name_seo'] ?? '' ?>">
                                </p>

                                <script>
                                    $(document).ready(function() {
                                        $('.projects').on('change', function() {
                                            var projectsValue = $(this).val();
                                            $('.projects-seo').val(projectsValue);
                                            var seoValue = projectsValue.toLowerCase().replace(/ /g, "-");
                                            $('input[name="projectsseo"]').val(seoValue);
                                        });

                                        $('.page_projects').on('change', function() {
                                            var pageValue = $(this).val();
                                            $('.page_projects_seo').val(pageValue);
                                            var seoValue = pageValue.toLowerCase().replace(/ /g, "-");
                                            $('input[name="pageprojectsseo"]').val(seoValue);
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

            <!-- Project Logo -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-success shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                    Project Logo:
                                </div>
                                <div class="row no-gutters align-items-center">
                                    <div class="col-auto">
                                        <div class="avatar-upload">
                                            <div class="avatar-edit">

                                                <input type="hidden" name="image_preview" value="<?= $row['project_logo'] ?? '' ?>" accept=".png, .jpg, .jpeg .webp" />'
                                                <input type="file" id="imageUpload" name="image_preview" value="<?= $row['project_logo'] ?? '' ?>" accept=".png, .jpg, .jpeg .webp" />
                                                <script>
                                                    window.addEventListener("load", function() {
                                                        var fileInput = document.getElementById("imageUpload");
                                                        fileInput.value = fileInput.placeholder;
                                                    });
                                                </script>
                                                <label for="imageUpload"></label>
                                            </div>
                                        </div>
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

            <!-- Project Image -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-success shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                    Project Image:
                                </div>
                                <div class="row no-gutters align-items-center">
                                    <div class="col-auto">
                                        <div class="avatar-upload">
                                            <div class="avatar-edit">

                                                <input type="hidden" name="image_preview" value="<?= $row['project_image'] ?? '' ?>" accept=".png, .jpg, .jpeg .webp" />'
                                                <input type="file" id="imageUpload" name="image_preview" value="<?= $row['project_image'] ?? '' ?>" accept=".png, .jpg, .jpeg .webp" />
                                                <script>
                                                    window.addEventListener("load", function() {
                                                        var fileInput = document.getElementById("imageUpload");
                                                        fileInput.value = fileInput.placeholder;
                                                    });
                                                </script>
                                                <label for="imageUpload"></label>
                                            </div>
                                        </div>
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

            <!-- Project Release -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                    Project Release Date:</div>
                                <input type="date" class="form-control required" name="invoice_date" placeholder="Invoice Date" data-date-format="" value="<?= $row['project_release'] ?? '' ?>" />
                                <span class="input-group-addon">
                                    <span class="glyphicon glyphicon-calendar"></span>
                                </span>
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
        </div>

        <div class="row">

            <div class="col-lg-6">

                <!-- FCKEDITOR WYSIWYG -->
                <div class="card mb-4">
                    <div class="card-header">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                    Project Description:</div>
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

                        echo '<textarea id="editor" name="projectcontent">'
                            . ($project_id ? $row['project_desc'] : '') .
                            '</textarea>';
                        ?>
                    </div>
                </div>
            </div>
        </div>

        <?php if ($project_id !== null) : ?>
            <input type="hidden" name="project_id" value="<?= $project_id ?>">
        <?php endif; ?>

        <div class="row">
            <div class="col-lg-2">
                <button type="submit" name="<?= $project_id ? 'update-post' : 'submit' ?>"
                    class="btn btn-primary btn-user btn-block">
                    <?= $project_id ? 'Update Project' : 'Add Project' ?>
                </button>
            </div>

            <div class="col-lg-2">
                <a href="index.html" class="btn btn-google btn-user btn-block">
                    Cancel
                </a>
            </div>
        </div>
    </form>

</div>
</div>

<script>
    ClassicEditor
        .create(document.querySelector('#editor'), {
            // toolbar: [ 'heading', '|', 'bold', 'italic', 'link' ]
        })
        .then(editor => {
            window.editor = editor;
        })
        .catch(err => {
            console.error(err.stack);
        });
</script>

<?php include "footer.php"; ?>