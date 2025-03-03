<?php

class Table extends Dbh
{

    public function getTableById($kind_id)
    {
        $stmt = $this->connect()->prepare('SELECT * FROM tabless WHERE table_id = ?');
        $stmt->execute(array($kind_id));
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getTables()
    {
        $sql = 'SELECT * FROM tabless
        INNER JOIN table_kind
        ON tabless.table_kind  = table_kind.kind_id
        WHERE kind_deleted IS NULL';
        $stmt = $this->connect()->query($sql);
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $results;
    }

    protected function setTable($tablekind)
    {
        $stmt = $this->connect()->prepare('INSERT INTO tabless ( `table_kind`) VALUES (?)');
        if (!$stmt->execute(array($tablekind))) {
            $stmt = null;
            exit();
        }

        $stmt = null;
    }


    protected function updateTable($table_id, $tablekind)
    {
        $stmt = $this->connect()->prepare('UPDATE tabless SET `tablekind` = ? WHERE table_id = ?');

        //execute the update
        if (!$stmt->execute(array($tablekind, $table_id))) {
            $stmt = null;
            exit();
        }
        $stmt = null;
        echo "<script>location.href='tables-overview.php';</script>";
    }

    public function getDeletedTable()
    {
        $sql = 'SELECT * FROM tabless WHERE table_deleted IS NOT NULL';
        $stmt = $this->connect()->query($sql);
        while ($row = $stmt->fetch()) {
            echo '<tr>';
            echo '<td>' . $row["role_title"] . '</td>';
            echo '<td>' . $row["role_deleted"] . '</td>';
            echo '<td>
                    <a href="?return=' . $row["role_id"] . '" class="btn btn-google btn-user btn-block chartjs-render-monitor" >Return</a>
                    <a href="?trash=' . $row["role_id"] . '" class="btn btn-google btn-user btn-block">Trash</a>';
            '</td>';
            echo '</tr>';
        }
    }

    public function deleteKindof($kind_id)
    {
        $sql = 'UPDATE kind_of SET kind_deleted = NOW() WHERE kind_id = :id';
        $stmt = $this->connect()->prepare($sql);
        $stmt->bindParam(':id', $kind_id);
        $stmt->execute();

        echo "<script>location.href='roles_overview.php';</script>";
    }

    public function trashkind($id)
    {
        $sql = 'DELETE FROM roles  WHERE role_id = :id';
        $stmt = $this->connect()->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();

        echo "<script>location.href='roles_deleted.php';</script>";
    }

    public function returnRole($id)
    {
        $sql = 'UPDATE roles SET role_deleted = NULL WHERE role_id = :id';
        $stmt = $this->connect()->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();

        echo "<script>location.href='roles_overview.php';</script>";
    }
}
