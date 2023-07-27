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

$carrinhoController->add(2);
$itensCarrinho = $carrinhoController->index();

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
            <tr>
              <td><img src="<?= $BASE_URL . $item->getImagem() ?>" alt="Imagem do Produto" width="100"></td>
              <td><?= $item->getNome() ?></td>
              <td>R$ <?= $item->getPreco() ?></td>
              <td>1</td> <!-- Aqui você precisará implementar a lógica para quantidades -->
              <td>R$ <?= $item->getPreco() ?></td> <!-- E aqui o subtotal para cada produto -->
              <td>
                <a href="#" class="btn btn-primary">Editar</a>
                <a href="#" class="btn btn-danger">Remover</a>
              </td>
            </tr>
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