<?php 
    
    require_once('../db/dbConnection.php');
    $room_type_id = $_GET['id'];
    $sql = "SELECT id, room_type, description FROM room_type WHERE id = $room_type_id";
    $query = $conn->query($sql);
    $room_type = $query->fetch_assoc();

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
            <form action="../backend/add-image.php" method="POST" enctype="multipart/form-data" class="bg-white shadow p-4">
                <h3>Add New Room Image</h3>
               
                <input type="hidden" name="room-type-id" value="<?php echo $room_type['id'] ?>" placeholder="Room Name" class="form-control">

                <label for="">Room Name:</label>
                <input type="text" style="background-color: white;" name="room-name" value="<?php echo $room_type['room_type'] ?>" placeholder="Room Name" class="form-control" readonly>

                <label for="">Description:</label>
                <textarea name="" id="" style="background-color: white;" class="form-control mb-4" readonly><?php echo $room_type['description'] ?> </textarea>
                <!-- <input type="text" name="description" value="<?php echo $room_type['description'] ?>" placeholder="Description" class="form-control"> -->

                
                <label for="">Image</label>
                <input type="file" name="image" id="" class="form-control" required>
               
                
                <input type="submit" name="add-btn" value="Add Image" class="btn btn-primary">
            </form>
            
        </div>
        
    </div>

    <script>
        $('#addGuest').click(function() {
                $('#guestFields').append('<div><label for="name">New Room:</label><input type="text" class="form-control" name="guests[]" id="name"></div>');
            });
    </script>
    
 </body>
 </html>

