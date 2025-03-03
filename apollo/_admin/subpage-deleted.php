<?php include "header.php"; ?>

<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 style="float:left;" class="m-0 font-weight-bold text-primary">Menu overview</h6>
            <a href="add-page.php" style="float:right;" class="btn btn-success btn-icon-split">
                <span class="icon text-white-50">
                    <i class="fas fa-check"></i>
                </span>
                <span class="text">Add new page</span>
            </a>
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Menu Title</th>
                            <th>Page Title</th>
                            <th>Menu Order</th>
                            <th>Visibility</th>
                            <th>Created</th>
                            <th>Options</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Menu Title</th>
                            <th>Page Title</th>
                            <th>Menu Order</th>
                            <th>Visibility</th>
                            <th>Created</th>
                            <th>Options</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        <?php $pageObj = new Pages();
                        $pageObj->getDeletedPages(); ?>

                        <?php
                        if (isset($_GET['trash'])) {
                            $pages = new Pages();
                            $pages->trashPage($_GET['trash']);
                        }
                        ?>

                        <?php
                        if (isset($_GET['return'])) {
                            $editpageObj = new Pages();
                            $editpageObj->returnPage($_GET['return']);
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