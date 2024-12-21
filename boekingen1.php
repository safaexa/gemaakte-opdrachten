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

if(isset($_POST["toevoegen"])) {
    $Naam = $_POST['Naam'];
    $achternaam = $_POST['achternaam'];
    $telefoonnummer = $_POST['telefoonnummer'];
    $email = $_POST['email'];
    $locatie = $_POST['locatie '];
    $ophalen = $_POST['ophalen'];
    $inleveren = $_POST['inleveren'];
   


    $data = [
        'Naam' => $Naam,
        'achternaam' => $achternaam,
        'telefoonnummer' => $telefoonnummer,
        'email' => $email,
        'locatie' => $locatie,
        'ophalen' => $ophalen,
        'inleveren' => $inleveren,        

    ];


    $sql = "INSERT INTO boekingen (Naam, achternaam, telefoonnummer, email, locatie ophalen/inleveren, ophalen, inleveren
    ) VALUES (:Naam, :achternaam, :telefoonnummer, :email, :locatie, :ophalen ophalen/inleveren, :inleveren )"; 
    
    $stmt=$pdo->prepare($sql);
    $stmt->execute([
        'Naam' => $Naam,
        'achternaam' => $achternaam,
        'telefoonnummer' => $telefoonnummer,
        'email' => $email,
        'locatie' => $locatie,
        'ophalen' => $ophalen,
        'inleveren' => $inleveren,


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
    <h2>RENT A CAR</h2>
<form method="POST" action="">

<input type="text" name="Naam" placeholder="Naam" required> <br>

<input type="text" name="achternaam" placeholder="achternaam" required> <br>

<input type="text" name="telefoonnummer" placeholder="telefoonnummer" required> <br>

<input type="email" name="email" placeholder="email" required> <br>

<input type="text" name="locatie" placeholder="locatie" required> <br>

<input type="date" name="ophalen" placeholder="ophalen" required> <br>

<input type="date" name="inleveren" placeholder="inleveren" required> <br>

<input type="Submit" name="BOEK NU" placeholder="BOEK NU" required><br>


</form>
</div>
    
</body>
</html>