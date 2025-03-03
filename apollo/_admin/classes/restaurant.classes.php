<?php

class Reservations extends Dbh
{

    public function getReservations()
    {
        $sql = 'SELECT * FROM reservations WHERE deleted_at IS NULL ORDER BY reservation_date ASC';
        $stmt = $this->connect()->query($sql);
        while ($row = $stmt->fetch()) {
            echo '<tr>';
            echo '<td>' . $row["first_name"] . '</td>';
            echo '<td>' . $row["last_name"] . '</td>';
            echo '<td>' . $row["telephone"] . '</td>';
            echo '<td>' . $row["reservation_date"] . '</td>';
            echo '<td>' . $row["table_size"] . '</td>';
            echo '<td>' . $row["status"] . '</td>';
            echo '<td>
                    <a href="edit_reservation.php?id=' . $row["reservation_id"] . '" class="btn btn-warning btn-block">Edit</a>
                    <a href="?delete=' . $row["reservation_id"] . '" class="btn btn-google btn-user btn-block">Delete</a>';
            '</td>';
            echo '</tr>';
        }
    }

    public function deleteReservation($id)
    {
        $sql = 'UPDATE reservations SET deleted_at = NOW() WHERE reservation_id = :id';
        $stmt = $this->connect()->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();

        echo "<script>location.href='reservations_overview.php';</script>";
    }

    public function getDeletedReservations()
    {
        $sql = 'SELECT * FROM reservations WHERE deleted_at IS NOT NULL';
        $stmt = $this->connect()->query($sql);
        while ($row = $stmt->fetch()) {
            echo '<tr>';
            echo '<td>' . $row["first_name"] . '</td>';
            echo '<td>' . $row["last_name"] . '</td>';
            echo '<td>' . $row["telephone"] . '</td>';
            echo '<td>' . $row["reservation_date"] . '</td>';
            echo '<td>' . $row["table_size"] . '</td>';
            echo '<td>' . $row["status"] . '</td>';
            echo '<td>
                    <a href="?restore=' . $row["reservation_id"] . '" class="btn btn-google btn-user btn-block chartjs-render-monitor" >Restore</a>
                    <a href="?trash=' . $row["reservation_id"] . '" class="btn btn-google btn-user btn-block">Trash</a>';
            '</td>';
            echo '</tr>';
        }
    }

    public function trashReservation($id)
    {
        $sql = 'DELETE FROM reservations  WHERE reservation_id = :id';
        $stmt = $this->connect()->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();

        echo "<script>location.href='reservations_deleted.php';</script>";
    }

    public function restoreReservation($id)
    {
        $sql = 'UPDATE reservations SET deleted_at = NULL WHERE reservation_id = :id';
        $stmt = $this->connect()->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();

        echo "<script>location.href='reservations_overview.php';</script>";
    }

    public function createReservation($first_name, $last_name, $telephone, $reservation_date, $table_size, $status)
    {
        $stmt = $this->connect()->prepare('INSERT INTO reservations (first_name, last_name, telephone, reservation_date, table_size, status) VALUES (?, ?, ?, ?, ?, ?)');
        $stmt->execute([$first_name, $last_name, $telephone, $reservation_date, $table_size, $status]);
        echo "<script>location.href='reservations_overview.php';</script>";
    }

