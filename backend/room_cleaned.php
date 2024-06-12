<?php 
    include('../db/dbConnection.php');
        

    if(isset($_GET['id'])){

        $booking_id = $_GET['id'];
        $sql = "SELECT * FROM booking WHERE id = '$booking_id'";
        $query = $conn->query($sql);
        $row = $query->fetch_assoc();

        $conn->begin_transaction();
        $conn->autocommit(false);

        $room_id = $row['room_id'];
        $user_id = $row['user_id'];
        $check_in = $row['check_in'];
        $check_out = $row['check_out'];
        $check_in_time = $row['check_in_time'];
        $check_out_time = $row['check_out_time'];
        $booking_date = $row['booking_date'];
        $total_price = $row['total_price'];
        $guest_count = $row['guest_count'];


        $sql = "INSERT INTO booking_history(room_id,user_id,check_in,check_out,check_in_time,check_out_time,booking_date,total_price,guest_count) 
                VALUES('$room_id', '$user_id', '$check_in', '$check_out', '$check_in_time', '$check_out_time', '$booking_date', '$total_price', '$guest_count')";
        $query = $conn->query($sql);
        if($query){
            $sql = "DELETE FROM booking WHERE id = '$booking_id' ";
            $query = $conn->query($sql);
            $conn->commit();
            if(isset($_SERVER['HTTP_REFERER'])) {
                header('Location: ' . $_SERVER['HTTP_REFERER']);
            }
        } else{
            $conn->rollback();
        }
    }

?>