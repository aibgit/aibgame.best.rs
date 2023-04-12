<?php

require "dbBroker.php";
require "model/user.php";


session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

if (isset($_SESSION['user_id']) && isset($_POST["submit"]) && $_POST["submit"]=="logout") {
    echo "Uspesna odjava";

    session_destroy();
    header('Location: login.php');
    exit();
} 

$user_id = $_SESSION['user_id'];

$user_name = User::returnName($user_id, $conn);
$user_score = User::returnScore($user_id, $conn);


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
    <!-- <link rel="stylesheet" href="css/treci.css"> -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
</head>
<body>

    <!-- header -->
    <div class="header">
        <img src="img/logo-white.png" alt="AIBG Logo" class="logo">
        
        <div class="score hide" data-score>0</div>
    </div>

    <!-- igrica -->
    <div class="world" data-world>
        
        <img src="img/pozadina.png" alt="" class="background" >
            
        <!-- <img src="img/planina-1.png" alt="" class="stone"> -->
        <img src="img/staza.png" alt="" class="ground" data-ground>
        <img src="img/staza.png" alt="" class="ground" data-ground>
        <img src="img/vuk-0.png" alt="" class="vuk" data-vuk>
        <!-- <img src="img/vuk-0.svg" alt="" class="vuk" data-vuk> -->

    </div>

    <!-- start container -->
    <div class="container" data-start>
        <p class="tekst">
            Zdravo <i style="color:white;"><?php echo $user_name; ?></i>! <br>
            Tvoj najbolji rezultat je <b><?php echo $user_score?></b>!
        </p>
        <button class="btn btn-start" data-start-btn>Start</button>

        <form method="POST" action="#">
            <button type="submit" name="submit" value="logout" class="btn btn-logout">Odjavi se</button>
        </form>
    </div>

    <!-- restart i logout container -->
    <div class="container hide" data-restart>
        <p class="rezultat">Tvoj rezultat je: <b data-rezultat></b></p>

        <button class="btn btn-restart" data-restart-btn>Restart</button>
        
        <form method="POST" action="#">
            <button type="submit" name="submit" value="logout" class="btn btn-logout">Odjavi se</button>
        </form>

        <div class="saznajvise">
            <p style="font-size: 15px;">Saznaj više</p> 
            <div class="vise">
            <a href="https://aibg.best.rs/" target="_blank"><button class="btn-small">O AIBG-u</button></a>
            <a href="https://best.rs/" target="_blank"><button class="btn-small">O BEST-u</button></a>
            </div>
        </div>

        <a href="/scoreboard.php" target="_blank"><button class="btn" style="margin-top:20px;">Scoreboard</button></a>
    </div>


    <script src="js/script.js" type="module"></script>
    
</body>
</html>