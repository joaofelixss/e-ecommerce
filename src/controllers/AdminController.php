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

  public function login($username, $password)
  {
    if ($this->adminModel->findAdmin($username, $password)) {
      $_SESSION['admin'] = $username;
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
