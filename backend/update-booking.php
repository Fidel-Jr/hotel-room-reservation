<?php 

    date_default_timezone_set('Asia/Manila');
    require_once('../db/dbConnection.php');
    session_start();

    if(isset($_POST['update-btn'])){

        $room_number = $_POST['room-number'];
        $room_type = $_POST['room-type-id'];
        $id = $_GET['id'];
        $user_id = $_POST['user-id'];
        $date = new Datetime();
        $currentDate = $date->format('Y-m-d');

        $sql = "SELECT check_in FROM booking WHERE id = '$id' ";
        $query = $conn->query($sql);
        $row = $query->fetch_assoc();
        if($row['check_in'] == $currentDate){

            if(isset($_SERVER['HTTP_REFERER'])) {
                $_SESSION['update-error'] = "Room cannot be change.";
                header('Location: ' . $_SERVER['HTTP_REFERER']);
            }

        } else{
            $sql = "UPDATE booking SET room_id = (SELECT id FROM room WHERE room_type = '$room_type' AND room_number = '$room_number') WHERE id = '$id' AND user_id = '$user_id'";
            $query = $conn->query($sql);
            if($query){
                if(isset($_SERVER['HTTP_REFERER'])) {
                    $_SESSION['update-success'] = "Room successfully changed.";
                    header('Location: ' . $_SERVER['HTTP_REFERER']);
                }
            }
        }

        

    }   
    
    

?>