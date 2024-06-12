<?php 

    date_default_timezone_set('Asia/Manila');
    require_once('../db/dbConnection.php');

    $dateTime = new DateTime();
    // Get the current date in the desired format
    $currentDate = $dateTime->format('Y-m-d');
    $fixedTime = '12:00:00';
    $currentTime = $dateTime->format('H:i:s');
    $sql = "SELECT booking.*, booking.id AS booking_id, room.id, room.room_number, room_type.room_type, user.email FROM booking INNER JOIN room ON booking.room_id = room.id INNER JOIN room_type ON room_type.id = room.room_type INNER JOIN user ON booking.user_id = user.id HAVING booking.check_out = '$currentDate' AND '$currentTime' >= booking.check_out_time AND '$currentTime' <='12:30:00' ";
    $query = $conn->query($sql);

 
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
    <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css">
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap5.min.js"></script>
</head>

    <style>
        form input{
            margin-bottom: 20px !important;
        }
    </style>

 <body>
    
    <?php include('sidebar.php'); ?>
    <?php include('hour.php'); ?>
    <div class="main-container mt-5">
        <div class="container table-responsive">
            <table id="table1" class="table table-striped bg-white shadow" style="width: 100%;">
                <thead>
                    <tr>
                        <th>Room</th>
                        <th>Room Number</th>
                        <th>Customer</th>
                        <th>Check In</th>
                        <th>Check Out</th>
                        <th>Booking Date</th>
                        <th>Total</th>
                        
                        <th>Guest Count</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 

                        while($row = $query->fetch_assoc()){

                    ?>
                            <tr>
                                <td> <?php echo $row['room_type']; ?> </td>
                                <td><b> <?php echo $row['room_number']; ?> </b></td>
                                <td> <?php echo $row['email']; ?> </td>
                                <td><b> <?php echo $row['check_in']; ?> </b></td>
                                <td><b> <?php echo $row['check_out']; ?> </b></td>
                                <td> <?php echo $row['booking_date']; ?> </td>
                                <td> <?php echo $row['total_price']; ?> </td>
                                
                                <td> <?php echo $row['guest_count']; ?> </td>
                                <td><a href="../backend/check-out.php?id=<?php echo $row['booking_id']; ?>" class="btn btn-sm btn-success">Check Out</a></td>
                            </tr>
                    <?php
                        }
                    
                    ?>
                    
                </tbody>
            </table>
        </div>
        
    </div>
    
    <script>
        new DataTable('#table1');
    </script>

 </body>
 </html>