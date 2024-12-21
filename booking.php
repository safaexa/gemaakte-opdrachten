<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="booking.css">
</head>
<body>
    <div class="background">
        <div class="booking-form">
         <h2>rent a car</h2>  

    <form method="POST" >

    <div class="input-box">
    <input type="text" name="Naam" placeholder="Naam" required>
    </div>
    <div class="input-box">
    <input type="text" name="achternaam" placeholder="achternaam" required> 
    </div>
    <div class="input-box">
    <input type="text" name="telefoonnummer" placeholder="telefoonnummer" required> 
    </div>
    <div class="input-box">
    <input type="email" name="email" placeholder="email" required> 
    </div>
    <div class="input-box">
    <input type="text" name="locatie ophalen/inleveren" placeholder="locatie ophalen/inleveren" required> 
    </div>
    <div class="input-box">
    <input type="date" name="ophalen" placeholder="ophalen" required> 
    </div>
    <div class="input-box">
    <input type="date" name="inleveren" placeholder="inleveren" required> 
    </div>

<input type="submit" class="btn" value="BOEK NU" name="BOEK NU" onclick="printData()">


</form>
</div>

        </div>
    </div>
</body>
</html>