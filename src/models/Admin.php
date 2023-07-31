<?php

namespace Felix\ECommerce\Models;

class Admin
{
  private $conn;

  public function __construct($connection)
  {
    $this->conn = $connection;
  }

  public function findAdmin($username, $password)
  {
    $stmt = $this->conn->prepare("SELECT * FROM admins WHERE username = :username AND password = :password");
    $stmt->bindParam(":username", $username);
    $stmt->bindParam(":password", $password);
    $stmt->execute();

    $row = $stmt->fetch(\PDO::FETCH_ASSOC);
    if ($row) {
      return true;
    }
    return false;
  }
}
