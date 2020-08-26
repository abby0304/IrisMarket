<?php
session_start(); 
include 'conexion.php';

$comenta_p = $_GET['id'];
$articulo_p = $_GET['id_a'];


$consulta= "call Comenta_Procedius(3,".$comenta_p.", 'hola', now(), 1,1,1)";

$resultado=mysqli_query($conexion, $consulta);

if($resultado)
{
	header("location:../articulo.php?id=". $articulo_p);
}
else
{
	echo'<script type="text/javascript">
    alert("No se puede guardar, favor de checar codigo");
    </script>';

}

mysqli_close($conexion);

?>