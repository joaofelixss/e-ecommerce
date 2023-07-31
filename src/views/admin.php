<?php
session_start();

if (!isset($_SESSION['admin'])) {
  header('Location: login.php');
  exit;
}

// Exibir a mensagem de sucesso, se houver
if (isset($_SESSION['success'])) {
  echo $_SESSION['success'];
  unset($_SESSION['success']);
}

require_once('../templates/header.php');
?>

<h2>Bem-vindo, <?php echo $_SESSION['admin']; ?></h2>

<?php
require_once('../templates/footer.php');
?>