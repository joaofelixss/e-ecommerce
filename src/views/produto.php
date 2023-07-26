<?php
require_once(__DIR__ . "/../../templates/header.php");
?>

<main>
  <div class="container">
    <div class="row">

      <!-- Produto -->
      <div class="col-md-6">
        <img src="<?= $BASE_URL ?>assets/img/foto1.jpg" class="img-fluid" alt="Imagem do Produto">
      </div>

      <div class="col-md-6">
        <h2>Mini-Teclado para jogos</h2>
        <p>Redragon K617 Fizz 60% RGB com fio, teclado mecânico compacto de 61 teclas.</p>
        <p>R$ 229,99</p>
        <a href="#" class="btn btn-primary">Adicionar ao carrinho</a>
      </div>

    </div>
  </div>
</main>

<?php
require_once(__DIR__ . "/../../templates/footer.php");
?>