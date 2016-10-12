<?php
require "../../PHP/database.php";
mysql_connect($db_host,$db_user,$db_pass);
mysql_select_db($db_name);

if($_POST['Tabla']=="Usuarios"){
	mysql_query("DELETE FROM usuarios where IdUsuario='$_POST[Id]'")or die(mysql_error());
	echo "N° de filas afectadas: ".mysql_affected_rows();
}

if($_POST['Tabla']=="Cotizaciones"){
	mysql_query("DELETE FROM cotizaciones where IdCotizacion='$_POST[Id]'")or die(mysql_error());
	echo "N° de filas afectadas: ".mysql_affected_rows();
}
else {
	mysql_query("DELETE FROM ".$_POST['Tabla']." where Id='$_POST[Id]'")or die(mysql_error());
	echo "N° de filas afectadas: ".mysql_affected_rows();
}
?>
	