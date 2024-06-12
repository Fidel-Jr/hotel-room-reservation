<?php

    session_start();
    include('./db/dbConnection.php');

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
</head>

<style>
    .room-item {
        display: flex;
        flex-direction: column;
        height: 100%;
    }

    .room-item .p-4 {
        flex: 1;
    }
</style>

<body>
    <?php 
    
        include('header.php');

    ?>


        <!-- Carousel Start -->
        <div class="container-fluid p-0 mb-5">
            <div id="header-carousel" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <img class="w-100" src="img/carousel-1.jpg" alt="Image">
                        <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                            <div class="p-3" style="max-width: 700px;">
                                <h6 class="section-title text-white text-uppercase mb-3 animated slideInDown">Luxury Living</h6>
                                <h1 class="display-3 text-white mb-4 animated slideInDown">Discover A Brand Luxurious Hotel</h1>
                                <a href="all-rooms.php" class="btn btn-primary py-md-3 px-md-5 me-3 animated slideInLeft">Our Rooms</a>
                                <a href="booking.php?id=1" class="btn btn-light py-md-3 px-md-5 animated slideInRight">Book A Room</a>
                            </div>
                        </div>
                    </div>
                    <div class="carousel-item">
                        <img class="w-100" src="img/carousel-2.jpg" alt="Image">
                        <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                            <div class="p-3" style="max-width: 700px;">
                                <h6 class="section-title text-white text-uppercase mb-3 animated slideInDown">Luxury Living</h6>
                                <h1 class="display-3 text-white mb-4 animated slideInDown">Discover A Brand Luxurious Hotel</h1>
                                <a href="" class="btn btn-primary py-md-3 px-md-5 me-3 animated slideInLeft">Our Rooms</a>
                                <a href="" class="btn btn-light py-md-3 px-md-5 animated slideInRight">Book A Room</a>
                            </div>
                        </div>
                    </div>
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#header-carousel"
                    data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#header-carousel"
                    data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
        </div>
        <!-- Carousel End -->


        <?php 

            include('search.php');

        ?>

        <!-- About Start -->
        <div class="container-xxl py-5">
            <div class="container">
                <div class="row g-5 align-items-center">
                    <div class="col-lg-6">
                        <h6 class="section-title text-start text-primary text-uppercase">About Us</h6>
                        <h1 class="mb-4">Welcome to <span class="text-primary text-uppercase">Haven</span></h1>
                        <p class="mb-4">Haven Hotel Reservation offers you a serene escape from the hustle and bustle of everyday life. Our elegant rooms are designed with your comfort in mind, featuring plush bedding, modern amenities, and breathtaking views. Whether you're here for a relaxing getaway or a business trip, our dedicated staff is committed to providing you with exceptional service.</p>
                        <div class="row g-3 pb-4">
                            <div class="col-sm-4 wow fadeIn" data-wow-delay="0.1s">
                                <div class="border rounded p-1">
                                    <div class="border rounded text-center p-4">
                                        <i class="fa fa-hotel fa-2x text-primary mb-2"></i>
                                        <?php 
                                            $sql = "SELECT * FROM room";
                                            $query = $conn->query($sql);
                                            $total = $query->num_rows;
                                        ?>
                                        <h2 class="mb-1" data-toggle="counter-up"><?php echo $total; ?></h2>
                                        
                                        <p class="mb-0">Rooms</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-4 wow fadeIn" data-wow-delay="0.3s">
                                <div class="border rounded p-1">
                                    <div class="border rounded text-center p-4">
                                        <i class="fa fa-users-cog fa-2x text-primary mb-2"></i>
                                        <h2 class="mb-1" data-toggle="counter-up">400</h2>
                                        <p class="mb-0">Staffs</p>
                                    </div>
                                </div>
                            </div>
                            <!-- <div class="col-sm-4 wow fadeIn" data-wow-delay="0.5s">
                                <div class="border rounded p-1">
                                    <div class="border rounded text-center p-4">
                                        <i class="fa fa-users fa-2x text-primary mb-2"></i>
                                        <h2 class="mb-1" data-toggle="counter-up">1234</h2>
                                        <p class="mb-0">Clients</p>
                                    </div>
                                </div>
                            </div> -->
                        </div>
                        <a class="btn btn-primary py-3 px-5 mt-2" href="all-rooms.php">Our Popular Rooms</a>
                    </div>
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
                </div>
            </div>
        </div>
        <!-- About End -->


        <!-- Room Start -->
        <div class="container-xxl py-5">
            <div class="container">
                <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
                    <h6 class="section-title text-center text-primary text-uppercase">Our Rooms</h6>
                    <h1 class="mb-5">Explore Our <span class="text-primary text-uppercase">Rooms</span></h1>
                </div>
                <div class="row g-4">
                    <?php 

                        $sql = "SELECT * FROM room_type WHERE rating = 5 LIMIT 6";
                        $query = $conn->query($sql);
                        
                        while($row = $query->fetch_assoc()){
                            $room_id = $row['id'];
                            $feature = "SELECT feature.name FROM room_feature INNER JOIN feature ON 
                            room_feature.feature_id=feature.id INNER JOIN room_type ON 
                            room_feature.room_type_id = room_type.id 
                            WHERE room_feature.room_type_id = $room_id";
                            $query2 = $conn->query($feature);
                           
                            $featureName = $query2->fetch_assoc();
                           
                    ?>
                    
                    <div class="col-lg-4 col-md-6 wow fadeInUp mb-5" data-wow-delay="0.1s">
                        <div class="room-item shadow rounded overflow-hidden">
                            <div class="position-relative">
                                <img class="img-fluid" src="img/<?php echo $row['image']; ?>" alt="">
                                <small class="position-absolute start-0 top-100 translate-middle-y bg-primary text-white rounded py-1 px-3 ms-4">₱<?php echo $row['price']; ?>/Night</small>
                            </div>
                            <div class="p-4 mt-2">
                                <div class="d-flex justify-content-between mb-3">
                                    <h5 class="mb-0"><?php echo $row['room_type'] ?></h5>
                                    <div class="ps-2">
                                    <?php 
                                            if($row['rating'] == 0){
                                        ?>
                                            <small class="fa fa-star"></small>
                                            <small class="fa fa-star"></small>
                                            <small class="fa fa-star"></small>
                                            <small class="fa fa-star"></small>
                                            <small class="fa fa-star"></small>
                                        <?php
                                            }elseif($row['rating'] == 1){
                                        ?>
                                                <small class="fa fa-star text-primary"></small>
                                                <small class="fa fa-star"></small>
                                                <small class="fa fa-star"></small>
                                                <small class="fa fa-star"></small>
                                                <small class="fa fa-star"></small>
                                        <?php
                                            
                                            }elseif($row['rating'] == 2){
                                        ?>
                                                <small class="fa fa-star text-primary"></small>
                                                <small class="fa fa-star text-primary"></small>
                                                <small class="fa fa-star"></small>
                                                <small class="fa fa-star"></small>
                                                <small class="fa fa-star"></small>
                                        <?php
                                            }elseif($row['rating'] == 3){

                                        ?>
                                                <small class="fa fa-star text-primary"></small>
                                                <small class="fa fa-star text-primary"></small>
                                                <small class="fa fa-star text-primary"></small>
                                                <small class="fa fa-star"></small>
                                                <small class="fa fa-star"></small>
                                        <?php
                                            }elseif($row['rating'] == 4){

                                        ?>
                                                <small class="fa fa-star text-primary"></small>
                                                <small class="fa fa-star text-primary"></small>
                                                <small class="fa fa-star text-primary"></small>
                                                <small class="fa fa-star text-primary"></small>
                                                <small class="fa fa-star"></small>
                                        <?php
                                            }else{

                                        ?>
                                                <small class="fa fa-star text-primary"></small>
                                                <small class="fa fa-star text-primary"></small>
                                                <small class="fa fa-star text-primary"></small>
                                                <small class="fa fa-star text-primary"></small>
                                                <small class="fa fa-star text-primary"></small>
                                        <?php
                                            }
                                        ?>
                                    </div>
                                </div>
                                <div class="d-flex mb-3">
                                    <small class="border-end me-3 pe-3"><i class="fa fa-bed text-primary me-2"></i> <?php echo $row['bed'] ?> Bed</small>
                                    <small class="border-end me-3 pe-3"><i class="fa fa-bath text-primary me-2"></i> <?php echo $row['bathroom'] ?> Bath</small>
                                    <?php 
                                        
                                        if(isset($featureName['name'])){
                                            
                                            if($featureName['name']=="Free Wifi"){
                                    ?>
                                    
                                        <small><i class="fa fa-wifi text-primary me-2"></i><?php echo $featureName['name']; ?></small>

                                    <?php 
                                         } elseif($featureName['name']=="Private Pool"){

                                    ?>

                                        <small><i class="fas fa-swimming-pool text-primary me-2"></i><?php echo $featureName['name']; ?></small>

                                    <?php 
                                    }
                                    }

                                    ?>
                                    
                                </div>
                                <p class="text-body mb-3 description-paragraph"><?php echo $row['description']; ?></p>
                                <div class="d-flex justify-content-between">
                                    <a class="btn btn-sm btn-primary rounded py-2 px-4" href="single-room.php?id=<?php echo $row['id']; ?>">View Detail</a>
                                    <a class="btn btn-sm btn-dark rounded py-2 px-4" href="booking.php?id=<?php echo $row['id'];?>">Book Now</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php 
                        }   
                    ?>
                </div>
            </div>
        </div>
        <!-- Room End -->


        <!-- Footer Start -->

            <?php include('footer.php'); ?>

        <!-- Footer End -->


        <!-- Back to Top -->
        <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>
    </div>

    <script src="js/datepicker.min.js"></script>
                       


    <script>
       
        document.addEventListener("DOMContentLoaded", function() {
            var descriptionParagraphs = document.querySelectorAll(".description-paragraph");

            descriptionParagraphs.forEach(function(paragraph) {
                var text = paragraph.textContent.trim();
                var truncatedText = text.split('.').slice(0, 1).join('.') + '...';
                paragraph.textContent = truncatedText;
            });

        });

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