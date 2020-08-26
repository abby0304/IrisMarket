<?php
session_start(); 
include 'conexion.php';

//POST guardar datos de la pagina
$id_usuario_p = mysqli_real_escape_string($conexion, $_POST['id_usuario']);
$id_articulo_p =  mysqli_real_escape_string($conexion, $_POST['id_articulo']); 

$consulta="call Compra_Procedius(1, 1, 0, 0, now(), 1, 1, ".$id_usuario_p.", ".$id_articulo_p.", null, '');";

$resultado=mysqli_query($conexion, $consulta);

if($resultado)
{
	header("location:../articulo.php?id=". $id_articulo_p);
}
else
{
	echo'<script type="text/javascript">
    alert("No se puede guardar, favor de checar codigo");
    </script>';

}

mysqli_close($conexion);
?>