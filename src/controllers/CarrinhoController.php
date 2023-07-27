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

    // Adiciona um produto ao carrinho para teste
    // Substitua '2' pelo ID do produto que você deseja adicionar
    $this->add(2);
  }

  public function add($idProduto, $quantidade = 1)
  {
    $produto = $this->produtosModel->buscarProduto($idProduto);

    // Imprima o valor de $produto para verificar se é um objeto Produto válido
    var_dump($produto);

    if ($produto) {
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
    // Obtem os itens do carrinho
    $itensCarrinho = $this->carrinho->getItens();

    // Retorna os itens do carrinho
    return $itensCarrinho;
    require_once("../views/carrinho.php");
  }

  public function getCarrinho()
  {
    return $this->carrinho;
  }
}
