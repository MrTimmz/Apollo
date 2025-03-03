<?php

class ReservationsContr extends Reservations {

    private $reservation_name;
    private $reservation_date;
    private $start_time;
    private $duration;
    private $num_adults;
    private $num_children;
    private $table;

    public function __construct($reservation_name, $reservation_date, $start_time, $duration, $num_adults, $num_children, $table) {
        $this->reservation_name = $reservation_name;
        $this->reservation_date = $reservation_date;
        $this->start_time = $start_time;
        $this->duration = $duration;
        $this->num_adults = $num_adults;
        $this->num_children = $num_children;
        $this->table = $table;
    }

    public function addNewReservation() {
        // Logic to insert new record
        if(empty($this->reservation_name)){
            // error handler for empty fields
            echo "Fields cant be empty";
            return;
        }
        $this->setReservation($this->reservation_name, $this->reservation_date, $this->start_time, $this->duration, $this->num_adults, $this->num_children, $this->table);
    }
}
