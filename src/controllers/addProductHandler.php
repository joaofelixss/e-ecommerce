<?php

var_dump($_POST);
var_dump($_FILES);

require_once '../../vendor/autoload.php';

use Felix\ECommerce\Config\Connection;
use Felix\ECommerce\Models\Produtos;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $database = new Connection();
  $conn = $database->getConnection();

  $produtosModel = new Produtos($conn);

  $name = $_POST['name'];
  $price = $_POST['price'];
  $description = $_POST['description'];

  // Trate o upload de imagem como apropriado para seu projeto
  $imagePath = "";

  if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
    $imagePath = 'uploads/' . $_FILES['image']['name'];
    move_uploaded_file($_FILES['image']['tmp_name'], __DIR__ . '/' . $imagePath);
  }

  $produtosModel->adicionarProduto($name, $description, $price, $imagePath);

  header('Location: ../views/index.php');
  exit;
}
