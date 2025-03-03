<?php include "header.php"; ?>

<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 style="float:left;" class="m-0 font-weight-bold text-primary">Clients overview</h6>
            <a href="clients.php" style="float:right;" class="btn btn-success btn-icon-split">
                <span class="icon text-white-50">
                    <i class="fas fa-check"></i>
                </span>
                <span class="text">Add New Client</span>
            </a>
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Client Name</th>
                            <th>Client Email</th>
                            <th>Client Phone number</th>
                            <th>Client address + zipcode</th>
                            <th>Client City</th>
                            <th>Client Province</th>
                            <th>Client Country</th>
                            <th>Options</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Client Name</th>
                            <th>Client Email</th>
                            <th>Client Phone number</th>
                            <th>Client address + zipcode</th>
                            <th>Client City</th>
                            <th>Client Province</th>
                            <th>Client Country</th>
                            <th>Options</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        <?php $clientObj = new Clients();
                        $clientObj->getClients();

                        $excistingObject = $clientObj->getClients();

                        if ($excistingObject) {
                            foreach ($excistingObject as $row) {
                                echo '<tr>';
                                echo '<td>' . $row["client_name"] . '</td>';
                                echo '<td>' . $row["client_email"] . '</td>';
                                echo '<td>' . $row["client_phone"] . '</td>';
                                echo '<td>' . $row["client_address"] . '&nbsp; - &nbsp;' . $row["client_town"] . '</td>';
                                echo '<td>' . $row["client_province"] . '</td>';
                                echo '<td>' . $row["client_zipcode"] . '</td>';
                                echo '<td>' . $row["client_country"] . '</td>';
                                echo '<td>
                                        <a href="clients.php?edit=' . $row["client_id"] . '" class="btn btn-warning btn-block">Edit</a>
                                        <a href="?delete=' . $row["client_id"] . '" class="btn btn-google btn-user btn-block">Delete</a>';
                                '</td>';
                                echo '</tr>';
                            }
                        }

                        if (isset($_GET['delete'])) {
                            $pages = new Clients();
                            $pages->deleteClients($_GET['delete']);
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