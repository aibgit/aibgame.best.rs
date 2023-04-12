<?php

require "../dbBroker.php";
require "user.php";


session_start();

if (isset($_POST['skor']) && isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
    $user_score = $_POST['skor'];

    User::writeScore($user_id, $conn, $user_score);
    
}
 


?>