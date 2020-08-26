<?php
include 'Conexion.php';
session_start();

$id_usuario = $_SESSION['Usuario'];

//POST guardar datos de la pagina
$nombre_a = mysqli_real_escape_string($conexion, $_POST['articulo']);
$descripcion_a = mysqli_real_escape_string($conexion, $_POST['descripcion']);
$precio_a = mysqli_real_escape_string($conexion, $_POST['precio']);
$unidades_a = mysqli_real_escape_string($conexion, $_POST['unidades']);
$oferta_a = mysqli_real_escape_string($conexion, $_POST['oferta']);
$categoria_a = mysqli_real_escape_string($conexion, $_POST['categoria']);

$publicar_a = 0;
if(isset($_POST['publicar']))
{
$publicar_a = 1;
}


//Pasar cambio de dato
//$precio_a = number_format((float)$precio_a, 2, '.', '');

//Mandar las fotos a la bases de datos 
$name_f1 = mysqli_real_escape_string($conexion,file_get_contents($_FILES['foto1']['tmp_name']));

$name_f2 = mysqli_real_escape_string($conexion,file_get_contents($_FILES['foto2']['tmp_name']));

$name_f3 = mysqli_real_escape_string($conexion,file_get_contents($_FILES['foto3']['tmp_name']));


///Video guardarlo en la carpeta
$name_v1 = mysqli_real_escape_string($conexion,$_FILES['video']['name']);

$name_vtotal= mysqli_real_escape_string($conexion,rand(0,1000)."$name_v1");

$ruta='C:/xampp/htdocs/Proyecto_BDM/video';

move_uploaded_file($_FILES['video']['tmp_name'], "$ruta/"."$name_vtotal");

//Guardar informacion multimedia
$consulta="CALL Multimedia_Procedius(1,1,'".$name_vtotal."','".$name_f1."','".$name_f2."','".$name_f3."', 1)";

$resultado= mysqli_query($conexion, $consulta);

mysqli_close($conexion);

include 'Conexion.php';

//Obtener el id de multimedia
$consulta="CALL P_id_anterior(1);";

$resultado= mysqli_query($conexion, $consulta);

$row = mysqli_fetch_assoc($resultado);


//$resultado->next_result(); 

$consulta2= "CALL Articulo_Procedius(1, 1, '".$nombre_a."', '".$descripcion_a."',
 ".$precio_a.", ".$unidades_a.", 0, 0, ".$publicar_a.", ".$oferta_a.", ". $id_usuario .", ". $row['id_num'].",1)";
 
mysqli_close($conexion);

include 'Conexion.php';

$resultado=$conexion->query($consulta2);

mysqli_close($conexion);
include 'Conexion.php';

//Obtener el id de articulo
$id_consulta_m="CALL P_id_anterior(2);";

$resultado= mysqli_query($conexion, $id_consulta_m);

$row2 = mysqli_fetch_assoc($resultado);

//Guardar categoria
$consulta3 = "CALL Cate_Art_Procedius(1,1,1, '". $row2['id_num']."',$categoria_a)";

mysqli_close($conexion);
include 'Conexion.php';

$resultado= mysqli_query($conexion, $consulta3);


if($resultado)
{
	header("location:../Principal.php");
}
else
{
	echo'<script type="text/javascript">
    alert("No se pudo guardar");
    </script>';

}


mysqli_close($conexion);
?>