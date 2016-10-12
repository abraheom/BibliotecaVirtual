<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
	<!--<script type="text/javascript" src="../js/jquery-2.1.1.min.js"></script>-->
	<link type="" href="http://img.xataka.com/2012/01/ibooks-icono.jpg" rel="icon" />
	<link rel="stylesheet"  href="<?php echo URL; ?>public/css/index.css">
	<script type="text/javascript" src="../views/cPanel/js/script.js"></script>
	<script type="text/javascript" src="../views/cPanel/js/funcionesAdmin.js"></script>
	<link rel="stylesheet" type="text/css" href="../public/fonts/flaticon.css">
	<link rel="stylesheet" href="../views/cPanel/css/index.css">
	<link rel="stylesheet" href="../views/cPanel/css/funcionesAdmin.css">
	<title>Biblioteca virtual</title>
</head>
<body>
<header>
	<a id="web" href="Index">Biblioteca Virtual</a>

	<nav>
		<a href="./" class="Boton">Inicio</a>
		<a href="../Productos" class="Boton">Productos</a>
		<a href="../Registrarse" class="Boton">Registrarse</a>
		<a href="../Contacto" class="Boton">Contacto</a>
	</nav>
</header>
<section id="seccion">
<?php
if(Session::exist('IdUsuario')) {
	if(Session::getValue("TipoUsuario") != "Administrador")
		header("location: Index");
}
else 
	header("location: Index");
?>
	<div class="menu">
		<div class="title-li2"><a onclick="getForms('NuevoProducto')">Ingresar Productos</a></div>
		<div class="title-li">Mi cuenta</div>
		<ul>
			<li><a onclick="getForms('Perfil')">Perfil</a></li>
			<li><a onclick="getForms('ChangePassword')">Cambiar contraseña</a></li>
			<li><a onclick="signout()" class="close-session">Cerrar sesion</a></li>
		</ul>
		<div class="title-li">Listado de tablas</div>
		<ul>
			<li><a onclick="getTableRows('usuarios')">Usuarios</a></li></li>
			<li><a onclick="getTableRows('productos')">Productos</a></li>
			<li><a onclick="getTableRows('contactos')">Contactos</a></li>
			<li><a onclick="getTableRows('compra')">Compras</a></li>
		</ul>
	</div>
	<div class="panel">
		<?php cPanel::getForms("Perfil"); ?>
	</div>
</section>
<div id="footer">
	<div style="text-align:center;padding:15px;font-size:14px;color:#fff;">Todos los derechos reservados. El Salvador 2014</div>
</div id="footer">
</body>
</html>