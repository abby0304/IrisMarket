<?php session_start(); ?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Usuario</title>

	<link rel="stylesheet" href="css/menu.css">
	<link rel="stylesheet" href="css/usuario.css">
	   <link rel="shortcut icon" type= "image/x-icon" href= "img/ico2.ico">

    <link rel="stylesheet" href="icon/style.css" media="screen" title="no title" charset="utf-8">
    <script src="https://code.jquery.com/jquery-2.2.4.js" charset="utf-8"></script>
    <link href="https://fonts.googleapis.com/css?family=Playfair+Display" rel="stylesheet">
  </head>
  
  
  <body>
  
   <!---Menu horizontal-->
     <div id="c-slider">
		<header>
		 <div class="contenedor">
			  <a href="Principal.php">
			   <img src = "img/banner2.png">
			  </a>
			   <form action="buscar.php" method="GET">
			  <input type="text" name="buscar_articulo" placeholder=" &#128269; Buscar..." style="width:15%;">
			  <input type="checkbox" name="check" style="display:none;" id="subscribe" checked>
			  <input type="submit"  value="Buscar" style="position:absolute; left: 26%; width: 80px;">
			 </form>
		 </div>
		 	
		 <div class="container">   
			<a href="carrito.php">
			  <img src = "img/13.png" class="shop"  width="50px" height="45px"/>
			</a>
			
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
			
			<a href="agregar_producto.php">
			  <img src = "img/icon3.png" class="add_p"  width="50px" height="45px"/>
			</a>
			
			<a href="index.php">
			  <img src = "img/icon_140-1.png" class="add_p"  width="45px"  style="left:1400px;"/>
			</a>
			
		</div>
	    </header>
	</div>
	
	    <div class="informacion" style="top:43px;">
		       <img src="img/portada.jpg" alt="Trulli" width="1000">
		</div>
		
		<!--------------------------------------->
		
		
		<br/>
		<br/>
		
		<div  class="c_contenido">	
		<div class="historial">
			  <h2>Editar Usuario</h2>
		</div>
		<?php
			 $id = $_SESSION['Usuario'];
		?>
		 <a href = "<?php echo "modificar_cuenta.php?id=" . $id; ?>">
		 <input type="submit" Value="Modificar" style="position:absolute; left: 40%; width:250px;">
		 </a>
		

	    <!-- Carrito de compras -->
	  <div class="shopping-cart">
		<div style="width: 100%;  overflow:auto; height:430px;">
		  <!-- Title -->
		  <div class="title">
			Editar los productos
		  </div>

		  <form action="php/m_publicar_producto.php" method="POST">
		  <?php 
			include 'php/conexion.php';

			 $id = $_SESSION['Usuario'];
			 
			
			 $consulta="call P_modificar_articulo(".$id.");";
			 
			 //Procesa el query
			 $resultado=$conexion->query($consulta);
			 
             $nume=0;
			 
			 while($fila=$resultado->fetch_array())
             {
				 
				 
		 ?>
		  <div class="item">

		    <div class="buttons">
			<a href = "<?php echo "php/m_eliminar_articulo.php?id=".$fila['id_articulo']; ?>" style="text-decoration:none">
			  <span class="delete-btn"></span>
			 </a>
			 
			  <a href = "<?php echo "modificar_producto.php?id=" . $fila['id_articulo']; ?>" style="text-decoration:none">
				  <span>
					<font size="5" color="gray"> &#9998; </font>
				  </span>
			  </a>
			  <input type="checkbox" name="escheck[<?php echo $nume; $nume++; ?>]" style =" height: 20px; width: 20px;" <?php if($fila['publicar']==1){ echo "checked";}?>><br>
			   <input type="hidden" name="num[]" value="<?php echo $fila['id_articulo']; ?>" >
			</div>
			
			<div class="image">
			   <?php echo '<img height="150" src="data:image/jpeg;base64,'.base64_encode($fila['img1']) .'" />'; ?>
			</div>

			<div class="description">
			  <span><?php echo $fila['nombre_Art'] ?></span>
			  <span>Descripcion: <?php echo $fila['descripcion'] ?></span>
			</div>
				
		  </div>
		  
		   <?php
		   } 
			mysqli_free_result($resultado);
			mysqli_close($conexion);
		   ?>
		
		 </div>	
		 </br>
		</div>
		
		<input type="submit"  value="Aceptar cambios" style="position:relative; left: 40%; width: 250px; height:40px;">
      </form>
	
        </br>
		</br>
		</br>
		<div class="historial">
		  <h2>Historial de compras</h2>
		</div>
	
		
		<div class="Contenido">
		
		 <form action="php/buscar_compra.php" method="GET">
			  <input type="date" name="f_1" style="position:relative; left: 28%; width: 250px; top:20px; height:40px;">
			  <input type="submit"  value="Buscar" style="position:relative; left: 30%; width: 80px; top:20px; height:40px;">
		 </form>
			</br>
				
			 
		 <div style="width: 100%;  overflow:auto; height:350px;">
			<h2 style="color:#CD678B;" align="center">Usted tiene las siguientes compras</h2>
	
	
	       <?php 
			include 'php/conexion.php';

			 $id = $_SESSION['Usuario'];
			 
			
			 $consulta="call P_historial_compras(".$id.");";
			 
			 //Procesa el query
			 $resultado=$conexion->query($consulta);
			 

			 while($fila=$resultado->fetch_array())
             {
				 
		   ?>
		   <p>
			<span style ="color:#CD678B;"><b><?php echo $fila['fechahora']; ?></b></span>
			<br/>
			<span><?php echo $fila['nombre_Art']; ?></span>
			<span style ="color:#F20000;"><?php echo "$ ".$fila['precio']; ?></span>
		   </p>
		  <?php
		   } 
			mysqli_free_result($resultado);
			mysqli_close($conexion);
		   ?>
			
		 </div>  
		</div>  
		
		</div>
	 
	 <br/>
	 <br/>
	 
	       
	</body>
</html>