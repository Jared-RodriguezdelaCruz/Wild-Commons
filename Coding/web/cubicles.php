<?php

$include = require_once("conection.php");

$cubicles = [];
$imageSources = [
    29 => "Images/america.png",
    30 => "Images/africa.png",
    31 => "Images/europe.png",
    32 => "Images/asia.png",
    33 => "Images/oceania.png"
];

if ($include) {
    $sql = "SELECT idResource, name, resource_type, status, capacity FROM Resource";
    $result = mysqli_query($con, $sql);

    if ($result->num_rows > 0) {
        // Guardar los estados de cada recurso
        while ($row = mysqli_fetch_assoc($result)) {
            $resources[$row['idResource']] = [
                'name' => $row['name'],
                'type' => $row['resource_type'],
                'status' => $row['status'],
                'capacity' => $row['capacity']
            ];
        }
    } else {
        echo "No hay recursos en la base de datos.";
    }

    // Genera los cubículos (ajusta el rango según la cantidad de cubículos)
    for ($i = 29; $i <= 33; $i++): // Cambia el rango según tus necesidades
        // Verifica si el recurso está en la matriz y aplica la clase correspondiente
        $statusClass = 'gray'; // Estado por defecto
        if (isset($resources[$i])) {
            if ($resources[$i]['status'] == 'Busy') {
                $statusClass = 'red'; 
            } elseif ($resources[$i]['status'] == 'Free') {
                $statusClass = 'green'; 
            } // 'gray' se asigna por defecto si está en mantenimiento u otro estado
        }
        
        // Asigna la imagen correspondiente según el tipo de cubículo
        $imageSrc = isset($imageSources[$i]) ? $imageSources[$i] : "Images/default.png"; // Imagen por defecto si no hay una específica
        ?>
        <div id="<?php echo $i; ?>" 
            class="continent-cube resource <?php echo $statusClass; ?>" style="text-align: center;">
            <img class="cube-icon" src="<?php echo $imageSrc; ?>" alt="Cubículo <?php echo $i; ?>" width="70px" height="70px">
            <?php echo isset($resources[$i]) ? $resources[$i]['name'] : "Cubículo ".$i; ?>
            <?php echo isset($resources[$i]) ? $resources[$i]['capacity'] : "Error"; ?> / 6
        </div>
    <?php endfor; 
} else {
    echo "Error connecting to the database.";
}

?>