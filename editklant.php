<?php
$tekst = '<h1 style="color: black;">User Aanpassen</h1>';
echo $tekst;

require('database.php');
echo $_GET['inlogid'];

if (isset($_GET['inlogid'])) {
    $id = $_GET['inlogid'];

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $user = $_POST["username"];
        $pass = $_POST["password"];
        $hashedPassword = password_hash($pass, PASSWORD_DEFAULT);

        $query = "UPDATE klantlogin SET username = :username, password = :password WHERE inlogid = :inlogid";

        $stmt = $pdo->prepare($query);

        $stmt->execute([
            'username' => $user,
            'password' => $hashedPassword,
            'inlogid' => $id
        ]);

        if ($stmt->rowCount() > 0) {
            header("Location:update.php?success");
        } else {
            echo "User update failed.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
          rel="stylesheet"
          integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN"
          crossorigin="anonymous">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>user aanpassen</title>
</head>

<body>
<form method="POST" action="">
    <div class="form-group mb-2">
        <input type="text" name="username" placeholder="username" required> <br>
        <input type="password" name="password" placeholder="password" required> <br>
        <div class="toevoegen">
            <input type="submit" class="btn btn-info" name="toevoegen" placeholder="toevoegen" required><br>
        </div>
    </div>
</form>
</body>
</html>
