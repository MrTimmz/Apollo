<?php include "header.php"; ?>

<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 style="float:left;" class="m-0 font-weight-bold text-primary">Deleted Users Overview</h6>
            <a href="pages.php" style="float:right;" class="btn btn-success btn-icon-split">
                <span class="icon text-white-50">
                    <i class="fas fa-check"></i>
                </span>
                <span class="text">Add new user</span>
            </a>
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>First Name</th>
                            <th>Middle Name</th>
                            <th>Last Name</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th>Options</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>First Name</th>
                            <th>Middle Name</th>
                            <th>Last Name</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th>Options</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        <?php $userObj = new Users();
                        $deletedObject = $userObj->getDeletedUser();

                        if ($deletedObject) {
                            foreach ($deletedObject as $row) {
                        ?>
                                <tr>
                                    <td><?= $row["user_fname"] ?> </td>
                                    <td><?= $row["user_prefix"] ?></td>
                                    <td><?= $row["user_lname"] ?></td>
                                    <td><?= $row["user_email"] ?></td>
                                    <td><?= $row["user_role"] ?></td>
                                    <td>
                                        <a href="?return=<?= $row["user_id"] ?>" class="btn btn-warning">Return</a>
                                        <a href="?trash=<?= $row["user_id"] ?>" class="btn btn-danger">Trash</a>
                                    </td>
                                </tr>
                        <?php
                            }
                        }

                        if (isset($_GET['trash'])) {
                            $trashUsers = new Users();
                            $trashUsers->trashUser($_GET['trash']);
                        }

                        if (isset($_GET['return'])) {
                            $returnUsers = new Users();
                            $returnUsers->returnUser($_GET['return']);
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