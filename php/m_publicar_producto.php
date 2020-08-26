<?php
include 'conexion.php';

//POST guardar datos de la pagina
$articulo_a =  $_POST['num'];
$checked = count($articulo_a);

mysqli_close($conexion);

for($i = 0; $i < $checked; $i++) {

$publicar_a = 0;
if(isset($_POST['escheck'][$i]))
{
$publicar_a = 1;
}
	
include 'conexion.php';

$publicar_a = 0;
if(isset($_POST['escheck'][$i]))
{
$publicar_a = 1;
}
	
$consulta2= "CALL Articulo_Procedius(4, ".$articulo_a[$i].", 0, 0,
0, 0, 0, 0, ".$publicar_a.", 0, 0, 0,1)";
 
$resultado=mysqli_query($conexion, $consulta2);

mysqli_close($conexion);

}


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