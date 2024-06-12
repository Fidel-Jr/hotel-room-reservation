<?php 
    
    date_default_timezone_set('Asia/Manila');
    require_once('./db/dbConnection.php');
    session_start();

    $dateTime = new DateTime();
    // Get the current date in the desired format
    $currentDate = $dateTime->format('Y-m-d');
    $currentTime = $dateTime->format('H:i:s');
    $fixedTime = '14:00:00';
    $sql = "SELECT booking.*, room_type.room_type, room.room_number FROM booking INNER JOIN room ON booking.room_id = room.id INNER JOIN room_type ON room.room_type = room_type.id ORDER BY booking.booking_date DESC";
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
    <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css">
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap5.min.js"></script>

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
                    <h1 class="display-3 text-white mb-3 animated slideInDown">View Reserved Rooms</h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb justify-content-center text-uppercase">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item"><a href="#">Pages</a></li>
                            <li class="breadcrumb-item text-white active" aria-current="page">Reserved Rooms</li>
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
    
                <table id="table1" class="table table-striped bg-white shadow" style="width: 100%;">
                    <thead>
                        <tr>
                            <th>Room</th>
                            <th>Room Number</th>
                            <th>Check In</th>
                            <th>Check Out</th>
                            <th>Booking Date</th>
                            <th>Booking Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 

                            while($row = $query->fetch_assoc()){

                        ?>
                                <tr>
                                    <td> <?php echo $row['room_type']; ?> </td>
                                    <td> <?php echo $row['room_number']; ?> </td>
                                    <td><b> <?php echo $row['check_in']; ?> </b></td>
                                    <td><b> <?php echo $row['check_out']; ?> </b></td>
                                    <td> <?php echo $row['booking_date']; ?> </td>
                                    <td><b> <?php echo $row['booking_status']; ?> </b></td>
                                    
                                </tr>
                        <?php
                            }
                        
                        ?>
                    
                    </tbody>
                </table>

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
        new DataTable('#table1');
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