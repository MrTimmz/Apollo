<?php

class newGamesContr extends Games {
    private $gamename;
    private $game_franchise;
    private $gameplayers;
    private $gamerelease;
    private $gameimage;
    private $gamelegal;

    public function __construct($gamename, $game_franchise, $gameplayers,  $gamerelease, $gameimage, $gamelegal) {
        $this->gamename = $gamename;
        $this->game_franchise = $game_franchise;
        $this->gameplayers = $gameplayers;
        $this->gamerelease = $gamerelease;
        $this->gameimage = $gameimage;
        $this->gamelegal = $gamelegal;
    }

    public function addNewGames() {
        // Logic to insert a new record into the database
        $this->setGames($this->gamename, $this->game_franchise, $this->gameplayers, $this->gamerelease, $this->gameimage, $this->gamelegal);
    }

    public function updateGames($game_id) {
        // Logic to update an existing record in the database
        $this->updateGames($game_id, $this->gamename, $this->game_franchise, $this->gameplayers, $this->gamerelease, $this->gameimage, $this->gamelegal);
    }
}
