<?php
// Set time zone
date_default_timezone_set('America/New_York');

// Get the current hour
$currentHour = date('G');

// Define working hours
$openingHour = 7;
$closingHour = 21;

// Determine the status
$status = ($currentHour >= $openingHour && $currentHour < $closingHour) ? 'We are open!' : 'We are closed.';
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Working Hours</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      text-align: start;
    }
    #time {
      font-size: 1em;
      color: red;
    }
    #status {
      font-size: 1.5em;
      color: green;
    }
    
  </style>
</head>
<body>

    <div class="main-container">
        <div class="container">
            <div id="time"></div>
            <!-- <div id="status"></div> -->
        </div>
    </div>
  

  <script>
    function updateTime() {
      const now = new Date();
      const hours = now.getHours().toString().padStart(2, '0');
      const minutes = now.getMinutes().toString().padStart(2, '0');
      const seconds = now.getSeconds().toString().padStart(2, '0');

      // Display current time
      document.getElementById('time').innerText = "Current Time: " + `${hours}:${minutes}:${seconds}`;

      // Define working hours (e.g., 9 AM to 5 PM)
      const openingHour = 9;
      const closingHour = 21;

      // Check if current time is within working hours
      if (now.getHours() >= openingHour && now.getHours() < closingHour) {
        document.getElementById('status').innerText = 'We are open!';
        document.getElementById('status').style.color = 'green';
      } else {
        document.getElementById('status').innerText = 'We are closed.';
        document.getElementById('status').style.color = 'red';
      }
    }

    // Update time every second
    setInterval(updateTime, 1000);

    // Initial call to display time immediately
    updateTime();
  </script>
</body>
</html>