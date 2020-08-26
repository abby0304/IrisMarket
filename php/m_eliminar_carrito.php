<?php
include 'conexion.php';

//POST guardar datos de la pagina
$id_compra = mysqli_real_escape_string($conexion, $_GET['id']);


$consulta="call compra_Procedius(3, ".$id_compra.", 0, 0, 0, 0, 0, 0, 0, 0, 0);";

$resultado=mysqli_query($conexion, $consulta);

if($resultado)
{
	header("location:../carrito.php");
}
else
{
	echo'<script type="text/javascript">
    alert("No se puede guardar, favor de checar codigo");
    </script>';

}

mysqli_close($conexion);
?>