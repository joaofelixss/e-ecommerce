<?php

namespace Felix\ECommerce\Models;

class Carrinho
{
  private $itens;

  public function __construct()
  {
    $this->itens = array();
  }

  public function adicionarProduto($produto)
  {
    $this->itens[] = $produto;
  }

  public function removerProduto($produtoId)
  {
    foreach ($this->itens as $key => $item) {
      if ($item->getId() == $produtoId) {
        unset($this->itens[$key]);
        break;
      }
    }
  }

  public function calcularTotal()
  {
    $total = 0;
    foreach ($this->itens as $item) {
      $total += $item->getPreco();
    }

    return $total;
  }

  public function getItens()
  {
    return $this->itens;
  }
}
