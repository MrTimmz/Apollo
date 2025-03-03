<?php

class Clients extends Dbh
{

    public function getClientsById($client_id){
        $stmt = $this->connect()->prepare('SELECT * FROM customers WHERE client_id = ?');
        $stmt->execute(array($client_id));
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getClients()
    {
        $sql = 'SELECT * FROM customers WHERE client_deleted IS NULL';
        $stmt = $this->connect()->query($sql);
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $results;
    }

    protected function setClients($clientname, $clientmail, $clientphone, $clientaddress, $clienttown, $clientprovince, $clientzip, $clientcountry)
    {
        $stmt = $this->connect()->prepare('INSERT INTO customers ( `client_name`, `client_email`, `client_phone`, `client_address`, `client_town`, `client_province`, `client_zipcode`, `client_country`) VALUES (?, ?, ?, ?, ?, ?, ?, ?);');
        if (!$stmt->execute(array($clientname, $clientmail, $clientphone, $clientaddress, $clienttown, $clientprovince, $clientzip, $clientcountry))) {
            $stmt = null;
            exit();
        }
        $stmt = null;
    }

    protected function updateClients($client_id, $clientname, $clientmail, $clientphone, $clientaddress, $clientzip, $clienttown, $clientprovince, $clientcountry)
    {
        $stmt = $this->connect()->prepare('UPDATE customers SET `client_name` = ?, `client_email` = ?, `client_phone` = ?, `client_address` = ?, `client_town` = ?, `client_province` = ?, `client_zipcode` = ?, `client_country` = ? WHERE `client_id` = ?');
        if (!$stmt->execute(array($clientname, $clientmail, $clientphone, $clientaddress, $clientzip, $clienttown, $clientprovince, $clientcountry, $client_id))) {
            $stmt = null;
            exit();
        }
        $stmt = null;
        echo "<script>location.href='clients-overview.php';</script>";
    }

    public function getDeletedClients()
    {
        $sql = 'SELECT * FROM menu WHERE menu_deleted IS NOT NULL';
        $stmt = $this->connect()->query($sql);
        while ($row = $stmt->fetch()) {
            echo '<tr>';
            echo '<td>' . $row["menu_title"] . '</td>';
            echo '<td> ' . $row["menu_page_title"] . '</td>';
            echo '<td>' . $row["menu_order"] . '</td>';
            echo '<td>' . $row["menu_status"] . '</td>';
            echo '<td>' . $row["menu_created"] . '</td>';
            echo '<td>
                    <a href="?return=' . $row["client_id"] . '" class="btn btn-google btn-user btn-block chartjs-render-monitor" >Return</a>
                    <a href="?trash=' . $row["client_id"] . '" class="btn btn-google btn-user btn-block">Trash</a>';
            '</td>';
            echo '</tr>';
        }
    }

    public function deleteClients($client_id)
    {
        $sql = 'UPDATE customers SET client_deleted = NOW() WHERE client_id = :id';
        $stmt = $this->connect()->prepare($sql);
        $stmt->bindParam(':id', $client_id);
        $stmt->execute();

        echo"<script>loation.href='clients-overview.php';</script>";
    }

    public function trashClients($id)
    {
        $sql = 'DELETE FROM menu  WHERE client_id = :id';
        $stmt = $this->connect()->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();

        echo "<script>location.href='pages-deleted.php';</script>";
    }

    public function returnClients($id)
    {
        $sql = 'UPDATE menu SET menu_deleted = NULL WHERE client_id = :id';
        $stmt = $this->connect()->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();

        echo "<script>location.href='clients-overview.php';</script>";
    }
}
