<?php include "header.php"; ?>

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <?php $news_id = isset($_GET['edit']) ? $_GET['edit'] : null;

        if ($news_id !== null) {
            echo '<h1 class="h3 mb-0 text-gray-800">Update Article</h1>';
        } else {
            echo '<h1 class="h3 mb-0 text-gray-800">Add New Article</h1>';
        }
        ?>

    </div>

    <?php $news = new News();

    $row = null;
    if ($news_id !== null) {
        $row = $news->getNewsById($news_id);
    }
    ?>

    <form action="includes/news.inc.php" method="post" enctype="multipart/form-data">
        <div class="row">
            <!-- News Title -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                    News Title:</div>
                                <input type="text" class="title inputbox long" name="title" value="<?= $row['news_title'] ?? '' ?>" placeholder="Article Title"><br>
                                <p style="">news/<input readonly type="text" class="title-seo" style="font-size:14px; float:left; position:absolute;" value="<?= $row['news_title_seo'] ?? '' ?>" name="titleseo"></p>
                                <script>
                                    $(document).ready(function() {
                                        $('.title').on('change', function() {
                                            var titleValue = $(this).val();

                                            // Remove all special characters and numbers
                                            var cleanedTitleValue = titleValue.replace(/[^a-zA-Z\s]/g, '');

                                            // Remove extra spaces and trim whitespace
                                            cleanedTitleValue = cleanedTitleValue.replace(/\s+/g, ' ').trim();

                                            // Set the cleaned title value to the input fields
                                            $('.title-seo').val(cleanedTitleValue);
                                            var seoValue = cleanedTitleValue.toLowerCase().replace(/ /g, "-");
                                            $('input[name="titleseo"]').val(seoValue);
                                            $('.page_title').val(cleanedTitleValue); // Set page_title to the cleaned title
                                            var pageSeoValue = seoValue; // Use the same hyphenated value for page_title_seo
                                            $('input[name="pagetitleseo"]').val(pageSeoValue);
                                        });
                                    });
                                </script>


                            </div>
                            <div class="col-auto">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-fill" viewBox="0 0 16 16">
                                    <path d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H3Zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6Z" />
                                </svg>
                            </div>

                        </div>
                    </div>
                </div>
            </div>

            <!-- News Image -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-info shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col-mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                    News Image Thumbnail:</div>
                                <div class="avatar-upload">
                                    <div class="avatar-edit">
                                        <input type="file" name="image" id="imageUpload">
                                        <label for="imageUpload"></label>
                                    </div>
                                    <!-- Show current image if available -->
                                    <div class="avatar-preview">
                                        <?php if ($news_id && !empty($row['news_header_image'])): ?>
                                            <img src="../uploads/news/<?= $row['news_header_image'] ?>" alt="Current Image" style="max-width: 100%; height: auto;">
                                        <?php else: ?>
                                            <p>No image uploaded</p>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <!-- News Status -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                    Visibility:</div>
                                <select name="status">
                                    <option value="Online">Online</option>
                                    <option value="Offline">Offline</option>
                                    <option value="Hidden">Hidden</option>
                                </select>
                            </div>
                            <div class="col-auto">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-fill" viewBox="0 0 16 16">
                                    <path d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H3Zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6Z" />
                                </svg>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <!-- News type -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                    News type "Featured is frontpage top":</div>
                                <select name="type">
                                    <option value="normal">Normal</option>
                                    <option value="featured">Featured</option>
                                    <option value="blog">Blog</option>
                                </select>
                            </div>
                            <div class="col-auto">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-fill" viewBox="0 0 16 16">
                                    <path d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H3Zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6Z" />
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
                    <!-- Other parts of your form -->

                    <div class="card-body">
                        <?php
                        echo '<textarea id="editor" name="content" class="newscontent inputbox long">'
                            . ($news_id ? $row['news_content'] : '') .
                            '</textarea>';
                        ?>
                        <input hidden readonly type="text" class="newscontentseo" style="font-size:14px; float:left; position:absolute;" value="<?= $row['news_content_seo'] ?? '' ?>" name="newscontentseo">

                        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
                        <script>
                            // Check if editor already exists, if not initialize it
                            if (window.editor) {
                                window.editor.destroy()
                                    .then(() => {
                                        initEditor();
                                    })
                                    .catch(error => {
                                        console.error('Error destroying editor:', error);
                                    });
                            } else {
                                initEditor();
                            }

                            function initEditor() {
                                ClassicEditor
                                    .create(document.querySelector('#editor'))
                                    .then(editor => {
                                        window.editor = editor; // Save the CKEditor instance globally

                                        // Add listener to CKEditor content changes
                                        editor.model.document.on('change:data', () => {
                                            var NewsValue = editor.getData(); // Get content from CKEditor

                                            // Clean and format content for SEO field
                                            var cleanedNewsValue = NewsValue.replace(/[^a-zA-Z\s]/g, '').replace(/\s+/g, ' ').trim();
                                            var seoValue = cleanedNewsValue.toLowerCase().replace(/\s+/g, '-');

                                            // Set the SEO value
                                            $('input[name="newscontentseo"]').val(seoValue);
                                        });
                                    })
                                    .catch(error => {
                                        console.error('Error initializing editor:', error);
                                    });
                            }
                        </script>
                    </div>

                </div>
            </div>

            <!-- News project -->
            <?php
            $projects = new News();
            $allProjects = $projects->getProjects();
            $currentProjectId = $projects->getProjectForNews($news_id);
            ?>
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                    News Project:
                                </div>
                                <select name="project">
                                    <option value="">Select Project</option>
                                    <?php
                                    foreach ($allProjects as $row) {
                                        $selected = ($row['project_id'] == $currentProjectId) ? 'selected' : '';
                                        echo "<option value='{$row['project_id']}' {$selected}>{$row['project_name']}</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="col-auto">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-fill" viewBox="0 0 16 16">
                                    <path d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H3Zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6Z" />
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
                                    Thumbnail Preview:</div>
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
                            <?php if ($news_id && !empty($row['news_header_image'])): ?>
                                <div id="imagePreview" style="background-image: url('../uploads/news/<?= $row['news_header_image'] ?>'); background-size: cover; width:250px; height:250px; background-position:center;"></div>
                            <?php else: ?>
                                <div id="imagePreview" style="background-image: url('http://i.pravatar.cc/500?img=7'); background-size: cover; width:250px; height:250px; background-position:center;"></div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>


        </div>

        <?php if ($news_id !== null) : ?>
            <input type="hidden" name="news_id" value="<?= $news_id ?>">
        <?php endif; ?>

        <div class="row">
            <div class="col-lg-2">
                <button type="submit" name="<?= $news_id ? 'update-news' : 'submit' ?>"
                    class="btn btn-primary btn-user btn-block">
                    <?= $news_id ? 'Update News Article' : 'Add News Article' ?>
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


<?php include "footer.php"; ?>