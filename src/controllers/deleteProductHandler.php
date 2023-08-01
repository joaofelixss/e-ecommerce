<?php

require_once '../../vendor/autoload.php';

use Felix\ECommerce\Config\Connection;
use Felix\ECommerce\Models\Produtos;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $database = new Connection();
  $conn = $database->getConnection();

  $produtosModel = new Produtos($conn);

  $id = $_POST['id'];

  $produtosModel->excluirProduto($id);

  header('Location: ../views/admin.php');
  exit;
}
