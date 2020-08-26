<?php
include 'conexion.php';

//POST guardar datos de la pagina
$id_articulo = mysqli_real_escape_string($conexion, $_GET['id']);
$num = mysqli_real_escape_string($conexion, $_GET['num']);

if($num == 1)
{	
  $consulta="CALL Articulo_Procedius(5, ". $id_articulo .", '','', 0, 0, 0 ,0 ,0 ,0 ,0 ,0 ,0);";
}
else
{
  $consulta="CALL Articulo_Procedius(6, ". $id_articulo .", '','', 0, 0, 0 ,0 ,0 ,0 ,0 ,0 ,0);";
}

$resultado=mysqli_query($conexion, $consulta);


if($resultado)
{
	header("location:../articulo.php?id=" . $_GET['id']);
}
else
{
	echo'<script type="text/javascript">
    alert("No se puede guardar, favor de checar codigo");
    </script>';

}
?>