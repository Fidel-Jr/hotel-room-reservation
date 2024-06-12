<?php 

    session_start();
    require_once("../db/dbConnection.php");

    if(isset($_POST['login_btn'])){
        $email = $_POST['email'];
        $password = $_POST['password'];
        $sql = "SELECT * FROM user 
            WHERE email='$email'";
        $query = $conn->query($sql);
        $user = $query->fetch_assoc();
        $user_pass = $user['password'];
        if(password_verify($password, $user_pass)){
            $user_id = $user['id'];
            $sql = "INSERT INTO login_attempts(user_id, success) VALUES('$user_id', 1)";
            $query = $conn->query($sql);
            $_SESSION['email'] = $email;
            $_SESSION['login_success'] = "You successfully login your account!";
            unset($_SESSION['login_error']);
            header('location: ../index.php');
        }else{
            $_SESSION['login_error'] = "Account Does not Exist!";
            unset($_SESSION['login_success']);
            header('location: ../login.php');
        }
    } 

?>