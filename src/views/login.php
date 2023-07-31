<?php
require_once('../../templates/header.php');
?>

<!-- Formulário de Login -->
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-6">
      <h2 class="text-center mt-5">Login de Admin</h2>
      <form action="../controllers/AdminController.php" method="post" class="p-4 mt-3 border rounded">
        <div class="form-group">
          <label for="username">Nome de usuário:</label>
          <input type="text" id="username" name="username" required class="form-control">
        </div>
        <div class="form-group">
          <label for="password">Senha:</label>
          <input type="password" id="password" name="password" required class="form-control">
        </div>
        <input type="submit" value="Entrar" class="btn btn-primary btn-block">
      </form>
    </div>
  </div>
</div>

<?php
require_once('../../templates/footer.php');
?>