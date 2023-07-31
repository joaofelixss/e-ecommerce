<?php

require_once __DIR__ . '/../../vendor/autoload.php';
require_once(__DIR__ . "/../../templates/header.php");
require_once("../config/url.php");

use Felix\ECommerce\Config\Connection;
use Felix\ECommerce\Controllers\ProdutoController;
use Felix\ECommerce\Models\Produtos;

//instância a classe connection e obtenha a conexão
$database = new Connection();
$conn = $database->getConnection();

if (!isset($_SESSION['admin'])) {
  header('Location: login.php');
  exit;
}

$produtosModel = new Produtos($conn);
$produtoController = new ProdutoController($produtosModel);

$produtos = $produtoController->index();
?>

<main>
  <div class="container pt-5 pb-5">
    <div class="row">

      <?php foreach ($produtos as $produto) : ?>

        <!-- Produto -->
        <div class="col-md-4 mb-3">
          <div class="card p-3 clickable" onclick="location.href='produto.php?id=<?= $produto->getId() ?>';">
            <img src="<?= $BASE_URL ?>src/controllers/<?= $produto->getImagem() ?>" class="card-img-top" alt="Imagem do Produto <?= $produto->getId() ?>">
            <div class="card-body d-flex flex-column">
              <h3 class="card-title"><?= $produto->getNome() ?></h3>
              <p class="card-text mb-1"><strong>Preço:</strong> R$ <?= $produto->getPreco() ?></p>
              <p class="card-text"><?= $produto->getDescricao() ?></p>
              <form method="post" action="carrinho.php">
                <input type="hidden" name="add" value="<?= $produto->getId() ?>">
                <input type="submit" class="btn btn-dark" value="Adicionar ao Carrinho">
              </form>
            </div>
          </div>
        </div>

      <?php endforeach; ?>

    </div>

    <div class="d-flex justify-content-center">
      <button type="button" class="btn btn-dark" data-toggle="modal" data-target="#addProductModal">
        Adicionar novo produto
      </button>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="addProductModal" tabindex="-1" role="dialog" aria-labelledby="addProductModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="addProductModalLabel">Adicionar Produto</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Fechar" style="background-color: #f8f9fa; padding: 5px; border-radius: 5px;">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form action="<?= $BASE_URL ?>src/controllers/addProductHandler.php" method="POST" enctype="multipart/form-data">
              <div class="form-group mb-3">
                <label for="name">Nome do Produto:</label>
                <input type="text" class="form-control" id="name" name="name">
              </div>
              <div class="form-group mb-3">
                <label for="price">Preço:</label>
                <input type="number" class="form-control" id="price" name="price" step=".01">
              </div>
              <div class="form-group mb-3">
                <label for="description">Descrição:</label>
                <textarea class="form-control" id="description" name="description"></textarea>
              </div>
              <div class="form-group mb-3">
                <label for="image">Imagem:</label>
                <input type="file" class="form-control-file" id="image" name="image">
              </div>
              <button type="submit" class="btn btn-dark">Adicionar Produto</button>
            </form>
          </div>
        </div>
      </div>
    </div>

  </div>
</main>

<?php
require_once(__DIR__ . "/../../templates/footer.php");
?>