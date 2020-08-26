<!doctype html>
<html lang="en"> <!--declarar idioma-->
	<head>
		<title>Login</title>
	    <link rel="shortcut icon" type= "image/x-icon" href= "img/ico2.ico">

		<meta charset="UTF-8">
		<link rel="stylesheet" href="css/login.css">
		<style>
		  body
			{
				background:url(img/10.jpg);
				background-repeat:none;
				background-size:cover;
				width:100%;
				height:100%;
				position:fixed;
				display:flex;
				min-height:100vh;
			}
			
		</style>
	
	</head>
	<body>
		<form method="post" action="php/login.php" >
			<img src = "img/7.jpg"  width="170px" height="110px"/>
		    <h2>Iris Market</h2> 
			
			<!--INPUT-->
			<h3>Iniciar sesión</h3>
			<br/>
			<input type="text" placeholder="&#128272; Usuario o email" name="usuario" maxlength="40" value="<?php if(isset($_COOKIE["remember_me"])) { echo $_COOKIE['remember_me'];} ?>" required>
			<br/>
		
		    <input type="password" id="psw" name="psw" placeholder="&#128273; Contraseña" maxlength="8" value="<?php if(isset($_COOKIE["passw"])) { echo $_COOKIE['passw'];} ?>" required>
			
			<!--Si el usuario se equivoco de contraseña-->
			<?php
			   if(isset($_GET["fallo"]) && $_GET["fallo"] == 'true')
			   {
				  echo "<br/><h4>Usuario o contraseña incorrecta</h4>";
			   }
			?>
			
		
			
			<!--Recordar Contraseña-->
			<br/>
			<h4>Recordar Contraseña</h4>
			
		    <input type="checkbox" class="compra" style="height: 17px;" name="remember" id="remember" value="1" onclick="info()" 
			<?php if(isset($_COOKIE['remember_me'])) {
			  echo 'checked="checked"';
			}
			else {
			  echo '';
			}
			?>/> 
			<input type="hidden" id="id_fiscal" name="i_remember" value="1">
	        <!--Ingresar-->
			<br/>
		    <input type="submit" class="compra" value="Ingresar"/>
			<br/>
			
			<a href="cuenta.php">Crear una cuenta</a> 

		</form>
		
			
		<script>
		function info()
		{

	     if(document.getElementById("remember").checked == true)
		 {
		 document.getElementById("id_fiscal").value = 1;
		 }
		 else
		 {
		 document.getElementById("id_fiscal").value = 0;
		 }
        }

		</script>
		
		
	  </body>
 </html>