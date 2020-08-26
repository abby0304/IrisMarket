<?php
session_start();
include 'conexion.php';

$id = $_SESSION['Usuario'];

//leer radio buttons
if ($_POST['gender']==1)
{
	$gender= 1;
}else if ($_POST['gender']==2)
{
	$gender= 2;
}else if ($_POST['gender']==3)
{
	$gender= 3;
}

$numero_tarjeta = mysqli_real_escape_string($conexion, $_POST['numero_tarjeta']);


$consulta="call compra_Procedius(5, ".$id.", 0, 0, now(), 1, 0, 1, 1, ".$gender.",'".$numero_tarjeta."');";

$resultado=mysqli_query($conexion, $consulta);


if($resultado)
{
	header("location:../valoracion.php?id=".$id);
}
else
{
	echo'<script type="text/javascript">
    alert("No se puede guardar, favor de checar codigo");
    </script>';
}

mysqli_close($conexion);

?>