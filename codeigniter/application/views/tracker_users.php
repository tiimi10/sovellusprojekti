<!DOCTYPE html>
<html>
<body>

<?php

/* 
 * Page where is users and information about them
 */

    echo "<table border='1'>
    <tr>   
    <th>Users:</th>
    <tr>
    <tr>
        <th>User ID</th>
        <th>First name</th>
        <th>Last name</th>
        <th>Email</th>
        <th>Phonenumber</th>

        </tr>";

        foreach ($users as $row)
            {
                echo "<tr>";
                echo "<td> $row->userID </td>";
                echo "<td> $row->name </td>";
                echo "<td> $row->lastname </td>"; 
                echo "<td> $row->email </td>";
                echo "<td> $row->phonenumber </td>";
                echo "</tr>";
            }
            
    
?>
    
<p>
</body>
</html>
                                                    
                                                        
                                                        
                                                        
                                                        
                                                        
                                                        
                                                        
                                                        
                                                        
                                                        
                                                        
                                                        
                                                        
                                                        
                                                        