    public function updateReservation($reservation_id, $first_name, $last_name, $telephone, $reservation_date, $table_size, $status)
    {
        $stmt = $this->connect()->prepare('UPDATE reservations SET first_name = ?, last_name = ?, telephone = ?, reservation_date = ?, table_size = ?, status = ? WHERE reservation_id = ?');
        $stmt->execute([$first_name, $last_name, $telephone, $reservation_date, $table_size, $status, $reservation_id]);
        echo "<script>location.href='reservations_overview.php';</script>";
    }
}




    //echo form
    public function echoForm()
    {

?>
         <form action="includes/reservations.inc.php" method="post">
            <div class="row">

                <!-- First Name -->
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border-left-primary shadow h-100 py-2">
                        <div class="card-body">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                First Name:</div>
                            <input type="text" class="form-control" name="first_name" placeholder="First Name">
                        </div>
                    </div>
                </div>

                <!-- Last Name -->
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border-left-primary shadow h-100 py-2">
                        <div class="card-body">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Last Name:</div>
                            <input type="text" class="form-control" name="last_name" placeholder="Last Name">
                        </div>
                    </div>
                </div>

                <!-- Telephone -->
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border-left-primary shadow h-100 py-2">
                        <div class="card-body">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Telephone:</div>
                            <input type="text" class="form-control" name="telephone" placeholder="Telephone">
                        </div>
                    </div>
                </div>

                <!-- Reservation Date -->
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border-left-primary shadow h-100 py-2">
                        <div class="card-body">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Reservation Date:</div>
                            <input type="datetime-local" class="form-control" name="reservation_date">
                        </div>
                    </div>
                </div>

                <!-- Table Size -->
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border-left-primary shadow h-100 py-2">
                        <div class="card-body">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Table Size:</div>
                            <input type="number" class="form-control" name="table_size" placeholder="Table Size">
                        </div>
                    </div>
                </div>

                <!-- Status -->
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border-left-primary shadow h-100 py-2">
                        <div class="card-body">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Status:</div>
                            <select class="form-control" name="status">
                                <option value="Pending">Pending</option>
                                <option value="Confirmed">Confirmed</option>
                                <option value="Cancelled">Cancelled</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-2">
                    <button type="submit" name="submit" class="btn btn-primary btn-user btn-block">
                        Add Reservation
                    </button>
                </div>

                <div class="col-lg-2">
                    <a href="index.html" class="btn btn-google btn-user btn-block">
                        Cancel
                    </a>
                </div>
            </div>
        </form>

    <?php
    }

    public function editForm($reservation_id = null)
{
    $reservation_id = isset($_GET['edit']) ? $_GET['edit'] : null;
    // Retrieve existing data if reservation_id is set
    $reservationData = null;
    if ($reservation_id) {
        $stmt = $this->connect()->prepare('SELECT * FROM reservations WHERE reservation_id = ?');
        $stmt->execute(array($reservation_id));
        $reservationData = $stmt->fetch(PDO::FETCH_ASSOC);
    }
        //check if form has been submitted
if (isset($_POST['update-post'])) {
    $title = $_POST["title"];
    $titleseo = $_POST["titleseo"];
    $pageheading = $_POST["pagetitle"];
    $pageheadingseo = $_POST["pagetitleseo"];
    $menuorder = $_POST["order"];
    $pagecontent = $_POST["content"];
    $visibility = $_POST["status"];
    $style = $_POST["styling"];

    // Check if form has been submitted
    if (isset($_POST['update-reservation'])) {
        $first_name = $_POST["first_name"];
        $last_name = $_POST["last_name"];
        $telephone = $_POST["telephone"];
        $reservation_date = $_POST["reservation_date"];
        $table_size = $_POST["table_size"];
        $status = $_POST["status"];

        // Check if $reservation_id is set to determine if it's an update or insert operation
        if ($reservation_id) {
            // Update existing reservation
            $this->updateReservation($reservation_id, $first_name, $last_name, $telephone, $reservation_date, $table_size, $status);

            // Log user activity for editing a record
            $action = "Edited reservation with ID: $reservation_id"; // Modify this according to your requirement
            $link = "reservations-overview.php"; // Modify this according to your requirement
            $functions->log_user_activity($_SESSION["user_fname"], $action, $link);
    } else {
        // Insert new reservation
        $this->setReservation($first_name, $last_name, $telephone, $reservation_date, $table_size, $status);
    }
}

    ?>
        <form action="includes/reservations.inc.php" method="post">
            <div class="row">

                <!-- First Name -->
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border-left-primary shadow h-100 py-2">
                        <div class="card-body">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                First Name:</div>
                            <input type="text" class="form-control" name="first_name" placeholder="First Name">
                        </div>
                    </div>
                </div>

                <!-- Last Name -->
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border-left-primary shadow h-100 py-2">
                        <div class="card-body">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Last Name:</div>
                            <input type="text" class="form-control" name="last_name" placeholder="Last Name">
                        </div>
                    </div>
                </div>

                <!-- Telephone -->
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border-left-primary shadow h-100 py-2">
                        <div class="card-body">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Telephone:</div>
                            <input type="text" class="form-control" name="telephone" placeholder="Telephone">
                        </div>
                    </div>
                </div>

                <!-- Reservation Date -->
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border-left-primary shadow h-100 py-2">
                        <div class="card-body">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Reservation Date:</div>
                            <input type="datetime-local" class="form-control" name="reservation_date">
                        </div>
                    </div>
                </div>

                <!-- Table Size -->
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border-left-primary shadow h-100 py-2">
                        <div class="card-body">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Table Size:</div>
                            <input type="number" class="form-control" name="table_size" placeholder="Table Size">
                        </div>
                    </div>
                </div>

                <!-- Status -->
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border-left-primary shadow h-100 py-2">
                        <div class="card-body">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Status:</div>
                            <select class="form-control" name="status">
                                <option value="Pending">Pending</option>
                                <option value="Confirmed">Confirmed</option>
                                <option value="Cancelled">Cancelled</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-2">
                    <button type="submit" name="submit" class="btn btn-primary btn-user btn-block">
                        Add Reservation
                    </button>
                </div>

                <div class="col-lg-2">
                    <a href="index.html" class="btn btn-google btn-user btn-block">
                        Cancel
                    </a>
                </div>
            </div>
        </form>
<?php

    }
}
