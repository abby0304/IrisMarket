<?php session_start(); ?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-6">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Carrito de compras</title>

	<link rel="stylesheet" href="css/menu.css">
	<link rel="shortcut icon" type= "image/x-icon" href= "img/ico2.ico">
    <link rel="stylesheet" href="icon/style.css" media="screen" title="no title" charset="utf-8">
    <script src="https://code.jquery.com/jquery-2.2.4.js" charset="utf-8"></script>
    <meta name="robots" content="noindex,follow" />


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
			  <input type="text" name="buscar_articulo" placeholder=" &#128269; Buscar..." style="width:12%;">
			  <input type="checkbox" name="check" style="display:none;" id="subscribe" checked>
			  <input type="submit"  value="Buscar" style="position:absolute; left: 23%; width: 80px;">
		 </form>
		  
		 </div>
		 	
		 <div class="container">
		 
		 <a href="agregar_producto.php">
			  <img src = "img/icon3.png" class="add_p"  width="50px" height="45px"/>
			</a>
			
		 
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
			
			
			<a href="index.php">
			  <img src = "img/icon_140-1.png" class="add_p"  width="45px"  style="left:1400px;"/>
			</a>
			
			</div>
	    </header>
	</div>
	
    <!--INFO PRODUCTOOOOOOOOO-->
	 <!-- Carrito de compras -->
		<div class="shopping-cart">
		  <!-- Title -->
		  <div class="title">
			Carrito
		  </div>

		  <!-- Product #1 -->
		  <!--Foto y nombre-->
	<form action="php/m_update_Total_carrito.php" method="post">

		<?php 
			include 'php/conexion.php';

			 $id = $_SESSION['Usuario'];
			 
			
			 $consulta="call P_carrito_articulos(1,".$id.");";
			 
			 //Procesa el query
			 $resultado=$conexion->query($consulta);
			 
			 
			 while($fila=$resultado->fetch_array())
             {
				 
				
			  mysqli_close($conexion);
			  include 'php/conexion.php';
			  
			  
			$consulta2="CALL P_oferta(".$fila['precio'].",".$fila['oferta'].");";
			
			$resultado2=mysqli_query($conexion, $consulta2);
			
			$fila2=$resultado2->fetch_array();
		 ?>

		  <div class="item">
		  <!--ELIMINAR CARRITOOOOOO-->
			<div class="buttons">  
			 <a href="<?php echo "php/m_eliminar_carrito.php?id=".$fila['id_compra']; ?>">
			  <img src="icon/delete-icn.svg" alt="" />
			 </a>
			</div>
			
			

			<div class="image">
			<input type="hidden" id="numero_uni" value="<?php echo $fila['unidades'] ?>">
			 <?php echo '<img height="150" src="data:image/jpeg;base64,'.base64_encode($fila['img1']) .'" />'; ?>
			</div>

			<div class="description">
			  <span style ="color:#CD678B;"><b><?php echo $fila['nombre_Art'] ?></b></span>
			  <span><?php echo $fila['descripcion'] ?></span>
			  <span><?php echo $fila['oferta']."%" ?></span>
			</div>

			<input type="hidden" name="compra[]" value="<?php echo $fila['id_compra'] ?>">

		
			<div class="quantity">
			  <button class="plus-btn" type="button" name="button">
				<img src="icon/plus.svg" alt="" />
			  </button>
			  <input type="text" name="name[]" value="<?php echo $fila['u_c'] ?>" >
			  <button class="minus-btn" type="button" name="button">
				<img src="icon/minus.svg" alt="" />
			  </button>
			</div>
           
			<div class="total-price"><b><?php echo "$ ".$fila2['descuento']*$fila['u_c'];?></b></div>
		  </div>
		  <?php
		   } 

			mysqli_free_result($resultado);
            mysqli_close($conexion);
			 ?>

		 
		  <div>
		  <?php
		   include 'php/conexion.php';
				
			 $consulta3="call P_carrito_articulos(2,". $_SESSION['Usuario'].");";
			 
			 //Procesa el query
			 $resultado3=$conexion->query($consulta3);
			
			  if($fila3=$resultado3->fetch_array())
			  {
		  ?>
		    
		    <div class="total-price" style="position:relative; left:640px; font-size: 20px; color:#CD678B;"><b> Total</b></div>
		    <div class="total-price" style="position:relative; left:620px; font-size: 20px;"><b><?php echo "$ ".$fila3['total'] ?></b> </div>
			<br/>
			<input type="submit" name="recargar" style="position:relative; width:20%; left:570px; " value="Recargar Precio">
			<br/>
			<br/>
		 <?php
		 } 

		mysqli_free_result($resultado3);
		mysqli_close($conexion);
		 ?>
		  </div>
		 </form>
		</div>
		
		<!--FORMA DE PAGOOOOOOO-->
       <form id="CreateForm" action="php/m_update_carrito.php" method="post">

		<div class="forma-pago" style="position:absolute; left:550px;"> 
			<label>Formas de pago: </label>
			
			<br/>
			<br/>
			
			<input type="radio" name="gender" id="myCheckbox" value="1" checked />
            <label for="myCheckbox"> 
			<img src="icon/f1.png" alt="" height="50px" style="padding-left: 20px;" />
			</label>
			
			
			<input type="radio" name="gender" id="myCheckbox2" value="2"/>
            <label for="myCheckbox2"> 
				<img src="icon/f2.png" alt="" height="50px" style="padding-left: 20px;"/>
            </label>
			
	
			<input type="radio" name="gender" id="myCheckbox3" value="3"/>
            <label for="myCheckbox3"> 
				<img src="icon/f3.png" alt="" height="50px" style="padding-left: 20px;"/>
			</label>
			
			<br/>
			<br/>
			
			<label>Numero: </label><input type="text" pattern=".{8,8}" name="numero_tarjeta" id="myCheckbox" required />
		</div>
		</form>
		
		<br/>
		<br/>
		<br/>
		<br/>
		<br/>
		<br/>
		<br/>
		<br/>
		<br/>
		
		<!--<a href="valoracion.html"><input type="submit" value="Comprar"/></a> -->

		<button  type="submit" form="CreateForm" 
		style="background-color: #CD678B; position:absolute; border: none; left:700px; padding: 15px 32px; color: white;">Comprar</button>
		
		<br/>
		<br/>
		
		<br/>
		<br/>
		
	
	
	<!-- Incrementar productos -->
    <script type="text/javascript">
      $('.minus-btn').on('click', function(e) {
    		e.preventDefault();
    		var $this = $(this);
    		var $input = $this.closest('div').find('input');
    		var value = parseInt($input.val());

    		if (value > 1) {
    			value = value - 1;
    		} else {
    			value = 0;
    		}

        $input.val(value);

    	});

    	$('.plus-btn').on('click', function(e) {
    		e.preventDefault();
    		var $this = $(this);
    		var $input = $this.closest('div').find('input');
    		var value = parseInt($input.val());
			var inputs = $('#numero_uni');
			var asociado = parseInt($(inputs).val());

    		if (value < asociado) {
      		value = value + 1;
			
    		} else {
    			value =1;
    		}

    		$input.val(value);
    	});

      $('.like-btn').on('click', function() {
        $(this).toggleClass('is-active');
      });
    </script>
  </body>
</html>
