<?php

    require_once("./db/dbConnection.php");
    include './classes/user.php';
    session_start();

    if(!isset($_SESSION["email"])){
        
    }else{
        $user = new User();
        $email = $_SESSION["email"];
        $sql = "SELECT * FROM user WHERE email='$email' ";
        $query = $conn->query($sql);
        while($row = $query->fetch_assoc() ){
            $user->id = $row["id"];
            $user->email = $row["email"];
            $user->username = $row["username"];
            $user->password = $row["password"];
            $user->fullname = $row["fullname"];
            $user->gender = $row["gender"];
            $user->phone_number = $row["phone_number"];
            $user->address = $row["address"];
            $user->dob = $row["dob"];
        }
    }

?>