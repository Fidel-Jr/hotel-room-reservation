<?php 

    include "./sessions/sessionCheck.php";

    if(!isset($_SESSION['email'])){
        header('Location: index.php');
    }

    if(isset($_POST["update_btn"])){
        $new_username = $_POST["username"];
        $new_email = $_POST["email"];
        $new_fullname = $_POST["fullname"];
        $new_gender = $_POST["gender"];
        $new_phone = $_POST["phone"];
        $new_address = $_POST["address"];
        $new_dob = $_POST["dob"];

        $sql = "UPDATE user SET username = '$new_username', email = '$new_email', fullname = '$new_fullname', 
                gender = '$new_gender', phone_number = '$new_phone', address = '$new_address', dob = '$new_dob'
                WHERE id = '$user->id' ";
        $query = $conn->query($sql);
        if($query){
            $_SESSION['update-profile-success'] = "You have changed your profile.";  
            header('Location: edit-profile.php');
        } else {
            echo "Error";
        }

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
</head>

<body>

    <?php 
        include('./header.php');
    ?>


         <div class="container-fluid page-header mb-5 p-0" style="background-image: url(img/carousel-1.jpg);">
            <div class="container-fluid page-header-inner py-5">
                <div class="container text-center pb-5">
                    <h1 class="display-3 text-white mb-3 animated slideInDown">Profile</h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb justify-content-center text-uppercase">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item"><a href="#">Pages</a></li>
                            <li class="breadcrumb-item text-white active" aria-current="page">Profile</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>


        <div class="container-xxl py-5">
            <div class="container">
                
                <form action="<?php htmlspecialchars($_SERVER["PHP_SELF"]) ?>" method="post">
                    <?php 
                        
                        if(isset($_SESSION['update-profile-success'])){
                            echo "<p class='text-success'> " . $_SESSION['update-profile-success'] ."</p>";
                            unset($_SESSION['update-profile-success']);
                        }
                        
                    ?>
                    <label for="">Fullname</label>
                    <input type="text" class="form-control" name="fullname" value="<?php echo $user->fullname; ?>" required>
                    <label for="">Username</label>
                    <input type="text" class="form-control" name="username" value="<?php echo $user->username; ?>" required>
                    <label for="">Email</label>
                    <input type="email" class="form-control" name="email" value="<?php echo $user->email; ?>" required>
                    <label for="">Gender</label>
                    <select name="gender" id="" class="form-select">
                    <option value="<?php echo $user->gender; ?>" selected><?php echo $user->gender; ?></option>
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                    </select>
                    <label for="">Phone</label>
                    <input type="text" class="form-control" name="phone" value="<?php echo $user->phone_number; ?>">
                    <label for="">Address</label>
                    <input type="text" class="form-control" name="address" value="<?php echo $user->address; ?>">
                    <label for="">Area</label>
                    <label for="">Date of Birth</label>
                    <input type="date" class="form-control" name="dob" value="<?php echo $user->dob; ?>">
                    <input type="submit" value="Update" class="btn btn-primary mt-3" name="update_btn">
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