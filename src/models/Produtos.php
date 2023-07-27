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
  public function adicionarProduto($nome, $descricao, $preco, $imagem)
  {
    $query = "INSERT INTO produtos(nome, descricao, preco, imagem) VALUES (:nome, :descricao, :preco, :imagem)";
    $stmt = $this->conn->prepare($query);

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

    return $stmt->fetchAll(); // Retorna um array com todos os produtos encontrados no banco de dados.
  }

  // Método para buscar um produto do banco de dados
  public function buscarProduto($id)
  {
    $query = "SELECT * FROM produtos WHERE id = :id";
    $stmt = $this->conn->prepare($query);
    $stmt->bindParam(":id", $id);
    $stmt->execute();

    return $stmt->fetch(); // Retorna o produto encontrado.
  }
}
