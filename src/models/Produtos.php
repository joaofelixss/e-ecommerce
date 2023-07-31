<?php

namespace Felix\ECommerce\Models;

class Produtos
{
  private $conn;

  // Construtor da classe (recebe a conexão com o banco de dados)
  public function __construct($connection)
  {
    $this->conn = $connection;
  }

  // Método para adicionar um novo produto ao banco de dados
  public function adicionarProduto($nome, $descricao, $preco, $imagem_url)
  {
    $query = "INSERT INTO produtos(nome, descricao, preco, imagem_url) VALUES (:nome, :descricao, :preco, :imagem_url)";
    $stmt = $this->conn->prepare($query);

    $stmt->bindParam(":nome", $nome);
    $stmt->bindParam(":descricao", $descricao);
    $stmt->bindParam(":preco", $preco);
    $stmt->bindParam(":imagem_url", $imagem_url);

    try {
      $stmt->execute();
      // Retornamos o id do último registro inserido
      return $this->conn->lastInsertId();
    } catch (\PDOException $e) {
      echo $e->getMessage();
      return false;
    }
  }

  // Método para atualizar o produto ao banco de dados
  public function atualizarProduto($id, $nome, $descricao, $preco, $imagem)
  {
    $query = "UPDATE produtos SET nome = :nome, descricao = :descricao, preco = :preco, imagem = :imagem WHERE id = :id";
    $stmt = $this->conn->prepare($query);

    $stmt->bindParam(":id", $id);
    $stmt->bindParam(":nome", $nome);
    $stmt->bindParam(":descricao", $descricao);
    $stmt->bindParam(":preco", $preco);
    $stmt->bindParam(":imagem", $imagem);

    try {
      $stmt->execute();
      // Retornamos o id do último registro inserido
      return $this->conn->lastInsertId();
    } catch (\PDOException $e) {
      echo $e->getMessage();
      return false;
    }
  }

  // Método para excluir o produto no banco de dados
  public function excluirProduto($id)
  {
    $query = "DELETE FROM produtos WHERE id = :id";
    $stmt = $this->conn->prepare($query);

    $stmt->bindParam(":id", $id);

    $stmt->execute();
  }

  // Método para listar um produto do banco de dados
  public function listarProduto()
  {
    $query = "SELECT * FROM produtos";
    $stmt = $this->conn->prepare($query);
    $stmt->execute();

    $produtos = [];
    while ($row = $stmt->fetch(\PDO::FETCH_ASSOC)) {
      $produto = new Produto();
      $produto->setId($row['id']);
      $produto->setNome($row['nome']);
      $produto->setDescricao($row['descricao']);
      $produto->setPreco($row['preco']);
      $produto->setImagem($row['imagem_url']);
      $produtos[] = $produto;
    }

    return $produtos;
  }


  // Método para buscar um produto do banco de dados
  public function buscarProduto($id)
  {
    $stmt = $this->conn->prepare("SELECT * FROM produtos WHERE id = :id");
    $stmt->bindParam(":id", $id);
    $stmt->execute();

    $row = $stmt->fetch(\PDO::FETCH_ASSOC);
    if ($row) {
      $produto = new Produto();
      $produto->setId($row['id']);
      $produto->setNome($row['nome']);
      $produto->setDescricao($row['descricao']);
      $produto->setPreco($row['preco']);
      $produto->setImagem($row['imagem_url']);
      return $produto;
    }
    return null;
  }
}
