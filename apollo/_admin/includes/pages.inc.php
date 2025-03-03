<?php

include "../classes/dbh.classes.php";
include "../classes/pages.classes.php";
include "../classes/pages-contr.classes.php";
include "../functions/functions.php";

// Check if the form is submitted for adding a new page
if (isset($_POST["submit"])) {
    $title = $_POST["title"];
    $titleseo = $_POST["titleseo"];
    $pageheading = $_POST["pagetitle"];
    $pageheadingseo = $_POST["pagetitleseo"];
    $menuorder = $_POST["order"];
    $pagecontent = $_POST["content"];
    $seo_keywords = $_POST["seo_keywords"];
    $visibility = $_POST["status"];
    $style = $_POST["styling"];

    // Instantiate controller for adding a new page
    $newpage = new newPageContr($title, $titleseo, $pageheading, $pageheadingseo, $menuorder, $pagecontent, $seo_keywords, $visibility, $style);

    // Add a new page
    $newpage->addNewPage();

    // Redirect after success
    header("location: ../index.php?error=none");
    exit();
}

// Check if the form is submitted for updating an existing page
if (isset($_POST["update-post"])) {
    $menu_id = $_POST["menu_id"];
    $title = $_POST["title"];
    $titleseo = $_POST["titleseo"];
    $pageheading = $_POST["pagetitle"];
    $pageheadingseo = $_POST["pagetitleseo"];
    $menuorder = $_POST["order"];
    $pagecontent = $_POST["content"];
    $seo_keywords = $_POST["seo_keywords"];
    $visibility = $_POST["status"];
    $style = $_POST["styling"];

    // Instantiate controller for updating the page
    $updatepage = new newPageContr($title, $titleseo, $pageheading, $pageheadingseo, $menuorder, $pagecontent, $seo_keywords, $visibility, $style);

    // Update an existing page
    $updatepage->updatePage($menu_id);

    // Redirect after success
    header("location: ../index.php?update=success");
    exit();
}
