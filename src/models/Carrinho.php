<?php

namespace Felix\ECommerce\Models;

class Carrinho
{
  private $itens;

  public function __construct()
  {
    $this->itens = array();
  }

  public function adicionarProduto($produto, $quantidade = 1)
  {
    $produtoId = $produto->getId();

    // Se o produto já está no carrinho, incrementa a quantidade
    if (isset($this->itens[$produtoId])) {
      $this->itens[$produtoId]['quantidade'] += $quantidade;
    } else {
      // Se o produto não está no carrinho, adiciona com a quantidade inicial
      $this->itens[$produtoId] = [
        'produto' => $produto,  // Aqui deve ser um objeto Produto, não um array associativo.
        'quantidade' => $quantidade,
      ];
    }
  }

  public function removerProduto($produtoId)
  {
    unset($this->itens[$produtoId]);
  }

  public function updateQuantidade($produtoId, $quantidade)
  {
    if (isset($this->itens[$produtoId])) {
      if ($quantidade > 0) {
        $this->itens[$produtoId]['quantidade'] = $quantidade;
      } else {
        // Se a quantidade é 0 ou menor, remove o produto do carrinho
        $this->removerProduto($produtoId);
      }
    }
  }

  public function calcularTotal()
  {
    $total = 0;
    foreach ($this->itens as $item) {
      $total += $item['produto']->getPreco() * $item['quantidade'];
    }
    return $total;
  }

  public function getItens()
  {
    return $this->itens;
  }
}
