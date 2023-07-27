<?php
require_once __DIR__ . '/../../vendor/autoload.php';
require_once(__DIR__ . "/../../templates/header.php");
require_once("../config/url.php");

use Felix\ECommerce\Config\Connection;
use Felix\ECommerce\Controllers\CarrinhoController;
use Felix\ECommerce\Models\Produtos;

$database = new Connection();
$conn = $database->getConnection();

$produtosModel = new Produtos($conn);
$carrinhoController = new CarrinhoController($produtosModel);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

  if (isset($_POST['add'])) {
    $idProduto = $_POST['add'];
    $carrinhoController->add($idProduto);
  }

  if (isset($_POST['update'])) {
    $idProduto = $_POST['update'];
    $quantidade = $_POST['quantidade'];
    $carrinhoController->updateQuantidade($idProduto, $quantidade);
  }

  if (isset($_POST['remove'])) {
    $idProduto = $_POST['remove'];
    $carrinhoController->remove($idProduto);
  }
}

$itensCarrinho = $carrinhoController->index();
$carrinhoController->add(2);
?>

<?php if (!empty($itensCarrinho)) : ?>
  <main class="bg-primary">
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
            <?php if ($item !== null) : ?>
              <tr>
                <td><img src="<?= $BASE_URL . $item->getImagem() ?>" alt="Imagem do Produto" width="100"></td>
                <td><?= $item->getNome() ?></td>
                <td>R$ <?= $item->getPreco() ?></td>
                <td><?= $item['quantidade'] ?></td> <!-- Aqui você irá mostrar a quantidade do produto -->
                <td>R$ <?= $item->getPreco() * $item['quantidade'] ?></td> <!-- E aqui o subtotal para cada produto -->
                <td>
                  <form method="post">
                    <input type="hidden" name="update" value="<?= $item->getId() ?>">
                    <input type="number" name="quantidade" value="<?= $item['quantidade'] ?>">
                    <input type="submit" value="Atualizar quantidade">
                  </form>
                  <form method="post">
                    <input type="hidden" name="remove" value="<?= $item->getId() ?>">
                    <input type="submit" value="Remover">
                  </form>
                </td>
              </tr>
            <?php endif; ?>
          <?php endforeach; ?>
        </tbody>

      <?php else : ?>
        <p>Nenhum item no carrinho.</p>
      <?php endif; ?>
      </table>
      <div class="text-right">
        <h4>Total: R$ <?= $carrinhoController->getCarrinho()->calcularTotal() ?></h4>
      </div>
      <div class="text-right mt-3">
        <a href="#" class="btn btn-success">Finalizar Compra</a>
      </div>
    </div>
  </main>

  <?php
  require_once(__DIR__ . "/../../templates/footer.php");
  ?>