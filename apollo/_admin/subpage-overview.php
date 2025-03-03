<?php include "header.php"; ?>

<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 style="float:left;" class="m-0 font-weight-bold text-primary">Submenu overview</h6>
            <a href="subpage.php" style="float:right;" class="btn btn-success btn-icon-split">
                <span class="icon text-white-50">
                    <i class="fas fa-check"></i>
                </span>
                <span class="text">Add new Submenu</span>
            </a>
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Main Menu</th>
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
                            <th>Main Menu</th>
                            <th>Menu Title</th>
                            <th>Page Title</th>
                            <th>Menu Order</th>
                            <th>Visibility</th>
                            <th>Created</th>
                            <th>Options</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        <?php $subpageObj = new Subpage();
                        $subpageObj->getSubpage(); ?>

                        <?php
                        if (isset($_GET['delete'])) {
                            $pages = new Subpage();
                            $pages->deleteSubpage($_GET['delete']);
                        }
                        ?>

                        <?php
                        if (isset($_GET['edit'])) {
                            $editpageObj = new Subpage();
                            $editpageObj->editForm($_GET['edit']);
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