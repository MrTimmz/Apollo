<?php include "header.php"; ?>

<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 style="float:left;" class="m-0 font-weight-bold text-primary">Forms overview</h6>
            <a href="forms.php" style="float:right;" class="btn btn-success btn-icon-split">
                <span class="icon text-white-50">
                    <i class="fas fa-check"></i>
                </span>
                <span class="text">Add New Form</span>
            </a>
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Form Title</th>
                            <th>Form Lists</th>
                            <th>Form Order</th>
                            <th>Form Status</th>
                            <th>Form Created</th>
                            <th style="width:10%;">Options</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                        <th>Form Title</th>
                            <th>Form Order</th>
                            <th>Form Lists</th>
                            <th>Form Status</th>
                            <th>Form Created</th>
                            <th style="width:10%;">Options</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        <?php $formObj = new Forms();
                        $formObj->getForms(); ?>

                        <?php
                        if (isset($_GET['delete'])) {
                            $deleteForm = new Forms();
                            $deleteForm->deleteForm($_GET['delete']);
                        }
                        ?>

                        <?php
                        if (isset($_GET['edit'])) {
                            $editForm = new Forms();
                            $editForm->editForm($_GET['edit']);
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