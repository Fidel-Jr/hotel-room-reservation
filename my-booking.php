<?php

    // session_start();
    
    include('./sessions/sessionCheck.php');
    include('./db/dbConnection.php');

    if(!isset($_SESSION['email'])){
        header('Location: index.php');
    }

    $user_id = $user->id;

    $sql = "SELECT booking.*, booking.id AS booking_id, room.id, room.room_number, room_type.room_type FROM booking INNER JOIN room ON booking.room_id = room.id INNER JOIN room_type ON room_type.id = room.room_type HAVING booking.user_id = '$user_id' AND (booking_status = 'Pending' OR booking_status = 'Confirmed') ORDER BY booking.booking_date DESC LIMIT 10";

    $query = $conn->query($sql);

    
   
    
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Hotelier - Hotel HTML Template</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Heebo:wght@400;500;600;700&family=Montserrat:wght@400;500;600;700&display=swap" rel="stylesheet">  

    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="lib/animate/animate.min.css" rel="stylesheet">
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css" rel="stylesheet" />

    <!-- Customized Bootstrap Stylesheet -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="css/style.css" rel="stylesheet">
    <!-- <link rel="stylesheet" type="text/css" href="css/datepicker.css"/> -->
    <!-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> -->

</head>

<style>
    table td{
        padding: 30px !important;
    }
</style>

<body>
        <?php 
            
            include('header.php');

        ?>


        <!-- Page Header Start -->
        <div class="container-fluid page-header mb-5 p-0" style="background-image: url(img/carousel-1.jpg);">
            <div class="container-fluid page-header-inner py-5">
                <div class="container text-center pb-5">
                    <h1 class="display-3 text-white mb-3 animated slideInDown">History</h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb justify-content-center text-uppercase">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item"><a href="#">Pages</a></li>
                            <li class="breadcrumb-item text-white active" aria-current="page">History</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
        <!-- Page Header End -->


        <!-- Booking Start -->
        <?php
        
            include('search.php');
        
        ?>
        
        <div class="container-xxl py-5 mb-5">
            <div class="container table-responsive">
                <?php 

                    if(isset($_SESSION['update-error'])){
                        echo "<p class='text-danger'>" . $_SESSION['update-error'] ."</p>";
                        unset($_SESSION['update-error']);
                    }
                    if($query->num_rows < 1){
                ?>
                <div class="d-flex justify-content-center">
                    <a href="all-rooms.php" class="btn btn-primary" style="text-align: center;">Book Now</a>
                </div>
                <?php
                    }else{
                ?>
                    <table class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>Room</th>
                                <th>Room Number</th>
                                <th>Check In</th>
                                <th>Check Out</th>
                                <th>Check In Time</th>
                                <th>Total Price</th>
                                <th>Payment Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php

                                while($row = $query->fetch_assoc()){
                                ?>
                                    <tr>
                                        <td><?php echo $row['room_type'] ?></td>
                                        <td style="width: 50px;"><?php echo $row['room_number'] ?></td>
                                        <td><?php echo $row['check_in'] ?></td>
                                        <td><?php echo $row['check_out'] ?></td>
                                        <td><?php echo $row['check_in_time'] ?></td>
                                        <td><?php echo $row['total_price'] ?></td>
                                        <td><?php echo $row['payment_status'] ?></td>
                                        <?php 
                                        
                                            if($row['booking_status']  == 'Confirmed'){
                                            
                                        ?>
                                                <td>
                                                    <?php echo $row['booking_status']; ?>
                                                </td>
                                        <?php
                                            }else{


                                        ?>
                                                <td>
                                                    <div class="d-flex gap-2">
                                                        <a href="edit-booking.php?id=<?php echo $row['booking_id']; ?>" class="btn btn-success btn-sm text-white">Change</a>
                                                        <a href="./backend/cancel-booking.php?id=<?php echo $row['booking_id']; ?>" class="btn btn-danger btn-sm text-white">Cancel</a>
                                                    </div>
                                                    
                                                </td>
                                        <?php
                                            }
                                        
                                        ?>
                                        
                                    </tr>
                                <?php     
                                }
                            
                            ?>
                            
                        </tbody>
                    </table>
                <?php
                    }
                ?>
                

            </div>
        </div>


        <!-- Footer Start -->
        <?php
            
            include('footer.php');            

        ?>

        <!-- Footer End -->


        <!-- Back to Top -->
        <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>
    </div>
    <!-- <script src="js/datepicker.min.js"></script> -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    
    <script>
        var checkInPicker = datepicker("#inputCheckIn", {
            position: "bl", 
            onSelect: function(instance, date) {
            },
            formatter: function(el, date) {
                el.value = date.toDateString();
            },
            minDate: new Date()

        

        });

        // Initialize datepicker for Check Out input
        var checkOutPicker = datepicker("#inputCheckOut", {
            position: "bl",
            onSelect: function(instance, date) {
            },
            formatter: function(el, date) {
                el.value = date.toDateString();
            },
            minDate: new Date() 
            
        });

        var check_in = $("#input_check_in").val();
        var check_out = $("#input_check_out").val();
        

        $('#submitBtn').prop("disabled", false);

        var checkInDate = new Date(check_in);
        var checkOutDate = new Date(check_out);

        
        if(check_in >= check_out){
            $('#submitBtn').prop("disabled", true);
            $('input#input_check_in').css('border-color', 'red')
            $('input#input_check_in').css('color', 'red')
            $('input#input_check_out').css('border-color', 'red')
            $('input#input_check_out').css('color', 'red')
            $('input#input-total-price').val() = 0;
        }
        if($('#room-number-input').val() === 'No Rooms Available'){
            $('#submitBtn').prop("disabled", true);
            $('#room-number-input').css('border-color', 'red');
            $('#room-number-input').css('color', 'red');
        }
                

       
    </script>

    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="lib/wow/wow.min.js"></script>
    <script src="lib/easing/easing.min.js"></script>
    <script src="lib/waypoints/waypoints.min.js"></script>
    <script src="lib/counterup/counterup.min.js"></script>
    <script src="lib/owlcarousel/owl.carousel.min.js"></script>
    <script src="lib/tempusdominus/js/moment.min.js"></script>
    <script src="lib/tempusdominus/js/moment-timezone.min.js"></script>
    <script src="lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js"></script>

    <!-- Template Javascript -->
    <script src="js/main.js"></script>
</body>

</html>