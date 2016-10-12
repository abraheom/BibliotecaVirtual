<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
	<script type="text/javascript" src="public/js/Carrito.js"></script>
	<link type="" href="http://img.xataka.com/2012/01/ibooks-icono.jpg" rel="icon" />
	<link rel="stylesheet" type="text/css" href="public/fonts/flaticon.css">
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
<?php
if(isset($_SESSION['IdUsuario']))
{
?>
<div class="contenedorCarrito">
  <div class="carrito">
    <img src="http://cdn.flaticon.com/png/256/34568.png" width="40" style="margin-top:-25px;margin-bottom:-12px;">
    Carrito de compras
    <span class="countProduct">0</span>
    <div class="divVistaCarrito">
      <div class="trianguloVista1"></div>
      <div class="trianguloVista2"></div>
      <div class="divVistaCarrito2">
        <?php CarritoCompras::verCarrito(); ?>
      </div>
    </div>
  </div>
</div>
<?php
}
?>

</header>
<section id="seccion">
	<article>
		<div id="productos">
			<?php
				Productos::ObtenerProductos();
			?>
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