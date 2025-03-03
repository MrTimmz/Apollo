<?php

if(isset ($_POST["submit"])) {
    //Grab data from users input
    $parent = $_POST ["mainmenu"];

    $subtitle = $_POST ["subtitle"];
    $subtitleseo = $_POST ["subtitleseo"];

    $subheading = $_POST ["subpagetitle"];
    $subheadingseo = $_POST ["pagetitleseo"];

    $submenuorder = $_POST ["subpageorder"];
    
    $subpagecontent = $_POST ["subpagecontent"];

    $visibility = $_POST ["subpagestatus"];

    //get instances using autoloader
    include "../classes/dbh.classes.php";
    include "../classes/subpage.classes.php";
    include "../classes/subpage-contr.classes.php";

    $newpsubpage = new newSubpageContr ($parent, $subtitle, $subtitleseo, $subheading, $subheadingseo, $submenuorder, $subpagecontent, $visibility);

    //run errors if we got any errors
    $newpsubpage->addnewSubpage();

    //continue if there are no errors
    header("location: ../index.php?error=none");
}