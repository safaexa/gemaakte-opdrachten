<?php


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

if(isset($_GET["toevoegen"])) {
 
     $Merk = $_GET['Merk'];

     $Model = $_GET['Model'];

     $Jaar = $_GET['Jaar'];

     $Kenteken = $_GET['Kenteken'];

     $Beschikbaarheid = $_GET['Beschikbaarheid'];

     $data = [
          'Merk' => $Merk,
          'Model' => $Model,
          'Jaar' => $Jaar,
          'Kenteken' => $Kenteken,
          'Beschikbaarheid' => $Beschikbaarheid
          
     ];

     $stmt = $pdo->prepare('SELECT * FROM autos WHERE Merk = ?');
     $stmt->execute([$Merk]);
     if ($stmt->rowCount() > 0) {
         echo "De Model bestaat al.";
     } else {
         // Voeg de nieuwe gebruiker toe
         $stmt = $pdo->prepare('INSERT INTO autos (Merk, Model, Jaar, Kenteken, Beschikbaarheid ) VALUES (?, ?, ?, ?, ?)');
         if ($stmt->execute([$Merk, $Model, $Jaar, $Kenteken, $Beschikbaarheid])) {
             echo "Auto is toegevoegd.";
         } else {
             echo "Fout bij het toevoegen van de auto.";
         }
     }
 }
       
      $sql = "SELECT autoID, Merk, Model, Jaar, Kenteken, Beschikbaarheid FROM autos";

      $result = $pdo->query($sql);

      if ($result->rowCount() > 0) {

          echo "
          
          <table class='table table-dark'>
      
          <tr>
      
            <th>autoID</th>
      
            <th>Merk</th>

            <th>Model</th>

            <th>Jaar</th>

            <th>Kenteken</th>

            <th>Beschikbaarheid</th>

            <th colspan='2'>action</th>

            </tr>";

            while($row = $result->fetch()) {

               ?>
       
               <tr>
       
                 <td><?php echo $row['autoID']; ?></td>
       
                 <td><?php echo $row['Merk']; ?></td>
       
                 <td><?php echo $row['Model']; ?></td>

                 <td><?php echo $row['Jaar']; ?></td>

                 <td><?php echo $row['Kenteken']; ?></td>
                 
                 <td><?php echo $row['Beschikbaarheid']; ?></td>

                 <td><a class="btn btn-success" href="edit.php?autoID=<?php echo $row['autoID']; ?>">Edit</a></td>

                 <td><a class="btn btn-danger" href="delete.php?ID=<?php echo $row['autoID']; ?>">delete</a></td>

                 <?php 
                 }
   echo "</table>";

    }else{
        echo "0 results";

  }?>

  

   </tr>

   

    </table>



<!DOCTYPE html>
<html lang="en">
<head>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
     <meta charset="UTF-8">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <link rel="stylesheet" href="style/auto.css">
     <title>Document</title>
</head>
<body>



     


<h1>Auto toevoegen</h1> 


<form method="GET" action="">

<input type="text" name="Merk" placeholder="Merk" required> <br>

<input type="text" name="Model" placeholder="Model" required> <br>

<input type="Date" name="Jaar" placeholder="Jaar" required> <br>

<input type="text" name="Kenteken" placeholder="Kenteken" required> <br>

<input type="text" name="Beschikbaarheid" placeholder="Beschikbaarheid" required> <br>

<input type="Submit" name="toevoegen" placeholder="toevoegen" required><br>


</form>
</body>
</html>