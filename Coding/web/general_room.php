<?php

$include = require_once("conection.php");

$resources = [];

if ($include) {
    $sql = "SELECT idResource, name, resource_type, status, capacity FROM Resource";
    $result = mysqli_query($con, $sql);

    if ($result->num_rows > 0) {
        // Guardar los estados de cada recurso
        while ($row = mysqli_fetch_assoc($result)) {
            $resources[$row['idResource']] = [
                'name' => $row['name'], // Agregamos el nombre
                'type' => $row['resource_type'],
                'status' => $row['status'],
                'capacity' => $row['capacity']
            ];
        }
    } else {
        echo "No hay recursos en la base de datos.";
    }

    // Muestra la sala general
    $generalRoomId = 1; // Asumiendo que el ID de la sala general es 1
    $generalRoomStatusClass = 'gray'; // Estado por defecto

    // Verifica si la sala general está en la matriz y aplica la clase correspondiente
    if (isset($resources[$generalRoomId])) {
        if ($resources[$generalRoomId]['status'] == 'Busy') {
            $generalRoomStatusClass = 'red'; 
        } elseif ($resources[$generalRoomId]['status'] == 'Free') {
            $generalRoomStatusClass = 'green'; 
        }
    }

    ?>
    <!-- Primera columna: Sala General -->
    <div class="column">
        <div class="general-room resource <?php echo $generalRoomStatusClass; ?>" style="text-align: center; font-size: 16px;">
            <?php echo isset($resources[$generalRoomId]) ? $resources[$generalRoomId]['name'] : "Sala General"; ?>
        </div>
    </div>

    <?php
} else {
    echo "Error connecting to the database.";
}

?>