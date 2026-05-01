<?php
require_once __DIR__ . '/../model/Usuari.php';
require_once __DIR__ . '/../include/errorHandler.proc.php';

class gameApi
{
    private $apiServerUrl = __DIR__ . "/../apiServer/apiServer.php";
    private function getApiUrl(): string
    {
        $protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'https' : 'http';
        $host = $_SERVER['HTTP_HOST'];
        return $protocol . '://' . $host . '/apiServer/apiServer.php';
    }

    public function postPartida(Partida $partida)
    {
        $ch = curl_init($this->getApiUrl() . '?action=saveGame');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_TIMEOUT, 30);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode([
            'idUsuari' => $partida->idUsuari,
            'punts' => $partida->punts,
        ]));
        $response = curl_exec($ch);
        return json_decode($response, true);
    }

    public function getPartides()
    {
        $ch = curl_init($this->getApiUrl() . '?action=getGames');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_TIMEOUT, 30);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        $response = curl_exec($ch);
        curl_close($ch);
        return json_decode($response, true);
    }
}
