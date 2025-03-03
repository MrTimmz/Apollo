<?php include "header.php"; ;?>

<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 style="float:left;" class="m-0 font-weight-bold text-primary">Roles overview</h6>
            <a href="roles.php" style="float:right;" class="btn btn-success btn-icon-split">
                <span class="icon text-white-50">
                    <i class="fas fa-check"></i>
                </span>
                <span class="text">Add New Role</span>
            </a>
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Role Title</th>
                            <th>Role Deleted</th>
                            <th>Options</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Role Title</th>
                            <th>Role Deleted</th>
                            <th>Options</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        <?php $roleObj = new Roles();
                        $roleObj->getDeletedRoles(); ?>

                        <?php
                        if (isset($_GET['trash'])) {
                            $trashrole = new Roles();
                            $trashrole->trashRole($_GET['trash']);
                        }
                        ?>

                        <?php
                        if (isset($_GET['return'])) {
                            $editrole = new Roles();
                            $editrole->returnRole($_GET['return']);
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