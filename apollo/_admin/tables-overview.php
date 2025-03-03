<?php include "header.php"; ?>

<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
    <div class="card-header py-3">
            <h6 style="float:left;" class="m-0 font-weight-bold text-primary">Table overview</h6>
            <a href="table.php" style="float:right;" class="btn btn-success btn-icon-split">
                <span class="icon text-white-50">
                    <i class="fas fa-check"></i>
                </span>
                <span class="text">Create New Table</span>
            </a>
        </div>

        <div class="card-header py-3">

            <a href="tables-type-overview.php" style="float:right;" class="btn btn-primary btn-icon-split">
                <span class="icon text-white-50">
                    <i class="fas fa-check"></i>
                </span>
                <span class="text">Manage Type of Tables</span>
            </a>
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Table Number</th>
                            <th>Table Kind</th>
                            <th>Options</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Role Number</th>
                            <th>Table Kind</th>
                            <th>Options</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        <?php $tableObj = new Table();
                        $excsitingTable = $tableObj->getTables();

                        if ($excsitingTable) {
                            foreach ($excsitingTable as $row) {
                        ?>
                                <tr>
                                    <td><?= $row["table_id"] ?></td>
                                    <td><?= $row["kind_name"] ?></td>
                                    <td>
                                        <a href="table.php?edit=<?= $row["table_id"] ?>" class="btn btn-warning btn-block">Edit</a>
                                        <a href="?delete=<?= $row["table_id"] ?>" class="btn btn-google btn-user btn-block">Delete</a>
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