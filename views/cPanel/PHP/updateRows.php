<?php
require "../../PHP/database.php";
mysql_connect($db_host,$db_user,$db_pass);
mysql_select_db($db_name);
if($_POST['Tabla']=="Usuarios"){
	$consulta = mysql_query("UPDATE usuarios set tipoUsuario='$_POST[tipoUsuario]', Nombres='$_POST[Nombres]', Apellidos='$_POST[Apellidos]', Email='$_POST[Email]', Password='$_POST[Password]', Telefono='$_POST[Telefono]', FechaNacimiento='$_POST[FechaNacimiento]',Direccion='$_POST[Direccion]' where IdUsuario='$_POST[Id]'")or die(mysql_error());
}
if($_POST['Tabla']=="Productos"){
	if($_POST["ImgPortada"]=="si"){
		$temName = '../files/temporalFileImg.jpg';
		$fp = fopen($temName, "rb");
		$contenido = fread($fp, filesize($temName));
		$ImgPortada = addslashes($contenido);//se escapan los caracteres especiales
		fclose($fp);

		
		$consulta = mysql_query("UPDATE Productos set Titulo='$_POST[Titulo]', Autor='$_POST[Autor]', Editorial='$_POST[Editorial]', Idioma='$_POST[Idioma]', FechaPublicacion='$_POST[FechaPublicacion]', Precio='$_POST[Precio]',Descripcion='$_POST[Descripcion]', ImgPortada='$ImgPortada' where Id='$_POST[Id]'")or die(mysql_error());
	}
	else
		$consulta = mysql_query("UPDATE Productos set Titulo='$_POST[Titulo]', Autor='$_POST[Autor]', Editorial='$_POST[Editorial]', Idioma='$_POST[Idioma]', FechaPublicacion='$_POST[FechaPublicacion]', Precio='$_POST[Precio]',Descripcion='$_POST[Descripcion]' where Id='$_POST[Id]'")or die(mysql_error());
}
if($_POST['Tabla']=="Cotizaciones"){
	$consulta = mysql_query("UPDATE cotizaciones set FechaDeCotizacion='$_POST[FechaCotizacion]', NombreCliente='$_POST[NombreCliente]', Informacion='$_POST[Informacion]' where IdCotizacion='$_POST[Id]'")or die(mysql_error());
}
if($_POST['Tabla']=="Contactos"){
	$consulta = mysql_query("UPDATE contactos set Nombre='$_POST[Nombre]', Email='$_POST[Email]', Telefono='$_POST[Telefono]', Mensaje='$_POST[Mensaje]' where Id='$_POST[Id]'")or die(mysql_error());
}
if($consulta){
?>
	<div align="center">
		<div class="titulo-2">¡Datos Guardados Exitosamente!</div>
	</div>
	<div class="divBotonesEdit" align="center">
		<input type='button' value='Cerrar' title="Cerrar esta ventana" onclick='ventanaEmergente_Close()'>
	</div>
<?php
}
else 
{
?>
	<div align="center">
		<div class="titulo-2">¡Error Al guardar!</div>
	</div>
	<div class="divBotonesEdit" align="center">
		<input type='button' value='Cerrar' title="Cerrar esta ventana" onclick='ventanaEmergente_Close()'>
	</div>
<?php
}
?>
	