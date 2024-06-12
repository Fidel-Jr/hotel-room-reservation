<?php 

    include('../db/dbConnection.php');

    if(isset($_POST['add-btn'])){

        $room_name = $_POST['room-name'];
        $description= $_POST['description'];
        $bed_count = $_POST['bed-count'];
        $bathroom_count = $_POST['bathroom-count'];
        $floor_number = $_POST['floor-number'];
        $price = $_POST['price'];
        $adult_capacity = $_POST['adult-capacity'];
        $children_capacity = $_POST['children-capacity'];
        $maximum_capacity = $_POST['maximum-capacity'];
       
        $file_name = $_FILES['image']['name'];
        $temp_name = $_FILES['image']['tmp_name'];
        $folder = "../img/" . $file_name;

        $file_extension = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));
        $allowed_extensions = ['jpg', 'jpeg', 'png', 'gif'];

        if (in_array($file_extension, $allowed_extensions)) {
            if (move_uploaded_file($temp_name, $folder)) {
                $sql = "INSERT INTO room_type(room_type, description, bed, bathroom, floor, price, capacity_adult, capacity_children, max_capacity, image) VALUES('$room_name', '$description', '$bed_count', '$bathroom_count', '$floor_number', '$price','$adult_capacity', '$children_capacity', '$maximum_capacity', '$file_name')";
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