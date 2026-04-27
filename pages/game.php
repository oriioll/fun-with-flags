<?php
ob_start();
session_start();
require_once __DIR__ . '/../include/initCountries.php';
require_once __DIR__ . '/../model/Pais.php';
require_once __DIR__ . '/../model/Partida.php';
require_once __DIR__ . '/../include/dbConnection.php';

if (!isset($_SESSION['isLoggedIn']) || $_SESSION['isLoggedIn'] == false) {
    ob_end_clean();
    header("Location: login.php");
    exit();
}

if (!isset($_SESSION['game'])) {
    $_SESSION['game'] = [
        'currentRound' => 0,
        'score' => 0,
        'answers' => [],
    ];
} else if ($_SESSION['game']['currentRound'] >= 10) {
    $saved = $gameController->saveGame(new Partida($_SESSION['userId'], $_SESSION['game']['score'], null, null));
    error_log("SAVE GAME: " . var_export($saved, true));
    error_log("USER ID: " . $_SESSION['userId']);
    error_log("SCORE: " . $_SESSION['game']['score']);
    $_SESSION['game'] = [
        'currentRound' => 0,
        'score' => 0,
        'answers' => [],
    ];
    ob_end_clean();
    header('Location: ranking.php');
    exit();
}
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['code']) && isset($_POST['goodCode'])) {
    if ($_POST['code'] == $_POST['goodCode']) {
        $_SESSION['game']['score']++;
    }
    $_SESSION['game']['currentRound']++;
    header('Location: game.php');
    exit();
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Game</title>
    <link rel="stylesheet" href="/styles/styles.css">
</head>

<body>
    <div class="stats">
        <?php
        echo "<p>Ronda: " . $_SESSION['game']['currentRound'] . "/10</p>";
        echo "<p>Punts: " . $_SESSION['game']['score'] . "</p>";
        ?>
    </div>
    <section class="game">
        <h1>Selecciona el pais correcte</h1>
        <?php
        $playedCountries = $controller->getGamesCountries();
        $codeCorrectCountry = null;
        foreach ($playedCountries as $pc) {
            if ($pc->esCorrecte) {
                $codeCorrectCountry = $pc->code;
                break;
            }
        }
        $flagUrl = $controller->getCountryByCCA($codeCorrectCountry);
        echo "<img class='game__flag' src='" . $flagUrl[0]['flags']['png'] . "' alt='Flag'>";
        echo "<section class='optionBtns'>";
        foreach ($playedCountries as $pc) {
            echo '<form method="POST" action="">';
            echo '<input type="hidden" name="goodCode" value="' . $codeCorrectCountry . '">';
            echo '<input type="hidden" name="code" value="' . $pc->code . '">';
            echo '<button class="btn btn--option" type="submit">' . $pc->nom . '</button>';
            echo '</form>';
        }
        echo "</section>";
        ?>
    </section>
</body>

</html>
<?php closeConnection($db); ?>