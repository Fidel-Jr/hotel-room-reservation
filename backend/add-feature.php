<?php 

    include('../db/dbConnection.php');

    if(isset($_POST['add-btn'])){

        $room_type_id = $_POST['room-type-id'];
        $feature = $_POST['feature'];
        $count = $_POST['count'];

        if($count > 0){
            $sql = "INSERT INTO room_feature(feature_id, room_type_id, count) VALUES('$feature', '$room_type_id', '$count')";
            $query = $conn->query($sql);
            if($query){
                if(isset($_SERVER['HTTP_REFERER'])) {
                    header('Location: ' . $_SERVER['HTTP_REFERER']);
                } 
            }
        } else{
            $_SESSION['count_error'] = TRUE;
            // if(isset($_SERVER['HTTP_REFERER'])) {
            //     header('Location: ' . $_SERVER['HTTP_REFERER']);
            // } 
            echo "NO";
        }

       
        
        

    }


?>