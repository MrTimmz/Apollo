<?php include "header.php"; ?>

<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 style="float:left;" class="m-0 font-weight-bold text-primary">Image category overview</h6>
            <a href="add-page.php" style="float:right;" class="btn btn-success btn-icon-split">
                <span class="icon text-white-50">
                    <i class="fas fa-check"></i>
                </span>
                <span class="text">Add New Category</span>
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
                       <?php $deletedCategory = new imagesCategory();
                       $deletedCategories = $deletedCategory->getDeletedCategory();
                       if($deletedCategories) {
                        foreach ($deletedCategories as $row){
                            echo '<tr>';
                            echo '<td>' . $row["image_category_title"] . '</td>';
                            echo '<td> ' . $row["image_category_order"] . '</td>';
                            echo '<td>' . $row["image_category_status"] . '</td>';
                            echo '<td>' . $row["count"] . '</td>';
                            echo '<td>' . $row["image_category_created"] . '</td>';
                            echo '<td>
                                    <a href="?return=' . $row["image_category_id"] . '" class="btn btn-warning btn-block">Return</a>
                                    <a href="?trash=' . $row["image_category_id"] . '" class="btn btn-google btn-user btn-block">Trash</a>';
                            '</td>';
                            echo '</tr>';
                        }
                       }

                       if (isset($_GET['trash'])) { $trashCategories = new imagesCategory(); $trashCategories->trashCategory($_GET['trash']); }

                    if (isset($_GET['return'])) { $returnCategories = new imagesCategory(); $returnCategories->returnCategory($_GET['return']); }

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