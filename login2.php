<?php
    //STRANICA KADA SE NE UNESE ODGOVARAJUCI IG/NAME ZA POSTOJECI EMAIL

    require "dbBroker.php";
    require "model/user.php";

    session_start();

    if (!isset($_SESSION['pogresan_name'])){
        header("Location: login.php");
        exit();
    }

    if (isset($_SESSION['pogresan_email'])) {
        $mejl = $_SESSION['pogresan_email'];
    }

    if (isset($_SESSION['pogresan_email']) && isset($_POST["submit"]) && $_POST["submit"]=="again") {

        header('Location: login.php');
        exit();
    } 

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AIBG Promo Game</title>

    <link rel="shortcut icon" href="img/favicon.png" type="image/x-icon">
    <link rel="stylesheet" href="css/style.css">
    <!-- <link rel="stylesheet" href="css/button.css"> -->
    <!-- <link rel="stylesheet" href="css/drugi.css"> -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
</head>
<body>

    <div class="header">
        <img src="img/logo-white.png" alt="AIBG Logo" class="logo">
    </div>

    
    <img src="img/pozadina.png" alt="" class="background">

    <div class="login-form">
        <form method="POST" action="#">

            <div class="container">
                <!-- <label for="email" class="lbl">Email</label>
                <input type="email" name="email" id="email" class="inpt" required> -->
                
                <p class="tekst">
                    Uneli ste pogrešan Instagram za email: <i style="color:white;"><?php echo $mejl; ?></i><br>
                    <br>
                    Ako imate neki proble u vezi prijave, obratite se na email <i style="color:white;">aibg.it@best.rs</i>
                </p>
                <br>
                <button type="submit" name="submit" value="again" class="btn btn-again">Pokušajte opet</button>
            </div>

        </form>
    </div>
    
</body>
</html>