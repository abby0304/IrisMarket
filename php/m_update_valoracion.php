<?php
session_start(); 
include 'conexion.php';


$id_compra_p =  $_POST['compra'];
$uni = count($id_compra_p);

mysqli_close($conexion);

for($i = 1; $i <= $uni; $i++) {
	include 'conexion.php';
	//leer radio buttons
	if ($_POST['estrellas'.$i]==1)
	{
		$gender= 1;
	}else if ($_POST['estrellas'.$i]==2)
	{
		$gender= 2;
	}else if ($_POST['estrellas'.$i]==3)
	{
		$gender= 3;
	}else if ($_POST['estrellas'.$i]==4)
	{
		$gender= 4;
	}else if ($_POST['estrellas'.$i]==5)
	{
		$gender= 5;
	}

	
	$consulta="call compra_Procedius(4, ".$id_compra_p[$i-1].", ".$gender.", 1, now(), 1, 0, 1, 1, 1,'');";

	$resultado=mysqli_query($conexion, $consulta);

	mysqli_close($conexion);
}

if($resultado)
{
	header("location:../Principal.php");
}
else
{
	echo'<script type="text/javascript">
    alert("No se puede guardar, favor de checar codigo");
    </script>';

}
?>
