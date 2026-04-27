<?php
session_start();
require_once __DIR__ . '/../include/initCountries.php';
require_once __DIR__ . '/../model/Pais.php';
require_once __DIR__ . '/../include/dbConnection.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ranking</title>
    <link rel="stylesheet" href="/styles/styles.css">
</head>

<body>
    <main>
        <header class="site-header">
            <nav class="site-nav">
                <a class="site-nav__logo" href="<?= $basePath ?>index.php">Fun with <span>Flags</span></a>
                <div class="site-nav__links">
                    <a href="../index.php">Inici</a>
                    <a href="ranking.php">Rànquing</a>
                </div>
            </nav>
            <div class="site-header__auth">
                <?php if (($_SESSION['isLoggedIn'] ?? false) == true): ?>
                    <p class="greetingUser">Hola <span>
                            <?= htmlspecialchars($_SESSION['username']) ?>
                        </span></p>
                    <a class="logoutLink" href="logout.proc.php">Logout</a>
                <?php else: ?>
                    <a class="loginLink" href="login.php">Login</a>
                <?php endif; ?>
            </div>
        </header>
        <section class="ranking">
            <h1 class="ranking__title">Rànquing</h1>
            <p class="ranking__subtitle">Les millors partides</p>

            <?php $gamesArr = $gameController->rankingView(); ?>

            <table class="ranking__table">
                <thead>
                    <tr>
                        <th>Jugador</th>
                        <th>Data</th>
                        <th style="text-align:right">Punts</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($gamesArr as $i => $g): ?>
                        <tr class="ranking__row">
                            <td class="ranking__player"><?= htmlspecialchars($g['username']) ?></td>
                            <td class="ranking__date"><?= $g['date'] ?></td>
                            <td class="ranking__score"><?= $g['punts'] ?> / 10</td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </section>
    </main>
</body>

</html>
<?php closeConnection($db); ?>