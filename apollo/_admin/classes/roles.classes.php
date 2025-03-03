<?php

class Roles extends Dbh
{

    public function getRolesbyId($role_id)
    {
        $stmt = $this->connect()->prepare('SELECT * FROM roles WHERE role_id = ?');
        $stmt->execute(array($role_id));
        return $stmt->fetch(PDO::FETCH_ASSOC);

        // $sql = 'SELECT ic.*, COUNT(i.user_id) as count FROM roles ic
        // LEFT JOIN users i ON ic.role_id = i.user_role
        // WHERE ic.role_deleted IS NULL GROUP BY ic.role_id';

        // $stmt = $this->connect()->query($sql);
        // while ($row = $stmt->fetch()) {
        //     echo '<tr>';
        //     echo '<td>' . $row["role_title"] . '</td>';
        //     echo '<td>' . $row["count"] . '</td>';
        //     echo '<td>
        //             <a href="roles.php?edit='. $row["role_id"] . '" class="btn btn-warning btn-block">Edit</a>
        //             <a href="?delete=' . $row["role_id"] . '" class="btn btn-google btn-user btn-block">Delete</a>';
        //     '</td>';
        //     echo '</tr>';
        // }
    }

    public function getRoles()
    {
        $sql = 'SELECT ic.*, COUNT(i.user_id) as count FROM roles ic
        LEFT JOIN users i ON ic.role_id = i.user_role
        WHERE ic.role_deleted IS NULL GROUP BY ic.role_id';

        $stmt = $this->connect()->query($sql);
        while ($row = $stmt->fetch()) {
            echo '<tr>';
            echo '<td>' . $row["role_title"] . '</td>';
            echo '<td>' . $row["count"] . '</td>';
            echo '<td>
                    <a href="roles.php?edit=' . $row["role_id"] . '" class="btn btn-warning btn-block">Edit</a>
                    <a href="?delete=' . $row["role_id"] . '" class="btn btn-google btn-user btn-block">Delete</a>';
            '</td>';
            echo '</tr>';
        }
    }

    public function deleteRole($id)
    {
        $sql = 'UPDATE roles SET role_deleted = NOW() WHERE role_id = :id';
        $stmt = $this->connect()->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();

        echo "<script>location.href='roles_overview.php';</script>";
    }

    public function getDeletedRoles()
    {
        $sql = 'SELECT * FROM roles WHERE role_deleted IS NOT NULL';
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

    public function trashRole($id)
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

    public function getRoleByTitle($title)
    {
        $query = "SELECT * FROM roles WHERE role_title = ?";
        $stmt = $this->connect()->prepare($query);
        $stmt->execute([$title]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result;
    }

    //insert new data into table
    protected function setRole($title)
    {
        $conn = $this->connect();
        $stmt = $conn->prepare('INSERT INTO roles (role_title) VALUES (:title)');
        $stmt->bindParam(':title', $title);

        //stop running and execute error statement
        if (!$stmt->execute()) {
            $stmt = null;
            exit();
        }
        $stmt = null;
    }

    protected function updateRole($role_id, $title)
    {
        $conn = $this->connect();
        $stmt = $conn->prepare('UPDATE roles SET role_title = :title WHERE role_id = :id');
        $stmt->bindParam(':title', $title);
        $stmt->bindParam(':id', $role_id);

        //stop running and execute error statement
        if (!$stmt->execute()) {
            $stmt = null;
            exit();
        }

        $stmt = null;
    }
}