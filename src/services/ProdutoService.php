<?php

namespace Felix\ECommerce\Services;

use Felix\ECommerce\Config\Connection;
use Felix\ECommerce\Models\Produtos;

class ProdutoService
{
  protected $produtosModel;

  public function __construct()
  {
    $database = new Connection();
    $conn = $database->getConnection();

    $this->produtosModel = new Produtos($conn);
  }

  public function getAllProducts()
  {
    return $this->produtosModel->listarProduto();
  }
}
