<?php
include 'conexion.php';

//POST guardar datos de la pagina
$id_articulo = mysqli_real_escape_string($conexion, $_GET['id']);


$consulta="CALL Articulo_Procedius(3, ".$id_articulo.", 0, 0,
0, 0, 0, 0, 0, 0, 0, 0,1)";

$resultado=mysqli_query($conexion, $consulta);

if($resultado)
{
	header("location:../Usuario.php");
}
else
{
	echo'<script type="text/javascript">
    alert("No se puede guardar, favor de checar codigo");
    </script>';

}
?>