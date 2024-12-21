<?php
   
   
   class Database {
       public $pdo;

public function __construct($db = "autoverhuur", $user = "root", $pwd = "", $host = "localhost:3308")
{
    try {
        $this->pdo = new PDO("mysql:host=$host;dbname=$db", $user, $pwd);
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      
    } catch (PDOException $e) {
        die("Connection failed: " . $e->getMessage());
    }
}


public function upload($name, $price, $file) {
    $stmt = $this->pdo->prepare("INSERT INTO auto (name, price, image) VALUES (?, ?, ?)");
    $stmt->execute([$name, $price, $file]);
}

public function Car(){
    $stmt = $this->pdo->prepare("SELECT * FROM auto");
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

       
   }
    ?>