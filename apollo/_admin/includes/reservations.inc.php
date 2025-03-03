<?php

include "../classes/dbh.classes.php";
include "../classes/reservations.classes.php";
include "../classes/reservations-contr.classes.php";

if (isset($_POST["submit"])) {
    $reservation_name = $_POST['reservation_name'];
    $start_time = $_POST['start_time'];
    $reservation_date = $_POST['reservation_date'];
    $duration = $_POST ['duration'];
    $num_adults = $_POST['num_adults'];
    $num_children = $_POST['num_children'];
    $table = $_POST['selected_table'];

    //Instantiate controller for adding new record
    $newReservation = new ReservationsContr($reservation_name, $reservation_date, $start_time, $duration, $num_adults, $num_children, $table);

    //add new record
    $newReservation->addNewReservation();

    //redirect after success
    header("location: ../index.php?error=none");
    exit();
}


if (isset($_POST['check_reservation'])) {
    $reservation_date = $_POST['reservation_date'];
    $start_time = $_POST['start_time'];
    $selected_tables = $_POST['selected_tables']; // This will be an array

    $reservation = new Reservations();

    $exists = false;
    foreach ($selected_tables as $table_id) {
        if ($reservation->checkDuplicateReservation($reservation_date, $start_time, $table_id)) {
            $exists = true;
            break; // Exit the loop if a match is found
        }
    }

    echo json_encode(['exists' => $exists]);
    exit();
}
