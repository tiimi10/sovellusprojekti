<!DOCTYPE html>
<html>
<body>

<?php

/* 
 * Page where is users devices and information about them
 */
 
            
    echo "<table border='1'>
    <tr>   
    <th>Devices:</th>
    <tr>
    <tr>
        <th>Device ID</th>
        <th>Owner ID</th>
        <th>Nickname</th>
        <th>DevEUI</th>

        </tr>";

        foreach ($devices as $row)
            {
                echo "<tr>";
                echo "<td> $row->deviceID </td>";
                echo "<td> $row->ownerID </td>";
                echo "<td> $row->nickname </td>"; 
                echo "<td> $row->registerName </td>";
                echo "</tr>";
            }
    
?>
    
<p>
</body>
</html>
                                                    
                                                        
                                                        
                                                        
                                                        
                                                        
                                                        
                                                        
                                                        
                                                        
                                                        
                                                        
                                                        
                                                        
                                                        
                                                        