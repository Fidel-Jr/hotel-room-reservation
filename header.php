<?php

    // session_start();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    
<div class="container-xxl bg-white p-0">
        <!-- Spinner Start -->
        <div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
            <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div>
        <!-- Spinner End -->

        <!-- Header Start -->
        <div class="container-fluid bg-dark px-0">
            <div class="row gx-0">
                <div class="col-lg-3 bg-dark d-none d-lg-block">
                    <a href="index.php" class="navbar-brand w-100 h-100 m-0 p-0 d-flex align-items-center justify-content-center">
                        <h1 class="m-0 text-primary text-uppercase">Haven</h1>
                    </a>
                </div>
                <div class="col-lg-9">
                    <!-- <div class="row gx-0 bg-white d-none d-lg-flex">
                        <div class="col-lg-7 px-5 text-start">
                            <div class="h-100 d-inline-flex align-items-center py-2 me-4">
                                <i class="fa fa-envelope text-primary me-2"></i>
                                <p class="mb-0">info@example.com</p>
                            </div>
                            <div class="h-100 d-inline-flex align-items-center py-2">
                                <i class="fa fa-phone-alt text-primary me-2"></i>
                                <p class="mb-0">+012 345 6789</p>
                            </div>
                        </div>
                        <div class="col-lg-5 px-5 text-end">
                            <div class="d-inline-flex align-items-center py-2">
                                <a class="me-3" href=""><i class="fab fa-facebook-f"></i></a>
                                <a class="me-3" href=""><i class="fab fa-twitter"></i></a>
                                <a class="me-3" href=""><i class="fab fa-linkedin-in"></i></a>
                                <a class="me-3" href=""><i class="fab fa-instagram"></i></a>
                                <a class="" href=""><i class="fab fa-youtube"></i></a>
                            </div>
                        </div>
                    </div> -->
                    <nav class="navbar navbar-expand-lg bg-dark navbar-dark p-3 p-lg-0">
                        <a href="index.html" class="navbar-brand d-block d-lg-none">
                            <h1 class="m-0 text-primary text-uppercase">Haven</h1>
                        </a>
                        <button type="button" class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
                            <span class="navbar-toggler-icon"></span>
                        </button>
                        <div class="collapse navbar-collapse justify-content-between" id="navbarCollapse">
                            <div class="navbar-nav mr-auto py-0">
                                <a href="index.php" class="nav-item nav-link active">Home</a>
                                <a href="all-rooms.php" class="nav-item nav-link">Rooms</a>
                                <div class="nav-item dropdown">
                                    <!-- <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">Pages</a> -->
                                    <div class="dropdown-menu rounded-0 m-0">
                                        
                                    </div>
                                </div>
                                
                                <?php 

                                    if(isset($_SESSION['email'])){


                                ?>
                                        <div class="nav-item dropdown mx-lg-4">
                                            <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">Profile</a>
                                            <div class="dropdown-menu rounded-0 m-0">
                                                <a href="my-booking.php" class="dropdown-item">My Booking</a>
                                                <a href="booking-history.php" class="dropdown-item">Booking History</a>
                                                <a href="edit-profile.php" class="dropdown-item">Edit Profile</a>
                                                <a href="./backend/logout.php" class="dropdown-item">Logout</a>
                                            </div>
                                        </div>
                                <?php 
                                    } else{

                                        ?>
                                            <ul class="navbar-nav me-auto mb-2 mb-lg-0 mx-lg-4">
                                                <li class="nav-item">
                                                <a class="nav-link" aria-current="page" href="signup.php">Register</a>
                                                </li>
                                                <li class="nav-item">
                                                <a class="nav-link" href="login.php">Login</a>
                                                </li>
                                            </ul>
                                        <?php
                                        }

                                ?>
                               
                            </div>

                            </div>
                            
                            
                            <!-- <a href="https://htmlcodex.com/hotel-html-template-pro" class="btn btn-primary rounded-0 py-4 px-md-5 d-none d-lg-block">Premium Version<i class="fa fa-arrow-right ms-3"></i></a> -->
                        </div>
                    </nav>
                </div>
            </div>
        </div>
        <!-- Header End -->

</body>
</html>


