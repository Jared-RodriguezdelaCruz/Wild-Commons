<?php

$include = require_once("conection.php");

if($include){
    $sql = "SELECT 
                l.idLog,
                l.userId,
                r.name AS resource_name,
                l.entry_date,
                l.exit_date
            FROM 
                Log AS l
            JOIN 
                Resource AS r ON l.resourceId = r.idResource";
    $result = mysqli_query($con, $sql);
    
    if($result){
        while($row = mysqli_fetch_assoc($result)){
            $idLog = $row['idLog'];
            $idUser = $row['userId'];
            $resourceName = $row['resource_name'];
            $entry_date = $row['entry_date'];
            $exit_date = $row['exit_date'];      
            ?>

            <tr>
                <td><?php echo $idLog?></td>
                <td><?php echo $idUser?></td>
                <td><?php echo $resourceName?></td>
                <td><?php echo $entry_date?></td>
                <td><?php echo $exit_date?></td>
            </tr>
            <?php
        }
    }
} else {
    echo "Error connecting to the database.";
}

?>