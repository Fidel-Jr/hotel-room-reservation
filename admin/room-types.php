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

        .room-item {
        display: flex;
        flex-direction: column;
        height: 100%;
        }

        .room-item .p-4 {
            flex: 1;
        }
    </style>

 <body>
    
    <?php include('sidebar.php'); ?>

    <div class="main-container mt-4">
        <div class="container p-4">
            <div class="row g-4">
                <?php 

                    $sql = "SELECT * FROM room_type";
                    $query = $conn->query($sql);

                    while($row = $query->fetch_assoc()){
                        $room_id = $row['id'];
                        $feature = "SELECT feature.name FROM room_feature INNER JOIN feature ON 
                        room_feature.feature_id=feature.id INNER JOIN room_type ON 
                        room_feature.room_type_id = room_type.id 
                        WHERE room_feature.room_type_id = $room_id";
                        $query2 = $conn->query($feature);

                        $featureName = $query2->fetch_assoc();
                    
                    ?>

                    <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                    <div class="room-item shadow rounded overflow-hidden">
                        <div class="position-relative">
                            <img class="img-fluid" src="../img/<?php echo $row['image']; ?>" alt="">
                            <small class="position-absolute start-0 top-100 translate-middle-y bg-primary text-white rounded py-1 px-3 ms-4">₱<?php echo $row['price']; ?>/Night</small>
                        </div>
                        <div class="p-4 mt-2">
                            <div class="d-flex justify-content-between mb-3">
                                <h5 class="mb-0"><?php echo $row['room_type'] ?></h5>
                                <div class="ps-2">
                                <?php 
                                            if($row['rating'] == 0){
                                        ?>
                                            <small class="fa fa-star"></small>
                                            <small class="fa fa-star"></small>
                                            <small class="fa fa-star"></small>
                                            <small class="fa fa-star"></small>
                                            <small class="fa fa-star"></small>
                                        <?php
                                            }elseif($row['rating'] == 1){
                                        ?>
                                                <small class="fa fa-star text-primary"></small>
                                                <small class="fa fa-star"></small>
                                                <small class="fa fa-star"></small>
                                                <small class="fa fa-star"></small>
                                                <small class="fa fa-star"></small>
                                        <?php
                                            
                                            }elseif($row['rating'] == 2){
                                        ?>
                                                <small class="fa fa-star text-primary"></small>
                                                <small class="fa fa-star text-primary"></small>
                                                <small class="fa fa-star"></small>
                                                <small class="fa fa-star"></small>
                                                <small class="fa fa-star"></small>
                                        <?php
                                            }elseif($row['rating'] == 3){

                                        ?>
                                                <small class="fa fa-star text-primary"></small>
                                                <small class="fa fa-star text-primary"></small>
                                                <small class="fa fa-star text-primary"></small>
                                                <small class="fa fa-star"></small>
                                                <small class="fa fa-star"></small>
                                        <?php
                                            }elseif($row['rating'] == 4){

                                        ?>
                                                <small class="fa fa-star text-primary"></small>
                                                <small class="fa fa-star text-primary"></small>
                                                <small class="fa fa-star text-primary"></small>
                                                <small class="fa fa-star text-primary"></small>
                                                <small class="fa fa-star"></small>
                                        <?php
                                            }else{

                                        ?>
                                                <small class="fa fa-star text-primary"></small>
                                                <small class="fa fa-star text-primary"></small>
                                                <small class="fa fa-star text-primary"></small>
                                                <small class="fa fa-star text-primary"></small>
                                                <small class="fa fa-star text-primary"></small>
                                        <?php
                                            }
                                        ?>
                                </div>
                            </div>
                            <div class="d-flex mb-3">
                                <small class="border-end me-3 pe-3"><i class="fa fa-bed text-primary me-2"></i> <?php echo $row['bed'] ?> Bed</small>
                                <small class="border-end me-3 pe-3"><i class="fa fa-bath text-primary me-2"></i> <?php echo $row['bathroom'] ?> Bath</small>
                                <?php 
                                    
                                    if(isset($featureName['name'])){
                                        
                                        if($featureName['name']=="Free Wifi"){
                                ?>
                                
                                    <small><i class="fa fa-wifi text-primary me-2"></i><?php echo $featureName['name']; ?></small>

                                <?php 
                                    } elseif($featureName['name']=="Private Pool"){

                                ?>

                                    <small><i class="fas fa-swimming-pool text-primary me-2"></i><?php echo $featureName['name']; ?></small>

                                <?php 
                                }
                                }

                                ?>
                                
                            </div>
                            <p class="text-body mb-3 description-paragraph"><?php echo $row['description']; ?></p>
                            <div class="d-flex justify-content-between">
                                <a class="btn btn-sm btn-primary rounded py-2 px-4" href="add-room.php?id=<?php echo $row['id']; ?>">Add Room</a>
                                <a class="btn btn-sm btn-dark rounded py-2 px-4" href="add-feature.php?id=<?php echo $row['id'];?>">Add Feature</a>
                            </div>
                            <div class="d-flex justify-content-center">
                                <a class="btn btn-sm btn-dark rounded py-2 px-4 mt-3" href="add-image.php?id=<?php echo $row['id'];?>">Add Room Image</a>
                            </div>
                            
                        </div>
                    </div>
                    </div>
                <?php 
                }   
                ?>
            </div>
        </div>
        
    </div>
    
 </body>
 </html>