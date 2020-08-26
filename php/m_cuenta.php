<?php
 include 'conexion.php';

//POST guardar datos de la pagina
$nombre_p = mysqli_real_escape_string($conexion, $_POST['Nombre']);
$apellido_p = mysqli_real_escape_string($conexion, $_POST['Apellido']);
$usuario_p = mysqli_real_escape_string($conexion,$_POST['Usuario']);
$correo_p = mysqli_real_escape_string($conexion,$_POST['Correo']);
$contra_p = mysqli_real_escape_string($conexion,$_POST['psw']);
$telefono_p = mysqli_real_escape_string($conexion,$_POST['phone']);
$direccion_p = mysqli_real_escape_string($conexion,$_POST['Direccion']);

//Mandar la foto a la bases de datos 
$name_f1 = mysqli_real_escape_string($conexion,file_get_contents($_FILES['foto1']['tmp_name']));

$name_f2 = mysqli_real_escape_string($conexion,file_get_contents($_FILES['foto2']['tmp_name']));


$consulta="CALL Usuario_Procedius(1,1,'".$nombre_p."', '".$apellido_p."', '".$usuario_p."',
'".$correo_p."', '".$contra_p."', '".$telefono_p."', '".$direccion_p."', '".$name_f1."', '".$name_f2."', 1)";

$resultado=mysqli_query($conexion, $consulta);

if($resultado)
{
	header("location:../index.php");
}
else
{
	echo'<script type="text/javascript">
    alert("No se puede guardar, favor de checar codigo");
    </script>';

}

mysqli_close($conexion);

?>