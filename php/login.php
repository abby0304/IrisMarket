<?php
session_start();

//Conexion con la base de datos
$servername     = "localhost";
$username       = "root";
$password       = "gue55me";
$dbname         = "market_proyectofinal";

$conexion = mysqli_connect($servername,$username,$password, $dbname) or die("Could not connect");

//POST guardar datos de la pagina
$usuario = mysqli_real_escape_string($conexion, $_POST['usuario']);
$contra = mysqli_real_escape_string($conexion, $_POST['psw']);
$recordar_psw = mysqli_real_escape_string($conexion, $_POST['i_remember']);

$consulta="CALL P_VUsuario('$usuario','$contra')";

$resultado=mysqli_query($conexion, $consulta);

if($filas = mysqli_fetch_assoc($resultado))
{
	if($recordar_psw==1) {
	 setcookie('remember_me', $_POST['usuario'], time() + (86400 * 30), "/");
	  setcookie('passw', $_POST['psw'], time() + (86400 * 30), "/");
	}else if($recordar_psw==0)
	{
		
	setcookie('remember_me', null, -1, '/');
    setcookie('passw', null, -1, '/');
	}
	
	
	$_SESSION['Usuario'] =$filas['id_usuario'];
	header("location:../Principal.php");
}
else
{
	if($filas==0)
	{
	header("location:../index.php?fallo=true");
	}
}

mysqli_free_result($resultado);
mysqli_close($conexion);

?>