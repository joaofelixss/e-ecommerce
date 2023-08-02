<?php

namespace Felix\ECommerce\Controllers;

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

  public function authenticate($username, $password)
  {
    return $this->adminModel->findAdmin($username, $password);
  }

  public function login($username, $password)
  {
    if ($this->authenticate($username, $password)) {
      $_SESSION['admin'] = $username;
      $_SESSION['success'] = "Login efetuado com sucesso";
      $this->redirectToAdminPage();
    } else {
      echo "Usuário ou senha incorretos.";
    }
  }

  public function redirectToAdminPage()
  {
    header('Location: ../views/admin.php');
    exit;
  }

  public function logout()
  {
    unset($_SESSION['admin']);
    header('Location: ../actions/login.php');
    exit;
  }
}
