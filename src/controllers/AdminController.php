<?php

namespace Felix\ECommerce\Controllers;

use Felix\ECommerce\Config\Connection;
use Felix\ECommerce\Models\Admin;

class AdminController
{
  private $adminModel;

  public function __construct(Admin $adminModel)
  {
    if (session_status() == PHP_SESSION_NONE) {
      session_start();
    }
    $this->adminModel = $adminModel;
  }

  public function login($username, $password)
  {
    if ($this->adminModel->findAdmin($username, $password)) {
      $_SESSION['admin'] = $username;
      $_SESSION['success'] = "Login efetuado com sucesso";
      header('Location: admin.php');
    } else {
      echo "Usuário ou senha incorretos.";
    }
  }

  public function logout()
  {
    unset($_SESSION['admin']);
    header('Location: login.php');
  }
}

// Processamento do Formulário de Login
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  include '../models/Admin.php';
  include '../config/connection.php';

  // Instancie a classe Connection e obtenha a conexão
  $connection = (new Connection())->getConnection();

  $adminModel = new \Felix\ECommerce\Models\Admin($connection);

  $username = $_POST['username'];
  $password = $_POST['password'];

  $adminController = new AdminController($adminModel);
  $adminController->login($username, $password);
}
