<?php session_start(); ?>
<!doctype html>
<html lang="en"> <!--declarar idioma--> 
  <head>
    <title>Modificar Producto</title>
    <link rel="shortcut icon" type= "image/x-icon" href= "img/ico2.ico">
    <meta charset="UTF-8">
		<link rel="stylesheet" href="css/menu.css">
		<link rel="stylesheet" href="css/cuenta.css">
		<style>
		  body
			{
				background:url(imagenes/11.jpg);
				background-repeat:no-repeat;
				width:100%;
				height:100%;
				display:flex;
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
			  
			 <form action="buscar.php" method="GET">
			  <input type="text" name="buscar_articulo" placeholder=" &#128269; Buscar..." style="width:15%;">
			  <input type="checkbox" name="check" style="display:none;" id="subscribe" checked>
			  <input type="submit"  value="Buscar" style="position:absolute; left: 26%; width: 80px;">
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
		
	<form class="contenido" action="php/m_update_producto.php" method="POST" enctype="multipart/form-data">

	 <?php 
		include 'php/conexion.php';
		 
		
		 $consulta="call P_set_usuario(2, ".$_GET["id"].");";
		 
		 //Procesa el query
		 $resultado=$conexion->query($consulta);
		 

		 if($fila=$resultado->fetch_array())
		 {
			 
	   ?>
	<!-- INFORMACION PARA LA BASE DE DATOS  -->
	   <img src = "img/banner.jpg"  width="220px" height="70px"/>
	    <br/>
	    <h3>Articulo</h3>
		
		<input type="hidden" name="id_a" value="<?php echo $_GET["id"] ?>">
		
		<input type="hidden" name="id_m" value="<?php echo $fila['id_multi'] ?>">
		
		<input type="hidden" name="id_ca" value="<?php echo $fila['id_catearti'] ?>">
		
		<br/>
		<input type="text" placeholder="&#9726; Nombre del articulo" name="articulo" value="<?php echo $fila['nombre_Art'] ?>">
		
		<br/>
		<input type="text" placeholder="&#9726; Descripcion" name="descripcion" value="<?php echo $fila['descripcion'] ?>">
		
		<br/>
        <input type="number" onkeypress="validate(event)"  min="0" step=".01" placeholder="&#128176; Precio" name="precio" value="<?php echo $fila['precio'] ?>">
		
		<br/>
		<input type="number" onkeypress="validate(event)"  min="0" step="1" placeholder="&#9997; Unidades" name="unidades" value="<?php echo $fila['unidades'] ?>">
		
		<br/>
		<input type="number" onkeypress="validate(event)"  min="0" step="1" placeholder="&#128184; Oferta" name="oferta" value="<?php echo $fila['oferta'] ?>">
		
		<br/>		
		<select name="categoria" >
		
		  <option value="<?php echo $fila['fk_categoria'] ?>"><?php echo $fila['nombre_Cate']; ?></option>
		  <?php 
		    include 'php/Conexion.php';
			
			$consulta2="call P_Vcategoria();";
			 
			 //Procesa el query
			 $resu=$conexion->query($consulta2);
			 
			 while($fila2 = $resu->fetch_array()){
		  ?>
		  <option value="<?php echo $fila2['id_categoria']; ?>"><?php echo $fila2['nombre_Cate']; ?></option>

		  <?php
			 } 
			mysqli_free_result($resu);
            mysqli_close($conexion);
			 ?>
		</select>
		
		<br/>
		<label for="publicar">Publicar articulo</label>
		<input type="checkbox" name="publicar" style="height: 20px;" <?php if($fila['publicar']==1){ echo "checked";}?>><br>
		
        <br/>
		<div class="multimedia">
		    <!--IMAGENESSSS-->
			<label for="Imagen1">Imagen 1</label>
			<input type="file" name="foto1" onchange="readURL(this, '#blah');" required> 
			</br>
            <img id="blah" src="<?php echo 'data:image/jpeg;base64,'.base64_encode($fila['img1']) ?>"/>
			<script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
			
			
			<br/>
			<label for="Imagen2">Imagen 2</label>
			<input type="file" name="foto2" onchange="readURL(this, '#blah2');" required>
            </br>
            <img id="blah2" src="<?php echo 'data:image/jpeg;base64,'.base64_encode($fila['img2']) ?>"/>
			<script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
			
			<br/>
			<label for="Imagen3">Imagen 3</label>
			<input type="file" name="foto3" onchange="readURL(this, '#blah3');" required> 
			</br>
            <img id="blah3" src="<?php echo 'data:image/jpeg;base64,'.base64_encode($fila['img3']) ?>"/>
			<script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
			
			
			<!--VIDEOOOOOOOOOOO-->
		   <script>
			  $(document).on("change", ".file_multi_video", function(evt) {
				  var $source = $('#video_here');
				  $source[0].src = URL.createObjectURL(this.files[0]);
				  $source.parent()[0].load();
				});
			</script>
			
			<br/>
			<label for="video">Selecciona un video</label>
			<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>

			<video width="420" controls>
			  <source src="<?php echo "video/".$fila['video'] ?>" id="video_here">
			</video>

			<input type="file" name="video" class="file_multi_video" accept="video/*">

	     </div>
		<br/>
		<input type="submit" Value="Modificar" style="position:relative; left: 20%; width:250px;">
		<br/>
		
		 <script  src="js/preview_fotos.js"></script>

	   <?php
	   } 
		
	   ?>
     </form>
	   

	<script>
	 function validate(e) {
	  var ev = e || window.event;
	  var key = ev.keyCode || ev.which;
	  key = String.fromCharCode( key );
	  var regex = /[0-9]/;
	  if( !regex.test(key) ) {
		ev.returnValue = false;
		if(ev.preventDefault) ev.preventDefault();
	  }
    }
	</script>
	
	
  </body>
</html>
