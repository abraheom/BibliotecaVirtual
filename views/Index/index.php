<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
	<link type="" href="http://img.xataka.com/2012/01/ibooks-icono.jpg" rel="icon" />
	<link rel="stylesheet" href="public/css/index.css">
	<title>Biblioteca virtual</title>
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
		<div class="titulo textoCentrado">¡¡¡¡¡Bienvenido seas, viajero virtual!!!!!</div>
		<p>
			En <label class="link"><a href="./">bibliotecavirtual.com</a></label> te brindamos la oportunidad de hacer una sola orden para comprar libros en diferentes países, realizar un solo pago y se lo entregamos en la dirección que tu indiques. Contamos con una gran variedad de libros de todos los temas para ofrecerte lo mejor en literatura, libros juveniles, libros infantiles, de historia, libros de filosofía, libros para regalar, narrativa romántica, literatura erótica, libros de bolsillo, además de una larga lista de libros técnicos.
		</p>
		<p>
			Te invitamos a navegar por nuestra seccion de <label class="link"><a href="Productos">Productos</a></label> para que puedas ver nuestra amplia y abastecida lista de productos, !En <labl class="link"><a href="./">bibliotecavirtual.com</a></labl> puedes conseguir cualquier libro que busques!
		</p>
		<p>
			En caso de que no encuentres entre los títulos ninguno de tu gusto, puedes pedirlo enviando un correo a <label class="link">pedidos@bibliotecavirtual.uhostfull.com</label> o en la pagina <label class="link">
			<a href="Contacto">Contacto</a></label>
		</p>

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