<?php include "header.php"; ?>

<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 style="float:left;" class="m-0 font-weight-bold text-primary">Image category overview</h6>
            <a href="imagescategory.php" style="float:right;" class="btn btn-success btn-icon-split">
                <span class="icon text-white-50">
                    <i class="fas fa-check"></i>
                </span>
                <span class="text">Add new category</span>
            </a>
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Category Title</th>
                            <th>Category Order</th>
                            <th>Visibility</th>
                            <th>Total Images</th>
                            <th>Created</th>
                            <th>Options</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Category Title</th>
                            <th>Category Order</th>
                            <th>Visibility</th>
                            <th>Total Images</th>
                            <th>Created</th>
                            <th>Options</th>
                        </tr>
                    </tfoot>
                    <tbody>

                        <?php $imagecategory = new imagesCategory();
                        $excistingCategory = $imagecategory->getCategory();

                        if ($excistingCategory) {
                            foreach ($excistingCategory as $row) {
                                echo '<tr>';
                                echo '<td>' . $row["image_category_title"] . '</td>';
                                echo '<td> ' . $row["image_category_order"] . '</td>';
                                echo '<td>' . $row["image_category_status"] . '</td>';
                                echo '<td>' . $row["count"] . '</td>';
                                echo '<td>' . $row["image_category_created"] . '</td>';
                                echo '<td>
                                            <a href="imagescategory.php?edit=' . $row["image_category_id"] . '" class="btn btn-warning btn-block">Edit</a>
                                            <a href="?delete=' . $row["image_category_id"] . '" class="btn btn-google btn-user btn-block">Delete</a>';
                                '</td>';
                                echo '</tr>';
                            }
                        }

                        if (isset($_GET['delete'])) {
                            $deletecat = new imagesCategory();
                            $deletecat->deleteCategory($_GET['delete']);
                        }
                        ?>

                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->
<?php include "footer.php"; ?>