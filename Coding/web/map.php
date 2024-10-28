<?php
$include = require_once("conection.php");

if ($include) {
    $sql = "SELECT idResource, status FROM Resource";
    $result = mysqli_query($con, $sql);

    $resources = [];

    if ($result->num_rows > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $resources[$row['idResource']] = $row['status'];
        }
    }

    // Devuelve los recursos en formato JSON
    echo json_encode($resources);
} else {
    echo json_encode(["error" => "Error connecting to the database."]);
}
?>
