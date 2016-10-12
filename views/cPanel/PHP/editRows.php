<?php
require "../../PHP/database.php";
$conexion = mysql_connect($db_host,$db_user,$db_pass);
$conexion = mysql_select_db($db_name);

if($_POST['Tabla']=="Usuarios"){
	$consulta = mysql_query("SELECT * FROM usuarios where IdUsuario='$_POST[Id]'");
	if(mysql_num_rows($consulta) > 0 )	{
		$reg = mysql_fetch_array($consulta);

	?>
<div class="ventanaEmergente-contenido">
	<table border="0" cellspacing="6" class="tableViewDetails">
		<tr>
		  <td>Nombres:</td>
		  <td><input type="text" id="EditNombres" value="<?php echo $reg["Nombres"]; ?>"></td>
		  <td rowspan="4">
		  	<span class="btnCloseViewDetails" onclick="ventanaEmergente_Close()">x</span>
		  	<img src="data:image/jpeg;base64,<?php echo base64_encode($reg['ImgPerfil']) ?>" >
		    	<div class="divTipo_trianglar1"></div>
		    	<div class="divTipo"><?php echo $reg["tipoUsuario"]; ?></div></div>
		  </td>
		</tr>
		<tr>
		  <td>Apellidos:</td>
		  <td><input type="text" id="EditApellidos" value="<?php echo $reg["Apellidos"]; ?>"></td>
		</tr>
		<tr>
		  <td width="90">Email:</td>
		  <td><input type="text" id="EditEmail" value="<?php echo $reg["Email"]; ?>"></td>
		</tr>
		<tr>
		  <td width="90">Contraseña:</td>
		  <td><input type="text" id="EditPassword" value="<?php echo $reg["Password"]; ?>"></td>
		</tr>
		<tr>
		  <td>Tipo Usuario:</td>
		  <td colspan="2">
		  	<select id="EditTipoUsuario" onchange="javascript: $('.divTipo').html(this.value)">
		  		<?php
		  		if($reg["tipoUsuario"]=="Administrador"){
		  		?>
		  			<option value="Administrador" selected>Administrador</option>
					<option value="Cliente">Cliente</option>		  			
		  		<?php
		  		} 
		  		else {
		  		?>
		  			<option value="Cliente" selected>Cliente</option>
		  			<option value="Administrador">Administrador</option>

				<?php
		  		}
		  		?>
		  	</select>
		  </td>
		</tr>
		<tr>
		  <td>Nacimiento:</td>
		  <td colspan="2"><input type="text" id="EditNacimiento" value="<?php echo $reg["FechaNacimiento"]; ?>"></td>
		</tr>
		<tr>
		  <td>Telefono:</td>
		  <td colspan="2"><input type="text" id="EditTelefono" value="<?php echo $reg["Telefono"]; ?>"></td>
		</tr>
		<tr>
		  <td>Direccion:</td>
		  <td colspan="2"><input type="text" id="EditDireccion" value="<?php echo $reg["Direccion"]; ?>"></td>
		</tr>
	</table>
	<div class="divBotonesEdit" align="center">
		<input type='button' value='Cancelar' onclick='ventanaEmergente_Close()'><input type='button' value='Guardar' onclick='UpdateRows("<?php echo $_POST['Tabla'];?>",<?php echo $_POST['Id'];?>)'>
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
	<span class="btnCloseViewDetails" onclick="ventanaEmergente_Close()">x</span>
	<table border="0" cellspacing="6" class="tableViewDetails">
		<tr>
		  <td>Titulo:</td>
		  <td><input type="text" id="EditTitulo" value="<?php echo $reg["Titulo"]; ?>"></td>
		  <td rowspan="4" class="tdPortada">
		  <form action="" enctype="multipart/form-data" id="formUploading">
		  	<div class="btnCambiarPort" onclick="getExplorerFile()">+</div>
		  	<img src="data:image/jpeg;base64,<?php echo base64_encode($reg['ImgPortada']) ?>" class="imgPortada">
	    	<div class="divTipo_trianglar1"></div>
	    	<div class="divTipo"><?php echo "$ ".$reg["Precio"]; ?></div></div>
	    	<input type="file" name="archivo" class="imgFile" style="display:none;" onchange="EditarPortada(<?php echo $_POST['Id']; ?>)">
		 </form> 
		  </td>
		</tr>
		<tr>
		  <td>Autor:</td>
		  <td><input type="text" id="EditAutor" value="<?php echo $reg["Autor"]; ?>"></td>
		</tr>
		<tr>
		  <td>Editorial:</td>
		  <td><input type="text" id="EditEditorial" value="<?php echo $reg["Editorial"]; ?>"></td>
		</tr>
		<tr>
		  <td>Idioma:</td>
		  <td><input type="text" id="EditIdioma" value="<?php echo $reg["Idioma"]; ?>"></td>
		</tr>
		<tr>
		  <td>Fecha Publicacion:</td>
		  <td><input type="text" id="EditFechaPublicacion" value="<?php echo $reg["FechaPublicacion"]; ?>"></td>
		</tr>
		<tr>
		  <td>Precio:</td>
		  <td><input type="text" id="EditPrecio" value="<?php echo $reg["Precio"]; ?>"></td>
		</tr>
		<tr>
		  <td colspan="3">Descripcion:</td>
		</tr>
		<tr>
		  <td colspan="3"><textarea rows="6" id="EditDescripcion" class="textareaDescripcionProductos"><?php echo $reg["Descripcion"]; ?></textarea></td>
		</tr>
	</table>
	<div class="divBotonesEdit" align="center">
		<input type='button' value='Cancelar' onclick='ventanaEmergente_Close()'><input type='button' value='Guardar' onclick='UpdateRows("<?php echo $_POST['Tabla'];?>",<?php echo $_POST['Id'];?>)'>
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
	<table border="0" cellspacing="6" class="tableViewDetails">
		<tr>
		  <td width="90">Fecha de cotizacion:</td>
		  <td><input type="text" id="EditFechaCotizacion" value="<?php echo $reg["FechaDeCotizacion"]; ?>"></td>
		  <td rowspan="3">
		  	<span class="btnCloseViewDetails" onclick="ventanaEmergente_Close()">x</span>
		  	<img src="data:image/jpeg;base64,<?php echo base64_encode($reg['ImgProducto']) ?>" class="imgPortada">
		    	<div class="divTipo_trianglar1"></div>
		    	<div class="divTipo"><?php echo "$ ".$reg["Precio"]; ?></div></div>
		  </td>
		</tr>
		<tr>
		  <td width="90">Nombre Cliente:</td>
		  <td><input type="text" id="EditNombreCliente" value="<?php echo $reg["NombreCliente"]; ?>"></td>
		</tr>
		<tr>
		  <td width="90">Informacion:</td>
		  <td><textarea class="textareaDescripcionProductos" id="EditInformacion" rows="3" style='width:250px;'><?php echo $reg["Informacion"]; ?></textarea></td>
		</tr>
		<tr>
		  <td width="90">Cantidad:</td>
		  <td width="90">Precio:</td>
		  <td width="30"  style="background:transparent;border:none;padding:0px;">Total Compra:</td>
		</tr>
		<tr>
			<td width="90"><input type="text" class='camposCotizacion' readonly title="Campo no Editable" value="<?php echo $reg["Cantidad"]; ?>"></td>
		  	<td width="90"><input type="text" class='camposCotizacion' readonly title="Campo no Editable" value="<?php echo $reg["Precio"]; ?>"></td>
			<td width="90"  style="background:transparent;border:none;padding:0px;"><input type="text" class='camposCotizacion' readonly title="Campo no Editable" value="<?php echo $reg["TotalCompra"]; ?>"></td>
		</tr>	
	</table>
	<div class="divBotonesEdit" align="center">
		<input type='button' value='Cancelar' onclick='ventanaEmergente_Close()'><input type='button' value='Guardar' onclick='UpdateRows("<?php echo $_POST['Tabla'];?>",<?php echo $_POST['Id'];?>)'>
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
		  <td width="90">Nombre:</td>
		  <td><input type="text" id="EditNombre" value="<?php echo $reg["Nombre"]; ?>"></td>
		</tr>
		<tr>
		  <td width="90">Email:</td>
		  <td><input type="text" id="EditEmail" value="<?php echo $reg["Email"]; ?>"></td>
		</tr>
		<tr>
		  <td width="90">Telefono:</td>
		  <td><input type="text" id="EditTelefono" value="<?php echo $reg["Telefono"]; ?>"></td>
		</tr>
		<tr>
		  <td width="90">Mensaje:</td>
		  <td><textarea style="width:392px;height:100px;"  id="EditMensaje" ><?php echo $reg["Mensaje"]; ?></textarea></td>
		</tr>
	</table>
	<div class="divBotonesEdit" align="center">
		<input type='button' value='Cancelar' onclick='ventanaEmergente_Close()'><input type='button' value='Guardar' onclick='UpdateRows("<?php echo $_POST['Tabla'];?>",<?php echo $_POST['Id'];?>)'>
	</div>
</div>
	<?php
	}
}

?>