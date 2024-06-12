<?php

    // session_start();
    
    include('./sessions/sessionCheck.php');

    if(!isset($_SESSION['email'])){
        header('Location: index.php');
    }
    
    if(!isset($_GET['id'])){
        header('Location: index.php');
    }

    
    $booking_id = $_GET['id'];
    $sql = "SELECT booking.*, room.room_number, room_type.room_type, room_type.id as room_type_id FROM booking INNER JOIN room ON booking.room_id = room.id INNER JOIN room_type ON room.room_type = room_type.id WHERE booking.id = '$booking_id' ";
    $query = $conn->query($sql);
    $row = $query->fetch_assoc();
    $total_price = $row['total_price'];
    $room_id = $row['room_type_id'];
    $check_in = $row['check_in'];
    $check_out = $row['check_out'];
    $room_number = $row['room_number'];
    
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


        <!-- Booking Start -->
        <?php
        
            include('search.php');
        
        ?>
        <!-- Booking End -->


        <!-- Booking Start -->
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
                            <form action="./backend/update-booking.php?id=<?php echo $row['id']; ?>" method="POST">
                                <div class="row g-3">
                                    <div class="col-md-12">
                                        <div class="form-floating">
                                            <input type="hidden" name="user-id" value="<?php echo isset($user->id)? $user->id: ''; ?>" class="form-control" id="name" placeholder="Your Name">
                                        </div>
                                        <div class="form-floating">
                                            <input type="hidden" name="room-type-id" value="<?php echo $room_id ?>" class="form-control" id="name" placeholder="Your Name">
                                        </div>
                                        <div class="form-floating">
                                            <input type="text" name="room-type" value="<?php echo $row['room_type'] ?>" class="form-control" id="name" placeholder="Your Name">
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
                                            <input name="check-in" style="background-color: white;" value="<?php echo $row['check_in'] ?>" type="text" class="form-control" id="input_check_in" placeholder="Check In" disabled>
                                            <label for="checkIn" id="checkInLabel">Check in</label>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-floating date-form">
                                            <!-- <i class="fa fa-calendar fa-2x tm-form-element-icon"></i> -->
                                            <input name="check-out" style="background-color: white;" value="<?php echo $row['check_out'] ?>" type="text" class="form-control" id="input_check_out" placeholder="Check Out" disabled>
                                            <label for="checkOut" id="checkOutLabel">Check out</label>
                                        </div>
                                    </div>
                                    
                                    <!-- <div class="col-md-6">
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
                                    </div> -->
                                    <!-- <div class="col-md-6">
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
                                    </div> -->
                                  
                                    <div class="col-12">
                                    <?php 
                                        
                                        if(isset($_SESSION['update-error'])){
                                            echo "<p class='text-danger'>" .  $_SESSION['update-error'] . "</p>";
                                            unset($_SESSION['update-error']);
                                        } elseif(isset($_SESSION['update-success'])){
                                            echo "<p class='text-success'>" .  $_SESSION['update-success'] . "</p>";
                                            unset($_SESSION['update-success']);
                                        }
                                    
                                    ?>
                                        <div class="form-floating">
                                            <select class="form-select" id="room-number-input" name="room-number">
                                                <option value="<?php echo $row['room_number']; ?>"><?php echo $row['room_number']; ?></option>
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
                                                            // $check_in = $row['check_in'];
                                                            // $check_out = $row['check_out'];
                                                            $isAvailable = "CALL check_room_availability('$room', '$check_in', '$check_out')";
                                                            $query2 = $conn->query($isAvailable);
                                                            if($query2->num_rows > 0){
                                                                continue;
                                                            } 
                                                    ?>
                                                        
                                                            <option value="<?php echo $row['room_number'] ?>"><?php echo $row['room_number'] ?></option>
                                                        
                                              
                                                <?php 

                                                        }
                                                        
                                                ?>
                                            </select>
                                            <label for="select3">Select A Room</label>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-floating">
                                            <input class="form-control" style="background-color: white;" name="total-price" type="text" id="input-total-price" value="<?php echo $total_price;  ?>" readonly>
                                            <label for="message">Total Price</label>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                    <!-- <input type="submit" name="check-btn" id="editBtn" class="btn btn-primary w-100 py-3" value="Check Availability"> -->
                                    <input type="submit" name="update-btn" id="editBtn" class="btn btn-primary w-100 py-3" value="Update Booking">
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
    <!-- <script src="js/datepicker.min.js"></script> -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    
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
        

            var checkInPicker = datepicker("#input_check_in", {
            position: "bl", 
            onSelect: function(instance, date) {
            },
            formatter: function(el, date) {
                el.value = date.toDateString();
            },
            minDate: new Date() 

       

        });
        

        var checkOutPicker = datepicker("#input_check_out", {
            position: "bl", 
            onSelect: function(instance, date) {
            },
            formatter: function(el, date) {
              
                el.value = date.toDateString();
            },
            minDate: new Date() 
           
        })
    

        console.log($("#input_check_in").val());

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

            console.log($('select#adult-count').val());

                $('#submitBtn').prop("disabled", false);


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