<?php

namespace Felix\ECommerce\Models;

class Produto
{

  private $id;
  private $nome;
  private $descricao;
  private $preco;
  private $imagem;

  public function __construct($nome = '', $descricao = '', $preco = '', $imagem = '')
  {
    $this->nome = $nome;
    $this->descricao = $descricao;
    $this->preco = $preco;
    $this->imagem = $imagem;
  }

  // Métodos Getters e Setters (acessores e modificadores) para cada propriedade

  public function getId()
  {
    return $this->id;
  }

  public function getNome()
  {
    return $this->nome;
  }

  public function getDescricao()
  {
    return $this->descricao;
  }

  public function getPreco()
  {
    return $this->preco;
  }

  public function getImagem()
  {
    return $this->imagem;
  }

  public function setId($id)
  {
    return $this->id = $id;
  }

  public function setNome($nome)
  {
    return $this->nome = $nome;
  }

  public function setDescricao($descricao)
  {
    return $this->descricao = $descricao;
  }

  public function setPreco($preco)
  {
    return $this->preco = $preco;
  }

  public function setImagem($imagem)
  {
    return $this->imagem = $imagem;
  }
}
