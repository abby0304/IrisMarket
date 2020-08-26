<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>Articulo</title>
<meta charset="utf-8">

  <link rel="stylesheet" href="css/menu.css">
  <link rel="shortcut icon" type= "image/x-icon" href= "img/ico2.ico">
  <script src="http://code.jquery.com/jquery-1.11.3.min.js"></script>
  <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css'>

  

    <!--Fuentes-->	 
   <link href="https://fonts.googleapis.com/css?family=Cookie" rel="stylesheet">
   <link href="https://fonts.googleapis.com/css?family=Taviraj" rel="stylesheet">
   <link href="https://fonts.googleapis.com/css?family=Playfair+Display" rel="stylesheet">
   <meta name="viewport" content="width=device-width, initial-scale=1">
   <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
   
   <!--CSS-->
  <link rel="stylesheet" href="css/style.css">
  <link rel="stylesheet" href="css/articulo_css.css">
  
  <style>
  .Contenido div, h1
{
 text-align:center;
 font-family: 'Cookie', cursive;
 
}

.Contenido div
{
  font-size: 22px;
}


  
  </style>

</head>

<body>



	<!-- Header -->

 <!---Menu horizontal-->
     <div id="c-slider">
		<header>
		 <div class="contenedor">
		      <a href="Principal.php">
			    <img src = "img/banner2.png" >
			   </a>
			   
			  <form action="buscar.php" method="GET">
				  <input type="text" name="buscar_articulo" placeholder=" &#128269; Buscar..." style="width:15%;">
				  <input type="checkbox" name="check" style="display:none;" id="subscribe" checked>
				  <input type="submit"  value="Buscar" style="position:relative; left: 26%; width: 80px; top:20px; height:40px;">
			  </form>
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
		
      <!---Concetenidoo-->
		<div id="main">
		 <div class="w3-content w3-section" style="max-width:300px;">
			   <?php 
				   //Imagenes
				   include 'php/conexion.php';
					
					 $consulta="call P_informacion_articulo(". $_GET["id"].");";
					 
					 //Procesa el query
					 $resultado=$conexion->query($consulta);
					
				
					if($fila=$resultado->fetch_array())
					 {
						 
				    echo '<img class="mySlides w3-animate-fading" style="width:100%" src="data:image/jpeg;base64,'.base64_encode($fila['img1']) .'" />'; 
					echo '<img class="mySlides w3-animate-fading" style="width:100%" src="data:image/jpeg;base64,'.base64_encode($fila['img2']) .'" />'; 
				    echo '<img class="mySlides w3-animate-fading" style="width:100%" src="data:image/jpeg;base64,'.base64_encode($fila['img3']) .'" />'; 
			
					 ?>
		  
		  <button class="w3-button w3-display-left" onclick="plusDivs(-1)">&#10094;</button>
          <button class="w3-button w3-display-right" onclick="plusDivs(1)" style="left:29%;" >&#10095;</button>
		  
		</div>

		  <div class="Contenido">
		    
	
		    <h1 style="color:#CD678B;" align="center"><?php echo $fila['nombre_Art'];?></h1>
			
			<div style="text-align: center; color:#CD678B;">Descripcion: <span style="color:black;"> <?php echo $fila['descripcion'];?> <span></div>
			
			<div style="text-align: center; color:#CD678B;">Categoria: <span style="color:black;"><?php echo $fila['nombre_Cate'];?> <span></div>
									
			<div style="text-align: center; color:#CD678B;">Unidades: <span style="color:black;"><?php echo $fila['unidades'];?> <span> </div>
			
			<div style="text-align: center; color:#CD678B;">Correo: <span style="color:black;"><?php echo $fila['email'];?><span></div>
			
			<div style="text-align: center; color:#CD678B;">Oferta: <span style="color:black;"><?php echo $fila['oferta']."%";?> <span> </div>
			
			<div style="text-align: center; color:#CD678B;">Precio Normal: <span style="color:black;"><del><?php echo "$ ".$fila['precio'];?></del><span></div>
						
				
			<?php
			 }
			  mysqli_free_result($resultado);
			  mysqli_close($conexion);
		    ?>
			
			<?php 
             include 'php/conexion.php';
			 
			 $consulta2="CALL P_oferta(".$fila['precio'].",".$fila['oferta'].");";
			 
			 //Procesa el query
			 $resu=$conexion->query($consulta2);
			 
			 if($fila2 = $resu->fetch_array()){
			?>

			<div style="text-align: center; color:#CD678B;">Precio Oferta: <span style="color:#F20000;"><?php echo "$ ".$fila2['descuento'];?><span></div>

			<?php
			 }
			 
			 mysqli_free_result($resu);
            mysqli_close($conexion);
			 ?>
			 
			<br/>
		
			
			<div class="c_estrella" style="text-align:center;">
				<?php 
			   //Imagenes
			   include 'php/conexion.php';
				
				 $consulta="CALL P_valoracion(".$_GET["id"].");";
				 
				 //Procesa el query
				 $resultado=$conexion->query($consulta);
				
			
			  if($fila=$resultado->fetch_array())
			  {
					 $star= $fila['valoracion'];
					 
					 $contador = 5;
			
			        //Contar valoracion
					for($i =0; $i<$star; $i++)
					{
						echo '<span class="checked"> <font size="5"> ★ </font></span>';	
						$contador--;
					}
				
				   //Contar no valoracion
					for($i =0; $i<$contador; $i++)
					{
						echo '<span class=""> <font size="5"> ★ </font></span>';		
					}
				
					
			 }
			  mysqli_free_result($resultado);
				  mysqli_close($conexion);
		    ?>
			</div>
		   <form method="POST" action="php/m_agregar_carrito.php">
		  
		    <input type="hidden" name="id_articulo" value="<?php echo $_GET["id"]; ?>">
			<input type="hidden" name="id_usuario" value="<?php echo $_SESSION['Usuario']; ?>">
			
			<input type="submit" value="Añadir al carrito">
		  </form>
		 </div>
		</div>

		
		<br/>
		<br/>
		<br/>
		<br/>
		<br/>
		
        <h3 style="text-align:center;">¿Quieres saber más de nuestros productos?</h3>
		<h3 style="text-align:center;">¡Te compartimos un video!</h3>
	
	
			 
		<video width="700" style="left:27%;"controls>
		    <?php 
			   //Imagenes
			   include 'php/conexion.php';
				
				 $consulta="call P_video(". $_GET["id"]. ");";
												 
				 //Procesa el query
				 $resultado=$conexion->query($consulta);
				
			
				if($fila=$resultado->fetch_array())
				 {
			?>
			      <source src="video/<?php echo $fila['video'] ?>" type="video/mp4">
				  
			<?php
			 }
			  mysqli_free_result($resultado);
				  mysqli_close($conexion);
		    ?>
		</video>
		
		
		<br/>
		<br/>
		
	  
		<!--Comentarios-->
        <h3 style="text-align:center;">Compartenos tu opinion!!</h3>
	    <section>	
		<div class="container2">
		
			<form class="box">
				<i class="fa fa-comment"></i>
				<?php 
			   //Imagenes
			   include 'php/conexion.php';
				
			   $consulta="call P_count_comentarios(".$_GET["id"].");";
												 
				 //Procesa el query
				 $resultado=$conexion->query($consulta);
				
			
				if($fila=$resultado->fetch_array())
				{
				?>
				<span id="comment-counter"><?php echo $fila['numero']?></span>
				
				<?php
				   }
				   mysqli_free_result($resultado);
				   mysqli_close($conexion);
		        ?>
			</form>
			
			<form class="box" action="php/m_agregar_comentario.php" method="POST">
				<input type="text" name="comenta" placeholder="Comentario..." id="comment" style=" width:70%; font-family: 'Playfair Display', serif;">
				<input type="hidden" name="articulo" value="<?php echo $_GET["id"] ?>">
				<button type ="submit" id="add-comment">Añadir comentario</button>
		    </form>
		
			 
			<section class="comments" id="comments-container" style="display: block;">
			 <?php 
			   //Imagenes
			   include 'php/conexion.php';
				
				 $consulta="call P_comentarios(".$_GET["id"].");";
												 
				 //Procesa el query
				 $resultado=$conexion->query($consulta);
				
			
				while($fila=$resultado->fetch_array())
				 {
				echo '<div style="display: block;"> ';
				echo $fila['comentario'];
				echo '<img width="40px" height="40px" src="data:image/jpeg;base64,'.base64_encode($fila['imagen_avatar']) .'" />';
				echo '<span>'.$fila['fecha'].'</span>';
			
			?>
			   
				<i class="fa fa-trash" onclick="location.href='php/m_eliminar_comentario.php?id=<?php echo $fila['id_comenta']?>&id_a=<?php echo $_GET["id"]?>'"></i>
				
			<?php
			 echo '</div>';
			 }
			  mysqli_free_result($resultado);
				  mysqli_close($conexion);
		    ?>
            
			</section>				
		</div>
		
	   </section>
	    
	   <h3 style="text-align:center;">¿Necesitas ayuda? contactame abby.garza@live.com</h3>
	   
	   <br/>
	   <br/>
		

		<script>
		var myIndex = 0;
		carousel();

		function carousel() {
			var i;
			var x = document.getElementsByClassName("mySlides");
			for (i = 0; i < x.length; i++) {
			   x[i].style.display = "none";  
			}
			myIndex++;
			if (myIndex > x.length) {myIndex = 1}    
			x[myIndex-1].style.display = "block";  
			setTimeout(carousel, 9000);    
		}
		</script>
		
		<!--BOTONES PARA MOVER LAS IMAGENES :p-->
		<script>
		var slideIndex = 1;
		showDivs(slideIndex);

		function plusDivs(n) {
		  showDivs(slideIndex += n);
		}

		function showDivs(n) {
		  var i;
		  var x = document.getElementsByClassName("mySlides");
		  if (n > x.length) {slideIndex = 1}    
		  if (n < 1) {slideIndex = x.length}
		  for (i = 0; i < x.length; i++) {
			 x[i].style.display = "none";  
		  }
		  x[slideIndex-1].style.display = "block";  
		}
		</script>
		

</body>

</html>