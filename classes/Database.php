<?php

class Database
{
  private $DB_HOST = "localhost:4306";
  private $DB_USER = "root";
  private $DB_PASS = "";
  private $DB_NAME = "visitor_management";
  public $conn;


  public function db_connect()
  {
    $this->conn = null;
    try {

      $this->conn = new PDO("mysql:host=$this->DB_HOST;dbname=$this->DB_NAME", $this->DB_USER, $this->DB_PASS);
      $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
      echo "Connection failed: " . $e->getMessage();
    }

    return $this->conn;
  }


  public function insert_data($query, $data = [])
  {
    $pdo = $this->db_connect();
    $stmt = $pdo->prepare($query);

    if (count($data) == 0) {
      $stmt = $pdo->query($query);
      $check = 0;
      if ($stmt) {
        $check  = 1;
      }
    } else {
      $check = $stmt->execute($data);
    }

    if ($check) {
      return true;
    } else {
      return false;
    }
  }

  public function fetch_data($query, $data = [])
  {
    $pdo = $this->db_connect();
    $stmt = $pdo->prepare($query);

    if (count($data) == 0) {
      $stmt = $pdo->query($query);
      $check = 0;
      if ($stmt) {
        $check  = 1;
      }
    } else {
      $check = $stmt->execute($data);
    }

    if ($check) {
      $data = $stmt->fetchAll();
      if (is_array($data) && count($data) > 0) {
        return $data;
      }

      return false;
    } else {
      return false;
    }
  }


  public function check($query, $data = [])
  {
    $pdo = $this->db_connect();
    $stmt = $pdo->prepare($query);


    if (!empty($data)) {
      $stmt->execute($data);
    }

    if ($stmt->rowCount() > 0) {
      return true;
    } else {
      return false;
    }
  }
}
