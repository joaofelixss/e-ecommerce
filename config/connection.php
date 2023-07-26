<?php

class Connection
{
  private $host = 'localhost';
  private $db = 'e-commerce';
  private $user = 'root';
  private  $pass = '';
  private  $conn;

  public function getConnection()
  {

    $this->conn = null;

    try {
      $this->conn = new PDO("Mysql:host=" . $this->host . ";db=" . $this->db, $this->user, $this->pass);
      $this->conn->exec("set names utf8");
    } catch (PDOException $e) {
      echo "Error na conexão:" . $e->getMessage();
    }

    return $this->conn;
  }
}
