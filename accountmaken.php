<?php
//database connecten

$host = 'localhost:3308';
$db   = 'autoverhuur';
$user = 'root';
$pass = '';
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];
try 
{
     $pdo = new PDO($dsn, $user, $pass, $options);
    
} 
catch (\PDOException $e) 
{
     throw new \PDOException($e->getMessage(), (int)$e->getCode());
}
// tot hier

?>

<?php

if(isset($_POST["submit"])) {
    $Naam = $_POST['Naam'];
    $Password = password_hash($_POST['Password'], PASSWORD_BCRYPT);
    
    


    $data = [
        'Naam' => $Naam,
        'Password' => $Password,
      

    ];


    $sql = "INSERT INTO accountmaken (Naam, Password) 
    VALUES (:Naam, :Password)"; 
    
    $stmt=$pdo->prepare($sql);
    $stmt->execute([
        'Naam' => $Naam,
        'Password' => $Password,
        

    ]);

    if ($stmt->rowCount() > 0) {
        header("Location:home2.php?success");
    }

  }


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="rentcar.css">
    
</head>
<body>

<div class="wrapper">
<form method="POST" >
    <h1>maak-account aan</h1>

    <div class="input-box">
    <input type="text" name="Naam" placeholder="Naam" required>
    </div>

    <div class="input-box">
    <input type="password" name="Password" placeholder="Password" required> 
    </div>

    <div class="input-box">
<input type="password" name="herhaal_wachtwoord" placeholder="herhaal_wachtwoord" required> 
    </div>

<input type="submit" class="btn" value="submit" name="submit" onclick="printData()">


</form>
</div>


</body>
</html>