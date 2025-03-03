<?php

class Menu extends Dbh{

    public function getMeta() {

        $sql = "SELECT `menu_title_seo`, `menu_title`, `menu_page_title_seo` FROM `menu` WHERE `menu_status` = 'Online' AND `menu_deleted` IS NULL ";
        $stmt = $this->connect()->query($sql);
        //var_dump ($stmt);

        while($row = $stmt->fetch()){

            echo '<title>Chokepoint Games -';
            echo $row["menu_page_title_seo"];
            echo '</title>';
        }
    }


    public function getMenu() {

        $sql = "SELECT `menu_title_seo`, `menu_title` FROM `menu` WHERE `menu_status` = 'Online' AND `menu_deleted` IS NULL ORDER BY `menu_order` ASC ";
        $stmt = $this->connect()->query($sql);
        //var_dump ($stmt);

        while($row = $stmt->fetch()){

            echo '<li class="nav-item"><a href="index.php?page=';
            echo $row["menu_title_seo"];
            echo '">';
            echo $row["menu_title"];
            echo '</a></li>';
        }
    }
}
