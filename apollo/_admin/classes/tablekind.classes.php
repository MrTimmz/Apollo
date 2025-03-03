<?php

class TableKind extends Dbh
{

    public function getKindbyId($kind_id)
    {
        $stmt = $this->connect()->prepare('SELECT * FROM table_kind WHERE kind_id = ?');
        $stmt->execute(array($kind_id));
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getKind()
    {
        $sql = 'SELECT * FROM table_kind WHERE kind_deleted IS NULL';
        $stmt = $this->connect()->query($sql);
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $results;
    }

    protected function setKindof($kindof)
    {
        $stmt = $this->connect()->prepare('INSERT INTO table_kind ( `kind_name`) VALUES (?)');
        if (!$stmt->execute(array($kindof))) {
            $stmt = null;
            exit();
        }

        $stmt = null;
    }


    protected function updateKindof($kind_id, $kindof)
    {
        $stmt = $this->connect()->prepare('UPDATE table_kind SET `kind_of` = ? WHERE kind_id = ?');

        //execute the update
        if (!$stmt->execute(array($kindof, $kind_id))) {
            $stmt = null;
            exit();
        }
        $stmt = null;
        echo "<script>location.href='tables-overview.php';</script>";
    }

    public function getDeletedKindof()
    {
        $sql = 'SELECT * FROM table_kind WHERE kind_deleted IS NOT NULL';
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
