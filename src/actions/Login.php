<?php

require_once __DIR__ . '/models/Admin.php';
require_once __DIR__ . '/config/connection.php';
require_once __DIR__ . '/controllers/AdminController.php';

use Felix\ECommerce\Config\Connection;
use Felix\ECommerce\Controllers\AdminController;
use Felix\ECommerce\Models\Admin;

if ($_SERVER["REQUEST_METHOD"] == "POST") {

  $connection = (new Connection())->getConnection();
  $adminModel = new Admin($connection);
  $adminController = new AdminController($adminModel);

  $username = $_POST['username'];
  $password = $_POST['password'];

  $adminController->login($username, $password);
}
