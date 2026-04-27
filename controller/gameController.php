<?php
require_once __DIR__ . '/../model/Usuari.php';
require_once __DIR__ . '/../model/Partida.php';
require_once __DIR__ . '/../apiClient/gameApi.php';
require_once __DIR__ . '/../include/errorHandler.proc.php';
class gameController
{
    private gameApi $gameApi;

    public function __construct(gameApi $gameApi)
    {
        $this->gameApi = $gameApi;
    }

    public function saveGame(Partida $partida)
    {
        $response = $this->gameApi->postPartida($partida);
        if ($response === null || $response['status'] !== 'success') {
            return false;
        }
        return true;
    }

    public function rankingView()
    {
        $response = $this->gameApi->getPartides();
        return $response;
    }
}