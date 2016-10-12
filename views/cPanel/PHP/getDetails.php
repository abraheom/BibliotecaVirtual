<?php
require "../../PHP/database.php";
$conexion = mysql_connect($db_host,$db_user,$db_pass);
$conexion = mysql_select_db($db_name);

//FECHAS 
function miFecha($fecha){
  $mes = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
  return substr($fecha,8,2)." de ". $mes[(substr($fecha,5,7)-1)]." de ".substr($fecha,0,4);
}

if($_POST['Tabla']=="Usuarios"){
	$consulta = mysql_query("SELECT * FROM usuarios where IdUsuario='$_POST[Id]'");
	if(mysql_num_rows($consulta) > 0 )	{
		$reg = mysql_fetch_array($consulta);

	?>
<div class="ventanaEmergente-contenido">
	<table border="0" cellspacing="0" class="tableViewDetails">
		<tr>
		  <td width="90">Nombres:</td>
		  <td><?php echo $reg["Nombres"]; ?></td>
		  <td rowspan="5">
		  	<span class="btnCloseViewDetails" onclick="ventanaEmergente_Close()">x</span>
		  	<img src="data:image/jpeg;base64,<?php echo base64_encode($reg['ImgPerfil']) ?>" >
		    	<div class="divTipo_trianglar1"></div>
		    	<div class="divTipo"><?php echo $reg["tipoUsuario"]; ?></div></div>
		  </td>
		</tr>
		<tr>
		  <td width="90">Apellidos:</td>
		  <td><?php echo $reg["Apellidos"]; ?></td>
		</tr>
		<tr>
		  <td width="90">Email:</td>
		  <td><?php echo $reg["Email"]; ?></td>
		</tr>
		<tr>
		  <td width="90">Contraseña:</td>
		  <td><?php echo $reg["Password"]; ?></td>
		</tr>
		<tr>
		  <td width="90">Nacimiento:</td>
		  <td><?php echo $reg["FechaNacimiento"]; ?></td>
		</tr>
		<tr>
		  <td width="90">Telefono:</td>
		  <td><?php echo $reg["Telefono"]; ?></td>
		</tr>
		<tr>
		  <td width="90">Direccion:</td>
		  <td><?php echo $reg["Direccion"]; ?></td>
		</tr>
	</table>
	<div class="divBotonesView" align="center">
		<input type='button' value='Cerrar' onclick='ventanaEmergente_Close()'>
	</div>
</div>
	<?php
	}
}
if($_POST['Tabla']=="Productos"){
	$consulta = mysql_query("SELECT * FROM productos where Id='$_POST[Id]'");
	if(mysql_num_rows($consulta) > 0 )	{
		$reg = mysql_fetch_array($consulta);

	?>
<div class="ventanaEmergente-contenido">
	<table border="0" cellspacing="0" class="tableViewDetails">
		<tr>
		  <td width="90">Titulo:</td>
		  <td><?php echo $reg["Titulo"]; ?></td>
		  <td rowspan="5">
		  	<span class="btnCloseViewDetails" onclick="ventanaEmergente_Close()">x</span>
		  	<img src="data:image/jpeg;base64,<?php echo base64_encode($reg['ImgPortada']) ?>" class="imgPortada">
		    	<div class="divTipo_trianglar1"></div>
		    	<div class="divTipo"><?php echo "$ ".$reg["Precio"]; ?></div></div>
		  </td>
		</tr>
		<tr>
		  <td width="90">Autor:</td>
		  <td><?php echo $reg["Autor"]; ?></td>
		</tr>
		<tr>
		  <td width="90">Editorial:</td>
		  <td><?php echo $reg["Editorial"]; ?></td>
		</tr>
		<tr>
		  <td width="90">Idioma:</td>
		  <td><?php echo $reg["Idioma"]; ?></td>
		</tr>
		<tr>
		  <td width="90">Fecha Publicacion:</td>
		  <td><?php echo $reg["FechaPublicacion"]; ?></td>
		</tr>
		<tr>
		  <td width="90" colspan="3">Descripcion:</td>
		 </tr>
		 <tr>
		  <td colspan="3"><?php echo $reg["Descripcion"]; ?></td>
		</tr>
		<tr>
		  <td width="90">Precio:</td>
		  <td><?php echo $reg["FechaPublicacion"]; ?></td>
		</tr>
	</table>
	<div class="divBotonesView" align="center">
		<input type='button' value='Cerrar' onclick='ventanaEmergente_Close()'>
	</div>
</div>
	<?php
	}
}


