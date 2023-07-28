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
        <img src="<?= $BASE_URL . $produto->getImagem() ?>" class="img-fluid rounded mb-3" alt="Imagem do Produto">

        <!-- Nome, Descrição e Preço -->
        <h2 class="mb-3"><?= $produto->getNome() ?></h2>
        <p class="text-muted"><?= $produto->getDescricao() ?></p>
        <h4 class="mb-3 text-primary">R$ <?= $produto->getPreco() ?></h4>

        <!-- Botão para adicionar ao carrinho -->
        <form method="post" action="../views/carrinho.php">
          <input type="hidden" name="add" value="<?= $produto->getId() ?>">
          <button type="submit" class="btn btn-primary">Adicionar ao Carrinho</button>
        </form>
      </div>

      <div class="col-md-6">
        <!-- Descrição detalhada -->
        <h4>Descrição detalhada</h4>
        <p>Este produto é um exemplo perfeito de design atencioso e qualidade superior. É feito com materiais da mais alta qualidade para garantir durabilidade e resistência ao desgaste. Seja para uso pessoal ou para presente, este produto certamente impressionará.</p>

        <!-- Imagens adicionais -->
        <h4 class="mt-4">Imagens adicionais</h4>

        <!-- Avaliações de clientes -->
        <h4 class="mt-4">Avaliações de clientes</h4>
        <p>
          <strong>João:</strong> Adorei este produto! Altamente recomendado. <br>
          <strong>Maria:</strong> Produto de excelente qualidade e entrega rápida. <br>
          <strong>Paulo:</strong> Serviço ao cliente foi ótimo, estou muito satisfeito com a compra.
        </p>

        <!-- Detalhes de envio e retorno -->
        <h4 class="mt-4">Detalhes de envio e retorno</h4>
        <p>Envio dentro de 2-3 dias. Retorno aceito dentro de 14 dias.</p>

        <!-- FAQ -->
        <h4 class="mt-4">Perguntas Frequentes</h4>
        <p>
          <strong>Q: Isso é um produto de exemplo?</strong><br>A: Sim, isso é apenas um produto de exemplo.<br>
          <strong>Q: Quanto tempo demora a entrega?</strong><br>A: A entrega geralmente demora de 2 a 3 dias.<br>
          <strong>Q: Vocês aceitam retornos?</strong><br>A: Sim, aceitamos retornos dentro de 14 dias.
        </p>
      </div>

      <!-- Produtos relacionados -->
      <div class="col-md-12 mt-5">
        <h4>Produtos relacionados</h4>
      </div>

    </div>
  </div>
</main>

<?php
require_once(__DIR__ . "/../../templates/footer.php");
?>