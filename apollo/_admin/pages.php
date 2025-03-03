<?php include "header.php"; ?>

<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <?php
        $menu_id = isset($_GET['edit']) ? $_GET['edit'] : null;

        if ($menu_id !== null) {
            echo '<h1 class="h3 mb-0 text-gray-800">Update page</h1>';
        } else {
            echo '<h1 class="h3 mb-0 text-gray-800">Add new page</h1>';
        }
        ?>
    </div>

    <?php
    $page = new Pages();

    $row = null;
    if ($menu_id !== null) {
        $row = $page->getPageById($menu_id);
    }
    ?>
    <form action="includes/pages.inc.php" method="post">
        <div class="row">

            <!-- Menu Title -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                    Menu Title:
                                </div>

                                <input type="text" class="title inputbox long" name="title" image_category_title placeholder="Title"><br>

                                <p style="">www.localhost/apollo/
                                    <input readonly type="text" class="title-seo" style="font-size:14px; float:left; position:absolute;" name="titleseo" value="<?= $row['menu_title_seo'] ?? '' ?>">
                                </p>

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
                                echo '<input type="text" class="page_title" name="pagetitle" value="' . ($menu_id ? $row['menu_page_title'] : '') . '">';
                                echo '<p style="">www.localhost/apollo/<input readonly type="text" class="page_title_seo" style="font-size:14px; float:left; position:absolute;" name="pagetitleseo" value="' . ($menu_id ? $row['menu_page_title_seo'] : '') . '">></p>';
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
                                        echo '<input type="text" name="order" value="' . ($menu_id ? $row['menu_order'] : '') . '" />';
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
                                echo '<select name="status" value="' . ($menu_id ? $row['menu_status'] : '') . '">';

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
                        echo '<textarea id="editor" name="content">'
                            . ($menu_id ? $row['menu_content'] : '') .
                            '</textarea>';
                        ?>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6 mb-4">

                <!-- Default Card Example -->
                <div class="card mb-4">
                    <div class="card-header">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                    SEO KeyWords:</div>
                            </div>
                            <div class="col-auto">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-code-slash" viewBox="0 0 16 16">
                                    <path d="M10.478 1.647a.5.5 0 1 0-.956-.294l-4 13a.5.5 0 0 0 .956.294l4-13zM4.854 4.146a.5.5 0 0 1 0 .708L1.707 8l3.147 3.146a.5.5 0 0 1-.708.708l-3.5-3.5a.5.5 0 0 1 0-.708l3.5-3.5a.5.5 0 0 1 .708 0zm6.292 0a.5.5 0 0 0 0 .708L14.293 8l-3.147 3.146a.5.5 0 0 0 .708.708l3.5-3.5a.5.5 0 0 0 0-.708l-3.5-3.5a.5.5 0 0 0-.708 0z" />
                                </svg>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                    <textarea type="text" class="seo_keywords inputbox long" name="seo_keywords" placeholder="SEO Keywords" value="<?= $row['menu_content_seo'] ?? '' ?>" readonly></textarea>
                    </div>
                </div>
            </div>



            <div class="col-xl-3 col-md-6 mb-4">

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
                        <?php
                        echo '<textarea name="styling">' . ($menu_id ? $row["menu_css"] : '') . '</textarea>';
                        ?>
                    </div>
                </div>
            </div>
        </div>

        <?php if ($menu_id !== null) : ?>
            <input type="hidden" name="menu_id" value="<?= $menu_id ?>">
        <?php endif; ?>

        <div class="row">
            <div class="col-lg-2">
                <button type="submit" name="<?= $menu_id ? 'update-post' : 'submit' ?>"
                    class="btn btn-primary btn-user btn-block">
                    <?= $menu_id ? 'Update Page' : 'Add Page' ?>
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