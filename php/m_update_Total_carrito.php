<?php
session_start();
include 'conexion.php';

$id = $_SESSION['Usuario'];

$id_unidades_p =  $_POST['name'];
$id_compra_p =  $_POST['compra']; 
$uni = count($id_unidades_p);
$articulo = count($id_compra_p);
mysqli_close($conexion);

for($i = 0; $i < $uni; $i++) {
	
	include 'conexion.php';
	$consulta="call compra_Procedius(2, ".$id_compra_p[$i].", 0, 0, now(), 1, ".$id_unidades_p[$i].", 1, 1, 1, '');";

	$resultado=mysqli_query($conexion, $consulta);

	mysqli_close($conexion);
}

if($resultado)
{
	header("location:../carrito.php?id=".$id);
}
else
{
	echo'<script type="text/javascript">
    alert("No se puede guardar, favor de checar codigo");
    </script>';

}
?>