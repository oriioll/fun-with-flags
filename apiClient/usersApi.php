<?php
require_once __DIR__ . '/../model/Usuari.php';
require_once __DIR__ . '/../include/errorHandler.proc.php';

class UsersApi
{
    private $apiServerUrl = __DIR__ . "/../apiServer/apiServer.php";
    private function getApiUrl(): string
    {
        $protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'https' : 'http';
        $host = $_SERVER['HTTP_HOST'];
        return $protocol . '://' . $host . '/apiServer/apiServer.php';
    }

    public function checkLogin(Usuari $usuari)
    {
        $ch = curl_init($this->getApiUrl() . '?action=login');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_TIMEOUT, 30);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode([
            'nom' => $usuari->nom,
            'password' => $usuari->password
        ]));
        $response = curl_exec($ch);
        return json_decode($response, true);
    }

    public function postUsuari(Usuari $usuari)
    {
        $ch = curl_init($this->getApiUrl() . '?action=register');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_TIMEOUT, 30);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode([
            'nom' => $usuari->nom,
            'password' => $usuari->password
        ]));
        $response = curl_exec($ch);
        return json_decode($response, true);
    }


}
