<?php
require_once(__DIR__ . "/../../templates/header.php");
?>

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
        <!-- Vamos assumir que temos um produto no carrinho -->
        <tr>
          <td><img src="<?= $BASE_URL ?>assets/img/foto1.jpg" alt="Imagem do Produto" width="100"></td>
          <td>Nome do Produto</td>
          <td>R$ 99,99</td>
          <td>1</td>
          <td>R$ 99,99</td>
          <td>
            <a href="#" class="btn btn-primary">Editar</a>
            <a href="#" class="btn btn-danger">Remover</a>
          </td>
        </tr>
        <!-- Mais produtos iriam aqui -->
      </tbody>
    </table>
    <div class="text-right">
      <h4>Total: R$ 99,99</h4>
    </div>
    <div class="text-right mt-3">
      <a href="#" class="btn btn-success">Finalizar Compra</a>
    </div>
  </div>
</main>

<?php
require_once(__DIR__ . "/../../templates/footer.php");
?>