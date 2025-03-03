<?php include "header.php"; ?>

<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <?php
        $reservation_id = isset($_GET['edit']) ? $_GET['edit'] : null;

        if ($reservation_id !== null) {
            echo '<h1 class="h3 mb-0 text-gray-800">Update Reservation</h1>';
        } else {
            echo '<h1 class="h3 mb-0 text-gray-800">Add new Reservation</h1>';
        }
        ?>
    </div>

    <?php
    $reservation = new Reservations();
    $row = null;
    if ($reservation_id !== null) {
        $row = $reservation->getReservationsById($reservation_id);
    }
    ?>

    <form action="includes/reservations.inc.php" method="post">
        <div class="alert alert-danger d-none" id="error-message" role="alert"></div>
        <div class="alert alert-success d-none" id="success-message" role="alert"></div>



        <div class="row">

            <!-- Reservation Name -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="form-group">
                            <label for="reservation_name">Reservation Name</label>
                            <input type="text" name="reservation_name" id="reservation_name" class="form-control" placeholder="Enter the name" value="<?= $row['reservation_name'] ?? '' ?>" required>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Date -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="form-group">
                            <label for="date">Reservation Date</label>
                            <input type="date" name="reservation_date" id="reservation_date" class="form-control" value="<?= $row['reservation_date'] ?? '' ?>" required>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="form-group">
                            <label for="start_time">Reservation Time</label>
                            <input type="Time" name="start_time" id="start_time" class="form-control" value="<?= $row['reservation_start'] ?? '' ?>" required>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Duration -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="form-group">
                            <label for="duration">Duration (hours)</label>
                            <input type="time" name="duration" id="duration" class="form-control" min="1" max="5" value="<?= $row['reservation_end'] ?? '' ?>" required>
                        </div>
                    </div>
                </div>
            </div>



            <!-- Number of Adults -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="form-group">
                            <label for="num_adults">Number of Adults</label>
                            <input type="number" name="num_adults" id="num_adults" class="form-control" max="10" min="1" value="<?= $row['reservation_adults'] ?? '' ?>" required>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Number of Children -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="form-group">
                            <label for="num_children">Number of Children</label>
                            <input type="number" name="num_children" id="num_children" class="form-control" max="4" min="0" value="<?= $row['reservation_kids'] ?? '' ?>" required>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Table Assignment -->
            <div class="col-xl-6 col-md-12 mb-4">
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                        <h4>Select a Table</h4>
                        <div class="table-overview">
                            <?php
                            $tableObj = new Table();
                            $existingTables = $tableObj->getTables(); // This fetches all tables

                            if ($existingTables) {
                                foreach ($existingTables as $table) {
                                    $isChecked = (isset($row['reservation_table']) && $row['reservation_table'] == $table["table_id"]) ? 'checked' : '';
                            ?>
                                    <div class="table <?= $table["kind_name"] ?>" data-table="<?= $table["table_id"] ?>">
                                        <label> Table <?= $table["table_id"] ?> <?= $table["kind_name"] ?></label><br>
                                        <input type="checkbox" name="selected_table[]" value="<?= $table["table_id"] ?>" <?= $isChecked ?>>
                                    </div>
                            <?php
                                }
                            }
                            ?>
                        </div>

                        <!-- Hidden input to keep track of the selected table -->
                        <input type="hidden" name="selected_table" id="selected_table" required>
                    </div>
                </div>
            </div>

        </div>

        <?php if ($reservation_id !== null) : ?>
            <input type="hidden" name="menu_id" value="<?= $reservation_id ?>">
        <?php endif; ?>

        <div class="row">
            <div class="col-lg-2">
                <button type="submit" name="<?= $reservation_id ? 'update-post' : 'submit' ?>"
                    class="btn btn-primary btn-user btn-block">
                    <?= $reservation_id ? 'Update Reservation' : 'Add reservation' ?>
                </button>
            </div>

            <div class="col-lg-2">
                <a href="index.html" class="btn btn-google btn-user btn-block">
                    Cancel
                </a>
            </div>
        </div>
    </form>

</div>
</div>
<style>
    .table-overview {
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
        gap: 20px;
        margin-top: 20px;
    }

    .table {
        width: 150px;
        height: 100px;
        background-color: #FFD700;
        border-radius: 10px;
        display: flex;
        justify-content: center;
        align-items: center;
        font-size: 18px;
        font-weight: bold;
        color: #333;
        cursor: pointer;
    }

    .Kids {
        background-color: #FF6347;
    }

    .Normal {
        background-color: #90EE90;
    }

    .table.selected {
        border: 4px solid #333;
    }
</style>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>



<?php include "footer.php"; ?>