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
        form input{
            margin-bottom: 20px !important;
        }
    </style>

 <body>
    
    <?php include('sidebar.php'); ?>

    <div class="main-container mt-4">
        <div class="container p-4">
            <form action="../backend/add-room-type.php" method="POST" enctype="multipart/form-data" class="bg-white shadow p-4">
                <h3>Add New Room Type</h3>
                <label for="">Room Name:</label>
                <input type="text" name="room-name" placeholder="Room Name" class="form-control" required>

                <label for="">Description:</label>
                <input type="text" name="description" placeholder="Description" class="form-control" required>

                <label for="">Number of Bed:</label>
                <input type="number" name="bed-count" placeholder="Number of Bed" class="form-control" required>

                <label for="">Number of Bathroom:</label>
                <input type="number" name="bathroom-count" placeholder="Number of Bathroom" class="form-control" required>

                <label for="">Floor Number:</label>
                <input type="number" name="floor-number" placeholder="Floor Number" class="form-control" required>

                <label for="">Price:</label>
                <input type="text" name="price" placeholder="Price" class="form-control" required>

                <label for="">Adult Capacity:</label>
                <input type="number" name="adult-capacity" placeholder="Adult Capacity" class="form-control" required>

                <label for="">Children Capacity:</label>
                <input type="number" name="children-capacity" placeholder="Children Capacity" class="form-control" required>

                <label for="">Maximum Capacity:</label>
                <input type="number" name="maximum-capacity" placeholder="Maximum Capacity" class="form-control" required>

                <label for="">Image</label>
                <input type="file" name="image" id="" class="form-control" required>

                <input type="submit" name="add-btn" value="Add" class="btn btn-primary">
            </form>
        </div>
        
    </div>
    
 </body>
 </html>