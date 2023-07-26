<?php
require_once("../../src/config/url.php");
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>e-commerce</title>
  <link rel="stylesheet" href="<?= $BASE_URL ?>assets/Bootstrap/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;500;700&display=swap" rel="stylesheet">
</head>

<style>
  .body {
    font-family: 'Poppins', sans-serif;
  }

  .card-body {
    height: 250px;
    overflow: auto;
  }
</style>

<body>

  <header class="bg-warning p-2">
    <nav class="navbar navbar-expand-lg navbar-light">
      <div class="container d-flex justify-content-between">
        <!-- Logo -->
        <a class="navbar-brand" href="#">E-commerce</a>

        <!-- Formulário de pesquisa -->
        <form class="form-inline d-flex align-items-center my-2 my-lg-0">
          <input class="form-control mr-sm-2" type="search" placeholder="Pesquisar" aria-label="Search">
          <button class="btn btn-outline-dark ms-3 my-2 my-sm-0" type="submit">
            <i class="fas fa-search"></i>
          </button>
        </form>



        <!-- Carrinho -->
        <a class="nav-link" href="#"><i class="fas fa-shopping-cart"></i> Carrinho</a>
      </div>
    </nav>
  </header>