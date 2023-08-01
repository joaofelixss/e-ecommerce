<?php

namespace Felix\ECommerce\Controllers;

use Felix\ECommerce\Models\Produtos;

class ProdutoController
{
  private $produtos;

  // O construtor recebe uma instância do modelo Produtos
  public function __construct(Produtos $produtos)
  {
    $this->produtos = $produtos;
  }

  // Lista todos os produtos
  public function index()
  {
    $produtos = $this->produtos->listarProduto();
    return $produtos;
  }

  // Mostra um produto específico
  public function show($id)
  {
    $produto = $this->produtos->buscarProduto($id);
    return $produto;
  }
}
