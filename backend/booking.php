<?php 

    session_start();
    include "../db/dbConnection.php";
    date_default_timezone_set('Asia/Manila');

    if(isset($_POST['update-date-btn'])){
        $check_in_date = $_POST['check-in'];
        $check_out_date = $_POST['check-out'];
        $adult_count = $_POST['adult-count'];
        $children_count = $_POST['children-count'];

        $_SESSION['check_in_date'] = $check_in_date;
        $_SESSION['check_out_date'] = $check_out_date;
        $_SESSION['adult_count'] = $adult_count;
        $_SESSION['children_count'] = $children_count;

        if(isset($_SERVER['HTTP_REFERER'])) {
            header('Location: ' . $_SERVER['HTTP_REFERER']);
        }
    }

    if(isset($_POST['book_room_btn'])){
        $user_id = $_POST['user-id'];
        $room_id = $_POST['room-id'];
        $check_in_date = $_POST['check-in'];
        $check_out_date = $_POST['check-out'];
        $adult_count = $_POST['adult-count'];
        $children_count = $_POST['children-count'];
        $guest_count = $adult_count + $children_count;
        $total_price = $_POST['total-price'];

        $dateTime1 = new DateTime($check_in_date);
        $dateTime2 = new DateTime($check_out_date);
    
    
        $formattedDate1 = $dateTime1->format('Y-m-d');
        $formattedDate2 = $dateTime2->format('Y-m-d');

        $time = date('H:i:s');
        $currentTime = date('H') . ':00:00';
        echo $time;

        if($time > '14:00:00'){
            $sql = "INSERT INTO booking(room_id, user_id, check_in, check_out, check_in_time, total_price, guest_count) VALUES('$room_id', '$user_id', '$formattedDate1', '$formattedDate2',  '$currentTime', '$total_price', '$guest_count')";
            $query = $conn->query($sql);
            if($query){
                header('Location: ../my-booking.php');
            }   
        }else{
            $sql = "INSERT INTO booking(room_id, user_id, check_in, check_out, total_price, guest_count) VALUES('$room_id', '$user_id', '$formattedDate1', '$formattedDate2', '$total_price', '$guest_count')";
            $query = $conn->query($sql);
            if($query){
                header('Location: ../my-booking.php');
            }   
        }

       
    }
//BEGIN SET NEW.check_in_time = '14:00:00';SET NEW.check_out_time = '12:00:00';END


?>