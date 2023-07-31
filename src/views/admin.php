<?php
session_start();

if (!isset($_SESSION['admin'])) {
  header('Location: login.php');
  exit;
}

require_once('../templates/header.php');
?>

<h2>Bem-vindo, <?php echo $_SESSION['admin']; ?></h2>

<?php
require_once('../templates/footer.php');
?>