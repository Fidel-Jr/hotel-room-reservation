<?php 

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
    <link rel="stylesheet" type="text/css" href="css/datepicker.css"/>
</head>

<body>

    <?php 
        include('header.php');
    ?>

        
        <div class="container-fluid page-header mb-5 p-0" style="background-image: url(img/carousel-1.jpg);">
            <div class="container-fluid page-header-inner py-5">
                <div class="container text-center pb-5">
                    <h1 class="display-3 text-white mb-3 animated slideInDown">Login</h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb justify-content-center text-uppercase">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item"><a href="#">Pages</a></li>
                            <li class="breadcrumb-item text-white active" aria-current="page">Login</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>


        <div class="container-xxl py-5">
            <div class="container">
                <?php 
                    if(isset($_SESSION['reg_sess_succ'])){
                        echo "<p class='text-success'> " . $_SESSION['reg_sess_succ'] ."</p>";
                        unset($_SESSION['reg_sess_succ']);
                    }
                    if(isset($_SESSION['login_error'])){
                        echo "<p class='text-danger'> " . $_SESSION['login_error'] ."</p>";
                        unset($_SESSION['login_error']);
                    }
                
                ?>
                <form action="./backend/check-login.php" method="post">
                    <label for="">Email</label>
                    <input type="email" class="form-control" name="email" required>
                    <label for="">Password</label>
                    <input type="password" class="form-control" name="password" required>
                    <div class="mt-3">
                        <a href="signup.php" style="color: #355aeb;">Don't have an account yet?</a>
                    </div>
                    <input type="submit" value="Log In" class="btn btn-primary mt-3" name="login_btn">
                    
                </form>
                
                
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

    <script src="js/datepicker.min.js"></script>
                       


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