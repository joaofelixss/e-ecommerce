<?php
require_once('../../templates/header.php');
?>

<!-- Formulário de Login -->
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-6">
      <div class="card mt-5">
        <h2 class="card-header text-center text-dark">Login de Admin</h2>
        <div class="card-body">
          <form action="../controllers/AdminController.php" method="post">
            <div class="form-group mb-3">
              <label for="username" class="text-dark">Nome de usuário:</label>
              <input type="text" id="username" name="username" required class="form-control">
            </div>
            <div class="form-group mb-3">
              <label for="password" class="text-dark">Senha:</label>
              <input type="password" id="password" name="password" required class="form-control">
            </div>
            <input type="submit" value="Entrar" class="btn btn-dark btn-block">
          </form>
        </div>
      </div>
    </div>
  </div>
</div>

<?php
require_once('../../templates/footer.php');
?>