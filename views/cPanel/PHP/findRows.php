<?php
require "../../PHP/database.php";
mysql_connect($db_host,$db_user,$db_pass);
mysql_select_db($db_name);

if($_POST['Tabla']=="usuarios"){
	$consulta = mysql_query("SELECT * FROM usuarios where TipoUsuario like '%".$_POST['Busqueda']."%' or Nombres like '%".$_POST['Busqueda']."%' or Apellidos like '%".$_POST['Busqueda']."%' or Email like '%".$_POST['Busqueda']."%'")or die("<div class='mensajeError'>Error al buscar...</div>".mysql_error());
	while($reg=mysql_fetch_array($consulta))
	{ 
		if($reg['tipoUsuario']=="Administrador")
			$classTipoUser="flaticon-important";
		else 
			$classTipoUser="flaticon-user91";
		echo "<tr class='tr'><td align='center' width='15'>".$reg['IdUsuario']."</td><td width='100'><span class='".$classTipoUser."'></span> ".$reg['tipoUsuario']."</td><td>".$reg['Nombres']." ".$reg['Apellidos']."</td><td>".$reg['Email']."</td><td align='right'><span class='flaticon-expand span-btn-admin' title='Detalles' onclick='expandDetails(this,\"Usuarios\",".$reg['IdUsuario'].")'></span><span class='flaticon-black322 span-btn-admin' title='Editar' onclick='editRows(this,\"Usuarios\",".$reg['IdUsuario'].")'></span><span class='flaticon-delete81 span-btn-admin' title='Borrar' onclick='deleteUser(this,\"Usuarios\",".$reg['IdUsuario'].")'></span></td></tr>";
	}
}
if($_POST['Tabla'] == "productos"){
	$consulta = mysql_query("SELECT * FROM productos where Titulo like '%".$_POST['Busqueda']."%' or Autor like '%".$_POST['Busqueda']."%'  ")or die("<div class='mensajeError'>Error al buscar...</div>".mysql_error());
	while($reg=mysql_fetch_array($consulta))
	{ 
		echo "<tr class='tr'><td><img class='portadaLibroReg' src='data:image/jpeg;base64,".base64_encode($reg['ImgPortada'])."'></td><td align='center'>".$reg['Id']."</td><td>".substr($reg['Titulo'],0,40)."..."."</td><td>".$reg['Autor']."</td><td align='right'><span class='flaticon-expand span-btn-admin' title='Detalles' onclick='expandDetails(this,\"Productos\",".$reg['Id'].")'></span><span class='flaticon-black322 span-btn-admin' title='Editar' onclick='editRows(this,\"Productos\",".$reg['Id'].")'></span><span class='flaticon-delete81 span-btn-admin' title='Borrar' onclick='deleteUser(this,\"Productos\",".$reg['Id'].")'></span></td></tr>";
	}
}
if($_POST['Tabla'] == "cotizaciones"){
	$consulta = mysql_query("SELECT * FROM cotizaciones where FechaDeCotizacion like '%".$_POST['Busqueda']."%' or Informacion like '%".$_POST['Busqueda']."%'")or die("<div class='mensajeError'>Error al buscar...</div>".mysql_error());
	while($reg=mysql_fetch_array($consulta))
	{ 
		echo "<tr class='tr'><td><img class='portadaLibroReg' src='data:image/jpeg;base64,".base64_encode($reg['ImgProducto'])."'></td><td align='center'>".$reg['IdCotizacion']."</td><td>".$reg['FechaDeCotizacion']."</td><td>".$reg['Informacion']."</td><td align='right'><span class='flaticon-expand span-btn-admin' title='Detalles' onclick='expandDetails(this,\"Cotizaciones\",".$reg['IdCotizacion'].")'></span><span class='flaticon-black322 span-btn-admin' title='Editar' onclick='editRows(this,\"Cotizaciones\",".$reg['IdCotizacion'].")'></span><span class='flaticon-delete81 span-btn-admin' title='Borrar' onclick='deleteUser(this,\"Cotizaciones\",".$reg['IdCotizacion'].")'></span></td></tr>";
	}
}
if($_POST['Tabla'] == "encuesta"){
	$consulta = mysql_query("SELECT * FROM encuesta where FechaRealizacion like '%".$_POST['Busqueda']."%'")or die("<div class='mensajeError'>Error al buscar...</div>".mysql_error());
	while($reg=mysql_fetch_array($consulta))
	{ 
		echo "<tr class='tr'><td align='center'>".$reg['Id']."</td><td>".$reg['FechaRealizacion']."</td><td>".$reg['p1']."</td><td>".$reg['p2']."</td><td align='right'><span class='flaticon-expand span-btn-admin' title='Detalles' onclick='expandDetails(this,\"Encuesta\",".$reg['Id'].")'></span><span class='flaticon-delete81 span-btn-admin' title='Borrar' onclick='deleteUser(this,\"Encuesta\",".$reg['Id'].")'></span></td></tr>";
	}
}
if($_POST['Tabla'] == "contactos"){
	$consulta = mysql_query("SELECT * FROM contactos where Nombre like '%".$_POST['Busqueda']."%' OR Email like '%".$_POST['Busqueda']."%' or Telefono like '%".$_POST['Busqueda']."%'")or die("<div class='mensajeError'>Error al buscar...</div>".mysql_error());
	while($reg=mysql_fetch_array($consulta))
	{ 
		echo "<tr class='tr'><td align='center'>".$reg['Id']."</td><td>".$reg['Nombre']."</td><td>".$reg['Email']."</td><td>".$reg['Telefono']."</td><td align='right'><span class='flaticon-expand span-btn-admin' title='Detalles' onclick='expandDetails(this,\"Contactos\",".$reg['Id'].")'></span><span class='flaticon-black322 span-btn-admin' title='Editar' onclick='editRows(this,\"Contactos\",".$reg['Id'].")'></span><span class='flaticon-delete81 span-btn-admin' title='Borrar' onclick='deleteUser(this,\"Contactos\",".$reg['Id'].")'></span></td></tr>";
	}
}
if($_POST['Tabla'] == "compra"){
	$consulta = mysql_query("SELECT * FROM compra where nombretc like '%".$_POST['Busqueda']."%'")or die("<div class='mensajeError'>Error al buscar...</div>".mysql_error());
	while($reg=mysql_fetch_array($consulta))
	{ 
		echo "<tr class='tr'><td>".$reg['id']."</td><td>".$reg['fecha']."</td><td>".$reg['idcliente']."</td><td>".$reg['nombretc']."</td><td>".$reg['estado']."</td><td align='right'><span class='flaticon-expand span-btn-admin' title='Detalles' onclick='expandDetails(this,\"compra\",".$reg['id'].")'></span><span class='flaticon-black322 span-btn-admin' title='Editar' onclick='editRows(this,\"compra\",".$reg['id'].")'></span><span class='flaticon-delete81 span-btn-admin' title='Borrar' onclick='deleteUser(this,\"compra\",".$reg['id'].")'></span></td></tr>";
	}
}
?>