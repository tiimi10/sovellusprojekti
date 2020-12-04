<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html>
<title>Tracker</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="/application/third_party/w3.css">
<body>

<!--navbar-->
<div class="w3-top">
  <div class="w3-bar w3-white w3-wide w3-padding w3-card">
    <a class="w3-bar-item"> Tracker</a>
    <!-- Float links to the right. Hide them on small screens -->
    <div class="w3-right">
      <a href="#about" class="w3-bar-item w3-button">About</a>
      <a href="/index.php/main/logout" class="w3-bar-item w3-button">Log out</a>
    </div>
  </div>
</div>

<!-- Page content -->
<div class="w3-content w3-padding" style="max-width:1564px">

  <!-- Device Section -->
  <div class="w3-container w3-padding-32" id="devices">
    <h3 class="w3-border-bottom w3-border-light-grey w3-padding-16">Welcome back <?php echo $_SESSION['name']; ?></h3>
  </div>
  <div class="w3-container w3-padding-12" id="projects">
    <h3 class="w3-border-bottom w3-border-light-grey w3-padding-16">Your devices</h3>
  </div>

  <div class="w3-row-padding">
    <?php
    foreach ($devices as $row)
    {?>
      <div class="w3-col 13 m6 w3-margin-bottom">
        <div class="w3-display-container w3-gray" style="min-width:200px" style="max-width:300px">
          <div class="w3-black w3-padding"><?php echo " $row->nickname"; ?></div>
          <div class="w3-padding-36">
            <a href=<?php echo "/index.php/tracker/selectDevice/?idDev=$row->deviceID"; ?> class=" w3-bar-item w3-button w3-padding">Show on map</a>
          </div>
          <div class="w3-padding-36">
            <a href="#about" class=" w3-bar-item w3-button w3-padding">Mark as stolen</a>
          </div>
          <div class="w3-padding-36">
            <a href="#about" class=" w3-bar-item w3-button w3-padding">Show location history</a>
          </div>
        </div>
      </div>
    <?php
    }?>
    
<p>
</body>
</html>
                                                    
                                                        
                                                        
                                                        
                                                        
                                                        
                                                        
                                                        
                                                        
                                                        
                                                        
                                                        
                                                        
                                                        
                                                        
                                                        