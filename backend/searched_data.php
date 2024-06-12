<?php 

    session_start();
    include('../db/dbConnection.php');



    if(isset($_POST['searchBtn'])){

        $check_in = $_POST['check-in'];
        $check_out = $_POST['check-out'];
        $adult_count = $_POST['adult-count'];
        $children_count = $_POST['children-count'];

        $dateTime1 = new DateTime($check_in);
        $dateTime2 = new DateTime($check_out);
    
        $formattedDate1 = $dateTime1->format('Y-m-d');
        $formattedDate2 = $dateTime2->format('Y-m-d');

       
        $_SESSION['check_in_date'] = $check_in;
        $_SESSION['check_out_date'] = $check_out;
        
        if($formattedDate1 >= $formattedDate2){
            $_SESSION['date_error'] = TRUE;
            header('Location: ../index.php');
        }
        elseif($adult_count == 0 && $children_count == 0){
            $_SESSION['count_error'] = TRUE;
            $_SESSION['adult_count'] = 0;
            $_SESSION['children_count'] = 0; 
            unset($_SESSION['adult_count']); 
            unset($_SESSION['children_count']);
            header('Location: ../index.php');
        }else{
            $_SESSION['adult_count'] = $adult_count;
            $_SESSION['children_count'] = $children_count;
            header('Location: ../room.php');
        }
        
        


        
    }

?>