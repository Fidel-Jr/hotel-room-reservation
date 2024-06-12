<?php 


    include('../db/dbConnection.php');
    $conn->begin_transaction();
    $conn->autocommit(false);
    if(isset($_POST['rate-btn'])){
        
        $booking_id = $_POST['bh_id'];
        $room_id = $_POST['room-id'];
        $rating_value = $_POST['rating-value'];

        $sql = "INSERT INTO rating(booking_history_id, room_type_id, rating) VALUES('$booking_id','$room_id', '$rating_value')";
        $query = $conn->query($sql);
        if($query){

            $sql = "UPDATE booking_history SET rating_status = 'rated' WHERE id = '$booking_id' ";
            $query = $conn->query($sql);
            if($query){
                $sql = "CALL rate('$room_id')";
                $query = $conn->query($sql);
                if($query){
                    $conn->commit();
                    if(isset($_SERVER['HTTP_REFERER'])) {
                        header('Location: ' . $_SERVER['HTTP_REFERER']);
                    }
                } else{
                    $conn->rollback();
                }
                
                
                
            }

        }
        



    }


?>