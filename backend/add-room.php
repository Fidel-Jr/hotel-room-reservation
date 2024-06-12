<?php 

    include('../db/dbConnection.php');

    if(isset($_POST['add-btn'])){

        $room_type_id = $_POST['room-type-id'];
        $room = $_POST['room'];

        $sql = "INSERT INTO room(room_type, room_number, availability) VALUES('$room_type_id', '$room', 'Available')";
        $query = $conn->query($sql);
        
        if($query){
            if(isset($_SERVER['HTTP_REFERER'])) {
                header('Location: ' . $_SERVER['HTTP_REFERER']);
            } 
        }

    }


?>