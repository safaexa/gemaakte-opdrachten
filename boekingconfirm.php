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

//

 // Assuming your database connection is in db1.php
                            

if (isset($_GET["success"])) {
    // Display success message or any other information you want to show after successful booking
    echo 
    // Display booking information
    $sql = "SELECT * FROM boekingen ORDER BY KlantID DESC LIMIT 1";
    $stmt = $pdo->query($sql);

    if ($stmt) {
        $booking = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($booking) { // Check if $booking is not null
?>
            <!DOCTYPE html>
            <html lang="en">
            <head>
                <meta charset="UTF-8">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <title>Booking Confirmation</title>
                <link rel="stylesheet" href="bookingconfirm.css">
            </head>
            <body>
              <div>
              <p><a href="home.php">Logout</a></p>
              </div>
                <div class="booking-details">
                    <h2>Booking Confirmation</h2>
                    <p><strong>Name:</strong> <?php echo $booking['Naam'] . ' ' . $booking['achternaam']; ?></p>
                    <p><strong>Phone Number:</strong> <?php echo $booking['telefoonnummer']; ?></p>
                    <p><strong>Email:</strong> <?php echo $booking['email']; ?></p>
                    <p><strong>Location:</strong> <?php echo $booking['locatie']; ?></p>
                    <p><strong>Pickup Date:</strong> <?php echo $booking['ophalen']; ?></p>
                    <p><strong>Return Date:</strong> <?php echo $booking['inleveren']; ?></p>
                    <!-- Add more details as needed -->

                    <!-- You can also provide a link to go back to the booking page or any other page -->
                    <p><a href="boekingen1.php">Go back to booking page</a></p>
                </div>
            </body>
            </html>
<?php

        } else {
            echo "No booking data found.";
        }
    } else {
        echo "Error fetching booking data.";
    }
}
?>
