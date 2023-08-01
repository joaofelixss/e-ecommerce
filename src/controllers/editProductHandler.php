<?php
require_once '../../vendor/autoload.php';

use Felix\ECommerce\Config\Connection;
use Felix\ECommerce\Models\Produtos;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $database = new Connection();
  $conn = $database->getConnection();

  $produtosModel = new Produtos($conn);

  $id = $_POST['id'];
  $name = $_POST['name'];
  $price = $_POST['price'];
  $description = $_POST['description'];

  // Se uma nova imagem foi enviada, a substituímos, se não, mantemos a antiga.
  $imagePath = $produtosModel->buscarProduto($id)->getImagem();

  if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
    $imagePath = 'uploads/' . $_FILES['image']['name'];
    move_uploaded_file($_FILES['image']['tmp_name'], __DIR__ . '/uploads/' . $imagePath);
  }

  $produtosModel->atualizarProduto($id, $name, $description, $price, $imagePath);

  header('Location: ../views/index.php');
  exit;
}
