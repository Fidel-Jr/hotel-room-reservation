<?php 

    date_default_timezone_set('Asia/Manila');
    require_once("../db/dbConnection.php");
    session_start();

    if(isset($_GET['admin-id'])){
        $booking_id = $_GET['admin-id'];
        $sql = "DELETE FROM booking WHERE id = '$booking_id' ";
            $query = $conn->query($sql);
            if($query){
                if(isset($_SERVER['HTTP_REFERER'])) {
                    header('Location: ' . $_SERVER['HTTP_REFERER']);
                }
            }

    }

    if(isset($_GET['id'])){

        $booking_id = $_GET['id'];

        $sql = "SELECT check_in FROM booking WHERE id = '$booking_id' ";
        $query = $conn->query($sql);
        $row = $query->fetch_assoc();
        $date = new Datetime();
        $currentDate = $date->format('Y-m-d');
        $currentTime = $date->format('h:i:s');
       
       
        if($row['check_in'] == $currentDate){
            $sql = "UPDATE booking SET booking_status = 'Canceled' WHERE id = '$booking_id' ";
            $query = $conn->query($sql);
            if($query){
                if(isset($_SERVER['HTTP_REFERER'])) {
                    header('Location: ' . $_SERVER['HTTP_REFERER']);
                }
            }
        }else{
            $sql = "DELETE FROM booking WHERE id = '$booking_id' ";
            $query = $conn->query($sql);
            if($query){
                if(isset($_SERVER['HTTP_REFERER'])) {
                    header('Location: ' . $_SERVER['HTTP_REFERER']);
                }
            }
        }
           
            

    }


?>