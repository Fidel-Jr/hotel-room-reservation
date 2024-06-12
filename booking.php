<?php

    // session_start();
    
    include('./sessions/sessionCheck.php');
    date_default_timezone_set('Asia/Manila');
    $today = new Datetime();
    $todayTime = $today->format('H:i:s');

    if(!isset($_GET['id'])){
        header('Location: index.php');
    }
    const CUT_OFF_TIME = "18:00:00";
    if('14:00:00' >= CUT_OFF_TIME){
        header("Location: ./not-available.html");
    }

    // $oldCheckAvailabilityQuery = "SELECT * FROM booking WHERE booking.room_id = 34
    // AND ((check_in =  '2024-06-06' AND booking.check_in_time  >= '14:00:00' )
    // OR(check_out =  '2024-06-08' AND booking.check_out_time  >= '12:00:00' )
    // OR(CONCAT( '2024-06-06', ' ', check_in_time)  BETWEEN CONCAT(check_in, ' ', check_in_time) AND CONCAT(check_out, ' ', check_out_time))
    // OR(CONCAT( '2024-06-08', ' ', check_out_time) BETWEEN CONCAT(check_in, ' ', check_in_time) AND CONCAT(check_out, ' ', check_out_time)))";

    // $oldCheckAvailabilityQuery1 = "SELECT * FROM booking WHERE booking.room_id = room_id
    // AND ((check_in = check_in_date AND booking.check_in_time  >= '14:00:00' )
    // OR(check_out = check_out_date AND booking.check_out_time  >= '12:00:00' )
    // OR(check_in_date BETWEEN CONCAT(check_in, ' ', check_in_time) AND CONCAT(check_out, ' ', check_out_time))
    // OR(check_out_date BETWEEN CONCAT(check_in, ' ', check_in_time) AND CONCAT(check_out, ' ', check_out_time)))";



    
    $room_id = $_GET['id'];
    $sql = "SELECT * FROM room_type WHERE id = '$room_id' ";
    $query = $conn->query($sql);
    $row = $query->fetch_assoc();

    if(isset($_SESSION['check_in_date']) && isset($_SESSION['check_out_date']) && isset($_SESSION['adult_count']) && isset($_SESSION['children_count'])){
        $dateTime1 = new DateTime($_SESSION['check_in_date']);
        $dateTime2 = new DateTime($_SESSION['check_out_date']);
    
        $adult_count = $_SESSION['adult_count'];
        $children_count = $_SESSION['children_count'];
    
        $formattedDate1 = $dateTime1->format('Y-m-d');
        $formattedDate2 = $dateTime2->format('Y-m-d');
    
        $checkInDateTime = new DateTime($formattedDate1);
        $checkOutDateTime = new DateTime($formattedDate2);
    
        $interval = $checkInDateTime->diff($checkOutDateTime);
    
        $numberOfDays = $interval->days;
    }

    
    
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
    <link rel="stylesheet" type="text/css" href="css/datepicker.css"/>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

</head>

