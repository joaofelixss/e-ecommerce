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

<main>
  <div class="container py-5">
    <h1 class="mb-4">Seu Carrinho</h1>
    <?php if (!empty($itensCarrinho)) : ?>
      <div class="table-responsive">
        <table class="table table-bordered table-striped text-center">
          <thead class="thead-light">
            <tr>
              <th scope="col">Imagem</th>
              <th scope="col">Nome do Produto</th>
              <th scope="col">Preço Unitário</th>
              <th scope="col">Quantidade</th>
              <th scope="col">Subtotal</th>
              <th scope="col">Ações</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($itensCarrinho as $item) : ?>
              <?php
              $produto = $item['produto']; // Acesso ao produto corrigido
              ?>
              <tr>
                <td class="align-middle"><img src="<?= $BASE_URL . $produto->getImagem() ?>" alt="Imagem do Produto" width="100"></td>
                <td class="align-middle"><?= $produto->getNome() ?></td>
                <td class="align-middle">R$ <?= $produto->getPreco() ?></td>
                <td class="align-middle"><?= $item['quantidade'] ?></td>
                <td class="align-middle">R$ <?= $produto->getPreco() * $item['quantidade'] ?></td>
                <td class="align-middle">
                  <form method="post" class="mb-2">
                    <input type="hidden" name="update" value="<?= $produto->getId() ?>">
                    <input type="number" name="quantidade" value="<?= $item['quantidade'] ?>" class="form-control mb-2">
                    <button type="submit" class="btn btn-info">Atualizar quantidade</button>
                  </form>
                  <form method="post">
                    <input type="hidden" name="remove" value="<?= $produto->getId() ?>">
                    <button type="submit" class="btn btn-danger">Remover</button>
                  </form>
                </td>
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>

      </div>
    <?php else : ?>
      <p class="alert alert-warning">Nenhum item no carrinho.</p>
    <?php endif; ?>
    <div class="text-right">
      <h4>Total: R$ <?= $carrinhoController->getCarrinho()->calcularTotal() ?></h4>
      <div class="mt-4">
        <a href="<?= $BASE_URL ?>src/views/index.php" class="btn btn-primary">Continuar Comprando</a>
        <a href="#" class="btn btn-success">
          <i class="fas fa-shopping-cart"></i> Finalizar Compra
        </a>
      </div>
    </div>

    <!-- Cupom de desconto -->
    <div class="mb-3 mt-5">
      <h2>Cupom de Desconto</h2>
      <form>
        <input type="text" class="form-control" placeholder="Digite seu cupom">
        <button type="submit" class="btn btn-primary mt-2">Aplicar</button>
      </form>
    </div>

    <!-- Estimativa de Frete e Impostos -->
    <div class="mb-3 mt-5">
      <h2>Estimativa de Frete e Impostos</h2>
      <form>
        <input type="text" class="form-control" placeholder="Digite seu CEP">
        <button type="submit" class="btn btn-primary mt-2">Calcular</button>
      </form>
    </div>

    <!-- Forma de Pagamento -->
    <div class="mb-3 mt-5">
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
  </div>
</main>

<?php
require_once(__DIR__ . "/../../templates/footer.php");
?>