if($_POST['Tabla']=="Cotizaciones"){
	$consulta = mysql_query("SELECT * FROM cotizaciones where IdCotizacion='$_POST[Id]'");
	if(mysql_num_rows($consulta) > 0 )	{
		$reg = mysql_fetch_array($consulta);

	?>
<div class="ventanaEmergente-contenido">
	<table border="0" cellspacing="0" class="tableViewDetails">
		<tr>
		  <td width="90">Id:</td>
		  <td><?php echo $reg["IdCotizacion"]; ?></td>
		  <td rowspan="4">
		  	<span class="btnCloseViewDetails" onclick="ventanaEmergente_Close()">x</span>
		  	<img src="data:image/jpeg;base64,<?php echo base64_encode($reg['ImgProducto']) ?>" class="imgPortada">
		    	<div class="divTipo_trianglar1"></div>
		    	<div class="divTipo"><?php echo "$ ".$reg["Precio"]; ?></div></div>
		  </td>
		</tr>
		<tr>
		  <td width="90">Fecha de cotizacion:</td>
		  <td><?php echo $reg["FechaDeCotizacion"]; ?></td>
		</tr>
		<tr>
		  <td width="90">Nombre Cliente:</td>
		  <td><?php echo $reg["NombreCliente"]; ?></td>
		</tr>
		<tr>
		  <td width="90">Informacion:</td>
		  <td><?php echo $reg["Informacion"]; ?></td>
		</tr>
		<tr>
			<td colspan="2">
				<table>
					<tr>
					  <td width="90">Cantidad:</td>
					  <td width="90">Precio:</td>
					  <td width="90" style="background:transparent;border:none;padding:0px;">Total Compra:</td>
					</tr>
					<tr>
					  <td><?php echo $reg["Cantidad"]; ?></td>		  
					  <td><?php echo $reg["Precio"]; ?></td>		 
					  <td style="background:transparent;border:none;padding:0px;"><?php echo $reg["TotalCompra"]; ?></td>
					</tr>
				</table>
			</td>
		</tr>		
	</table>
	<div class="divBotonesView" align="center">
		<input type='button' value='Cerrar' onclick='ventanaEmergente_Close()'>
	</div>
</div>
	<?php
	}
}

