<?php
//Conexion con la base de datos
$servername     = "localhost";
$username       = "root";
$password       = "gue55me";
$dbname         = "market_proyectofinal";

$conexion = mysqli_connect($servername,$username,$password, $dbname) or die("Could not connect");
?>