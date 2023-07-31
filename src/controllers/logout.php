<?php
session_start();
unset($_SESSION['admin']); // Remove o usuário da sessão
header('Location: ../views/login.php'); // Redireciona para a página de login
exit();
