

<?php
    
require "dbBroker.php";
require "model/user.php";

// $odg = User::deleteUser($conn);

$rezultat = User::getAll($conn);
if (!$rezultat) {
   echo "Greska" ;
   die();
}
if ($rezultat->num_rows == 0) {
    echo "Nema rezultata";
    die();
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
    <link rel="stylesheet" href="css/board.css">
    <!-- <link rel="stylesheet" href="css/button.css"> -->
    <!-- <link rel="stylesheet" href="css/drugi.css"> -->
    <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script> -->
</head>
<body>

    <div class="header">
        <!-- <img src="img/logo-white.png" alt="AIBG Logo" class="logo"> -->
    </div>

    <!-- <img src="img/pozadina.png" alt="" class="background"> -->

    <div class="proba">

        <h2 style="color:#33bca5; text-align:center;">S C O R E B O A R D</h2>

        <table class="tabela">
            <thead>
                <tr>
                    <th class="tbl-rang">Rang</th>
                    <th class="tbl-name">Email</th>
                    <th class="tbl-name">Name</th>
                    <th class="tbl-score">Score</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $i = 0;
                while (($red = $rezultat->fetch_array())) {
                    $i++;
                ?>
                    <tr>
                        <td class="tbl-rang"><?php echo $i ?></td>
                        <td class="tbl-name"><?php echo $red['email'] ?></td>
                        <td class="tbl-name"><?php echo $red['name'] ?></td>
                        <td class="tbl-score"><?php echo $red['score'] ?></td>
                    </tr>
                <?php    
                }
                ?>
            </tbody>
        </table>
    </div>
    



</body>
</html>