<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
	<link type="" href="http://img.xataka.com/2012/01/ibooks-icono.jpg" rel="icon" />
	<link rel="stylesheet" href="public/css/index.css">
	<title>Biblioteca virtual</title>
	<script type="text/javascript" src="public/js/contacto.js"></script>
</head>
<body>
<header>
	<a id="web" href="index.php">Biblioteca Virtual</a>
	<nav>
		<a href="./" class="Boton">Inicio</a>
		<a href="Productos" class="Boton">Productos</a>
		<?php if(!Session::exist("IdUsuario") || Session::getValue("TipoUsuario")=="Administrador"){echo '<a href="Registrarse" class="Boton">Registrarse</a>';} ?>
		<a href="Contacto" class="Boton">Contacto</a>
	</nav>
</header>
<section id="seccion">
	<article>
		<div id="divRegistro">
			<h2 class="titulo">Contactanos</h2>
			<p>Si tienes un problema para pagar, duda, segerencias o pedidos en cuanto al rugro de esta pagina no dudes en contactarnos, con el equipo desarrollador debatiremos tus propuestas o nos comunicaremos contigo si tienes problemas</p>
			<form action="PHP/dbContacto.php" id="formRegistro">
				<fieldset>
					<legend>Formulario de contacto</legend>
					<table>
						<tr>
							<td>Nombre</td>
							<td><input type="text" placeholder="Nombre Completo" class="camposTexto" onblur="evaluar(this)" id="Name" name="Nombre"></td>
						</tr>
						<tr>
							<td>Email:</td>
							<td><input type="text" placeholder="ejemplo@ejemplo.com" class="camposTexto" onblur="evaluar(this)" id="Email" name="Email"></td>
						</tr>
						<tr>
							<td>Telefono:</td>
							<td><input type="text" placeholder="2000-0000" class="camposTexto" onblur="evaluar(this)" id="telefono"  name="Telefono" onkeypress="evaluarTelefono()"></td>
						</tr>
						<tr>
							<td style="vertical-align:top;">Mensaje:</td>
							<td><textarea class="camposTexto" rows="8" onblur="evaluar(this)" id="mensaje" name="Mensaje"></textarea></td>
						</tr>
						<tr>
							<td colspan="2">
								<input type="button" id="btnEnviar" value="Enviar" onclick="enviarMensaje()">
							</td>
						</tr>
					</table>
				</fieldset>
			</form>
		</div>
	</article>
	<aside>
		<script type="text/javascript" src="public/js/login.js"></script>
		<div id="divLogin">
			<?php (new Loguear())->Index(); ?>
		</div>
	</aside>
	<div id="clearFloat"></div>
</section>
<div id="footer">
	<div style="text-align:center;padding:15px;font-size:14px;color:#fff;">Todos los derechos reservados. El Salvador 2016</div>
</div id="footer">
</body>
</html>