if($_POST['Tabla']=="Encuesta"){
	$consulta = mysql_query("SELECT * FROM encuesta where Id='$_POST[Id]'");
	if(mysql_num_rows($consulta) > 0 )	{
		$reg = mysql_fetch_array($consulta);

	?>
<div class="ventanaEmergente-contenido">
	<span class="btnCloseViewDetails" onclick="ventanaEmergente_Close()">x</span>
	<table class="cotizacionIdFecha"  cellspacing="0">
		<tr>
			<td>ID</td>
			<td>FECHA DE REALIZACION</td>
		</tr>
		<tr>
			<td><?php echo $reg['Id']; ?></td>
			<td><?php echo miFecha($reg['FechaRealizacion']); ?></td>
		</tr>
	</table>

	<div class="divEncuesta">
		<br>
		<div class="divViewPreguntas" id="pre1">
			<p>1) ¿Cree que el sitio actual promueve una experiencia de usuario favorable? </p>
			<label class="identiRespuesta">Respuesta: </label><?php echo $reg['p1']; ?>
		</div>
		<div class="divViewPreguntas" id="pre2">
			<p>2) ¿Qué áreas específicas del sitio actual cree que tienen éxito?</p>
			<label class="identiRespuesta">Respuesta: </label><?php echo $reg['p2']; ?>

		</div>
		<div class="divViewPreguntas" id="pre3">
			<p>3) ¿Qué defectos ve en el sitio actual, y qué cosas cambiaría ahora en el sitio si pudiera?</p>
			<label class="identiRespuesta">Respuesta: </label><?php echo $reg['p3']; ?>
		</div>
		<div class="divViewPreguntas" id="pre4">
			<p>4) ¿Cuál es la acción principal que debe cometer un usuario cuando entre en el sitio (hacer una compra , buscar información)?</p>	
			<label class="identiRespuesta">Respuesta: </label><?php echo $reg['p4']; ?>
		</div>
		<div class="divViewPreguntas" id="pre5">
			<p>5) ¿Cuáles son las razones principales por las que usted elige los productos y/o servicios de nuestra biblioteca (coste, servicio, valor)?</p>
			<label class="identiRespuesta">Respuesta: </label><?php echo $reg['p5']; ?>
			
		</div>
		<div class="divViewPreguntas" id="pre6">
			<p>6) ¿Le resulto útil la información expuesta en esta pagina?</p>
			<label class="identiRespuesta">Respuesta: </label><?php echo $reg['p6']; ?>
			
		</div>
		<div class="divViewPreguntas" id="pre7">
			<p>7) ¿Qué sugiere que se deba agregar a nuestra pagina web?</p>
			<label class="identiRespuesta">Respuesta: </label><?php echo $reg['p7']; ?>
		</div>
		<div class="divViewPreguntas" id="pre8">
			<p>8) ¿Encontraste el libro que necesitabas?</p>
			<label class="identiRespuesta">Respuesta: </label><?php echo $reg['p8']; ?>
		</div>
		<div class="divViewPreguntas" id="pre9">
			<p>9) ¿Consideras que el diseño de la interfaz: de la página web son adecuados?</p>
			<label class="identiRespuesta">Respuesta: </label><?php echo $reg['p9']; ?>
			
		</div>
		<div class="divViewPreguntas" id="pre10">
			<p>10) ¿El tipo de letra utilizado, así como el tamaño de la misma, ¿crees que son los adecuados?</p>
			<label class="identiRespuesta">Respuesta: </label><?php echo $reg['p10']; ?>
			
		</div>
		<div class="divViewPreguntas" id="pre11">
			<p>11) ¿Qué mejoras introducirías en la nueva página web?</p>
			<label class="identiRespuesta">Respuesta: </label><?php echo $reg['p11']; ?>
		</div>
		<div class="divViewPreguntas" id="pre12">
			<p>12) ¿En general como calificarias esta pagina?</p>
			<label class="identiRespuesta">Respuesta: </label><?php echo $reg['p12']; ?>
		</div>
		<div class="divViewPreguntas" id="pre13">
			<p>13) ¿Le parece agradable los colores y fondos usados en esta pagina?</p>
			<label class="identiRespuesta">Respuesta: </label><?php echo $reg['p13']; ?>
		</div>
		<div class="divViewPreguntas" id="pre14">
			<p>14) ¿Cómo beneficia a los alumnos el hecho de poder contar con una nueva biblioteca virtual?</p>
			<label class="identiRespuesta">Respuesta: </label><?php echo $reg['p14']; ?>
		</div>
		<div class="divViewPreguntas" id="pre15">
			<p>15) ¿Recomendaria esta pagina a una persona o amigo?</p>
			<label class="identiRespuesta">Respuesta: </label><?php echo $reg['p15']; ?>
		</div>
	</div>
	<div class="divBotonesView" align="center">
		<input type='button' value='Cerrar' onclick='ventanaEmergente_Close()'>
	</div>
</div>
	<?php
	}
}

