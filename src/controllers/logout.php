<?php
session_start();
unset($_SESSION['admin']); // Remove o usuário da sessão
header('Location: ../views/index.php'); // Redireciona para a página de login
exit();
