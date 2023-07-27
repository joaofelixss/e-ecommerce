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

  public function add($idProduto)
  {
    $produto = $this->produtosModel->buscarProduto($idProduto);

    if ($produto) {
      $this->carrinho->adicionarProduto($produto);
      return true;
    }
    return false;
  }


  public function remove($idProduto)
  {
    return $this->carrinho->removerProduto($idProduto);
  }

  public function index()
  {

    $itensCarrinho = $this->carrinho->getItens();

    // Renderiza a visão do carrinho e passa $itensCarrinho
    require_once("../views/carrinho.php");
  }


  public function getCarrinho()
  {
    return $this->carrinho;
  }
}
