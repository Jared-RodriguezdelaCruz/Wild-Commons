<?php

$include = require_once("conection.php");

if ($include) {
    if (isset($_POST['id']) && isset($_POST['status'])) {
        $id = $_POST['id'];
        $status = $_POST['status'];

        // Escapar variables para evitar inyecciones SQL
        $id = mysqli_real_escape_string($con, $id);
        $status = mysqli_real_escape_string($con, $status);

        $sql = "UPDATE complaint SET status = '$status' WHERE idComplaint = '$id'";
        if (mysqli_query($con, $sql)) {
            echo "Estado actualizado.";
        } else {
            echo "Error: " . mysqli_error($con);
        }
    } else {
        echo "ID o estado no proporcionados.";
    }
} else {
    echo "Error connecting to the database.";
}

?>