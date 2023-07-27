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
    // Renderiza a visão de lista de produtos e passa a variável $produtos
    require_once __DIR__ . '/../../views/produtos/index.php';
  }

  // Mostra um produto específico
  public function show($id)
  {
    $produto = $this->produtos->buscarProduto($id);
    // Renderiza a visão de detalhes do produto e passa a variável $produto
    require_once __DIR__ . '/../../views/produtos/produto.php';
  }
}
