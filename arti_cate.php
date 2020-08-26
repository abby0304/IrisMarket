<?php session_start(); ?>

<!DOCTYPE html>
<html lang="es">
 <head>
   <title>Articulos</title>
   <meta charset="UTF-8">
   
   <meta name="viewport" content="width=device-width, user-scalable=no,
   initial-scale=1, maximum-scale=1, minimum-scale=1">
   
    <!--css y mas-->
   <link rel="stylesheet" href="css/Principal.css">
   <link rel="stylesheet" href="css/galeria_arti.css">
   <script src="http://code.jquery.com/jquery-1.11.3.min.js"></script>
   <link rel="shortcut icon" type= "image/x-icon" href= "img/ico2.ico">
   
	
    <link rel="stylesheet" href="icon/style.css" media="screen" title="no title" charset="utf-8">

    <!--slider2-->
	<link href="https://netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css" rel="stylesheet" />
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.1/jquery.js"></script>
	<script src="https://netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>
	
	<!--Fuente-->
   <link href="https://fonts.googleapis.com/css?family=Great+Vibes" rel="stylesheet">
   <link href="https://fonts.googleapis.com/css?family=Cormorant+Garamond" rel="stylesheet">
   <link href="https://fonts.googleapis.com/css?family=Tinos" rel="stylesheet">
  
   
   <style>
	.centro {
	 position:relative;
	 left:1%;
	}
	
	.centro label {
	 font-family: 'Cormorant Garamond', serif;
	 font-size:17px;
	}
  </style>
 

  </head>
  
  <body>
  
     <!---Menu horizontal-->
     <div id="c-slider">
		<header>
		 <div class="contenedor">
		      <a href="Principal.php">
			   <img src = "img/banner2.png" style="left: 43%;">
			  </a>
			  
			  <form action="buscar.php" method="GET">
			  <input type="text" name="buscar_articulo" placeholder=" &#128269; Buscar..." style="width:15%;">
			  <input type="checkbox" name="check" style="display:none;" id="subscribe" checked>
			  <input type="submit"  value="Buscar" style="position:absolute; left: 26%; width: 80px;">
			 </form>

		 </div>
		 	
		 <div class="container">
			<input type="checkbox" id="toggle">
			<label for="toggle" class="button"><font color="white">&#8801; </font></label>
			
			<a href="carrito.php">
			  <img src = "img/13.png" class="shop"  width="50px" height="45px"/>
			</a>
			
			<a href="agregar_producto.php">
			  <img src = "img/icon3.png" class="add_p"  width="50px" height="45px"/>
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
			
			<a href="index.php">
			  <img src = "img/icon_140-1.png" class="add_p"  width="50px"  style="left:1400px;"/>
			</a>

			 <nav class="nav">
				<?php 
				 include 'php/conexion.php';
				 
				 $consulta2="call P_Vcategoria();";
				 
				 //Procesa el query
				 $resu=$conexion->query($consulta2);
				 
				 while($fila2 = $resu->fetch_array()){
				?>
					<a href="<?php echo "arti_cate.php?id=" . $fila2['id_categoria']; ?>"><?php echo $fila2['nombre_Cate']; ?></a>
				<?php
				 }
				 
				 mysqli_free_result($resu);
				mysqli_close($conexion);
				 ?>
			</nav>
			</div>
	    </header>

	
	<br/>
	<br/>
	<br/>
	<br/>
	<br/>
		
		<!---Slider de contenido-->						 

		<?php 
		   //Imagenes
		   include 'php/conexion.php';
			
			$consulta="call P_Categoria_info(1, ". $_GET["id"].");";
				
			 //Procesa el query
			 $resultado=$conexion->query($consulta);
			
		
			  if($fila=$resultado->fetch_array())
			 {
			?>
		
        <p class="title2"><?php echo $fila['nombre_Cate'] ?></p>
		<?php 
			 }
		  mysqli_free_result($resultado);
		  mysqli_close($conexion);
		 ?>
		
		  <ul class="galeria">
		  <?php 
			   //Imagenes
			   include 'php/conexion.php';
				
				$consulta="call P_Categoria_info(2, ". $_GET["id"].");";
				
				 //Procesa el query
				 $resultado=$conexion->query($consulta);
				
			
				  while($fila=$resultado->fetch_array())
				 {
			?>
						
		  <div class="galeria__item">
		  <a href="<?php echo "php/m_busqueda_a.php?id=" . $fila['id_articulo'] ."&num=2" ?>">
		  <img src="<?php echo 'data:image/jpeg;base64,'.base64_encode($fila['img1']) ?>" >
		  </a>

			</br>
				<div class="centro">
					<label style="color:#CD678B;">Nombre:</label> <label><?php echo $fila['nombre_Art'] ?> </label>
					<br/>
					<label style="color:#CD678B;">Descripcion:</label> <label> <?php echo $fila['descripcion'] ?></label>
					<br/>
					<label style="color:#CD678B;">Precio:</label> <label> <?php echo $fila['descuento'] ?></label>
					<br/>
					<br/>
				
				</div>

		  </div>
		  <?php 
			 }
		  mysqli_free_result($resultado);
		  mysqli_close($conexion);
		 ?>

  </ul>
 
 
		<br/>
		<br/>
		<br/>
		<br/>
	</div> <!-- div cierre final -->

	 
	 <script src="js/trans.js"></script>
	 
	 <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.5.2/jquery.min.js"></script>
	 <script type="text/javascript" src="js/jquery.transform-0.9.3.min_.js"></script>
	 <script type="text/javascript" src="js/jquery.RotateImageMenu.js"></script>
		
  </body>
</html>