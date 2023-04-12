<?php

class User {
    public $id;
    public $email;
    public $name;
    public $score;

    public function __construct($id = null, $email=null, $name=null, $score=null) {
        $this->id = $id;
        $this->email = $email;
        $this->name = $name;
        $this->score = $score;
    }

    public static function loginUser($usr, mysqli $conn) {
        $query = "SELECT * FROM korisnik WHERE email='$usr->email'";
        // echo $conn->query($query);
        $rez = $conn->query($query);
        return $rez;
    }

    public static function loginNewUser($usr, mysqli $conn) {
        // $newid = User::maxId($conn) + 1;
        $query = "INSERT INTO korisnik (email, name, score) VALUES ('$usr->email', '$usr->name', 0)";
        $rez = $conn->query($query);
    }

    // public static function maxId(mysqli $conn) {
    //     $query = "SELECT MAX(id) as maxid FROM korisnik";
    //     $rez = $conn->query($query);
    //     // return mysqli_fetch_assoc($rez)['maxid'];
    //     return $rez->fetch_assoc()['maxid'];
    // }

    // public static function returnUser($usrid, mysqli $conn) {
    //     $query = "SELECT * FROM korisnik WHERE id = '$usrid'";
    //     $rez = $conn->query($query);
    //     // return mysqli_fetch_assoc($rez)['maxid'];
    //     return $rez->fetch_assoc();
    // }

    public static function returnEmail($id, mysqli $conn) {
        $query = "SELECT email as ml FROM korisnik WHERE id = '$id'";
        $rez = $conn->query($query);
        // return mysqli_fetch_assoc($rez)['maxid'];
        return $rez->fetch_assoc()['ml'];
    }
    
    public static function returnName($id, mysqli $conn) {
        $query = "SELECT name as nm FROM korisnik WHERE id = '$id'";
        $rez = $conn->query($query);
        // return mysqli_fetch_assoc($rez)['maxid'];
        return $rez->fetch_assoc()['nm'];
    }

    public static function returnScore($id, mysqli $conn) {
        $query = "SELECT score as scr FROM korisnik WHERE id = '$id'";
        $rez = $conn->query($query);
        // return mysqli_fetch_assoc($rez)['maxid'];
        return $rez->fetch_assoc()['scr'];
    }

    public static function writeScore($id, mysqli $conn, $score) {
        $lastScore = User::returnScore($id, $conn);
        echo "novi:"; echo $score;
        echo " ";
        echo "stari:"; echo $lastScore;
        // exit();
        if ($score > $lastScore) {
            $query = "UPDATE korisnik SET score='$score' WHERE id='$id'";
            $rez = $conn->query($query);
            return;
        }
    }
    
    public static function maxScore(mysqli $conn) {
        $query = "SELECT MAX(score) as maxscr FROM korisnik";
        $rez = $conn->query($query);
        return $rez->fetch_assoc()['maxscr'];
    }

    public static function maxUser(mysqli $conn) {
        $maxscore = User::maxScore($conn);
        $query = "SELECT * FROM korisnik WHERE score='$maxscore'";
        $rez = $conn->query($query);
        return $rez->fetch_assoc();
    }


    public static function getAll(mysqli $conn) {
        $query = "SELECT * FROM korisnik ORDER BY score DESC";

        $rez = $conn->query($query);
        return $rez;
    }


    // public static function deleteUser(mysqli $conn){
    //     $query = "DELETE FROM korisnik WHERE email='igorilic962000@gmail.com'";
    //     $rez = $conn->query($query);
    //     return $rez;
    // }

}

?>