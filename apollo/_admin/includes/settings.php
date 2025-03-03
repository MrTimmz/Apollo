<?php

class Settings extends Dbh {
    
    //insert data into table
    public function getSettings()
    {
        $sql = 'SELECT * FROM `web_settings`';
        $stmt = $this->connect()->query($sql);
        while ($row = $stmt->fetch()) {
            echo '<title>' . $row["websettings_title"] . '</title>';
        }
    }
}