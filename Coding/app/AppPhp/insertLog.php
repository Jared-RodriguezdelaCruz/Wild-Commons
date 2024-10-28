<?php

require_once 'conection.php';

$idUser = $_POST['idUser'];
$idResource = $_POST['idResource'];
$entry = $_POST['entry'];

// Inserta los datos en la base de datos
$sql = "INSERT INTO log (userId, resourceId, entry_date) 
VALUES ('$idUser', '$idResource', '$entry')";

if ($con->query($sql) === TRUE) {
    echo "Registro exitoso";
} else {
    echo "Error: " . $sql . "<br>" . $con->error;
}


$con->close();
?>