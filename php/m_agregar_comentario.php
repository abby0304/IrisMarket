<?php
session_start(); 
include 'conexion.php';

//POST guardar datos de la pagina
$comentario_p = mysqli_real_escape_string($conexion, $_POST['comenta']);
$articulo_p =  mysqli_real_escape_string($conexion, $_POST['articulo']); 
$usuario_p = $_SESSION['Usuario'];

$consulta="call Comenta_Procedius(1,1, '".$comentario_p."', now(), 1, ".$usuario_p.",".$articulo_p.");";

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