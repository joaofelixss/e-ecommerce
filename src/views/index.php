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
          <a href="<?= $BASE_URL ?>src/views/produto.php?id=<?= $produto->getId() ?>" class="view-details">
            <div class="card p-3">
              <img src="<?= $BASE_URL ?>src/controllers/<?= $produto->getImagem() ?>" class="card-img-top" alt="Imagem do Produto <?= $produto->getId() ?>">
              <div class="card-body d-flex flex-column">
                <h3 class="card-title"><?= $produto->getNome() ?></h3>
                <p class="card-text mb-1"><strong>Preço:</strong> R$ <?= $produto->getPreco() ?></p>
                <p class="card-text"><?= substr($produto->getDescricao(), 0, 200) ?>...</p>
              </div>
              <form method="post" action="carrinho.php">
                <input type="hidden" name="add" value="<?= $produto->getId() ?>">
                <input type="submit" class="btn btn-dark" value="Adicionar ao Carrinho">
              </form>
            </div>
          </a>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
</main>

<?php
require_once(__DIR__ . "/../../templates/footer.php");
?>