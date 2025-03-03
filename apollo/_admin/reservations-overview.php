<?php include "header.php"; ?>

<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 style="float:left;" class="m-0 font-weight-bold text-primary">Reservations overview</h6>
            <a href="reservations.php" style="float:right;" class="btn btn-success btn-icon-split">
                <span class="icon text-white-50">
                    <i class="fas fa-check"></i>
                </span>
                <span class="text">Create New Reservations</span>
            </a>
        </div>

        <div class="card-header py-3">

            <a href="tables-overview.php" style="float:right;" class="btn btn-primary btn-icon-split">
                <span class="icon text-white-50">
                    <i class="fas fa-check"></i>
                </span>
                <span class="text">Manage Tables</span>
            </a>
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Reservation Date</th>
                            <th>Arrival</th>
                            <th>Leave</th>
                            <th>Total People</th>
                            <th>Table</th>
                            <th>Options</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Name</th>
                            <th>Reservation Date</th>
                            <th>Arrival</th>
                            <th>Leave</th>
                            <th>Total People</th>
                            <th>Table</th>
                            <th>Options</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        <?php $reservationObj = new Reservations();
                        $excistingReservation = $reservationObj->getReservations();

                        if ($excistingReservation) {
                            foreach ($excistingReservation as $row) {
                        ?>
                                <tr>
                                    <td><?= $row["reservation_name"] ?></td>
                                    <td><?= $row["reservation_date"] ?></td>
                                    <td><?= date('H:i', strtotime($row["reservation_start"])) ?></td>
                                    <td><?= date('H:i', strtotime($row["reservation_end"])) ?></td>
                                    <td><?= $row["reservation_adults"] + $row["reservation_kids"] ?></td>
                                    <td><?= $row["reservation_table"] ?></td>

                                    <td>
                                        <a href="reservations.php?edit=<?= $row["reservation_id"] ?>" class="btn btn-warning btn-block">Edit</a>
                                        <a href="?delete=<?= $row["reservation_id"] ?>" class="btn btn-google btn-user btn-block">Delete</a>
                                    </td>
                                </tr>
                        <?php
                            }
                        }

                        if (isset($_GET['delete'])) {
                            $deletenews = new News();
                            $deletenews->deleteNews($_GET['delete']);
                        }

                        if (isset($_GET['update'])) {
                            $updateReservations = new Reservations();
                            $updateReservations->updateReservation($_GET['update']);
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