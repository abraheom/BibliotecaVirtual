<?php 

//Elementos globales----------------------------------------------------------------
$Buscador="<div class='divBuscador'><input type='text' class='campoBuscador' placeholder='Buscar'/><label class='btnBuscador' onclick=\"BuscarRegistros('".$_POST['tabla']."')\"><span class='flaticon-magnifying42'></span></label></div>";

////////////////////////////////////////////////////////////////////////
require "../PHP/database.php";
$conexion = mysql_connect($db_host,$db_user,$db_pass);
$conexion = mysql_select_db($db_name);
$consulta = mysql_query("SELECT * FROM ".$_POST['tabla'])or die("<div class='mensajeError'>La tabla no existe...</div>");
if(mysql_num_rows($consulta) > 0){
	echo "<h1 id='titlePanel'>Registro de ".$_POST['tabla']."</h1>";
	echo "<div class='divToTable'><table cellspacing='0' cellpading='0' class='tablaReportes'>";
	if($_POST['tabla']=="usuarios")
		tablaUsuarios($consulta);
	if($_POST['tabla']=="productos")
		tablaProductos($consulta);
	if($_POST['tabla']=="encuesta")
		tablaEncuesta($consulta);
	if($_POST['tabla']=="contactos")
		tablaContactos($consulta);	
	if($_POST['tabla']=="cotizaciones")
		tablaCotizaciones($consulta);
	if($_POST['tabla']=="compra")
		tablaCompra($consulta);
	echo "</table></div>";
}
else 
	echo "<div class='mensajeError'>No hay registros en esta tabla</div>";
