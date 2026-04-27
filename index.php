<?php
require_once __DIR__ . '/include/initCountries.php';
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="color-scheme" content="dark">
    <title>Fun with Flags</title>
    <link rel="stylesheet" href="styles/styles.css">
</head>

<body>
    <header class="site-header">
        <nav class="site-nav">
            <a class="site-nav__logo" href="<?= $basePath ?>index.php">Fun with <span>Flags</span></a>
            <div class="site-nav__links">
                <a href="index.php">Inici</a>
                <a href="pages/ranking.php">Rànquing</a>
            </div>
        </nav>
        <div class="site-header__auth">
            <?php if (($_SESSION['isLoggedIn'] ?? false) == true): ?>
                <p class="greetingUser">Hola <span><?= htmlspecialchars($_SESSION['username']) ?></span></p>
                <a class="logoutLink" href="pages/logout.proc.php">Logout</a>
            <?php else: ?>
                <a class="loginLink" href="pages/login.php">Login</a>
            <?php endif; ?>
        </div>
    </header>
    <main>
        <section class="hero">
            <h1>Fun with <span class="hero__accent">Flags</span></h1>
            <p class="hero__subtitle">Quant saps de les banderes del món? Posa't a prova.</p>
            <form action="pages/game.php">
                <button class="btn btn--primary">Jugar</button>
            </form>

        </section>
        <section class="dayFlag">
            <h2 class="section-title">Country of The Day</h2>
            <?php
            $country = $controller->getCountryOfTheDay();
            $nameSpa = $country[0]['translations']['spa']['common'];
            $nameOff = $country[0]['name']['official'];
            $flagPng = $country[0]['flags']['png'];
            $capital = $country[0]['capital'][0];
            $region = $country[0]['subregion'] ?? $country[0]['region'] ?? 'N/A';
            ?>
            <div class="dayFlag__card">
                <div class="dayFlag__flag-wrap">
                    <img class="dayFlag__flag" src="<?= $flagPng ?>">
                </div>
                <div class="dayFlag__info">
                    <h3 class="dayFlag__name"><?= $nameSpa ?></h3>
                    <p class="dayFlag__official"><?= $nameOff ?></p>
                    <ul class="dayFlag__meta">
                        <li><span class="dayFlag__label">Capital</span><?= $capital ?></li>
                        <li><span class="dayFlag__label">Regió</span><?= $region ?></li>
                    </ul>
                </div>
            </div>
        </section>
    </main>

</body>

</html>