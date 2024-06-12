<?php 

    include('../db/dbConnection.php');
    

    if(isset($_GET['id'])){

        $booking_id = $_GET['id'];
        
        $sql = "UPDATE booking SET booking_status = 'Cleaning' WHERE id = '$booking_id' ";
        $query = $conn->query($sql);
        if($query){
           
            if(isset($_SERVER['HTTP_REFERER'])) {
                header('Location: ' . $_SERVER['HTTP_REFERER']);
            }
        } 
        
    }

?>