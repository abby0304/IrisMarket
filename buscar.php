<?php session_start(); ?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-6">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Busqueda</title>

	<link rel="stylesheet" href="css/menu.css">
	
	<link rel="shortcut icon" type= "image/x-icon" href= "img/ico2.ico">
    <link rel="stylesheet" href="icon/style.css" media="screen" title="no title" charset="utf-8">
    <script src="https://code.jquery.com/jquery-2.2.4.js" charset="utf-8"></script>
	
	
	<style>
	

	label {
	  color: grey;
	}


    .checked {
    color: orange;
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
			   <img src = "img/banner2.png" style="left: 42%;">
			  </a>
			  <form action="buscar.php" method="GET">
			      
				  <input type="text" name="buscar_articulo" placeholder=" &#128269; Buscar..." style="position:relative; left: 8%; top:15px; width: 170px;"  id="buscar_t">
				  <input type="date" name="f_1" style="position:relative; left: 7%; top:15px; width: 185px; height: 40px;"  id="buscar_d1">
				  <input type="date" name="f_2" style="position:relative; left: 7%; top:15px; width: 185px; height: 40px;"  id="buscar_d2">
				  <input type="checkbox" name="check" style="position:relative; left: 8%; top:20px; width: 20px; height: 20px;" id="subscribe" checked>

				  <input type="submit"  value="Buscar" style="position:relative; left: 8%; top:20px; width: 80px;">
			  </form>
		 </div>
		 	
		 <div class="container">
		
			
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
	
	 <!-- Carrito de compras -->
		<div class="shopping-cart">
		  <!-- Title -->
		  <div class="title">
			Busqueda...
		  </div>
		  
		  
		  <?php
			include 'php/conexion.php';
			
			if(isset($_GET['check']))
			{	
			 
				$buscar_articulo = mysqli_real_escape_string($conexion, $_GET['buscar_articulo']);

				$consulta="call P_Buscar_articulo(1, '".$buscar_articulo."', '', '');";
				
				$resultado=mysqli_query($conexion, $consulta);
			}else
			{
				$fecha_1 = mysqli_real_escape_string($conexion, $_GET['f_1']);
				$fecha_2 = mysqli_real_escape_string($conexion, $_GET['f_2']);
				
				$consulta="call P_Buscar_articulo(2, '', '".$fecha_1."', '".$fecha_2."');";

				$resultado=mysqli_query($conexion, $consulta);
				
			}
			
				while($fila=$resultado->fetch_array())
				{
				
				  mysqli_close($conexion);
				  include 'php/conexion.php';
				  
				  
				$consulta2="CALL P_oferta(".$fila['precio'].",".$fila['oferta'].");";
				
			     $resultado2=mysqli_query($conexion, $consulta2);
			
			     $fila2=$resultado2->fetch_array();
		
		  ?>

		  <!-- Product #1 -->
		  <div class="item">

			<div class="image">
			  <a href="<?php echo "php/m_busqueda_a.php?id=" . $fila['id_articulo'] ."&num=1" ?>">
			  <?php echo '<img height="150" src="data:image/jpeg;base64,'.base64_encode($fila['img1']) .'" />'; ?>
			  </a>
			</div>

			<div class="description">
			  <span><?php echo $fila['nombre_Art'] ?></span>
			  <span>Precio: <?php echo $fila['precio'] ?></span>
			  <span>Oferta: <?php echo "$ ".$fila2['descuento'];?></span>
			</div>
			
			
			<div class="c_estrella" style="position:absolute; left:60%;">
				<?php 
			   //Imagenes
			    mysqli_close($conexion);
			   include 'php/conexion.php';
				
				 $consulta3="CALL P_valoracion(".$fila["id_articulo"].");";
				 
				 //Procesa el query
				 $resultado3=$conexion->query($consulta3);
				
			
			  if($fila3=$resultado3->fetch_array())
			  {
					 $star= $fila3['valoracion'];
					 
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
			 ?>
			</div>
			
			
		  </div>

		  
		  <?php
		   }
		   mysqli_free_result($resultado);
		   mysqli_close($conexion);
		  ?>

		
		</div>
	
		<br/>
		<br/>
	
    
  </body>
</html>
