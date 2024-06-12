<?php 

    require_once('../db/dbConnection.php');

    if(isset($_POST['add-btn'])){

        $room_type_id = $_POST['room-type-id'];
        $image = $_POST['image'];

        $file_name = $_FILES['image']['name'];
        $temp_name = $_FILES['image']['tmp_name'];
        $folder = "../img/" . $file_name;

        $file_extension = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));
        $allowed_extensions = ['jpg', 'jpeg', 'png', 'gif'];

        if (in_array($file_extension, $allowed_extensions)) {
            if (move_uploaded_file($temp_name, $folder)) {
                $sql = "INSERT INTO room_images(room_type_id, image) VALUES('$room_type_id', '$file_name')";
                $query = $conn->query($sql);
                if($query){
                    if(isset($_SERVER['HTTP_REFERER'])) {
                        header('Location: ' . $_SERVER['HTTP_REFERER']);
                    } 
                   
                }
            }
        
        }

    }


?>