<?php

    include('./db/dbConnection.php');
    session_start();

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


        <!-- Page Header Start -->
        <div class="container-fluid page-header mb-5 p-0" style="background-image: url(img/carousel-1.jpg);">
            <div class="container-fluid page-header-inner py-5">
                <div class="container text-center pb-5">
                    <h1 class="display-3 text-white mb-3 animated slideInDown">Rooms</h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb justify-content-center text-uppercase">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item"><a href="#">Pages</a></li>
                            <li class="breadcrumb-item text-white active" aria-current="page">Rooms</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
        <!-- Page Header End -->


        <?php 
        
            include('search.php');

        ?>


        <!-- Room Start -->
        
        
                <!-- Room Start -->
        <div class="container-xxl py-5 mb-5">
            <div class="container">
                <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
                    <h6 class="section-title text-center text-primary text-uppercase">Our Rooms</h6>
                    <h1 class="mb-5">Explore Our <span class="text-primary text-uppercase">Rooms</span></h1>
                </div>
                <div class="row g-4">
                    <?php 

                        $sql = "SELECT * FROM room_type ORDER BY rating DESC";
                        $query = $conn->query($sql);
                        
                        while($row = $query->fetch_assoc()){
                            $room_id = $row['id'];
                            $feature = "SELECT feature.name FROM room_feature INNER JOIN feature ON 
                            room_feature.feature_id=feature.id INNER JOIN room_type ON 
                            room_feature.room_type_id = room_type.id 
                            WHERE room_feature.room_type_id = $room_id";
                            $query2 = $conn->query($feature);
                            // if($query2->num_rows == 0){
                            //     continue;
                            // }
                            $featureName = $query2->fetch_assoc();
                           
                    ?>
                    
                    <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
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
    
            <?php
            
                include('footer.php');            

            ?>

        <!-- Back to Top -->
        <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>
    </div>
        

   <script>
     var checkInPicker = datepicker("#inputCheckIn", {
        position: "bl", // Position of the datepicker relative to the input
        onSelect: function(instance, date) {
            // Handle date selection if needed
        },
        formatter: function(el, date) {
            // Format the selected date if needed
            el.value = date.toDateString();
        },
        minDate: new Date() // Disable past dates
    });

    // Initialize datepicker for Check Out input
    var checkOutPicker = datepicker("#inputCheckOut", {
        position: "bl", // Position of the datepicker relative to the input
        onSelect: function(instance, date) {
            // Handle date selection if needed
        },
        formatter: function(el, date) {
            // Format the selected date if needed
            el.value = date.toDateString();
        },
        minDate: new Date() // Disable past dates
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