<?php
require_once __DIR__ . '/../../vendor/autoload.php';
require_once(__DIR__ . "/../../templates/header.php");
require_once("../config/url.php");

use Felix\ECommerce\Config\Connection;
use Felix\ECommerce\Controllers\ProdutoController;
use Felix\ECommerce\Models\Produtos;

// Obtendo a conexão do banco de dados
$database = new Connection();
$conn = $database->getConnection();

$produtosModel = new Produtos($conn);
$produtoController = new ProdutoController($produtosModel);

$idProduto = $_GET['id']; 
$produto = $produtoController->show($idProduto);
?>

<main>
  <div class="container mt-5">
    <div class="row">
      <!-- Detalhes do Produto -->
      <div class="col-md-6">
        <!-- Imagens do Produto -->
        <img src="<?= $BASE_URL . $produto->getImagem() ?>" class="img-fluid" alt="Imagem do Produto">

        <!-- Nome, Descrição e Preço -->
        <h2><?= $produto->getNome() ?></h2>
        <p><?= $produto->getDescricao() ?></p>
        <p>R$ <?= $produto->getPreco() ?></p>

        <!-- Botão para adicionar ao carrinho -->
        <form method="post" action="../views/carrinho.php">
          <input type="hidden" name="add" value="<?= $produto->getId() ?>">
          <input type="submit" value="Adicionar ao Carrinho">
        </form>
      </div>

      <!-- Descrição detalhada -->
      <div class="col-md-12 mt-5">
        <h4>Descrição detalhada</h4>
        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer nec odio. Praesent libero.</p>
      </div>

      <!-- Imagens adicionais -->
      <div class="col-md-12 mt-5">
        <h4>Imagens adicionais</h4>
        <!-- Adicionar suas imagens adicionais aqui -->
      </div>

      <!-- Avaliações de clientes -->
      <div class="col-md-12 mt-5">
        <h4>Avaliações de clientes</h4>
        <!-- Adicionar avaliações de clientes aqui -->
      </div>

      <!-- Detalhes de envio e retorno -->
      <div class="col-md-12 mt-5">
        <h4>Detalhes de envio e retorno</h4>
        <p>Envio dentro de 2-3 dias. Retorno aceito dentro de 14 dias.</p>
      </div>

      <!-- FAQ -->
      <div class="col-md-12 mt-5">
        <h4>Perguntas Frequentes</h4>
        <p>Q: Isso é um produto de exemplo?<br>A: Sim, isso é apenas um produto de exemplo.</p>
      </div>

      <!-- Produtos relacionados -->
      <div class="col-md-12 mt-5">
        <h4>Produtos relacionados</h4>
        <!-- Adicionar produtos relacionados aqui -->
      </div>

    </div>
  </div>
</main>

<?php
require_once(__DIR__ . "/../../templates/footer.php");
?>