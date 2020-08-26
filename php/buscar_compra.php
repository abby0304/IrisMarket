<?php
include 'conexion.php';
session_start();

//POST guardar datos de la pagina
$fecha = mysqli_real_escape_string($conexion, $_GET['f_1']);
$num = $_SESSION['Usuario'];


header("location:../Usuariob.php?id=$num&fecha=$fecha");

?>