<?php

    // session_start();
    
    include('./sessions/sessionCheck.php');
    include('./db/dbConnection.php');

    if(!isset($_SESSION['email'])){
        header('Location: index.php');
    }

    $user_id = $user->id;
    if(isset($_GET['id'])){
        $id = $_GET['id'];
        $sql = "SELECT booking_history.*, booking_history.id as bh_id, room.id, room.room_number, room_type.room_type, room_type.id as room_type_id FROM booking_history INNER JOIN room ON booking_history.room_id = room.id INNER JOIN room_type ON room_type.id = room.room_type WHERE booking_history.id = '$id'";
        $query = $conn->query($sql);
        $row = $query->fetch_assoc();
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
    <!-- <link rel="stylesheet" type="text/css" href="css/datepicker.css"/> -->
    <!-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> -->
</head>

<style>
    table td{
        padding: 30px !important;
    }
    .star-rating {
        display: flex;
        flex-direction: row;
        justify-content: center;
    }

    .star {
        font-size: 2em;
        cursor: pointer;
        color: gray;
    }

    .star:hover,
    .star:hover ~ .star,
    .star.selected,
    .star.selected ~ .star {
        color: gold;
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
                    <h1 class="display-3 text-white mb-3 animated slideInDown">Rating Room</h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb justify-content-center text-uppercase">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item"><a href="#">Pages</a></li>
                            <li class="breadcrumb-item text-white active" aria-current="page">Rating</li>
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
                
                            <table class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th>Room</th>
                                        <th>Room Number</th>
                                        <th>Check In</th>
                                        <th>Check Out</th>
                                        <th>Booking Date</th>
                                        <th>Total Price</th>
                                        <th>Booking Status</th>
                                        <th>Rate</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    
                                    <tr>
                                        <td><?php echo $row['room_type'] ?></td>
                                        <td style="width: 50px;"><?php echo $row['room_number'] ?></td>
                                        <td><?php echo $row['check_in'] ?></td>
                                        <td><?php echo $row['check_out'] ?></td>
                                        <td><?php echo $row['booking_date'] ?></td>
                                        <td><?php echo $row['total_price'] ?></td>
                                        <td><?php echo $row['booking_status'] ?></td>
                                        <?php 

                                                    if($row['rating_status'] != NULL){
                                                ?>
                                                    <td>
                                                        Done
                                                    </td>
                                                <?php
                                                    }else{

                                        ?>
                                            <td>
                                            <div class="star-rating">
                                                <span class="star" data-value="5">&#9733;</span>
                                                <span class="star" data-value="4">&#9733;</span>
                                                <span class="star" data-value="3">&#9733;</span>
                                                <span class="star" data-value="2">&#9733;</span>
                                                <span class="star" data-value="1">&#9733;</span>
                                            </div>
                                            <p id="rating-value">Your rating: <span id="rating">0</span></p>
                                            <p id="rating-value" style="display: none;">Your rating: <span id="rating">0</span></p>
                                            <form class="rating-form" action="./backend/rate.php" method="POST">
                                                <input type="hidden" name="bh_id" value="<?php echo $row['bh_id']; ?>">
                                                <input type="hidden" name="room-id" value="<?php echo $row['room_type_id']; ?>">
                                                <input type="hidden" name="rating-value" id="input-rating">

                                                <div class="d-flex justify-content-center">
                                                    <input type="submit" value="Rate" name="rate-btn" class="btn btn-sm btn-primary">
                                                </div>
                                            </form>
                                            </td>
                                        <?php 
                                        
                                            }
                                        ?>
                                    </tr>
                                        
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

        document.addEventListener('DOMContentLoaded', function() {
            const stars = document.querySelectorAll('.star');
            const ratingValue = document.getElementById('rating');
            const input = document.getElementById('input-rating');
            let currentRating = 0;

            stars.forEach(star => {
                star.addEventListener('click', setRating);
                star.addEventListener('mouseover', addHoverEffect);
                star.addEventListener('mouseout', removeHoverEffect);
            });

            function setRating(e) {
                currentRating = e.target.getAttribute('data-value');
                ratingValue.innerText = currentRating;
                input.value = currentRating;
                stars.forEach(star => {
                    star.classList.remove('selected');
                    if(star.getAttribute('data-value') <= currentRating) {
                        star.classList.add('selected');
                    }
                });
            }

            function addHoverEffect(e) {
                stars.forEach(star => {
                    star.classList.remove('hover');
                    if(star.getAttribute('data-value') <= e.target.getAttribute('data-value')) {
                        star.classList.add('hover');
                    }
                });
            }

            function removeHoverEffect() {
                stars.forEach(star => {
                    star.classList.remove('hover');
                });
            }
        });
        
        var checkInPicker = datepicker("#inputCheckIn", {
            position: "bl", 
            onSelect: function(instance, date) {
                
            },
            formatter: function(el, date) {
                // 
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
        console.log($("#input_check_in").val());

        
                    
        console.log($('#room-number-input').val());

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