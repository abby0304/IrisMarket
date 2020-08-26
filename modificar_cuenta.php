<?php session_start(); ?>


<!doctype html>
<html lang="en"> <!--declarar idioma--> 
  <head>
    <title>Modificar Cuenta</title>
    <link rel="shortcut icon" type= "image/x-icon" href= "img/ico2.ico">
    <meta charset="UTF-8">
		<link rel="stylesheet" href="css/cuenta.css">
		<link rel="stylesheet" href="css/menu.css">
		<link rel="shortcut icon" type= "image/x-icon" href= "img/ico2.ico">
		<link rel="stylesheet" href="icon/style.css" media="screen" title="no title" charset="utf-8">
		<script src="https://code.jquery.com/jquery-2.2.4.js" charset="utf-8"></script>
		<link href="https://fonts.googleapis.com/css?family=Playfair+Display" rel="stylesheet">
		
		
		<style>
		  body
			{
				background:url(imagenes/11.jpg);
				background-repeat:no-repeat;
				background-attachment:fixed;
				width:100%;
				height:100%;
				min-height:100vh;
			}
			
			.multimedia img{
			  max-width:180px;
			}
			
			input[type=file]
			{
			padding:10px;
			background:pink;
			}
			
			/* The message box is shown when the user clicks on the password field */
			#message {
				display:none;
				background: #f1f1f1;
				color: #000;
				position: relative;
				padding: 20px;
				margin-top: 10px;
			}

			#message p {
				padding: 10px 35px;
				font-size: 15px;
			}
			
			/* Add a green text color and a checkmark when the requirements are right */
			.valid {
				color: green;
			}

			.valid:before {
				position: relative;
				left: -35px;
				content: "✔";
			}

			/* Add a red text color and an "x" when the requirements are wrong */
			.invalid {
				color: red;
			}

			.invalid:before {
				position: relative;
				left: -35px;
				content: "✖";
			}
			
			
		</style>
  </head>
  <body>
   <!---Menu horizontal-->
     <div id="c-slider">
		<header>
		 <div class="contenedor">
			  <a href="Principal.php">
			   <img src = "img/banner2.png">
			  </a>
			  
		 </div>
		 	
		 <div class="container">
			
		  <a href="Usuario.php">
			<!--Foto y nombre-->
			<?php 
			include 'php/conexion.php';

			 $id = $_SESSION['Usuario'];
			
			 $consulta="CALL P_IUsuario('".$id."');";
			 
			 //Procesa el query
			 $resultado=$conexion->query($consulta);
			 
			 
			 if($fila=$resultado->fetch_array())
             {
			  //washar la foto
		      echo '<img src="data:image/jpeg;base64,'.base64_encode($fila['imagen_avatar']) .'" class="avatar"  width="70px" height="70px" style="top:-10px" />';
			 } 

			mysqli_free_result($resultado);
            mysqli_close($conexion);
			 ?>
			</a>
			
			<a href="carrito.php">
			  <img src = "img/13.png" class="shop"  width="50px" height="45px"/>
			</a>
			
			<a href="agregar_producto.php">
			  <img src = "img/icon3.png" class="add_p"  width="50px" height="45px"/>
			</a>
			
			
			<a href="index.php">
			  <img src = "img/icon_140-1.png" class="add_p"  width="45px"  style="left:1400px;"/>
			</a>
			
		
			</div>
	    </header>
		</div>
		
       <?php 
		include 'php/conexion.php';
		 
		$id = $_SESSION['Usuario'];
		
		 $consulta="call P_set_usuario(1, ".$_GET["id"].");";
		 
		 //Procesa el query
		 $resultado=$conexion->query($consulta);
		 

		 if($fila=$resultado->fetch_array())
		 {
			 
	   ?>
		
    <form class="contenido" action="php/m_update_cuenta.php" method="POST" enctype="multipart/form-data">
	   <img src = "img/banner.jpg"  width="220px" height="70px"/>
	    <br/>
	    <h3>Cuenta</h3>
		
		<br/>
		<input type="text" placeholder="&#9726; Nombre" name="Nombre" value="<?php echo $fila['nombre_Usu'] ?>" required>
		
		<br/>
		<input type="text" placeholder="&#9726; Apellido" name="Apellido" value="<?php echo $fila['apellido'] ?>" required>
		
		<br/>
		<input type="text" placeholder="&#9726; Usuario" name="Usuario" value="<?php echo $fila['usuario'] ?>" required>
		
		<br/>
        <input type="text" placeholder="&#128231; Correo electronico" name="Correo" value="<?php echo $fila['email'] ?>" required>
		
		<br/>

		<input type="password" id="psw" name="psw" placeholder="&#128273; Contraseña"
		pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Debe contener al menos un número y una letra mayúscula y minúscula, y al menos 8 o más caracteres"
		value="<?php echo $fila['contra'] ?>" required>

		
		<div id="message">
		  <h3>La contraseña debe contener lo siguiente:</h3>
		  <p id="letter" class="invalid">Una letra <b>Minúscula</b></p>
		  <p id="capital" class="invalid">Una letra <b>Mayuscula</b></p>
		  <p id="number" class="invalid">Un <b>Numero</b></p>
		  <p id="length" class="invalid">Minimo <b>8 caracteres</b></p>
		</div>
		
		<br/>
		<input type="text" placeholder="&#9742; Telefono" name="phone" value="<?php echo $fila['telefono'] ?>" required>
		
		<br/>
		
		<select disabled>
		   <option value="OPC" >M&eacute;xico</option>
		</select>
		  
		  <br/>
		  
		<select name="Direccion" required>
	    	<option value="OPC">Seleccione un Estado</option>
			<option value="DIF">Distrito Federal</option>
			<option value="AGS">Aguascalientes</option>
			<option value="BCN">Baja California</option>
			<option value="BCS">Baja California Sur</option>
			<option value="CAM">Campeche</option>
			<option value="CHP">Chiapas</option>
			<option value="CHI">Chihuahua</option>
			<option value="COA">Coahuila</option>
			<option value="COL">Colima</option>
			<option value="DUR">Durango</option>
			<option value="GTO">Guanajuato</option>
			<option value="GRO">Guerrero</option>
			<option value="HGO">Hidalgo</option>
			<option value="JAL">Jalisco</option>
			<option value="MEX">M&eacute;xico</option>
			<option value="MIC">Michoac&aacute;n</option>
			<option value="MOR">Morelos</option>
			<option value="NAY">Nayarit</option>
			<option value="NLE">Nuevo Le&oacute;n</option>
			<option value="OAX">Oaxaca</option>
			<option value="PUE">Puebla</option>
			<option value="QRO">Quer&eacute;taro</option>
			<option value="ROO">Quintana Roo</option>
			<option value="SLP">San Luis Potos&iacute;</option>
			<option value="SIN">Sinaloa</option>
			<option value="SON">Sonora</option>
			<option value="TAB">Tabasco</option>
			<option value="TAM">Tamaulipas</option>
			<option value="TLX">Tlaxcala</option>
			<option value="VER">Veracruz</option>
			<option value="YUC">Yucat&aacute;n</option>
			<option value="ZAC">Zacatecas</option>
        </select>	
		
        <br/>
		 
		 <div class="multimedia">
		
		    <label for="Imagen">Imagen</label>
			<input type="file" name="foto1" onchange="readURL(this, '#blah2');" required>
			</br>
			<img id="blah2" src="<?php echo 'data:image/jpeg;base64,'.base64_encode($fila['imagen_avatar']) ?>" />
			<script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
			
			
			<br/>
			<label for="Portada">Portada</label>
			<input type="file" name="foto2" onchange="readURL(this, '#blah3');" required> 
			</br>
			<img id="blah3" style= "max-width:400px;" src="<?php echo 'data:image/jpeg;base64,'.base64_encode($fila['imagen_portada']) ?>"  />
			<script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
			
		 </div>
		 
		 
		 
		<br/>
		<input type="submit" Value="Registar" style="position:relative; left: 35%;">

		 <script  src="js/preview_fotos.js"></script>
		 
	</form>
	
	   <?php
	   } 
		mysqli_free_result($resultado);
		mysqli_close($conexion);
	   ?>
	
	
	<script  src="js/validate_pass.js"></script>
	
	
  </body>
</html>
