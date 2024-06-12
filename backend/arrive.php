<?php 

    date_default_timezone_set('Asia/Manila');
    require_once('../db/dbConnection.php');

    if(isset($_GET['id'])){

        $booking_id = $_GET['id'];

        $sql = "UPDATE booking SET payment_status = 'Completed', booking_status = 'Confirmed' WHERE id = '$booking_id'";
        $query = $conn->query($sql);
        if($query){
            if(isset($_SERVER['HTTP_REFERER'])) {
                // $_SESSION['update-error'] = "Room cannot be change.";
                header('Location: ' . $_SERVER['HTTP_REFERER']);
            }
        }

    }

?>