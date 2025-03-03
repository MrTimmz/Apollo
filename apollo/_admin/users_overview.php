<?php include "header.php"; ?>

<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 style="float:left;" class="m-0 font-weight-bold text-primary">User overview</h6>
            <a href="users.php" style="float:right;" class="btn btn-success btn-icon-split">
                <span class="icon text-white-50">
                    <i class="fas fa-check"></i>
                </span>
                <span class="text">Add new User</span>
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
                        $excistingUser = $userObj->getUser();

                        if ($excistingUser) {
                            foreach ($excistingUser as $row) {
                        ?>
                                <tr>
                                    <td><?= $row["user_fname"] ?> </td>
                                    <td><?= $row["user_prefix"] ?></td>
                                    <td><?= $row["user_lname"] ?></td>
                                    <td><?= $row["user_email"] ?></td>
                                    <td><?= $row["role_title"] ?></td>
                                    <td>
                                        <a href="users.php?edit=<?= $row["user_id"] ?>" class="btn btn-warning btn-block">Edit</a>
                                        <a href="?delete=<?= $row["user_id"]; ?>" class="btn btn-google btn-user btn-block">Delete</a>';
                                    </td>
                                </tr>
                        <?php
                            }
                        }
                        if (isset($_GET['delete'])) {
                            $deleteuser = new Users();
                            $deleteuser->deleteUser($_GET['delete']);
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