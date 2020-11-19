<!DOCTYPE html>
<html>
<body>

<?php

/* 
 * Page where is users and information about them
 */

    echo "<table border='1'>
    <tr>   
    <th>Location history:</th>
    <tr>
    <tr>
        <th>Location ID</th>
        <th>Date and time</th>
        <th>trackId</th>
        <th>Location</th>

        </tr>";

        foreach ($locations as $row)
            {
                echo "<tr>";
                echo "<td> $row->logID </td>";
                echo "<td> $row->logDateTime </td>";
                echo "<td> $row->trackID </td>"; 
                echo "<td> $row->location </td>";
                echo "</tr>";
            }
            
    
?>
    
<p>
</body>
</html>
                                                    
                                                        
                                                        
                                                        
                                                        
                                                        
                                                        
                                                        
                                                        
                                                        
                                                        
                                                        
                                                        
                                                        
                                                        
                                                        