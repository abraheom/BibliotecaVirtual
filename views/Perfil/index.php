<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
	<script type="text/javascript" src="public/js/login.js"></script>
	<script type="text/javascript" src="public/js/perfil.js"></script>
	<link type="" href="http://img.xataka.com/2012/01/ibooks-icono.jpg" rel="icon" />
	<link rel="stylesheet" href="public/css/index.css">
	<link rel="stylesheet" href="public/css/perfil.css">
	<title>Biblioteca virtual</title>
</head>
<body>
<header>
	<a id="web" href="index.php">Biblioteca Virtual</a>
	<nav>
		<a href="./" class="Boton">Inicio</a>
		<a href="Productos" class="Boton">Productos</a>
		<?php if(!Session::exist("IdUsuario")){echo '<a href="Registrarse" class="Boton">Registrarse</a>';} ?>
		<a href="Contacto" class="Boton">Contacto</a>
	</nav>
</header>
<section id="seccion">
<?php
function miFecha($fecha){
  $mes = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
  return substr($fecha,8,2)." de ". $mes[(substr($fecha,5,7)-1)]." de ".substr($fecha,0,4);
}
if(isset($_SESSION['IdUsuario']) and !empty($_SESSION['IdUsuario'])) {
	$IdUsuario=$_SESSION['IdUsuario'];
	$consulta = MySQLDriver::consulta("SELECT * FROM usuarios WHERE IdUsuario='$IdUsuario' LIMIT 1");
	$reg=mysql_fetch_array($consulta);
	if($reg['tipoUsuario']=="Administrador")
		header("location:cPanel/");
}
else {
	header("location: ./Index");
}
?>
<div class="full_Width">
	<div id="perfilArea2">
		<table cellspacing="5" width="100%">
			<tr>
				<td width="160" rowspan="6">
				<div class="divPerfilUploading">
					
					<span class="btnCambiarImagenPerfil" onclick="getExplorerFile()">Cambiar Imagen</span>
					<img id="imgPerfil" <?php  echo 'src="public/imagenes/Perfil/'.$reg['ImgPerfil'].'"'; ?>>
					<form action="PHP/uploadImgPerfil.php" method="post" enctype="multipart/form-data" style="display:none;">
						<input type="file" name="archivo" id="ImgPerfil" class="imgFile" style="display:none;" onchange="UploadImg('Perfil')">
						<input type="submit" style="display:none;" id="btnSubmit">
					</form>
				</div>
				</td>
			</tr>
			<tr>
				<td colspan="2">
				<label class="NombrePerfil"><label class="lblEdit"><img src="public/imagenes/edit.png"> Editar</label><?php echo $reg['Nombres']." "; echo $reg['Apellidos']; ?></label>
				</td>
				<td align="right">
					<spam id="btn" onclick="if(window.lista.style.display=='inline-block'){window.lista.style.display='none'}else {window.lista.style.display='inline-block'}">Acciones</spam><spam id="lista">
					<ul>
					  <!--<li>Editar perfil</li>-->
					  <li onclick="miscompras();" title="Mostrar todas las compras realizadas">Mis compras</span></li>
					  <li onclick="logout();">Cerrar session</li>
					</ul>  
					</spam>
				</td>
			</tr>
			<tr>
				<td><label class="lblEdit"><img src="imagenes/edit.png"> Editar</label><label class="PerfilValor"><?php echo $reg['Email']; ?></label></td>
			</tr>
			<tr>
				<td><label class="lblEdit"><img src="imagenes/edit.png"> Editar</label><label class="PerfilValor"><?php echo $reg['Telefono']; ?></label></td>
			</tr>
			<tr>
				<td><label class="lblEdit"><img src="imagenes/edit.png"> Editar</label><label class="PerfilValor"><?php echo miFecha($reg['FechaNacimiento']); ?></label></td>
			</tr>
			<tr>
				<td><label class="lblEdit"><img src="imagenes/edit.png"> Editar</label><label class="PerfilValor"><?php echo $reg['Direccion']; ?></label></td>
			</tr>
		</table>
	</div>
	<div class="misCompras">
		
	</div>
	<div id="clearFloat"></div>
</div>
</section>
<div id="footer">
	<div style="text-align:center;padding:15px;font-size:14px;color:#fff;">Todos los derechos reservados. El Salvador 2016</div>
</div id="footer">
</body>
</html>