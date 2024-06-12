<?php

    // session_start();
    // include('./db/dbConnection.php');

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

    <?php 

        if(isset($_SESSION['count_error'])){
        ?>
            select#adultCount,
            select#childrenCount{
                border-color: red;
            }
        <?php
            unset($_SESSION['count_error']);
        }else{
        ?>
            select#adultCount,
                select#childrenCount{
                border-color: #ced4da;
            }
            <?php
        }

        if(isset($_SESSION['date_error'])){
            ?>
                input#inputCheckIn,
                input#inputCheckOut{
                    border-color: red;
                    color: red;
                }
            <?php
                unset($_SESSION['date_error']);
            }else{
            ?>
                input#inputCheckIn,
                input#inputCheckOut{
                    border-color: #ced4da;
                    color: #666565;
                }
                <?php
            }
    
    ?>
   
</style>

<body>
    


        <!-- Booking Start -->
        <div class="container-fluid booking pb-5 wow fadeIn" data-wow-delay="0.1s">
            <div class="container">
                <div class="bg-white shadow" style="padding: 35px;">
                    <div class="row g-2">
                        <div class="col-md-10">
                            <form action="./backend/searched_data.php" method="post">
                                <div class="row g-2">
                                    
                                    <div class="col-md-3">
                                        <div class="form-group tm-form-element tm-form-element-50">
                                            <!-- <i class="fa fa-calendar fa-2x tm-form-element-icon"></i> -->
                                            <input name="check-in" style="background-color: white;" type="text" class="form-control" id="inputCheckIn" placeholder="Check In" required readonly>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group tm-form-element tm-form-element-50">
                                            <!-- <i class="fa fa-calendar fa-2x tm-form-element-icon"></i> -->
                                            <input name="check-out" style="background-color: white;" type="text" class="form-control" id="inputCheckOut" placeholder="Check Out" required readonly>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <select class="form-select" name="adult-count" id="adultCount">
                                            <option value="0">Adult</option>
                                            <option value="1">Adult 1</option>
                                            <option value="2">Adult 2</option>
                                            <option value="3">Adult 3</option>
                                            <option value="4">Adult 4</option>
                                            <option value="5">Adult 5</option>
                                        </select>
                                    </div>
                                    <div class="col-md-3">
                                        <select class="form-select" name="children-count" id="childrenCount">
                                            <option value="0">Child</option>
                                            <option value="1">Child 1</option>  
                                            <option value="2">Child 2</option>
                                            <option value="3">Child 3</option>
                                            <option value="4">Adult 4</option>
                                            <option value="5">Adult 5</option>
                                        </select>
                                    </div>
                                
                                </div>
                           
                        </div>
                        <div class="col-md-2">
                            <input type="submit" name="searchBtn" class="btn btn-primary w-100" value="Submit">
                        </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- Booking End -->
        </div>

       
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
            var inputElement = document.getElementById('inputCheckIn');
            inputElement.value = "<?php echo $_SESSION['check_in_date']; ?>";
            var inputElement2 = document.getElementById('inputCheckOut');
            inputElement2.value = '<?php echo $_SESSION['check_out_date'] ?>';
            var inputElement3 = document.getElementById('adultCount');
            inputElement3.value = '<?php echo $_SESSION["adult_count"] ?>';

            var inputElement4 = document.getElementById('childrenCount');
            inputElement4.value = '<?php echo $_SESSION["children_count"] ?>';



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