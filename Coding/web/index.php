
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="cssIndex.css">
</head>
<body>
    <div class="sidebar">
        <ul>
            <li><a href="#monitor-status">Monitor Resource Status</a></li>
            <li><a href="#view-logs">View Logs</a></li>
            <li><a href="#manage-complaints">Manage Complaints</a></li>
        </ul>
    </div>

    <div class="main-content">
        <center><h1 id="Title" class="Title">WILD COMMONS</h1></center>

        <h1 id="monitor-status" class="Subtitle">Monitor Resource Status</h1>
        
        <div id="container" style="display: flex; flex-wrap: wrap; gap: 10px; padding: 10px; width:100%;">
            <div id="map" style="display: grid; grid-template-columns: repeat(4, 1fr); grid-gap: 10px; width: 100%;">
                
                <!-- Primera columna: Sala General -->
                <div class="column">
                    <?php include('general_room.php');?>
                </div>

                <!-- Segunda columna: 2 subcolumnas de 11 computadoras cada una -->
                <div class="column" style="display: grid; grid-template-columns: 1fr 1fr; grid-gap: 5px;">
                    <div class="subcolumn">
                        <!-- <div id="computer12" class="resource computer green">🖥️</div> -->
                        <!-- Primera subcolumna -->
                        <?php include('computers1.php');?>
                    </div>
                    <div class="subcolumn">
                        <!-- Segunda subcolumna -->
                        <?php include('computers2.php');?>
                    </div>
                </div>

                <!-- Tercera columna: 5 computadoras horizontales más juntas -->
                <div class="column" style="display: flex; justify-content: center; gap: 2px;">
                    <!-- <div id="computer23" class="resource computer green" style="margin: 0;">🖥️</div> -->
                    <?php include('computers3.php');?>
                </div>

                <!-- Cuarta columna: 5 cubículos verticales -->
                <div class="column">
                    <?php include('cubicles.php');?>
                </div>

            </div>
        </div>

        <h1 id="view-logs" class="Subtitle">View Logs</h1>
        <div class="logs-container">
            <table id="logsTable">
                <thead>
                    <tr>
                        <th>ID Log</th>
                        <th>ID User</th>
                        <th>Resource</th>
                        <th>Entry Date</th>
                        <th>Exit Date</th>
                    </tr>
                </thead>
                <tbody>
                    <?php include("showLogs.php");?>
                </tbody>
            </table>
        </div>

        <h1 id="manage-complaints" class="Subtitle">Manage Complaints</h1>
        <div class="complaints-container">
            <table id="complaintsTable">
                <thead>
                    <tr>
                        <th>ID Complaint</th>
                        <th>ID User</th>
                        <th>Resource</th>
                        <th>Date</th>
                        <th>Description</th>
                        <th>Status</th>
                        <th>Resolved</th>
                    </tr>
                </thead>
                <tbody>
                    <?php include("showComplaints.php");?>
                </tbody>
            </table>
        </div>

    </div>

    <footer>
        <center><p>&copy; 2024 Universidad Tecnológica El Retorno - BIS Universities. All rights reserved.</p></center>
        <center><a href="#Title">Back to the Start</a></center>
    </footer>


    <script>
    // Script para mandar el checkbox js al php
    document.addEventListener('DOMContentLoaded', function() {
        // Selecciona todos los checkboxes de quejas
        var checkboxes = document.querySelectorAll('.complaintCheckbox');

        checkboxes.forEach(function(checkbox) {
            checkbox.addEventListener('change', function() {
                var complaintId = this.getAttribute('data-id');
                var newStatus = this.checked ? 'Resolved' : 'Pending';

                // Crear una solicitud XMLHttpRequest
                var xhr = new XMLHttpRequest();
                xhr.open('POST', 'updateStatusComplaint.php', true);
                xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

                // Manejar la respuesta
                xhr.onload = function() {
                    if (xhr.status === 200) {
                        location.reload(); 
                    } else {
                        alert('Error al actualizar el estado.');
                    }
                };

                // Enviar la solicitud
                xhr.send('id=' + encodeURIComponent(complaintId) + '&status=' + encodeURIComponent(newStatus));
            });
        });
    });
    </script>


    <!-- Tasks:
    1.- Darle un mejor diseño al mapa, y a todo en General
    2.- Haz que al clickear un recurso se pueda ver quien lo está usando
    3.- Además el admin debe poder cambiar el status del recurso, si alguien lo estaba usando
    sera kickeado... -->
</body>
</html>