<body>
        <?php 
            
            include('header.php');

        ?>


        <!-- Page Header Start -->
        <div class="container-fluid page-header mb-5 p-0" style="background-image: url(img/carousel-1.jpg);">
            <div class="container-fluid page-header-inner py-5">
                <div class="container text-center pb-5">
                    <h1 class="display-3 text-white mb-3 animated slideInDown">Booking</h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb justify-content-center text-uppercase">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item"><a href="#">Pages</a></li>
                            <li class="breadcrumb-item text-white active" aria-current="page">Booking</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
        <!-- Page Header End -->


        <?php
        
            include('search.php');
        
        ?>


        <div class="container-xxl py-5 mb-5">
            <div class="container">
                <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
                    <h6 class="section-title text-center text-primary text-uppercase">Room Booking</h6>
                    <h1 class="mb-5">Book A <span class="text-primary text-uppercase">Luxury Room</span></h1>
                </div>
                <div class="row g-5">
                    <div class="col-lg-6">
                        <div class="row g-3">
                            <div class="col-6 text-end">
                                <img class="img-fluid rounded w-75 wow zoomIn" data-wow-delay="0.1s" src="img/about-1.jpg" style="margin-top: 25%;">
                            </div>
                            <div class="col-6 text-start">
                                <img class="img-fluid rounded w-100 wow zoomIn" data-wow-delay="0.3s" src="img/about-2.jpg">
                            </div>
                            <div class="col-6 text-end">
                                <img class="img-fluid rounded w-50 wow zoomIn" data-wow-delay="0.5s" src="img/about-3.jpg">
                            </div>
                            <div class="col-6 text-start">
                                <img class="img-fluid rounded w-75 wow zoomIn" data-wow-delay="0.7s" src="img/about-4.jpg">
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="wow fadeInUp" data-wow-delay="0.2s">
                            <form action="./backend/booking.php" method="POST">
                                <div class="row g-3">
                                    <div class="col-md-12">
                                    <div class="form-floating">
                                            <input type="hidden" name="user-id" value="<?php echo isset($user->id)? $user->id: ''; ?>" class="form-control" id="name" placeholder="Your Name">
                                        </div>
                                        <div class="form-floating">
                                            <input type="text" style="background-color: white;" name="room-type-id" value="<?php echo isset($row['room_type'])? $row['room_type']: ''; echo ' - ' . $row['bed'] ?> beds" class="form-control" id="name" placeholder="Room" readonly>
                                            <label for="name">Room</label>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-floating">
                                            <input type="text" value="<?php echo isset($user->fullname)? $user->fullname: ''; ?>" class="form-control" id="name" placeholder="Your Name">
                                            <label for="name">Your Name</label>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-floating">
                                            <input type="email" value="<?php echo isset($user->email)? $user->email: ''; ?>" class="form-control" id="email" placeholder="Your Email">
                                            <label for="email">Your Email</label>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-floating">
                                            <!-- <i class="fa fa-calendar fa-2x tm-form-element-icon"></i> -->
                                            <input name="check-in" style="background-color: white;" value="<?php echo isset($_SESSION['check_in_date']) ? $_SESSION['check_in_date']: ''; ?>" type="text" class="form-control" id="input_check_in" placeholder="Check In" readonly>
                                            <label for="checkIn" id="checkInLabel">Check in</label>
                                            <div>
                                                <?php 

                                                    $fixTime = '14:00:00';
                                                    $date = new Datetime();
                                                    $currentTime = $date->format('H');
                                            
                                                ?>
                                                <p style="margin: 0;" class="mt-2">
                                                    <?php 
                                                        if($currentTime >= '18'){
                                                            echo  $fixTime;
                                                        } elseif($currentTime >= $fixTime){
                                                            echo $currentTime . ":00:00 - 18:00:00";
                                                        }else{
                                                            echo  $fixTime;
                                                        }                                                    
                                                    ?>
                                                    <span class="mx-2"><a href="view-reserved.php">Check Rooms</a></span>
                                                </p>
                                                
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-6">
                                        <div class="form-floating date-form">
                                            <!-- <i class="fa fa-calendar fa-2x tm-form-element-icon"></i> -->
                                            <input name="check-out" style="background-color: white;" value="<?php echo isset($_SESSION['check_out_date']) ? $_SESSION['check_out_date']: '';?>" type="text" class="form-control" id="input_check_out" placeholder="Check Out" readonly>
                                            <label for="checkOut" id="checkOutLabel">Check out</label>
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-6">
                                        <div class="form-floating">

                                            <select class="form-select" id="adult-count" name="adult-count">

                                                <option value="0">Adult</option>
                                                <?php
                                                
                                                    if( $adult_count > 0){
                                                ?>
                                                <option value="<?php echo $adult_count; ?>" selected>Adult <?php echo $adult_count; ?></option>
                                                <?php
                                                    }
                                                
                                                ?>
                                            <?php 
                                              
                                              for($i=1; $i<=$row['capacity_adult']; $i++){
                                                    if($adult_count == $i){
                                                        continue;
                                                    }
                                                  ?>
                                                  <option value="<?php echo $i; ?>">Adult <?php echo $i; ?></option>
                                            <?php
                                              }
                                            
                                             ?>
                                            </select>
                                            <label for="select1">Adult</label>
                                          </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-floating">


                                            <select class="form-select" id="children-count" name="children-count">
                                                <option value="0">Child</option>

                                                <?php
                                                
                                                    if( $children_count > 0){
                                                ?>
                                                <option value="<?php echo $children_count; ?>" selected>Child <?php echo $children_count; ?></option>
                                                <?php
                                                    }
                                                
                                                ?>

                                              <?php 
                                              
                                                for($i=1; $i<=$row['capacity_children']; $i++){
                                                    if($children_count == $i){
                                                        continue;
                                                    }
                                                    ?>
                                                    <option value="<?php echo $i; ?>">Child <?php echo $i; ?></option>
                                              <?php
                                                }
                                                
                                               ?>
                                               
                                            </select>
                                            <label for="select2">Children</label>
                                          </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-floating">
                                            <select class="form-select" id="room-number-input" name="room-id">
                                                <?php
                                                    $fixedCheckInTime = '14:00:00';
                                                    $fixedCheckOutTime = '12:00:00';
                                                    $noRoomsAvailable = TRUE;
                                                    $sql = "SELECT room.*, room_type.price FROM room INNER join room_type ON room.room_type = room_type.id HAVING room_type = '$room_id'";
                                                    $query = $conn->query($sql);
                                                    $conn->close();
                                                    while($row = $query->fetch_assoc()){
                                                        include('./db/dbConnection.php');
                                                        $room = $row['id'];
                                                        $price = $row['price'];
                                                        $isAvailable = "CALL check_room_availability('$room', '$formattedDate1', '$formattedDate2')";
                                                        $query2 = $conn->query($isAvailable);
                                                        if($query2->num_rows > 0){
                                                            continue;
                                                        } 
                                                    ?>
                                                        
                                                            <option value="<?php echo $row['id'] ?>"><?php echo $row['room_number'] ?></option>
                                                        
                                                <?php
                                                $noRoomsAvailable = FALSE;
                                                    }
                                                ?>
                                                <?php 
                                                    
                                                    if($noRoomsAvailable){
                                                    ?>
                                                        <option value="No Rooms Available">No Rooms Available</option>
                                                    <?php
                                                    }
                                                    
                                                ?>
                                            </select>
                                            <label for="select3">Select A Room</label>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-floating">
                                            <!-- <textarea class="form-control" placeholder="Special Request" id="message" style="height: 100px"></textarea> -->
                                            <input class="form-control" style="background-color: white;" name="total-price" type="text" id="input-total-price" value="<?php if(isset($formattedDate1) && isset($formattedDate2)){ if($formattedDate1 < $formattedDate2){ echo $price * $numberOfDays; }} else{ echo $price; }  ?>" readonly>
                                            <label for="message">Total Price</label>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                    <input type="submit" name="update-date-btn" id="update-btn" class="btn btn-primary w-100 py-3 mb-3" value="Check Availabilty">
                                    <?php 
                                        if(isset($_SESSION['email'])){
                                            if($user->gender == NULL || $user->phone_number == NULL || $user->address == NULL || $user->dob == NULL){
                                        ?>
                                            <a href="edit-profile.php" name="book_room_btn" class="btn btn-primary w-100 py-3">Finish Your Profile</a>
                                        <?php
                                            }else{
                                        ?>
                                                <input type="submit" name="book_room_btn" id="submitBtn" class="btn btn-primary w-100 py-3" value="Book Now" disabled>
                                        <?php

                                            }
                                    ?>
                                    <?php 
                                       } else{

                                       ?>
                                        <a href="login.php" class="btn btn-primary w-100 py-3" >Log in first before booking</a>
                                   <?php
                                   
                                        }
                                            
                                    ?>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Booking End -->



        <!-- Footer Start -->
        <?php
            
            include('footer.php');            

        ?>

        <!-- Footer End -->


        <!-- Back to Top -->
        <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="js/datepicker.min.js"></script>
    <script>
         $(document).ready(function() {
            var originalCheckInValue = $('#input_check_in').val(); 
            var originalCheckOutValue = $('#input_check_out').val(); 

            function checkForDateChange() {
                var currentCheckInValue = $('#input_check_in').val(); 
                var currentCheckOutValue = $('#input_check_out').val(); 
                
                if (currentCheckInValue !== originalCheckInValue || currentCheckOutValue !== originalCheckOutValue) {
                    $('#submitBtn').prop('disabled', true);
                } 
                else if(formattedDate1 >= formattedDate2 && ($('select#adult-count').val() == 0 && $('select#children-count').val() == 0)){
                $('#submitBtn').prop("disabled", true);
                $('input#input_check_in').css('border-color', 'red')
                $('input#input_check_in').css('color', 'red')
                $('input#input_check_out').css('border-color', 'red')
                $('input#input_check_out').css('color', 'red')
                $('select#adult-count').css('border-color', 'red');
                $('select#children-count').css('border-color', 'red');
                $('input#input-total-price').val() = 0;
            }
            else if(formattedDate1 >= formattedDate2){
                $('#submitBtn').prop("disabled", true); 
                $('input#input_check_in').css('border-color', 'red')
                $('input#input_check_in').css('color', 'red')
                $('input#input_check_out').css('border-color', 'red')
                $('input#input_check_out').css('color', 'red')
                $('input#input-total-price').val() = 0;

            }else if($('select#adult-count').val() == 0 && $('select#children-count').val() == 0){
                $('select#adult-count').css('border-color', 'red');
                $('select#children-count').css('border-color', 'red');
                $('#submitBtn').prop("disabled", true);
            }
            else if($('#room-number-input').val() === 'No Rooms Available'){
                $('#submitBtn').prop("disabled", true);
                $('#room-number-input').css('border-color', 'red');
                $('#room-number-input').css('color', 'red');
            }
            else {
                $('#submitBtn').prop('disabled', false);
            }
            }
      
            setInterval(checkForDateChange, 500);
        

            var checkInPicker = datepicker("#inputCheckIn", {
                position: "bl", 
                onSelect: function(instance, date) {
                },
                formatter: function(el, date) {
                    el.value = date.toDateString();
                },
                minDate: new Date() 
            });

            var checkOutPicker = datepicker("#inputCheckOut", {
                position: "bl", 
                onSelect: function(instance, date) {
                },
                formatter: function(el, date) {
                    el.value = date.toDateString();
                },
                minDate: new Date() 
            });

            var checkInPicker = datepicker("#input_check_in", {
                position: "bl", 
                onSelect: function(instance, date) {
                },
                formatter: function(el, date) {
                    el.value = date.toDateString();
                },
                minDate: new Date() 
            });

            var checkInPicker = datepicker("#input_check_out", {
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
            
            const currentDate1 = new Date(check_in);
            const currentDate2 = new Date(check_out);
            const year_in = currentDate1.getFullYear();
            let month_in = currentDate1.getMonth() + 1;
            let day_in = currentDate1.getDate();

            const year_out = currentDate2.getFullYear();
            let month_out = currentDate2.getMonth() + 1; 
            let day_out = currentDate2.getDate();

            month_in = month_in < 10 ? '0' + month_in : month_in;
            day_in = day_in < 10 ? '0' + day_in : day_in;

            month_out = month_out < 10 ? '0' + month_out : month_out;
            day_out = day_out < 10 ? '0' + day_out : day_out;

            const formattedDate1 = `${year_in}-${month_in}-${day_in}`;
            const formattedDate2 = `${year_out}-${month_out}-${day_out}`;


            // $('#submitBtn').prop("disabled", false);


            if(formattedDate1 >= formattedDate2 && ($('select#adult-count').val() == 0 && $('select#children-count').val() == 0)){
                $('#submitBtn').prop("disabled", true);
                $('input#input_check_in').css('border-color', 'red')
                $('input#input_check_in').css('color', 'red')
                $('input#input_check_out').css('border-color', 'red')
                $('input#input_check_out').css('color', 'red')
                $('select#adult-count').css('border-color', 'red');
                $('select#children-count').css('border-color', 'red');
                $('input#input-total-price').val() = 0;
            }
            if(formattedDate1 >= formattedDate2){
                $('#submitBtn').prop("disabled", true); 
                $('input#input_check_in').css('border-color', 'red')
                $('input#input_check_in').css('color', 'red')
                $('input#input_check_out').css('border-color', 'red')
                $('input#input_check_out').css('color', 'red')
                $('input#input-total-price').val() = 0;

            }if($('select#adult-count').val() == 0 && $('select#children-count').val() == 0){
                $('select#adult-count').css('border-color', 'red');
                $('select#children-count').css('border-color', 'red');
                $('#submitBtn').prop("disabled", true);
            }
            if($('#room-number-input').val() === 'No Rooms Available'){
                $('#submitBtn').prop("disabled", true);
                $('#room-number-input').css('border-color', 'red');
                $('#room-number-input').css('color', 'red');
            }
        });
        $(document).ready(function(){
            $('#room-number-input').change(function(){
                $('#submitBtn').prop("disabled", true);
            })
        })
        
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