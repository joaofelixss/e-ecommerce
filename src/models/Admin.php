<?php

namespace Felix\ECommerce\Models;

class Admin
{
  private $conn;

  public function __construct($connection)
  {
    $this->conn = $connection;
  }

  public function insertAdmin($username, $password)
  {
    $passwordHash = password_hash($password, PASSWORD_DEFAULT);

    $query = "INSERT INTO admins (username, password) VALUES (:username, :password)";
    $stmt = $this->conn->prepare($query);

    $stmt->bindParam(":username", $username);
    $stmt->bindParam(":password", $passwordHash);

    try {
      $stmt->execute();
      return true;
    } catch (\PDOException $e) {
      echo $e->getMessage();
      return false;
    }
  }

  public function findAdmin($username, $password)
  {
    $query = "SELECT * FROM admins WHERE username = :username";
    $stmt = $this->conn->prepare($query);

    $stmt->bindParam(":username", $username);

    try {
      $stmt->execute();
      $user = $stmt->fetch();

      if ($user && password_verify($password, $user['password'])) {
        return true;
      } else {
        return false;
      }
    } catch (\PDOException $e) {
      echo $e->getMessage();
      return false;
    }
  }
}
