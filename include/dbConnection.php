<?php
require_once __DIR__ . '/../model/Usuari.php';
require_once __DIR__ . '/../model/Partida.php';
require_once __DIR__ . '/../controller/usuarisController.php';
require_once __DIR__ . '/../apiClient/usersApi.php';
require_once __DIR__ . '/../apiClient/gameApi.php';
require_once __DIR__ . '/../dao/Users_Dao.php';
require_once __DIR__ . '/../controller/gameController.php';

$dbPath = __DIR__ . '/../db/dbGame.db';
$db = new SQLite3($dbPath);
$dao = new Users_Dao($db);

$usuarisController = new usuarisController(new UsersApi());
$gameController = new gameController(new gameApi());

function closeConnection($db)
{
    $db->close();
}
