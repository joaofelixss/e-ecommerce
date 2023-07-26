<?php

namespace Felix\ECommerce\Config;

class Connection
{
  private $host = 'localhost';
  private $dbname = 'e-commerce';
  private  $user = 'root';
  private  $pass = '';
  public $conn;

  public function getConnection()
  {

    $this->conn = null;

    try {
      $this->conn = new \PDO("mysql:host=" . $this->host . ";dbname=" . $this->dbname, $this->user, $this->pass);
      $this->conn->exec("set names utf8");
    } catch (\PDOException $e) {
      echo "Erro na conexão: " . $e->getMessage();
    }

    return $this->conn;
  }
}
