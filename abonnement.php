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

if(isset($_POST["SEND"])) {
    $Naam = $_POST['Naam'];
    $achternaam = $_POST['achternaam'];
    $telefoonnummer = $_POST['telefoonnummer'];
    $email = $_POST['email'];
    $woonplaats = $_POST['woonplaats'];
   


    $data = [
        'Naam' => $Naam,
        'achternaam' => $achternaam,
        'telefoonnummer' => $telefoonnummer,
        'email' => $email,
        'woonplaats' => $woonplaats,        

    ];


    $sql = "INSERT INTO abonnementen (Naam, achternaam, telefoonnummer, email, woonplaats
    ) VALUES (:Naam, :achternaam, :telefoonnummer, :email, :woonplaats )"; 
    
    $stmt=$pdo->prepare($sql);
    $stmt->execute([
        'Naam' => $Naam,
        'achternaam' => $achternaam,
        'telefoonnummer' => $telefoonnummer,
        'email' => $email,
        'woonplaats' => $woonplaats,

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
  <link rel="stylesheet" href="booking.css">
<body>
    

<div class="booking-form">
    <h2>Maak een abonnement</h2>
<form method="POST" action="">

<input type="text" name="Naam" placeholder="Naam" required> <br>

<input type="text" name="achternaam" placeholder="achternaam" required> <br>

<input type="text" name="telefoonnummer" placeholder="telefoonnummer" required> <br>

<input type="email" name="email" placeholder="email" required> <br>

<input type="text" name="woonplaats" placeholder="woonplaats" required> <br>

<input type="Submit" name="SEND" placeholder="SEND" required><br>


</form>
</div>
    
</body>
</html>