<?php

$include = require_once("conection.php");

if($include){
    $sql = "SELECT 
                c.idComplaint,
                c.userId,
                r.name AS resource_name,
                c.date,
                c.description,
                c.status
            FROM 
                Complaint AS c
            JOIN 
                Resource AS r ON c.resourceId = r.idResource";
    $result = mysqli_query($con, $sql);
    
    if($result){
        while($row = mysqli_fetch_assoc($result)){
            $idComplaint = $row['idComplaint'];
            $idUser = $row['userId'];
            $resourceName = $row['resource_name'];
            $date = $row['date'];
            $description = $row['description'];      
            $status = $row['status'];      
            ?>

            <tr>
                <td id="$idComplaint"><?php echo $idComplaint?></td>
                <td><?php echo $idUser?></td>
                <td><?php echo $resourceName?></td>
                <td><?php echo $date?></td>
                <td><?php echo $description; ?></td>
                <td><?php echo $status?></td>
                <td>
                    <input type="checkbox" 
                        class="complaintCheckbox" 
                        data-id="<?php echo $idComplaint; ?>" 
                        <?php echo ($status == 'Resolved') ? 'checked' : ''; ?>>
                </td>
            </tr>
            <?php
        }
    }
} else {
    echo "Error connecting to the database.";
}

?>