if($_POST['Tabla']=="Contactos"){
	$consulta = mysql_query("SELECT * FROM contactos where Id='$_POST[Id]'");
	if(mysql_num_rows($consulta) > 0 )	{
		$reg = mysql_fetch_array($consulta);

	?>
<div class="ventanaEmergente-contenido">
	<span class="btnCloseViewDetails" onclick="ventanaEmergente_Close()">x</span>
	<table border="0" cellspacing="6" class="tableViewDetails">
		<tr>
		  <td width="90">Id:</td>
		  <td><?php echo $reg["Id"]; ?></td>
		</tr>
		<tr>
		  <td width="90">Nombre:</td>
		  <td><?php echo $reg["Nombre"]; ?></td>
		</tr>
		<tr>
		  <td width="90">Email:</td>
		  <td><?php echo $reg["Email"]; ?></td>
		</tr>
		<tr>
		  <td width="90">Telefono:</td>
		  <td><?php echo $reg["Telefono"]; ?></td>
		</tr>
		<tr>
		  <td width="90">Mensaje:</td>
		  <td><?php echo $reg["Mensaje"]; ?></td>
		</tr>
	</table>
	<div class="divBotonesView" align="center">
		<input type='button' value='Cerrar' onclick='ventanaEmergente_Close()'>
	</div>
</div>
	<?php
	}
}


if($_POST['Tabla']=="compra"){
	$consulta = mysql_query("SELECT * FROM compra where id='$_POST[Id]'");
	if(mysql_num_rows($consulta) > 0 )	{
		$reg = mysql_fetch_array($consulta);

	?>
<div class="ventanaEmergente-contenido">
	<span class="btnCloseViewDetails" onclick="ventanaEmergente_Close()">x</span>
	<div class="divViewCompra">
	<div class="titulo-2">Informacion de la compra</div>
		<table border="0" cellspacing="0"  class="tablaCompras">
			<tr>
			  <td width="90">Id:</td>
			  <td><?php echo $reg["id"]; ?></td>
			  <td width="90">IdCliente:</td>
			  <td><?php echo $reg["idcliente"]; ?></td>
			</tr>
			<tr>
			  <td width="90">Valor Compra:</td>
			  <td><?php echo $reg["valorcompra"]; ?></td>
			  <td width="90">Estado:</td>
			  <td><?php echo $reg["estado"]; ?></td>
			</tr>
			<tr>
			  <td width="90">Nombre segun tarjeta:</td>
			  <td><?php echo $reg["nombretc"]; ?></td>
			  <td width="90">Banco:</td>
			  <td><?php echo $reg["bancotc"]; ?></td>
			</tr>
			<tr>
			  <td width="90">Numero Tarjeta:</td>
			  <td><?php echo $reg["numerotc"]; ?></td>
			  <td width="90">Tipo de tarjeta:</td>
			  <td><?php echo $reg["tipotc"]; ?></td>
			</tr>
			<tr>
			  <td width="90">Mes  de vencimiento:</td>
			  <td><?php echo $reg["mestc"]; ?></td>
			  <td width="90">Año  de vencimiento:</td>
			  <td><?php echo $reg["aniotc"]; ?></td>
			</tr>
			<tr>
			  <td width="90">Fecha de compra:</td>
			  <td colspan="3"><?php echo $reg["fecha"]; ?></td>
			</tr>
		</table>
	<div class="titulo-2">
		Productos comprados
	</div>
	<div>
		<table class="detalleProducto" cellspacing="0">
			<tr>
				<td align="center">Id</td>
				<td align="center">Producto</td>
				<td align="center">Precio</td>
				<td align="center">Cantidad</td>
				<td align="center">Total</td>
			</tr>
			<?php
				$consulta = mysql_query("SELECT * FROM detallecompra where idcompra='$_POST[Id]'");
				while($regi=mysql_fetch_array($consulta)){
					echo "<tr>";
					echo "<td align='center'>$regi[id]</td>";
					echo "<td>$regi[producto]</td>";
					echo "<td align='center'>$regi[precio]</td>";
					echo "<td align='center'>$regi[cantidad]</td>";
					echo "<td align='center'>".($regi['precio']*$regi['cantidad'])."</td>";
					echo "</tr>";
				}
			?>
		</table>
	</div>
	</div>
	<div class="divBotonesView" align="center">
		<input type='button' value='Cerrar' onclick='ventanaEmergente_Close()'>
	</div>
</div>
	<?php
	}
}

?>