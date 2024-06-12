<?php 

    session_start();
    require_once("../db/dbConnection.php");

    if(isset($_POST["register_btn"])){
        $username = $_POST["username"];
        $email = $_POST["email"];
        $password = $_POST["password"];
        $fullname = $_POST["fullname"];

        $sql = "SELECT id FROM user WHERE email='$email'";
        $query = $conn->query($sql);
        $numRows = $query->num_rows;

        if($numRows > 0){
            $_SESSION['reg_sess_err'] = "Email is already exists!";
            header('Location: ../signup.php');
        } else{
            $hash_pass = password_hash($password, PASSWORD_DEFAULT);
            $sql = "INSERT INTO user(username, password, email,fullname) 
            VALUES('$username', '$hash_pass', '$email', '$fullname')";
            $query = $conn->query($sql);
            if($query){
                $_SESSION['reg_sess_succ'] = "<p class='text text-success'>You are registered successfully. Please log in</p>";
                header("Location: ../login.php");
            }
           
        }

        

    }

?>