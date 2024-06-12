<?php 
    
    require_once('../db/dbConnection.php');
 
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

    <style>

        .offcanvas{
            width: 270px !important;
            background-color: #222831;
            color: white;
        }
        @media(min-width: 992px) {
            .offcanvas-start {
                visibility: visible !important;
                transform: translateX(0) !important;
            }
            .btn-collapse,
            .btn-close{
                display: none;
            }
            .main-container{
                margin-left: 270px !important;
                height: fit-content;
            }
            
        }
        .offcanvas-backdrop {
        display: none;
        }

        .dashboard-card {
      border: none;
      border-radius: 10px;
      /* box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); */
      transition: transform 0.3s ease;
    }

    .dashboard-card:hover {
      transform: translateY(-5px);
    }

    .dashboard-card .card-body {
      display: flex;
      align-items: center;
      justify-content: space-between;
    }

    .dashboard-card .icon {
      font-size: 3rem;
      color: #4e73df;
    }

    .dashboard-card .details {
      text-align: right;
    }

    .dashboard-card .details .number {
      font-size: 2rem;
      font-weight: bold;
    }

    .dashboard-card .details .label {
      font-size: 1rem;
      color: #6c757d;
    }

    @media (max-width: 768px) {
      .dashboard-card .card-body {
        flex-direction: column;
        text-align: center;
      }

      .dashboard-card .icon {
        margin-bottom: 1rem;
      }

      .dashboard-card .details {
        text-align: center;
      }
    }

    .nav-list {
      list-style: none;
      padding: 0;
      margin: 0;
    }

    .nav-list li {
      margin: 10px 0;
    }

    .nav-list a {
      display: block;
      padding: 10px 20px;
      text-decoration: none;
      color: #333;
      background-color: #f8f9fa;
      border-radius: 5px;
      transition: background-color 0.3s, color 0.3s;
    }

    .nav-list a:hover {
      background-color: #4e73df;
      color: #fff;
    }

    </style>

 <body>
    
   

    
    

    <div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasExample" aria-labelledby="offcanvasExampleLabel">
    <div class="offcanvas-header">
        <h5 class="offcanvas-title" id="offcanvasExampleLabel">Haven</h5>
        <button type="button" class="btn-close text-reset bg-light" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body">
       <ul class="nav-list">
        <li>
            <a href="index.php">Dashboard</a>
        </li>
        <li>
            <a href="add-room-type.php">New Room Type</a>
        </li>
        <li>
            <a href="room-types.php">Room Types</a>
        </li>
        <li>
            <a href="check-in.php">Check In</a>
        </li>
        <li>
            <a href="check-out.php">Check Out</a>
        </li>

        <li>
            <a href="cleaning_time.php">Cleaned</a>
        </li>


        <li>
            <a href="canceled.php">Canceled</a>
        </li>
        
        
       </ul>
        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
            <li><a class="dropdown-item" href="#">Action</a></li>
            <li><a class="dropdown-item" href="#">Another action</a></li>
            <li><a class="dropdown-item" href="#">Something else here</a></li>
        </ul>
        </div>
    </div>
    </div>
    <div class="main-container shadow">
        <div class="d-flex align-items-center">
            <button class="btn btn-primary btn-collapse m-2" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasExample" aria-controls="offcanvasExample">
                <i class='fa fa-bars'></i>
            </button>
            <nav class="navbar navbar-expand-lg navbar-white bg-white">
                <div class="container-fluid">
                    <a class="navbar-brand" href="#"><h2 class="text-dark">Haven Hotel Admin</h2></a>
                    <?php include('hour.php'); ?>
                    <!-- <a href="check-in.php" class="btn btn-primary">Check</a> -->
                    </div>
                </div>
            </nav>
        </div>
       
    </div>
    
 </body>
 </html>