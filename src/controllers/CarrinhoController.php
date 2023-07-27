<?php

namespace Felix\ECommerce\Controllers;

use Felix\ECommerce\Models\Carrinho;
use Felix\ECommerce\Models\Produtos;

class CarrinhoController
{
  private $produtosModel;
  private $carrinho;

  public function __construct(Produtos $produtosModel)
  {
    // Inicializa a sessão
    if (session_status() == PHP_SESSION_NONE) {
      session_start();
    }

    // Inicializa o carrinho na sessão se ele não existir
    if (!isset($_SESSION['carrinho'])) {
      $_SESSION['carrinho'] = new Carrinho();
    }
    $this->carrinho = &$_SESSION['carrinho'];
    $this->produtosModel = $produtosModel;
  }

  public function add($idProduto, $quantidade = 1)
  {
    $produto = $this->produtosModel->buscarProduto($idProduto);

    if ($produto) {
      var_dump($produto, $produto instanceof \Felix\ECommerce\Models\Produto, $quantidade);
      $this->carrinho->adicionarProduto($produto, $quantidade);
      return true;
    }
    return false;
  }

  public function updateQuantidade($idProduto, $quantidade)
  {
    $this->carrinho->updateQuantidade($idProduto, $quantidade);
  }

  public function remove($idProduto)
  {
    return $this->carrinho->removerProduto($idProduto);
  }

  public function index()
  {
    $itensCarrinho = $this->carrinho->getItens();

    $itensCompletos = [];
    foreach ($itensCarrinho as $item) {
      $produto = $item;  // item é um objeto Produto
      $itensCompletos[] = [
        'produto' => $produto,
        'quantidade' => 1  // você precisa definir como você quer determinar a quantidade
      ];
    }

    return $itensCompletos;
  }

  public function getCarrinho()
  {
    return $this->carrinho;
  }
}
