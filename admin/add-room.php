<?php 
    
    require_once('../db/dbConnection.php');
    $room_type_id = $_GET['id'];
    $sql = "SELECT room_type.*, COUNT(room.id) as total_room FROM room INNER JOIN room_type ON room.room_type = room_type.id WHERE room.room_type = '$room_type_id' ";
    $query = $conn->query($sql);
    $row = $query->fetch_assoc();
   
    $sql2 = "SELECT * FROM room_type WHERE id = '$room_type_id' ";
    $query2 = $conn->query($sql2);
    $row2 = $query2->fetch_assoc();
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
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>

    <style>
        form input{
            margin-bottom: 20px !important;
        }
    </style>

 <body>
    
    <?php include('sidebar.php'); ?>

    <div class="main-container mt-4">
        <div class="container p-4">
            <form action="../backend/add-room.php" method="POST" enctype="multipart/form-data" class="bg-white shadow p-4">
                <h3>Add New Room Type</h3>
                <input type="hidden" name="room-type-id" value="<?php echo $row2['id'] ?>" placeholder="Room Name" class="form-control">

                <label for="">Room Name:</label>
                <input type="text" name="room-name" value="<?php echo $row2['room_type'] ?>" placeholder="Room Name" class="form-control"  style="background-color: white;" readonly>

                <label for="">Description:</label>
                <textarea name="description" id="" class="form-control mb-4"  style="background-color: white;" readonly><?php echo $row2['description'] ?></textarea>

                <label for="">Number of Bed:</label>
                <input type="number" name="bed-count" value="<?php echo $row2['bed'] ?>" placeholder="Number of Bed" class="form-control"  style="background-color: white;" readonly>

                <label for="">Price:</label>
                <input type="text" name="price" value="<?php echo $row2['price'] ?>" placeholder="Price" class="form-control"  style="background-color: white;" readonly>
                
                <label for="">Total Rooms:</label>
                <input type="number" value="<?php echo $row['total_room'] ?>" class="form-control"  style="background-color: white;" readonly>

               
                <label for="name1">New Room:</label>
                <input type="number" name="room" id="name1" class="form-control" required>
            
                
                <input type="submit" name="add-btn" value="Submit" class="btn btn-primary">
            </form>
        </div>
        
    </div>


    
 </body>
 </html>

