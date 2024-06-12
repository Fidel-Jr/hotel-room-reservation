 <?php 
    
    require_once('../db/dbConnection.php');
    date_default_timezone_set('Asia/Manila');

 ?>
 
 <!DOCTYPE html>
 <html lang="en">
 <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet"> 
</head>
 <body>
    
    <?php include('sidebar.php'); ?>
    <div class="main-container mt-5">
        <div class="container">
        <div class="row">
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="card dashboard-card shadow">
                    <div class="card-body">
                        <div class="icon">
                        <i class="fas fa-list"></i>
                        </div>
                        <div class="details">
                        <?php 
                            
                            $sql = "SELECT * FROM room_type";
                            $query = $conn->query($sql);
                            $total = $query->num_rows;

                        ?>
                        <div class="number"><?php echo $total; $conn->close();?></div>
                        
                        <div class="label">Total Room Type</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="card dashboard-card shadow">
                    <div class="card-body">
                        <div class="icon">
                        <i class="fas fa-hotel"></i>
                        </div>
                        <div class="details">
                        <?php 
                            include('../db/dbConnection.php');
                            $sql = "SELECT * FROM room";
                            $query = $conn->query($sql);
                            $total = $query->num_rows;

                        ?>
                        <div class="number"><?php echo $total;  ?></div>
                        <div class="label">Total Rooms</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="card dashboard-card shadow">
                    <div class="card-body">
                        <div class="icon">
                        <i class="fas fa-clock"></i>
                        </div>
                        <div class="details">
                        <?php 
                            include('../db/dbConnection.php');
                            $sql = "SELECT * FROM booking";
                            $query = $conn->query($sql);
                            $total = $query->num_rows;

                        ?>
                        <div class="number"><?php echo $total;  ?></div>
                        <div class="label">Total Room Reserved</div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- <div class="col-lg-4 col-md-6 mb-4">
                <div class="card dashboard-card shadow">
                    <div class="card-body">
                        <div class="icon">
                        <i class="fas fa-check"></i>
                        </div>
                        <div class="details">
                        <?php 
                            include('../db/dbConnection.php');
                            // Get the current date in the desired format
                            $sql = "CALL total_check_out()";
                            $query = $conn->query($sql);
                            $total = $query->fetch_assoc();
                            
                        ?>
                        <div class="number"><?php echo $total['total']; ?></div>
                        <div></div>
                        <div class="label">Total Check Out Today</div>
                        </div>
                    </div>
                </div>
            </div> -->
        </div>
    </div>
 </body>
 </html>