//Funciones para mostrar las tablas-------------------------------------------------
function tablaUsuarios($consulta) {
	global $Buscador;
	echo "<tr class='tr-th'><td>Id</td><td>Tipo</td><td>Nombre</td><td>Email</td><td align='right'>".$Buscador."</td></tr>";
	while($reg=mysql_fetch_array($consulta))
	{ 
		if($reg['tipoUsuario']=="Administrador")
			$classTipoUser="flaticon-important";
		else 
			$classTipoUser="flaticon-user91";
		echo "<tr class='tr'><td align='center'>".$reg['IdUsuario']."</td><td width='100'><span class='".$classTipoUser."'></span> ".$reg['tipoUsuario']."</td><td>".$reg['Nombres']." ".$reg['Apellidos']."</td><td>".$reg['Email']."</td><td align='right'><span class='flaticon-expand span-btn-admin' title='Detalles' onclick='expandDetails(this,\"Usuarios\",".$reg['IdUsuario'].")'></span><span class='flaticon-black322 span-btn-admin' title='Editar' onclick='editRows(this,\"Usuarios\",".$reg['IdUsuario'].")'></span><span class='flaticon-delete81 span-btn-admin' title='Borrar' onclick='deleteUser(this,\"Usuarios\",".$reg['IdUsuario'].")'></span></td></tr>";
	}
}
function tablaProductos($consulta) {
	global $Buscador;
	echo "<tr class='tr-th'><td><img width='16' style='margin-left:5px;' src='../imagenes/icons/frontBook.png'></td><td>Id</td><td>Titulo</td><td>Autor</td><td align='right'>$Buscador</td></tr>";
	while($reg=mysql_fetch_array($consulta))
	{ 
		echo "<tr class='tr'><td><img class='portadaLibroReg' src='data:image/jpeg;base64,".base64_encode($reg['ImgPortada'])."'></td><td align='center'>".$reg['Id']."</td><td>".substr($reg['Titulo'],0,40)."..."."</td><td>".$reg['Autor']."</td><td align='right'><span class='flaticon-expand span-btn-admin' title='Detalles' onclick='expandDetails(this,\"Productos\",".$reg['Id'].")'></span><span class='flaticon-black322 span-btn-admin' title='Editar' onclick='editRows(this,\"Productos\",".$reg['Id'].")'></span><span class='flaticon-delete81 span-btn-admin' title='Borrar' onclick='deleteUser(this,\"Productos\",".$reg['Id'].")'></span></td></tr>";
	}
}
function tablaContactos($consulta) {
	global $Buscador;
	echo "<tr class='tr-th'><td>Id</td><td>Nombre Completo</td><td>Email</td><td>Telefono</td><td align='right'>".$Buscador."</td></tr>";
	while($reg=mysql_fetch_array($consulta))
	{ 
		echo "<tr class='tr'><td align='center'>".$reg['Id']."</td><td>".$reg['Nombre']."</td><td>".$reg['Email']."</td><td>".$reg['Telefono']."</td><td align='right'><span class='flaticon-expand span-btn-admin' title='Detalles' onclick='expandDetails(this,\"Contactos\",".$reg['Id'].")'></span><span class='flaticon-black322 span-btn-admin' title='Editar' onclick='editRows(this,\"Contactos\",".$reg['Id'].")'></span><span class='flaticon-delete81 span-btn-admin' title='Borrar' onclick='deleteUser(this,\"Contactos\",".$reg['Id'].")'></span></td></tr>";
	}
}
function tablaEncuesta($consulta){
	global $Buscador;
	echo "<tr class='tr-th'><td>Id</td><td>Fecha Realizacion</td><td>Pregunta 1</td><td>Pregunta 2</td><td>".$Buscador."</td></tr>";
	while($reg=mysql_fetch_array($consulta))
	{ 
		echo "<tr class='tr'><td align='center'>".$reg['Id']."</td><td>".$reg['FechaRealizacion']."</td><td>".$reg['p1']."</td><td>".$reg['p2']."</td><td align='right'><span class='flaticon-expand span-btn-admin' title='Detalles' onclick='expandDetails(this,\"Encuesta\",".$reg['Id'].")'></span><span class='flaticon-delete81 span-btn-admin' title='Borrar' onclick='deleteUser(this,\"Encuesta\",".$reg['Id'].")'></span></td></tr>";
	}
}
function tablaCotizaciones($consulta){
	global $Buscador;
	echo "<tr class='tr-th'><td align='center'><img width='16' src='../imagenes/icons/frontBook.png'></td><td> Id </td><td>Fecha y Hora</td><td  width='375'>Informacion del Producto</td><td>".$Buscador."</td></tr>";
	while($reg=mysql_fetch_array($consulta))
	{ 
		echo "<tr class='tr'><td><img class='portadaLibroReg' src='data:image/jpeg;base64,".base64_encode($reg['ImgProducto'])."'></td><td align='center'>".$reg['IdCotizacion']."</td><td>".$reg['FechaDeCotizacion']."</td><td>".$reg['Informacion']."</td><td align='right'><span class='flaticon-expand span-btn-admin' title='Detalles' onclick='expandDetails(this,\"Cotizaciones\",".$reg['IdCotizacion'].")'></span><span class='flaticon-black322 span-btn-admin' title='Editar' onclick='editRows(this,\"Cotizaciones\",".$reg['IdCotizacion'].")'></span><span class='flaticon-delete81 span-btn-admin' title='Borrar' onclick='deleteUser(this,\"Cotizaciones\",".$reg['IdCotizacion'].")'></span></td></tr>";
	}
}
function tablaCompra($consulta){
	global $Buscador;
	echo "<tr class='tr-th'><td align='center' title='Id De Compra'>Id</td><td>Fecha de Compra</td><td>IdCliente</td><td>Nombre segun tarjeta</td><td '>Estado</td><td>".$Buscador."</td></tr>";
	while($reg=mysql_fetch_array($consulta))
	{
		echo "<tr class='tr'><td>".$reg['id']."</td><td>".$reg['fecha']."</td><td>".$reg['idcliente']."</td><td>".$reg['nombretc']."</td><td>".$reg['estado']."</td><td align='right'><span class='flaticon-expand span-btn-admin' title='Detalles' onclick='expandDetails(this,\"compra\",".$reg['id'].")'></span><span class='flaticon-black322 span-btn-admin' style='display:none;' title='Editar' onclick='editRows(this,\"compra\",".$reg['id'].")'></span><span class='flaticon-delete81 span-btn-admin' title='Borrar' onclick='deleteUser(this,\"compra\",".$reg['id'].")'></span></td></tr>";
	}
}
?>

