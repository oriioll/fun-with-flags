<?php
require_once __DIR__ . '/../dao/Users_Dao.php';
require_once __DIR__ . '/../model/Usuari.php';
require_once __DIR__ . '/../include/errorHandler.proc.php';
require_once __DIR__ . '/../model/Partida.php';
header("Content-Type: application/json");

$dao = new Users_Dao(new SQLite3(__DIR__ . '/../db/dbGame.db'));

if (isset($_GET['action'])) {
    $action = $_GET['action'];
} else {
    $action = '';
}

if ($action === 'register') {
    $usuari = new Usuari($_POST['nom'], $_POST['password'], null);
    $result = $dao->insertUser($usuari);
    if ($result === false) {
        http_response_code(500);
        echo json_encode(["status" => "error"]);
    } else {
        http_response_code(201);
        echo json_encode(["status" => "success", "id" => $result->id,]);
    }
    exit;
}

if ($action === 'login') {
    $usuari = new Usuari($_POST['nom'], $_POST['password']);
    $ok = $dao->loginUser($usuari);
    if ($ok === false) {
        http_response_code(500);
        echo json_encode(["status" => "error"]);
    } else {
        http_response_code(200);
        echo json_encode(["status" => "success", "id" => $ok->id,]);
    }
    exit;
}

if ($action === 'getGames') {
    $partidas = $dao->getPartides();
    $data = [];
    foreach ($partidas as $fila) {
        $data[] = [
            "username" => $fila['username'],
            "date" => $fila['data'],
            "punts" => $fila['punts']
        ];
    }
    http_response_code(200);
    echo json_encode($data);
    exit;
}


if ($action === 'saveGame') {
    $game = new Partida($_POST['idUsuari'], $_POST['punts'], null, null);
    error_log("SAVEGAME POST: " . print_r($_POST, true));
    $result = $dao->insertPartida($game->idUsuari, $game->punts);
    error_log("INSERT RESULT: " . var_export($result, true));
    if ($result === false) {
        http_response_code(500);
        echo json_encode(["status" => "error"]);
    } else {
        http_response_code(201);
        echo json_encode(["status" => "success"]);
    }
    exit;
}

http_response_code(405);
echo json_encode(["status" => "error", "message" => "Acció no permesa"]);