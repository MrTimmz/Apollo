<?php

class Games extends Dbh
{
    public function getGamesById($project_id)
    {
        // Fetch the game by ID
        $stmt = $this->connect()->prepare('SELECT * FROM `games` WHERE `game_id` = ?');
        $stmt->execute(array($project_id));
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getGames()
    {

        $sql = 'SELECT * FROM `games` WHERE `game_deleted` IS NULL ORDER BY `game_id` ASC ';
        $stmt = $this->connect()->query($sql);
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $results;
    }

    protected function setGames($gamename, $game_franchise, $gameplayers,  $gamerelease, $gameimage, $gamelegal)
    {
        $stmt = $this->connect()->prepare('INSERT INTO `games` ( `game_name`, `game_franchise`, `game_players`,  `game_release`, `game_image`, `game_legalnotice`) VALUES (?, ?, ?, ?, ?, ?);');

        if (!$stmt->execute(array($gamename, $game_franchise, $gameplayers,  $gamerelease, $gameimage, $gamelegal))) {
            $stmt = null;
            exit();
        }
        $stmt = null;
    }

    public function updateGames($project_id, $gamename, $game_franchise, $gameplayers,  $gamerelease, $gameimage, $gamelegal)
    {
        $stmt = $this->connect()->prepare('UPDATE `games` SET `game_name` = ?, `game_franchise` = ?, `game_players` = ?,  `game_release` = ?, `game_release` = ?, `game_legalnotice` = > WHERE `project_id` = ?');

        // Execute the update query
        if (!$stmt->execute(array($gamename, $game_franchise, $gameplayers,  $gamerelease, $gameimage, $gamelegal, $game_id))) {
            $stmt = null;
            exit();
        }
        $stmt = null;
        echo "<script>location.href='games-overview.php';</script>";
    }

    public function getDeletedGames()
    {
        $sql = 'SELECT * FROM `games` WHERE `game_deleted` IS NOT NULL';
        $stmt = $this->connect()->query($sql);
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $results;
    }

    public function deleteGames($game_id)
    {
        $sql = 'UPDATE `games` SET `game_deleted` = NOW() WHERE `game_id` = :id';
        $stmt = $this->connect()->prepare($sql);
        $stmt->bindParam( ':id', $game_id);
        $stmt->execute();

        echo "<script>location.href='games-overview.php';</script>";
    }

    public function trashGames($id)
    {
        $sql = 'DELETE FROM `games` WHERE `game_id` = :id';
        $stmt = $this->connect()->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();

        echo "<script>location.href='games-deleted.php';</script>";
    }

    public function returnGames($id)
    {
        $sql = 'UPDATE `games` SET `game_deleted` = NULL WHERE game_id = :id';
        $stmt = $this->connect()->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();

        echo "<script>location.href='games-overview.php';</script>";
    }

}