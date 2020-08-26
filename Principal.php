<?php session_start(); ?>
<!DOCTYPE html>
<html lang="es">
 <head>
   <title>Home</title>
   <meta charset="UTF-8">
   
   <meta name="viewport" content="width=device-width, user-scalable=no,
   initial-scale=1, maximum-scale=1, minimum-scale=1">
   
    <!--css y mas-->
   <link rel="stylesheet" href="css/Principal.css">
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
   
   <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">

   <style>
	.centro {
	 position:relative;
	 left:25%;
	}
	
	.centro label {
	 font-family: 'Tinos', serif;
	 font-size:15px;
	}
  </style>
  
   <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
	
  <script>
  $(document).ready(function(){
		 $("#buscar_t").show();
		 $("#buscar_d1").hide();
		 $("#buscar_d2").hide();
		 
	  $('#subscribe').on('change',function(){
		if (this.checked) {
		 $("#buscar_t").show();
		 $("#buscar_d1").hide();
		 $("#buscar_d2").hide();
		} else {
		 $("#buscar_t").hide();
		 $("#buscar_d1").show();
		 $("#buscar_d2").show();
		}  
	  })
	});
  </script>
 

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
			      
				  <input type="text" name="buscar_articulo" placeholder=" &#128269; Buscar..." style="position:relative; left: 8%; top:15px; width: 170px;"  id="buscar_t">
				  <input type="date" name="f_1" style="position:relative; left: 8%; top:15px; width: 185px; height: 40px;"  id="buscar_d1">
				  <input type="date" name="f_2" style="position:relative; left: 8%; top:15px; width: 185px; height: 40px;"  id="buscar_d2">
				  <input type="checkbox" name="check" style="position:relative; left: 8.5%; top:20px; width: 20px; height: 20px;" id="subscribe" checked>

				  <input type="submit"  value="Buscar" style="position:relative; left: 9%; top:20px; width: 80px;">
			  </form>
		 </div>
		 	
		 <div class="container">
			<input type="checkbox" id="toggle">
			<label for="toggle" class="button"><font color="white">&#8801; </font></label>
			
			<a href="carrito.php">
			  <img src ="img/13.png" class="shop"  width="50px" height="45px"/>
			</a>
			
			<a href="agregar_producto.php">
			  <img src = "img/icon3.png" class="add_p"  width="50px" height="45px"/>
			</a>
			
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
			  echo '<a href="Usuario.php">';
		      echo '<img src="data:image/jpeg;base64,'.base64_encode($fila['imagen_avatar']) .'" class="avatar"  width="70px" height="70px" style="top:-10px" />';
			  echo ' </a>';
			} 

			mysqli_free_result($resultado);
            mysqli_close($conexion);
			 ?>
			
			 
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

	
		<!---Desliz de imagenes BANEEER-->	
	    <div class="slider-img">
			<div id="slider">
			   <section class="w3-display-container mySlides">
				   <?php 
				   //PORTADAAAA
				   include 'php/conexion.php';
				   
					 $id = $_SESSION['Usuario'];
					
					 $consulta="CALL P_IUsuario('".$id."');";
					 
					 //Procesa el query
					 $resultado=$conexion->query($consulta);
			 
                      if($fila=$resultado->fetch_array())
                     {
				     echo '<img src="data:image/jpeg;base64,'.base64_encode($fila['imagen_portada']) .'" />'; 
				   
				   ?>
				   <div class="w3-display-topleft w3-large w3-container ">
					<p class="title2" style="font-size: 60px; color:white;"><?php echo "Bienvenido " . $fila['nombre_usu']?></p>
				     </div>
				  <?php }
                    mysqli_free_result($resultado);
                    mysqli_close($conexion);
				  ?> 
				 
			   </section>
			   <section><img src="img/18.jpg" alt=""></section>
			   <section><img src="img/19.jpg" alt=""></section>
			   <section><img src="img/20.jpg" alt=""></section>
			</div>
			<div id="btn-prev">&#60;</div>
			<div id="btn-next">&#62;</div>
		</div>
		 
	 <!---Contenido-->	
		<div class="bienvenidos">
			<p class="title2" style="color:#CD678B;"><font size="200px">♥ Conoce nuestros productos ♥</font></p>
		</div>
	
		
		<!---Slider de contenido-->
		
        <p class="title2">♥ Lo mas vendido ♥</p>
		
		<div class="clearfix">
			<div id="thumbcarousel" class="carousel slide" data-interval="false">
				<div class="carousel-inner">
				
				    <?php 
					   //Imagenes
					   include 'php/conexion.php';
					   
						 $id = $_SESSION['Usuario'];
						
						 $consulta="call P_secciones_p(1);";
						 
						 //Procesa el query
						 $resultado=$conexion->query($consulta);
						
						echo '<div class="item active">';
						
						$num = 1;
						  while($fila=$resultado->fetch_array() AND $num <=4)
						 {
						 $num++;
						
				   	?>
					
						<div data-target="#carousel" data-slide-to="0" class="thumb">
							<a href="<?php echo "php/m_busqueda_a.php?id=" . $fila['id_articulo'] ."&num=2" ?>">
						     <?php echo '<img src="data:image/jpeg;base64,'.base64_encode($fila['img1']) .'" />'; ?>
						    </a>
							
							</br>
								<div class="centro">
									<label style="color:#CD678B;">Nombre: </label><label> <?php echo $fila['nombre_Art'];?></label>
									<br/>
									<label style="color:#CD678B;">Oferta: </label><label> <?php echo $fila['oferta'] ."%";?></label>
									<br/>
									<label style="color:#CD678B;">Precio: </label><label> <?php echo "$".$fila['precio'];?></label>
									<br/>
								
								</div>
						</div>
					
					
					<?php 
						 }
					  echo' </div>';
                      mysqli_free_result($resultado);
                      mysqli_close($conexion);
					 ?>					
				</div><!-- /carousel-inner -->

			</div> <!-- /thumbcarousel -->
		</div>
		
		<br/>
		<br/>
		
		<!---Slider de contenido-->
		
		<p class="title2">♥ Lo mas visto ♥</p>
		
		<div class="clearfix">
			<div id="thumbcarousel2" class="carousel slide" data-interval="false">
		       <div class="carousel-inner">
					
					 <?php 
					   //Imagenes
					   include 'php/conexion.php';
					   
						 $id = $_SESSION['Usuario'];
						
						 $consulta="call P_secciones_p(2);";
						 
						 //Procesa el query
						 $resultado=$conexion->query($consulta);
						
						echo '<div class="item active">';
				 
				         $num=1;
						  while($fila=$resultado->fetch_array() AND $num <=4)
						 {
							 $num ++;
				   	?>
						<div data-target="#carousel" data-slide-to="0" class="thumb">
							 <a href="<?php echo "php/m_busqueda_a.php?id=" . $fila['id_articulo'] ."&num=2" ?>">
						      <?php echo '<img src="data:image/jpeg;base64,'.base64_encode($fila['img1']) .'" />'; ?>
						     </a>
							 
							</br>
								<div class="centro">
									<label style="color:#CD678B;">Nombre: </label><label> <?php echo $fila['nombre_Art'];?></label>
									<br/>
									<label style="color:#CD678B;">Oferta: </label><label> <?php echo $fila['oferta'] ."%";?></label>
									<br/>
									<label style="color:#CD678B;">Precio: </label><label> <?php echo "$".$fila['precio'];?></label>
									<br/>
									
								</div>
						</div>
						
					<?php 
						 }
					  echo' </div>';
                      mysqli_free_result($resultado);
                      mysqli_close($conexion);
					 ?>		

				</div><!-- /carousel-inner -->
				
			</div> <!-- /thumbcarousel -->
		</div>
		
		<br/>
		<br/>
		
		<!---Slider de contenido-->
		
		<p class="title2">♥ Lo mas buscado ♥</p>
		
		<div class="clearfix">
			<div id="thumbcarousel3" class="carousel slide" data-interval="false">
				<div class="carousel-inner">
					<?php 
					   //Imagenes
					   include 'php/conexion.php';
					   
						 $id = $_SESSION['Usuario'];
						
						 $consulta="call P_secciones_p(3);";
						 
						 //Procesa el query
						 $resultado=$conexion->query($consulta);
						
						echo '<div class="item active">';
						
						$num = 1;
						  while($fila=$resultado->fetch_array() AND $num <=4)
						 {
						 $num++;
						
				   	?>
						<div data-target="#carousel" data-slide-to="0" class="thumb">
						<a href="<?php echo "php/m_busqueda_a.php?id=" . $fila['id_articulo'] ."&num=2" ?>">
						   <?php echo '<img src="data:image/jpeg;base64,'.base64_encode($fila['img1']) .'" />'; ?>
						</a>
							
							</br>
								<div class="centro">
									<label style="color:#CD678B;">Nombre: </label><label> <?php echo $fila['nombre_Art'];?></label>
									<br/>
									<label style="color:#CD678B;">Oferta: </label><label> <?php echo $fila['oferta'] ."%";?></label>
									<br/>
									<label style="color:#CD678B;">Precio: </label><label> <?php echo "$".$fila['precio'];?></label>
									<br/>
									
								</div>
						</div>
						<?php 
						 }
					  echo' </div>';
                      mysqli_free_result($resultado);
                      mysqli_close($conexion);
					 ?>		

						
				</div><!-- /carousel-inner -->
				
			</div> <!-- /thumbcarousel -->
		</div>
		
		<br/>
		<br/>
		
		<!---Slider de contenido-->
		
		<p class="title2">♥ Lo mejor calificado ♥</p>
		
		<div class="clearfix">
			<div id="thumbcarousel4" class="carousel slide" data-interval="false">
				<div class="carousel-inner">
					<?php 
					   //Imagenes
					   include 'php/conexion.php';
					   
						 $id = $_SESSION['Usuario'];
						
						 $consulta="call P_secciones_p(4);";
						 
						 //Procesa el query
						 $resultado=$conexion->query($consulta);
						
						echo '<div class="item active">';
						
						$num = 1;
						  while($fila=$resultado->fetch_array() AND $num <=4)
						 {
						 $num++;
						
				   	?>
						<div data-target="#carousel" data-slide-to="0" class="thumb">
							<a href="<?php echo "php/m_busqueda_a.php?id=" . $fila['id_articulo'] ."&num=2" ?>">
						     <?php echo '<img src="data:image/jpeg;base64,'.base64_encode($fila['img1']) .'" />'; ?>
						    </a>
							</br>
								<div class="centro">
									<label style="color:#CD678B;">Nombre: </label><label> <?php echo $fila['nombre_Art'];?></label>
									<br/>
									<label style="color:#CD678B;">Oferta: </label><label> <?php echo $fila['oferta'] ."%";?></label>
									<br/>
									<label style="color:#CD678B;">Precio: </label><label> <?php echo "$".$fila['precio'];?></label>
									<br/>
									
								</div>
						</div>
						
						<?php 
						 }
					  echo' </div>';
                      mysqli_free_result($resultado);
                      mysqli_close($conexion);
					 ?>		
					
				</div><!-- /carousel-inner -->
			
			</div> <!-- /thumbcarousel -->
		</div>
		
		<br/>
		<br/>
		<br/>
		<br/>
	</div> <!-- div cierre final -->

   
	 <script src="js/trans.js"></script>
		
  </body>
</html>