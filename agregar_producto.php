<?php
session_start();
?>
<!doctype html>
<html lang="en"> <!--declarar idioma--> 
  <head>
    <title>Registrarse</title>
    <link rel="shortcut icon" type= "image/x-icon" href= "img/ico2.ico">
    <meta charset="UTF-8">
		<link rel="stylesheet" href="css/menu.css">
		<link rel="stylesheet" href="css/cuenta.css">
		<style>
		 
			
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
		
		
	<!-- INFORMACION PARA LA BASE DE DATOS  -->
    <form class="contenido" action="php/m_agregar_producto.php" method="POST" enctype="multipart/form-data">
	   <img src = "img/banner.jpg"  width="220px" height="70px"/>
	    <br/>
	    <h3>Articulo</h3>
		
		<br/>
		<input type="text" placeholder="&#9726; Nombre del articulo" name="articulo" required>
		
		<br/>
		<input type="text" placeholder="&#9726; Descripcion" name="descripcion" required>
		
		<br/>
        <input type="number" onkeypress="validate(event)"  min="0" step=".01" placeholder="&#128176; Precio" name="precio" required>
		
		<br/>
		<input type="number" onkeypress="validate(event)"  min="0" step="1" placeholder="&#9997; Unidades" name="unidades" required>
		
		<br/>
		<input type="number" onkeypress="validate(event)"  min="0" step="1" placeholder="&#128184; Oferta" name="oferta" required>
		
		<br/>		
		<select name="categoria" required>
		
		  <option value="">&#9726; Selecciona la categoria</option>
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
		<input type="checkbox" name="publicar" style="height: 20px;" checked><br>
		
        <br/>
		<div class="multimedia">
		    <!--IMAGENESSSS-->
			<label for="Imagen1">Imagen 1</label>
			<input type="file" name="foto1" onchange="readURL(this, '#blah');" required> 
			</br>
            <img id="blah" src=""/>
			<script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
			
			
			<br/>
			<label for="Imagen2">Imagen 2</label>
			<input type="file" name="foto2" onchange="readURL(this, '#blah2');" required>
            </br>
            <img id="blah2" src=""/>
			<script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
			
			<br/>
			<label for="Imagen3">Imagen 3</label>
			<input type="file" name="foto3" onchange="readURL(this, '#blah3');" required> 
			</br>
            <img id="blah3" src=""/>
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
			  <source src="" id="video_here">
			</video>

			<input type="file" name="video" class="file_multi_video" accept="video/*">

	     </div>
		<br/>
		<input type="submit" Value="Registar" style="position:relative; left: 20%; width:250px;">
		<br/>
		
		 <script  src="js/preview_fotos.js"></script>
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
