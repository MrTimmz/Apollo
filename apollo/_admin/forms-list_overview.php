<?php include "header.php"; ?>

<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 style="float:left;" class="m-0 font-weight-bold text-primary">Form Lists Overciews</h6>
            <a href="images.php" style="float:right;" class="btn btn-success btn-icon-split">
                <span class="icon text-white-50">
                    <i class="fas fa-check"></i>
                </span>
                <span class="text">Add New Image</span>
            </a>
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Form List Name</th>
                            <th>Form List Assigned</th>
                            <th>Options</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                        <th>Form List Name</th>
                            <th>Form List Assigned</th>
                            <th>Options</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        <?php $categoryObj = new formsList();
                        $categoryObj->getformsList(); ?>

                        <?php
                        if (isset($_GET['delete'])) {
                            $deletecat = new formsList();
                            $deletecat->deleteformsList($_GET['delete']);
                        }
                        ?>

                        <?php
                        if (isset($_GET['edit'])) {
                            $editCat = new formsList();
                            $editCat->updateformList($_GET['edit']);
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