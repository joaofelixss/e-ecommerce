<?php
require_once __DIR__ . '/../../vendor/autoload.php';
require_once(__DIR__ . "/../../templates/header.php");
require_once("../config/url.php");

use Felix\ECommerce\Config\Connection;
use Felix\ECommerce\Controllers\CarrinhoController;
use Felix\ECommerce\Models\Produtos;

// Iniciar a sessão
session_start();

$database = new Connection();
$conn = $database->getConnection();

$produtosModel = new Produtos($conn);
$carrinhoController = new CarrinhoController($produtosModel);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  if (isset($_POST['add'])) {
    $idProduto = $_POST['add'];
    $carrinhoController->add($idProduto);
  }

  if (isset($_POST['remove'])) {
    $idProduto = $_POST['remove'];
    $carrinhoController->remove($idProduto);
  }

  if (isset($_POST['update'])) {
    $idProduto = $_POST['update'];
    $quantidade = $_POST['quantidade'];
    $carrinhoController->updateQuantidade($idProduto, $quantidade);
  }
}
$itensCarrinho = $carrinhoController->index();
?>

<?php if (!empty($itensCarrinho)) : ?>
  <main>
    <div class="container">
      <h1>Seu Carrinho</h1>
      <table class="table table-striped">
        <thead>
          <tr>
            <th>Imagem</th>
            <th>Nome do Produto</th>
            <th>Preço Unitário</th>
            <th>Quantidade</th>
            <th>Subtotal</th>
            <th>Ações</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($itensCarrinho as $item) : ?>
            <?php
            $produto = $item['produto']; // Acesso ao produto corrigido
            ?>
            <tr>
              <td><img src="<?= $BASE_URL . $produto->getImagem() ?>" alt="Imagem do Produto" width="100"></td>
              <td><?= $produto->getNome() ?></td>
              <td>R$ <?= $produto->getPreco() ?></td>
              <td><?= $item['quantidade'] ?></td>
              <td>R$ <?= $produto->getPreco() * $item['quantidade'] ?></td>
              <td>
                <form method="post">
                  <input type="hidden" name="update" value="<?= $produto->getId() ?>">
                  <input type="number" name="quantidade" value="<?= $item['quantidade'] ?>">
                  <input type="submit" value="Atualizar quantidade">
                </form>
                <form method="post">
                  <input type="hidden" name="remove" value="<?= $produto->getId() ?>">
                  <input type="submit" value="Remover">
                </form>
              </td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    <?php else : ?>
      <p>Nenhum item no carrinho.</p>
    <?php endif; ?>
    <div class="text-right">
      <h4>Total: R$ <?= $carrinhoController->getCarrinho()->calcularTotal() ?></h4>
    </div>
    <div class="text-right mt-3">
      <a href="#" class="btn btn-success">Finalizar Compra</a>
      <!-- Continuar Comprando -->
      <a href="<?= $BASE_URL ?>src/views/index.php" class="btn btn-primary">Continuar Comprando</a>
    </div>

    <!-- Cupom de desconto -->
    <div class="mb-3">
      <h2>Cupom de Desconto</h2>
      <form>
        <input type="text" class="form-control" placeholder="Digite seu cupom">
        <button type="submit" class="btn btn-primary mt-2">Aplicar</button>
      </form>
    </div>

    <!-- Estimativa de Frete e Impostos -->
    <div class="mb-3">
      <h2>Estimativa de Frete e Impostos</h2>
      <form>
        <input type="text" class="form-control" placeholder="Digite seu CEP">
        <button type="submit" class="btn btn-primary mt-2">Calcular</button>
      </form>
    </div>

    <!-- Forma de Pagamento -->
    <div class="mb-3">
      <h2>Forma de Pagamento</h2>
      <div class="form-check">
        <input class="form-check-input" type="radio" name="paymentMethod" id="creditCard" checked>
        <label class="form-check-label" for="creditCard">
          Cartão de Crédito
        </label>
      </div>
      <div class="form-check">
        <input class="form-check-input" type="radio" name="paymentMethod" id="paypal">
        <label class="form-check-label" for="paypal">
          PayPal
        </label>
      </div>
      <!-- Adicione mais opções de pagamento conforme necessário -->
    </div>
  </main>

  <?php
  require_once(__DIR__ . "/../../templates/footer.php");
  ?>