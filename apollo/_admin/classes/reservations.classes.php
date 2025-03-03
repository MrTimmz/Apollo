<?php

class Reservations extends Dbh
{
    public function getReservationsById($reservation_id)
    {
        $stmt = $this->connect()->prepare('SELECT * FROM reservations WHERE reservation_id = ? ');
        $stmt->execute(array($reservation_id));
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }


    public function getReservations()
    {
        $sql = ('SELECT * FROM `reservations` WHERE `reservation_deleted` IS NULL');
        $stmt = $this->connect()->query($sql);
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $results;
    }

    protected function setReservation($reservation_name, $date, $start_time, $duration, $num_adults, $num_children, $table)
    {
        $stmt = $this->connect()->prepare('INSERT INTO reservations (`reservation_name`, `reservation_date`, `reservation_start`, `reservation_end`, `reservation_adults`, `reservation_kids`, `reservation_table`) VALUES (?, ?, ?, ?, ?, ?, ?) ');
        if (!$stmt->execute(array($reservation_name, $date, $start_time, $duration, $num_adults, $num_children, $table))) {
            exit();
        }

        $stmt = null;
    }

    protected function updateReservation($reservation_id, $reservation_name)
    {
        $stmt = $this->connect()->prepare('UPDATE reservations SET `reservations_name` = ? WHERE `reservation_id` = ?');
        if (!$stmt->execute(array($reservation_name, $reservation_id))) {
            $stmt = null;
            exit();
        }

        $stmt = null;
        echo "<script>location.href='reservations_overview.php';</scrupt>";
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
            echo '<td>' . ($row["children_included"] ? 'Yes' : 'No') . '</td>';
            echo '<td>
                    <a href="?restore=' . $row["reservation_id"] . '" class="btn btn-google btn-user btn-block chartjs-render-monitor">Restore</a>
                    <a href="?trash=' . $row["reservation_id"] . '" class="btn btn-google btn-user btn-block">Trash</a>
                  </td>';
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

    public function trashReservation($id)
    {
        $sql = 'DELETE FROM reservations WHERE reservation_id = :id';
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

    public function checkDuplicateReservation($reservation_date, $start_time, $table_id)
    {
        $stmt = $this->connect()->prepare('
        SELECT COUNT(*)
        FROM reservations
        WHERE reservation_date = ?
          AND reservation_start = ?
          AND reservation_table = ?
          AND reservation_deleted IS NULL
    ');
        $stmt->execute([$reservation_date, $start_time, $table_id]);
        return $stmt->fetchColumn() > 0; // Returns true if a duplicate exists
    }
}
