<?php

$con = mysqli_connect("localhost", "root", "", "db_wildcommons");

if (!$con) {
    die("Error de conexión: " . mysqli_connect_error());
} 
