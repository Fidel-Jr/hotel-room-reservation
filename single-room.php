<?php

    session_start();
    include('./db/dbConnection.php');

    if(!isset($_GET['id'])){
        header('Location: index.php');
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
</head>

<style>
    ul{
        list-style: none;
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


        <div class="container single-room mt-5 wow fadeIn" data-wow-delay="0.1s">
            <?php 
                $room_type_id = $_GET['id'];
                $images = array();
                $sql = "SELECT room_images.image FROM room_images WHERE room_type_id = '$room_type_id' ";
                $query = $conn->query($sql);
                while($row = $query->fetch_assoc()){
                    array_push($images, $row['image']);
                }
                

            
            ?>
            <div class="row gap-3">
                <div class="col-sm-12 col-lg-9 row">
                    <div class="col-sm-12 col-lg-4">
                        <img src="./img/<?php echo $images[0]; ?>" alt="" width="100%">
                        <img src="./img/<?php echo $images[1]; ?>" alt="" width="100%" class="mt-3">
                        <div class="row">
                            <div class="col">
                                <img src="./img/<?php echo $images[2]; ?>" alt="" width="100%" class="mt-3">
                            </div>
                            <div class="col">
                                <img src="./img/<?php echo $images[3]; ?>" alt="" width="100%" class="mt-3">
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12 col-lg-8">
                        <?php 
                            $sql = "SELECT image FROM room_type WHERE id = '$room_type_id' ";
                            $query = $conn->query($sql);
                            $row = $query->fetch_assoc();
                        ?>
                        <img src="./img/<?php echo $row['image']; ?>" alt="" width="100%">
                        <div class="row mt-3">
                            <div class="col-3">
                                <img src="./img/<?php echo $images[4]; ?>" alt="" width="100%">
                            </div>
                            <div class="col-3">
                                <img src="./img/<?php echo $images[5]; ?>" alt="" width="100%">
                            </div>
                            <div class="col-3">
                                <img src="./img/<?php echo $images[6]; ?>" alt="" width="100%">
                            </div>
                            <div class="col-3">
                                <img src="./img/<?php echo $images[7]; ?>" alt="" width="100%">
                            </div>
                      
                        </div>
                    </div>
                   
                </div>
                <div class="col-sm-12 col-lg-3 border p-3" style="height: fit-content;">
                    <?php 
                        $room_id = $_GET['id'];
                        $room_type_id = "";
                        $sql = "CALL display_room($room_id)";
                        $query = $conn->query($sql);
                        $row = $query->fetch_assoc();
                       
                        $room_type_id = $row['id'];
                        $room_type = $row['room_type'];
                        $room_desc = $row['description'];
                        $room_price = $row['price'];
                    ?>

                    <h4><?php echo $room_type; ?></h4>
                    <p><?php echo $room_desc; ?></p>
                    <p> <span style="font-weight: 600;">Bed:</span> <?php echo $bed = $row['bed']; ?></p>
                    <p><span style="font-weight: 600;">Bathroom:</span> <?php echo $row['bathroom'] ?></p>
                    <p><span style="font-weight: 600;">Floor:</span> <?php echo $floor = $row['floor'] ?></p>
                    <p><span style="font-weight: 600;">Price:</span> <?php echo $room_price; ?></p>
                    <p><span style="font-weight: 600;">Rating:</span> <?php echo $row['rating']; ?></p>
                </div>
            </div>
            <div class="row mt-5">
                <h4>Room Special Features</h4>
                <ul class="col-8 row mt-4">
                    <?php 
                        $conn->close();
                        include('./db/dbConnection.php');
                        $sql = "SELECT room_feature.*, feature.name FROM room_feature INNER JOIN feature ON room_feature.feature_id=feature.id WHERE room_feature.room_type_id = '$room_type_id' AND feature.type = 'Special' ";
                        $query = $conn->query($sql);    
                            
                        if($query->num_rows < 1){
                    ?>
                    <p>This room has no special features.</p>
                    <?php 
                    } else{
                            while($row = $query->fetch_assoc()){
                            
                    ?>
                            
                                <li class="col">
                                    <?php echo $row['name']; ?>
                                </li>
                          
                           
                    <?php
                            }

                        }
                    ?>
                </ul>
                
            </div>
            <!-- <div class="mt-5">
                <a href="booking.php" class="btn btn-primary">Book Now</a>
            </div> -->
            <div class="mt-5" id="roomdetails">
                <h4>Room Details</h4>
                <table class="table mt-5">
                    <thead>
                        <tr>
                            <th>Room Type</th>
                            <th>Description</th>
                            <th>Price</th>
                            <th>Features</th>
                            <th>Find Available Room</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>
                                <?php echo $room_type; ?>
                            </td>
                            <td style="width: 300px;">
                                <?php echo $room_desc; ?>

                            </td>
                            <td>
                                <?php echo $room_price; ?>
                            </td>
                            <td>
                                <?php 
                                
                                $sql = "SELECT room_feature.*, feature.name FROM room_feature INNER JOIN feature ON room_feature.feature_id=feature.id WHERE room_feature.room_type_id = '$room_type_id' ";
                                $query = $conn->query($sql);    
                                    
                                while($row = $query->fetch_assoc()){
                                    
                            ?>
                                
                                    <li class="col">
                                        <?php echo $row['name']; ?>
                                    </li>
                                  
                                   
                            <?php
                                }
        
                            ?>

                            </td>
                            <td>
                                <form action="booking.php?id=<?php echo $room_id; ?>" method="POST">

                               
                                    <span><input type="submit" class="btn btn-primary" value="Book Now"></span>
                                </form>
                            </td>
                            
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