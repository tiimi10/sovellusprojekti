<!DOCTYPE html>
<html>
<body>

<?php

/* 
 * Page where is users devices and information about them
 */
 
            
    echo "Devices:<br>";

        foreach ($devices as $row)
            {
                echo " $row->nickname"; 
                echo " ";
                echo "<a href='/index.php/tracker/selectDevice/?idDev=$row->deviceID'>Show on map</a>";
                echo " ";
                echo "<a href='/index.php/tracker/selectDevice/?idDev=$row->deviceID'>Mark as stolen</a> <br> ";
            }
    
?>
    
<p>
</body>
</html>
                                                    
                                                        
                                                        
                                                        
                                                        
                                                        
                                                        
                                                        
                                                        
                                                        
                                                        
                                                        
                                                        
                                                        
                                                        
                                                        