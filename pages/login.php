<?php
session_start();
require_once __DIR__ . '/../include/errorHandler.proc.php';
require_once __DIR__ . '/../controller/usuarisController.php';
require_once __DIR__ . '/../model/Usuari.php';
require_once __DIR__ . '/../include/dbConnection.php';

$error = false;
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['username']) && isset($_POST['password'])) {
  $username = $_POST['username'];
  $password = $_POST['password'];
  $userExists = $usuarisController->userExists(new Usuari($username, $password));
  if ($userExists == false) {
    $error = true;
  } else {
    $error = false;
    $_SESSION['username'] = $username;
    $_SESSION['userId'] = $userExists;
    $_SESSION['isLoggedIn'] = true;
    header('Location: ../index.php');
    exit();
  }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login</title>
  <link rel="stylesheet" href="../styles/styles.css">
</head>

<body>
  <main class="auth">
    <div class="auth__card">
      <h2 class="auth__title">Inicia <span>sessió</span></h2>

      <form action="" method="post" class="auth__form">
        <div class="auth__field">
          <label class="auth__label" for="username">Nom d'usuari</label>
          <input class="auth__input" type="text" name="username" id="username" placeholder="el teu nom" required>
        </div>
        <div class="auth__field">
          <label class="auth__label" for="password">Contrasenya</label>
          <input class="auth__input" type="password" name="password" id="password" placeholder="••••••••" required>
        </div>
        <?php if ($error): ?>
          <p class="auth__error">Usuari o contrasenya incorrectes</p>
        <?php endif; ?>
        <button class="btn btn--primary btn--full" type="submit">Entrar</button>
      </form>

      <p class="auth__footer">Encara no tens compte? <a href="registre.php">Registra't</a></p>
    </div>
  </main>
</body>

</html>
<?php
closeConnection($db);
?>