<?php

$include = require_once("conection.php");

$resources = [];

if($include){
    $sql = "SELECT idResource, name, resource_type, status, capacity FROM Resource";
    $result = mysqli_query($con, $sql);

    if ($result->num_rows > 0) {
        // Guardar los estados de cada recurso
        while($row = mysqli_fetch_assoc($result)) {
            $resources[$row['idResource']] = [
                'type' => $row['resource_type'],
                'status' => $row['status'],
                'capacity' => $row['capacity']
            ];
        }
    } else {
        echo "No hay recursos en la base de datos.";
    }
    // Genera las computadoras (ajusta el rango según la cantidad de computadoras)
    for ($i = 24; $i <= 28; $i++):
        // Verifica si el recurso está en la matriz y aplica la clase correspondiente
        $statusClass = 'gray'; // Estado por defecto
        if (isset($resources[$i])) {
            if ($resources[$i]['status'] == 'Busy') {
                $statusClass = 'red'; 
            } elseif ($resources[$i]['status'] == 'Free') {
                $statusClass = 'green'; 
            } // 'gray' se asigna por defecto si está en mantenimiento u otro estado
        }
        ?>
        <div id="computer<?php echo $i; ?>" 
            class="resource computer <?php echo $statusClass; ?>">
            🖥️
        </div>
    <?php endfor; 
} else {
echo "Error connecting to the database.";
}

?>