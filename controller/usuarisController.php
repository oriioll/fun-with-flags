<?php
require_once __DIR__ . '/../model/Usuari.php';
require_once __DIR__ . '/../apiClient/usersApi.php';
require_once __DIR__ . '/../include/errorHandler.proc.php';
class usuarisController
{
    private usersApi $usersApi;

    public function __construct(usersApi $usersApi)
    {
        $this->usersApi = $usersApi;
    }

    public function crearUsuari(Usuari $usuari)
    {
        $response = $this->usersApi->postUsuari($usuari);
        if ($response['status'] === 'success') {
            return $response['id'];
        } else {
            return false;
        }
    }

    public function userExists(Usuari $usuari)
    {
        $response = $this->usersApi->checkLogin($usuari);
        if ($response['status'] === 'success') {
            return $response['id'];
        } else {
            return false;
        }
    }
}