<?php include "header.php"; ?>

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <?php $image_category_id = isset($_GET['edit']) ? $_GET['edit'] : null;

        if ($image_category_id !== null) {
            echo '<h1 class="h3 mb-0 text-gray-800">Update category</h1>';
        } else {
            echo '<h1 class="h3 mb-0 text-gray-800">Add new category</h1>';
        }
        ?>

    </div>


    <?php
    $imageCategory = new imagesCategory();

    $row = null;
    if ($image_category_id !== null) {
        $row = $imageCategory->getImageCategoryById($image_category_id);
    }
    ?>

    <form action="includes/imagescategory.inc.php" method="post" enctype="multipart/form-data">
        <div class="row">

            <!-- Category Title -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                    Category Title:</div>

                                <input type="text" class="title inputbox long" name="title" value="<?= $row['image_category_title'] ?? '' ?>"><br>
                                <p style="">www.localhost/apollo/<input readonly type="text" class="title-seo" style="font-size:14px; float:left; position:absolute;" name="titleseo" value="<?= $row['image_cartegory_title_seo'] ?? '' ?>"></p>
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

            <!-- Category Thumbnail -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-success shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                    Category Thumbnail:
                                </div>
                                <div class="row no-gutters align-items-center">
                                    <div class="col-auto">
                                        <div class="avatar-upload">
                                            <div class="avatar-edit">

                                                <input type="hidden" name="image_preview" value="<?= $row['image_category_preview'] ?? '' ?>" accept=".png, .jpg, .jpeg .webp" />'
                                                <input type="file" id="imageUpload" name="image_preview" value="<?= $row['image_category_preview'] ?? '' ?>" accept=".png, .jpg, .jpeg .webp" />
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
                                        <input type="text" name="order" value="<?= $row['image_category_order'] ?? '' ?>" />
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
                                <select name="status" value="<? $row['image_category_status'] ?? '' ?>">';
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

                            <div id="imagePreview" style="background-size: 250px 250px; width: 250px; height: 250px; background-position: center; background-image: url(<?= $webRootImage . $row['image_category_preview'] ?? '' ?>);">
                                <span></span>
                            </div>

                        </div>
                    </div>
                </div>
            </div>

            <?php if ($image_category_id !== null) : ?>
                <input type="hidden" name="image_category_id" value="<?= $image_category_id ?>">
            <?php endif; ?>

            <div class="col-lg-2">
                <a href="overview-pages.php">
                    <button type="submit" name="<?= $image_category_id ? 'update-category' : 'submit' ?>"
                        class="btn btn-primary btn-user btn-block">
                        Update Category
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