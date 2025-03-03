<?php include "header.php"; ?>

<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
    <div class="card-header py-3">
            <h6 style="float:left;" class="m-0 font-weight-bold text-primary">Table Kind overview</h6>
            <a href="tablekind.php" style="float:right;" class="btn btn-success btn-icon-split">
                <span class="icon text-white-50">
                    <i class="fas fa-check"></i>
                </span>
                <span class="text">Create New Table Kind</span>
            </a>
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Table kind</th>
                            <th>Total Table's of this kind</th>
                            <th>Options</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                        <th>Table kind</th>
                        <th>Total Table's of this kind</th>
                            <th>Options</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        <?php $roleObj = new tableKind();
                        $excistingRole = $roleObj->getKind();

                        if ($excistingRole) {
                            foreach ($excistingRole as $row) {
                        ?>
                                <tr>
                                    <td><?= $row["kind_name"] ?></td>
                                    <td></td>
                                    <td>
                                        <a href="kindof.php?edit=<?= $row["kind_id"] ?>" class="btn btn-warning btn-block">Edit</a>
                                        <a href="?delete=<?= $row["kind_id"] ?>" class="btn btn-google btn-user btn-block">Delete</a>
                                        '
                                    </td>
                                </tr>
                        <?php
                            }
                        }

                        if (isset($_GET['delete'])) {
                            $deleteRole = new Roles();
                            $deleteRole->deleteRole($_GET['delete']);
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