
<?php

$serverName = "localhost";
$username = "root";
$password = "";
$dbName = "hotel_db";

// mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);  

$conn = new mysqli($serverName,$username,$password,$dbName);


  if($conn->connect_error){
    die("Connection Failed: " . $conn->connect_error);
  }

    //   echo "<div class='alert alert-primary h-40' role='alert' style='background-color: grey; border: 1px solid gray; color: white;'>
    //   Database Connection Success!
    // </div>";
    // $conn->close();
?>