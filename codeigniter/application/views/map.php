<!DOCTYPE html>
<html>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="/application/css/w3.css">
<body>
<div class="w3-container w3-padding-12">
  <a href=<?php echo $link ?> class=" w3-bar-item w3-button w3-padding"><?php echo $message ?></a>
</div>
<div class="w3-container w3-padding-12" id="map">
  <?php 
    echo $map['js']; 
    echo $map['html'];
  ?>
</div>

</body>
</html>