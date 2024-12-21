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
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);


    $data = [
        'username' => $username,
        'password' => $password,
    ];


    $sql = "INSERT INTO adminlogin (username, password
    ) VALUES (:username, :password )"; 
    
    $stmt=$pdo->prepare($sql);
    $stmt->execute([
        'username' => $username,
        'password' => $password,
    ]);

    if ($stmt->rowCount() > 0) {
        header("Location:choose.php?success");
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
<form method="POST">
    <h1>Login Admin</h1>


<div class="input-box">
<input type="text" name="username" placeholder="username" required> <br>
</div>

    
<div class="input-box">
<input type="password" name="password" placeholder="password" required> <br>
</div>


<div class="remember-forget">
    <label><input type="checkbox"> Remember me </label>
<a href="#"> Wachtwoord vergeten?</a>
</div>

<input type="submit" class="btn" value="Login" name="submit" onclick="printData()">


     


</form>
</div>

</body>
</html>