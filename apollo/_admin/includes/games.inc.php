<?php

include "../classes/dbh.classes.php";
include "../classes/games.classes.php";
include "../classes/games-contr.classes.php";
include "../functions/functions.php";

// Check if the form is submitted for adding a new record
if (isset($_POST["submit"])) {
    $gamename = $_POST["gamename"];
    $game_franchise = $_POST["game_franchise"];
    $gameplayers = $_POST["gameplayers"];
    $gamerelease = $_POST["gamerelease"];
    $gameimage = $_POST["gameimage"];
    $gamelegal = $_POST["gamelegal"];

    // Instantiate controller for adding a new record
    $newproject = new newGamesContr($gamename, $game_franchise, $gameplayers,  $gamerelease, $gameimage, $gamelegal);

    // Add a new record
    $newproject->addNewGames();

    // Redirect after success
    header("location: ../index.php?error=none");
    exit();
}

// Check if the form is submitted for updating an existing reocrd
if (isset($_POST["update-post"])) {
    $gamename = $_POST["gamename"];
    $game_franchise = $_POST["game_franchise"];
    $gameplayers = $_POST["gameplayers"];
    $gamerelease = $_POST["gamerelease"];
    $gameimage = $_POST["gameimage"];
    $gamelegal = $_POST["gamelegal"];

    // Instantiate controller for updating the record
    $updateproject = new newGamesContr($gamename, $game_franchise, $gameplayers,  $gamerelease, $gameimage, $gamelegal);

    // Update an existing record
    $updateprojects->updateGames($game_id);

    // Redirect after success
    header("location: ../index.php?update=success");
    exit();
}
