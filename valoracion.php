<?php session_start(); ?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-6">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Valoracion</title>

	<link rel="stylesheet" href="css/menu.css">
	
	<link rel="shortcut icon" type= "image/x-icon" href= "img/ico2.ico">
    <link rel="stylesheet" href="icon/style.css" media="screen" title="no title" charset="utf-8">
    <script src="https://code.jquery.com/jquery-2.2.4.js" charset="utf-8"></script>
    <meta name="robots" content="noindex,follow" />
	
	
	<style>
	 .clasificacion
	{
	 position: relative;
	   right: 50%;
	}
	input[type="radio"] {
	  display: none;
	}

	label {
	  color: grey;
	}

	.clasificacion {
	  direction: rtl;
	  unicode-bidi: bidi-override;
	}

	label:hover,
	label:hover ~ label {
	  color: orange;
	}

	input[type="radio"]:checked ~ label {
	  color: orange;
	}

    .checked {
    color: orange;
    }
	</style>
	
	<script>
	$(document).ready(function(){
		$(".compra").click(function(){
		 alert("Su compra se realizo con exito!!");
		});
	});
	</script>
	
  </head>
  <body>
   <!---Menu horizontal-->
     <div id="c-slider">
		<header>
		 <div class="contenedor">
			  <a href="">
			  <img src = "img/banner2.png">
			  </a>

		 </div>
		 	
		 <div class="container">
			
			<a href="">
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
			  <img src = "img/icon_140-1.png" class="add_p"  width="45px"  style="left:1400px;"/>
			</a>
			
			</div>
	    </header>
	</div>
	
	 <!-- Carrito de compras -->
		<div class="shopping-cart">
		  <!-- Title -->
		  <div class="title">
			Ayudanos a mejorar...
		  </div>
		  
    	<form id="CreateForm" action="php/m_update_valoracion.php" method="post">

		  <?php 
			include 'php/conexion.php';

			 $id = $_SESSION['Usuario'];
			 
			
			 $consulta="call P_carrito_articulos(1,".$id.");";
			 
			 //Procesa el query
			 $resultado=$conexion->query($consulta);
			 
			 $var=1;
			 $num=1;
			 while($fila=$resultado->fetch_array())
             {
		 ?>
		  <!-- Product #1 -->
		  <div class="item">
			<div class="image">
			  <?php echo '<img height="150" src="data:image/jpeg;base64,'.base64_encode($fila['img1']) .'" />'; ?>
			</div>

			<div class="description">
			  <span><?php echo $fila['nombre_Art'] ?></span>
			  <span><?php echo $fila['descripcion'] ?></span>
			</div>
			
			<input type="hidden" name="compra[]" value="<?php echo $fila['id_compra'] ?>">

			
			<div class="estrellas_s" style="position:relative; left:150px;">
			<span style="position:relative; right:45px;">Calificacion</span>
				<p class="clasificacion" style=" font-size: 25px;">
				   <input id="<?php echo "radio".$var; ?>" type="radio" name="<?php echo "estrellas".$num; ?>" value="5"><!--
				--><label for="<?php echo "radio".$var; ?>">★</label><!--
				<?php $var++; ?>
				--><input id="<?php echo "radio".$var; ?>" type="radio" name="<?php echo "estrellas".$num; ?>" value="4"><!--
				--><label for="<?php echo "radio".$var; ?>">★</label><!--
				<?php $var++; ?>
				--><input id="<?php echo "radio".$var; ?>" type="radio" name="<?php echo "estrellas".$num; ?>" value="3"><!--
				--><label for="<?php echo "radio".$var; ?>">★</label><!--
				<?php $var++; ?>
				--><input id="<?php echo "radio".$var; ?>" type="radio" name="<?php echo "estrellas".$num; ?>" value="2"><!--
				--><label for="<?php echo "radio".$var; ?>">★</label><!--
				<?php $var++; ?>
				--><input id="<?php echo "radio".$var; ?>" type="radio" name="<?php echo "estrellas".$num; ?>" value="1"><!--
				--><label for="<?php echo "radio".$var; ?>">★</label>
				<?php $var++; $num++;  ?>
				</p>
           </div>
			
		  </div>

		  <?php
		   } 
			mysqli_free_result($resultado);
			mysqli_close($conexion);
		 ?>
			</div>
		<div>
		</form>
		
		<button  type="submit" form="CreateForm" 
		style="background-color: #CD678B; position:absolute; border: none; left:700px; padding: 15px 32px; color: white;">Comprar</button>
		
	
		<br/>
		<br/>
	
		<br/>
		<br/>
	
    
  </body>
</html>
