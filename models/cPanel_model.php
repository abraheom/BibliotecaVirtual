<?php 
	class cPanel_model extends Model {
		function __construct() {
            parent::__construct();
        }
        public function getBase64(){
        	if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') 
			{
			    $img = file_get_contents($_FILES['archivo']['tmp_name']);
			    $imgdata = base64_encode($img);
			    echo $imgdata;
			}
			else{
			    echo "error";   
			}
        }
        public function generarNombre(){
        	$Nombre="";
        	for($i=0; $i < 20 ; $i++) { 
        		if(rand(0,1))
        			$Nombre.=chr(rand(ord("a"), ord("z")));
        		else
        			$Nombre.=rand(0,9);
        	}
        	return $Nombre;
        }
        function changePassword() {
        	$IdUsuario = Session::getValue("IdUsuario");
        	MySQLDriver::consulta("UPDATE usuarios set Password='$_POST[newPassword]' where IdUsuario='$IdUsuario' and Password='$_POST[Password]'");
			if(MySQLDriver::affectedRows())
				echo "<div class='mensajeSuccess' onclick='$(this).remove()'>La contraseña se modifico correctamente...</div>";
        	else
				echo "<div class='mensajeError' onclick='$(this).remove()'>La contraseña no se modifico...</div>";
        }
        function editarPefil(){
        	$IdUsuario = Session::getValue("IdUsuario");
        	$ImgPerfil=cPanel_model::generarNombre().".jpg";

        	//Comprobacion de subida del archivo
        	$file = $_FILES['archivo']['name'];
		    if ($file && move_uploaded_file($_FILES['archivo']['tmp_name'],"public/imagenes/Perfil/".$ImgPerfil))
		    {
	        	MySQLDriver::consulta("UPDATE usuarios set Nombres='$_POST[Nombres]', Apellidos='$_POST[Apellidos]', Email='$_POST[Email]', Telefono='$_POST[Telefono]', Direccion='$_POST[Direccion]', ImgPerfil='$ImgPerfil' where IdUsuario='$IdUsuario'");
				echo "<div class='mensajeSuccess' onclick='$(this).remove()'>Los datos se modificaron correctamente</div>";
        	}
			else {
	        	MySQLDriver::consulta("UPDATE usuarios set Nombres='$_POST[Nombres]', Apellidos='$_POST[Apellidos]', Email='$_POST[Email]', Telefono='$_POST[Telefono]', Direccion='$_POST[Direccion]' where IdUsuario='$IdUsuario'");
				echo "<div class='mensajeSuccess' onclick='$(this).remove()'>Los datos se modificaron correctamente</div>";
			}
        }
        function getFormsPerfil(){
			if(Session::exist('IdUsuario')) {
				$IdUsuario=Session::getValue('IdUsuario');
				$consulta = MySQLDriver::consulta("SELECT * FROM usuarios WHERE IdUsuario='$IdUsuario' LIMIT 1");
				$reg=mysql_fetch_array($consulta);
			}
			?>
			<h1 id="titlePanel"><?php echo $reg['Nombres']; ?><label class="lblTipoUsuario">(Usuario Administrador)</h1>
					<form action="" enctype="multipart/form-data" id="formUploading">
						<table class="tablaEditPerfil" border="0">
							<tr>
								<td><input type="text" class="camposTexto width100" name="Nombres" placeholder="Nombres" value="<?php echo $reg['Nombres']; ?>"></td>
								<td align="right" rowspan="4" class="tdImgPerfil">
									<div class="imagen">
										<div id="btnUploadImgPerfil" onclick="getExplorerFile()" class="colorVisible">+</div>
										<img width="200" height="200" id="imgPerfil" src="../public/imagenes/Perfil/<?php echo $reg['ImgPerfil']; ?>" >
										<input type="file" name="archivo" class="imgFile" style="display:none;" onchange="UploadImg('Perfil')">
									</div>
								</td>
							</tr>
							<tr>
								<td><input type="text" class="camposTexto width100" name="Apellidos" placeholder="Apellidos" value="<?php echo $reg['Apellidos']; ?>"></td>
							</tr>
							<tr>
								<td><input type="text" class="camposTexto width100" name="Email" placeholder="Email" value="<?php echo $reg['Email']; ?>"></td>
							</tr>
							<tr>
								<td><input type="text" class="camposTexto width100" name="Telefono" placeholder="Telefono" value="<?php echo $reg['Telefono']; ?>"></td>
							</tr>
							<tr>
								<td>
									<label class="titleNoPlaceholder">Fecha de Nacimiento:</label>
											<select class="selectFechaRegistroPerfil" onclick="evaluar(this)" name="fechaDia" id="fechaDia" onblur="evaluar(this)">
												<option value="0" disabled selected>Dia</option>
												<option value="1">1</option>
												<option value="2">2</option>
												<option value="3">3</option>
												<option value="4">4</option>
												<option value="5">5</option>
												<option value="6">6</option>
												<option value="7">7</option>
												<option value="8">8</option>
												<option value="9">9</option>
												<option value="10">10</option>
												<option value="11">11</option>
												<option value="12">12</option>
												<option value="13">13</option>
												<option value="14">14</option>
												<option value="15">15</option>
												<option value="16">16</option>
												<option value="17">17</option>
												<option value="18">18</option>
												<option value="19">19</option>
												<option value="20">20</option>
												<option value="21">21</option>
												<option value="22">22</option>
												<option value="23">23</option>
												<option value="24">24</option>
												<option value="25">25</option>
												<option value="26">26</option>
												<option value="27">27</option>
												<option value="28">28</option>
												<option value="29">29</option>
												<option value="30">30</option>
												<option value="31">31</option>
											</select>
											<select class="selectFechaRegistroPerfil" onclick="evaluar(this)" name="fechaMes" id="fechaMes" onblur="evaluar(this)" >
												<option value="0" disabled selected>Mes</option>
												<option value="1">Enero</option>
												<option value="2">Febrero</option>
												<option value="3">Marzo</option>
												<option value="4">Abril</option>
												<option value="5">Mayo</option>
												<option value="6">Junio</option>
												<option value="7">Julio</option>
												<option value="8">Agosto</option>
												<option value="9">Septiembre</option>
												<option value="10">Octubre</option>
												<option value="11">Noviembre</option>
												<option value="12">Diciembre</option>
											</select>
											<select class="selectFechaRegistroPerfil" onclick="evaluar(this)" name="fechaAnio" id="fechaAnio" onblur="evaluar(this)" >
														<option value="0" disabled selected>Año</option>
														<option value="2014">2014</option>
														<option value="2013">2013</option>
														<option value="2012">2012</option>
														<option value="2011">2011</option>
														<option value="2010">2010</option>
														<option value="2009">2009</option>
														<option value="2008">2008</option>
														<option value="2007">2007</option>
														<option value="2006">2006</option>
														<option value="2005">2005</option>
														<option value="2004">2004</option>
														<option value="2003">2003</option>
														<option value="2002">2002</option>
														<option value="2001">2001</option>
														<option value="2000">2000</option>
														<option value="1999">1999</option>
														<option value="1998">1998</option>
														<option value="1997">1997</option>
														<option value="1996">1996</option>
														<option value="1995">1995</option>
														<option value="1994">1994</option>
														<option value="1993">1993</option>
														<option value="1992">1992</option>
														<option value="1991">1991</option>
														<option value="1990">1990</option>
														<option value="1989">1989</option>
														<option value="1988">1988</option>
														<option value="1987">1987</option>
														<option value="1986">1986</option>
														<option value="1985">1985</option>
														<option value="1984">1984</option>
														<option value="1983">1983</option>
														<option value="1982">1982</option>
														<option value="1981">1981</option>
														<option value="1980">1980</option>
														<option value="1979">1979</option>
														<option value="1978">1978</option>
														<option value="1977">1977</option>
														<option value="1976">1976</option>
														<option value="1975">1975</option>
														<option value="1974">1974</option>
														<option value="1973">1973</option>
														<option value="1972">1972</option>
														<option value="1971">1971</option>
														<option value="1970">1970</option>
														<option value="1969">1969</option>
														<option value="1968">1968</option>
														<option value="1967">1967</option>
														<option value="1966">1966</option>
														<option value="1965">1965</option>
														<option value="1964">1964</option>
														<option value="1963">1963</option>
														<option value="1962">1962</option>
														<option value="1961">1961</option>
														<option value="1960">1960</option>
														<option value="1959">1959</option>
														<option value="1958">1958</option>
														<option value="1957">1957</option>
														<option value="1956">1956</option>
														<option value="1955">1955</option>
														<option value="1954">1954</option>
														<option value="1953">1953</option>
														<option value="1952">1952</option>
														<option value="1951">1951</option>
														<option value="1950">1950</option>
														<option value="1949">1949</option>
														<option value="1948">1948</option>
														<option value="1947">1947</option>
														<option value="1946">1946</option>
														<option value="1945">1945</option>
														<option value="1944">1944</option>
														<option value="1943">1943</option>
														<option value="1942">1942</option>
														<option value="1941">1941</option>
														<option value="1940">1940</option>
														<option value="1939">1939</option>
														<option value="1938">1938</option>
														<option value="1937">1937</option>
														<option value="1936">1936</option>
														<option value="1935">1935</option>
														<option value="1934">1934</option>
														<option value="1933">1933</option>
														<option value="1932">1932</option>
														<option value="1931">1931</option>
														<option value="1930">1930</option>
														<option value="1929">1929</option>
														<option value="1928">1928</option>
														<option value="1927">1927</option>
														<option value="1926">1926</option>
														<option value="1925">1925</option>
														<option value="1924">1924</option>
														<option value="1923">1923</option>
														<option value="1922">1922</option>
														<option value="1921">1921</option>
														<option value="1920">1920</option>
														<option value="1919">1919</option>
														<option value="1918">1918</option>
														<option value="1917">1917</option>
														<option value="1916">1916</option>
														<option value="1915">1915</option>
														<option value="1914">1914</option>
														<option value="1913">1913</option>
														<option value="1912">1912</option>
														<option value="1911">1911</option>
														<option value="1910">1910</option>
														<option value="1909">1909</option>
														<option value="1908">1908</option>
														<option value="1907">1907</option>
														<option value="1906">1906</option>
														<option value="1905">1905</option>
											</select>
										</td>
							</tr>
							<tr>
								<td><textarea name="Direccion" class="camposTexto width100" name="" placeholder="Direccion Completa"><?php echo $reg['Direccion']; ?></textarea></td>
							</tr>
							<tr>
								<td align="center" colspan="1">
									<input type="button" class="btnSaveBook" onclick="UpdateUsers()" value="Guardar Datos"><img class="loadingData" src='../public/imagenes/loading1.gif' style='margin-left:9px;margin-top:8px;position:absolute;width:40px;visibility:hidden;'>
								</td>
							</tr>
						</table>
					</form>
			<?php
        }
        function getFormsChangePassword(){
			?>
			<form action="" enctype="multipart/form-data" id="formUploading">
				<table class="tableChangePassword" border="0" cellpadding="5">
					<tr>
						<td align="center"><input type="text" class="camposTexto width400" name="Password" placeholder="Contraseña Antigua"></td>
					</tr>
					<tr>
						<td align="center"><input type="password" class="camposTexto width400" name="newPassword" placeholder="Contraseña Nueva"></td>
					</tr>
					<tr>
						<td align="center"><input type="password" class="camposTexto width400" name="repetPassword" placeholder="Repita Contraseña"></td>
					</tr>
					<tr>
						<td align="center" colspan="1">
							<input type="button" class="btnSaveBook" onclick="ChangePassword()" value="Cambiar Contraseña"><img class="loadingData" src='../public/imagenes/loading1.gif' style='margin-left:9px;margin-top:8px;position:absolute;width:40px;visibility:hidden;'>
						</td>
					</tr>
				</table>
			</form>
			<?php
        }
        function getFormsNuevoProducto(){
			?>
			<h1 id="titlePanel">Nuevo Libro</h1>
			<form action="" enctype="multipart/form-data" id="formUploading">
				<table class="tablaNuevoProducto">
					<tr>
						<td rowspan="8" width="300" height="400" class="tdImgPortada">
							<div id="btnUploadImg" onclick="getExplorerFile()" class="colorVisible">+</div>
							<img width="300" height="400" id="imgPortada">
							<input type="file" name="archivo" id="ImgPortada" class="imgFile" style="display:none;" onchange="UploadImg('Portada')">
						</td>
					</tr>
					<tr>
						<td><input type="text" class="camposTexto" onchange="evaluar(this,'')" onclick="evaluar(this,'')" onblur="evaluar(this,'')" name="Titulo" placeholder="Titulo" id="Titulo"><span></span></td>
					</tr>
					<tr>
						<td><input type="text" class="camposTexto" onchange="evaluar(this,'')" onclick="evaluar(this,'')" onblur="evaluar(this,'')" name="Editorial" placeholder="Editorial" id="Editorial"></td>
					</tr>
					<tr>
						<td><input type="text" class="camposTexto" onchange="evaluar(this,'')" onclick="evaluar(this,'')" onblur="evaluar(this,'')" name="Autor" placeholder="Autor" id="Autor"></td>
					</tr>
					<tr>
						<td><input type="text" class="camposTexto" onchange="evaluar(this,'')" onclick="evaluar(this,'')" onblur="evaluar(this,'')" name="Idioma" placeholder="Idioma" id="Idioma"></td>
					</tr>
					<tr>
						<td>
							<label class="titleNoPlaceholder">Fecha de publicacion:</label>
									<select class="selectFechaRegistro" onclick="evaluar(this)" name="fechaDia" id="fechaDia" onblur="evaluar(this)">
										<option value="0" disabled selected>Dia</option>
										<option value="1">1</option>
										<option value="2">2</option>
										<option value="3">3</option>
										<option value="4">4</option>
										<option value="5">5</option>
										<option value="6">6</option>
										<option value="7">7</option>
										<option value="8">8</option>
										<option value="9">9</option>
										<option value="10">10</option>
										<option value="11">11</option>
										<option value="12">12</option>
										<option value="13">13</option>
										<option value="14">14</option>
										<option value="15">15</option>
										<option value="16">16</option>
										<option value="17">17</option>
										<option value="18">18</option>
										<option value="19">19</option>
										<option value="20">20</option>
										<option value="21">21</option>
										<option value="22">22</option>
										<option value="23">23</option>
										<option value="24">24</option>
										<option value="25">25</option>
										<option value="26">26</option>
										<option value="27">27</option>
										<option value="28">28</option>
										<option value="29">29</option>
										<option value="30">30</option>
										<option value="31">31</option>
									</select>
									<select class="selectFechaRegistro" onclick="evaluar(this)" name="fechaMes" id="fechaMes" onblur="evaluar(this)" >
										<option value="0" disabled selected>Mes</option>
										<option value="1">Enero</option>
										<option value="2">Febrero</option>
										<option value="3">Marzo</option>
										<option value="4">Abril</option>
										<option value="5">Mayo</option>
										<option value="6">Junio</option>
										<option value="7">Julio</option>
										<option value="8">Agosto</option>
										<option value="9">Septiembre</option>
										<option value="10">Octubre</option>
										<option value="11">Noviembre</option>
										<option value="12">Diciembre</option>
									</select>
									<select class="selectFechaRegistro" onclick="evaluar(this)" name="fechaAnio" id="fechaAnio" onblur="evaluar(this)" >
												<option value="0" disabled selected>Año</option>
												<option value="2014">2014</option>
												<option value="2013">2013</option>
												<option value="2012">2012</option>
												<option value="2011">2011</option>
												<option value="2010">2010</option>
												<option value="2009">2009</option>
												<option value="2008">2008</option>
												<option value="2007">2007</option>
												<option value="2006">2006</option>
												<option value="2005">2005</option>
												<option value="2004">2004</option>
												<option value="2003">2003</option>
												<option value="2002">2002</option>
												<option value="2001">2001</option>
												<option value="2000">2000</option>
												<option value="1999">1999</option>
												<option value="1998">1998</option>
												<option value="1997">1997</option>
												<option value="1996">1996</option>
												<option value="1995">1995</option>
												<option value="1994">1994</option>
												<option value="1993">1993</option>
												<option value="1992">1992</option>
												<option value="1991">1991</option>
												<option value="1990">1990</option>
												<option value="1989">1989</option>
												<option value="1988">1988</option>
												<option value="1987">1987</option>
												<option value="1986">1986</option>
												<option value="1985">1985</option>
												<option value="1984">1984</option>
												<option value="1983">1983</option>
												<option value="1982">1982</option>
												<option value="1981">1981</option>
												<option value="1980">1980</option>
												<option value="1979">1979</option>
												<option value="1978">1978</option>
												<option value="1977">1977</option>
												<option value="1976">1976</option>
												<option value="1975">1975</option>
												<option value="1974">1974</option>
												<option value="1973">1973</option>
												<option value="1972">1972</option>
												<option value="1971">1971</option>
												<option value="1970">1970</option>
												<option value="1969">1969</option>
												<option value="1968">1968</option>
												<option value="1967">1967</option>
												<option value="1966">1966</option>
												<option value="1965">1965</option>
												<option value="1964">1964</option>
												<option value="1963">1963</option>
												<option value="1962">1962</option>
												<option value="1961">1961</option>
												<option value="1960">1960</option>
												<option value="1959">1959</option>
												<option value="1958">1958</option>
												<option value="1957">1957</option>
												<option value="1956">1956</option>
												<option value="1955">1955</option>
												<option value="1954">1954</option>
												<option value="1953">1953</option>
												<option value="1952">1952</option>
												<option value="1951">1951</option>
												<option value="1950">1950</option>
												<option value="1949">1949</option>
												<option value="1948">1948</option>
												<option value="1947">1947</option>
												<option value="1946">1946</option>
												<option value="1945">1945</option>
												<option value="1944">1944</option>
												<option value="1943">1943</option>
												<option value="1942">1942</option>
												<option value="1941">1941</option>
												<option value="1940">1940</option>
												<option value="1939">1939</option>
												<option value="1938">1938</option>
												<option value="1937">1937</option>
												<option value="1936">1936</option>
												<option value="1935">1935</option>
												<option value="1934">1934</option>
												<option value="1933">1933</option>
												<option value="1932">1932</option>
												<option value="1931">1931</option>
												<option value="1930">1930</option>
												<option value="1929">1929</option>
												<option value="1928">1928</option>
												<option value="1927">1927</option>
												<option value="1926">1926</option>
												<option value="1925">1925</option>
												<option value="1924">1924</option>
												<option value="1923">1923</option>
												<option value="1922">1922</option>
												<option value="1921">1921</option>
												<option value="1920">1920</option>
												<option value="1919">1919</option>
												<option value="1918">1918</option>
												<option value="1917">1917</option>
												<option value="1916">1916</option>
												<option value="1915">1915</option>
												<option value="1914">1914</option>
												<option value="1913">1913</option>
												<option value="1912">1912</option>
												<option value="1911">1911</option>
												<option value="1910">1910</option>
												<option value="1909">1909</option>
												<option value="1908">1908</option>
												<option value="1907">1907</option>
												<option value="1906">1906</option>
												<option value="1905">1905</option>
									</select>
								</td>
					</tr>
					<tr>
						<td><textarea name="Descripcion" class="camposTexto" id="Descripcion" placeholder="Descripcion"></textarea></td>
					</tr>
					<tr>
						<td><input type="text" class="camposTexto" name="Precio" id="Precio" placeholder="Precio"></td>
					</tr>
					<tr>
						<td align="center" colspan="2">
							<input type="button" class="btnSaveBook" onclick="saveBook()" value="Guardar Libro"><img class="loadingData" src='../public/imagenes/loading1.gif' style='margin-left:9px;margin-top:8px;position:absolute;width:40px;visibility:hidden;'>
						</td>
					</tr>
				</table>
			</form>
			<?php
        }

        function getTableRows($Table){
        	$Buscador="<div class='divBuscador'><input type='text' class='campoBuscador' placeholder='Buscar'/><label class='btnBuscador' onclick=\"BuscarRegistros('".$Table."')\"><span class='flaticon-magnifying42'></span></label></div>";
			$consulta = MySQLDriver::consulta("SELECT * FROM ".$Table);
			if(mysql_num_rows($consulta) > 0){
				echo "<h1 id='titlePanel'>Registro de ".$Table."</h1>";
				echo "<div class='divToTable'><table cellspacing='0' cellpading='0' class='tablaReportes'>";
				if($Table=="usuarios")
					cPanel_model::tablaUsuarios($consulta,$Buscador);
				if($Table=="productos")
					cPanel_model::tablaProductos($consulta,$Buscador);
				if($Table=="encuesta")
					cPanel_model::tablaEncuesta($consulta,$Buscador);
				if($Table=="contactos")
					cPanel_model::tablaContactos($consulta,$Buscador);	
				if($Table=="cotizaciones")
					cPanel_model::tablaCotizaciones($consulta,$Buscador);
				if($Table=="compra")
					cPanel_model::tablaCompra($consulta,$Buscador);
				echo "</table></div>";
			}
			else 
				echo "<div class='mensajeError'>No hay registros en esta tabla</div>";
        }
		//Funciones para mostrar las tablas-------------------------------------------------
		function tablaUsuarios($consulta,$Buscador) {
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
		function tablaProductos($consulta,$Buscador) {
			echo "<tr class='tr-th'><td><img width='16' style='margin-left:5px;' src='../public/imagenes/icons/frontBook.png'></td><td>Id</td><td>Titulo</td><td>Autor</td><td align='right'>$Buscador</td></tr>";
			while($reg=mysql_fetch_array($consulta))
			{ 
				echo "<tr class='tr'><td><img class='portadaLibroReg' src='../public/imagenes/Portadas/".$reg['ImgPortada']."'></td><td align='center'>".$reg['Id']."</td><td>".substr($reg['Titulo'],0,40)."..."."</td><td>".$reg['Autor']."</td><td align='right'><span class='flaticon-expand span-btn-admin' title='Detalles' onclick='expandDetails(this,\"Productos\",".$reg['Id'].")'></span><span class='flaticon-black322 span-btn-admin' title='Editar' onclick='editRows(this,\"Productos\",".$reg['Id'].")'></span><span class='flaticon-delete81 span-btn-admin' title='Borrar' onclick='deleteUser(this,\"Productos\",".$reg['Id'].")'></span></td></tr>";
			}
		}
		function tablaContactos($consulta,$Buscador) {
			echo "<tr class='tr-th'><td>Id</td><td>Nombre Completo</td><td>Email</td><td>Telefono</td><td align='right'>".$Buscador."</td></tr>";
			while($reg=mysql_fetch_array($consulta))
			{ 
				echo "<tr class='tr'><td align='center'>".$reg['Id']."</td><td>".$reg['Nombre']."</td><td>".$reg['Email']."</td><td>".$reg['Telefono']."</td><td align='right'><span class='flaticon-expand span-btn-admin' title='Detalles' onclick='expandDetails(this,\"Contactos\",".$reg['Id'].")'></span><span class='flaticon-black322 span-btn-admin' title='Editar' onclick='editRows(this,\"Contactos\",".$reg['Id'].")'></span><span class='flaticon-delete81 span-btn-admin' title='Borrar' onclick='deleteUser(this,\"Contactos\",".$reg['Id'].")'></span></td></tr>";
			}
		}
		function tablaEncuesta($consulta,$Buscador) {
			echo "<tr class='tr-th'><td>Id</td><td>Fecha Realizacion</td><td>Pregunta 1</td><td>Pregunta 2</td><td>".$Buscador."</td></tr>";
			while($reg=mysql_fetch_array($consulta))
			{ 
				echo "<tr class='tr'><td align='center'>".$reg['Id']."</td><td>".$reg['FechaRealizacion']."</td><td>".$reg['p1']."</td><td>".$reg['p2']."</td><td align='right'><span class='flaticon-expand span-btn-admin' title='Detalles' onclick='expandDetails(this,\"Encuesta\",".$reg['Id'].")'></span><span class='flaticon-delete81 span-btn-admin' title='Borrar' onclick='deleteUser(this,\"Encuesta\",".$reg['Id'].")'></span></td></tr>";
			}
		}
		function tablaCotizaciones($consulta,$Buscador) {
			echo "<tr class='tr-th'><td align='center'><img width='16' src='../public/imagenes/icons/frontBook.png'></td><td> Id </td><td>Fecha y Hora</td><td  width='375'>Informacion del Producto</td><td>".$Buscador."</td></tr>";
			while($reg=mysql_fetch_array($consulta))
			{ 
				echo "<tr class='tr'><td><img class='portadaLibroReg' src='data:image/jpeg;base64,".base64_encode($reg['ImgProducto'])."'></td><td align='center'>".$reg['IdCotizacion']."</td><td>".$reg['FechaDeCotizacion']."</td><td>".$reg['Informacion']."</td><td align='right'><span class='flaticon-expand span-btn-admin' title='Detalles' onclick='expandDetails(this,\"Cotizaciones\",".$reg['IdCotizacion'].")'></span><span class='flaticon-black322 span-btn-admin' title='Editar' onclick='editRows(this,\"Cotizaciones\",".$reg['IdCotizacion'].")'></span><span class='flaticon-delete81 span-btn-admin' title='Borrar' onclick='deleteUser(this,\"Cotizaciones\",".$reg['IdCotizacion'].")'></span></td></tr>";
			}
		}
		function tablaCompra($consulta,$Buscador) {
			echo "<tr class='tr-th'><td align='center' title='Id De Compra'>Id</td><td>Fecha de Compra</td><td>IdCliente</td><td>Nombre segun tarjeta</td><td '>Estado</td><td>".$Buscador."</td></tr>";
			while($reg=mysql_fetch_array($consulta))
			{
				echo "<tr class='tr'><td>".$reg['id']."</td><td>".$reg['fecha']."</td><td>".$reg['idcliente']."</td><td>".$reg['nombretc']."</td><td>".$reg['estado']."</td><td align='right'><span class='flaticon-expand span-btn-admin' title='Detalles' onclick='expandDetails(this,\"compra\",".$reg['id'].")'></span><span class='flaticon-black322 span-btn-admin' style='display:none;' title='Editar' onclick='editRows(this,\"compra\",".$reg['id'].")'></span><span class='flaticon-delete81 span-btn-admin' title='Borrar' onclick='deleteUser(this,\"compra\",".$reg['id'].")'></span></td></tr>";
			}
		}
		function findRows(){
			if($_POST["Tabla"]=="usuarios"){
				$consulta = MySQLDriver::consulta("SELECT * FROM usuarios where TipoUsuario like '%".$_POST['Busqueda']."%' or Nombres like '%".$_POST['Busqueda']."%' or Apellidos like '%".$_POST['Busqueda']."%' or Email like '%".$_POST['Busqueda']."%'");
				while($reg=mysql_fetch_array($consulta))
				{ 
					if($reg['tipoUsuario']=="Administrador")
						$classTipoUser="flaticon-important";
					else 
						$classTipoUser="flaticon-user91";
					echo "<tr class='tr'><td align='center' width='15'>".$reg['IdUsuario']."</td><td width='100'><span class='".$classTipoUser."'></span> ".$reg['tipoUsuario']."</td><td>".$reg['Nombres']." ".$reg['Apellidos']."</td><td>".$reg['Email']."</td><td align='right'><span class='flaticon-expand span-btn-admin' title='Detalles' onclick='expandDetails(this,\"Usuarios\",".$reg['IdUsuario'].")'></span><span class='flaticon-black322 span-btn-admin' title='Editar' onclick='editRows(this,\"Usuarios\",".$reg['IdUsuario'].")'></span><span class='flaticon-delete81 span-btn-admin' title='Borrar' onclick='deleteUser(this,\"Usuarios\",".$reg['IdUsuario'].")'></span></td></tr>";
				}
			}
			if($_POST["Tabla"] == "productos"){
				$consulta = MySQLDriver::consulta("SELECT * FROM productos where Titulo like '%".$_POST['Busqueda']."%' or Autor like '%".$_POST['Busqueda']."%'  ");
				while($reg=mysql_fetch_array($consulta))
				{ 
					echo "<tr class='tr'><td><img class='portadaLibroReg' src='../public/imagenes/Portadas/".($reg['ImgPortada'])."'></td><td align='center'>".$reg['Id']."</td><td>".substr($reg['Titulo'],0,40)."..."."</td><td>".$reg['Autor']."</td><td align='right'><span class='flaticon-expand span-btn-admin' title='Detalles' onclick='expandDetails(this,\"Productos\",".$reg['Id'].")'></span><span class='flaticon-black322 span-btn-admin' title='Editar' onclick='editRows(this,\"Productos\",".$reg['Id'].")'></span><span class='flaticon-delete81 span-btn-admin' title='Borrar' onclick='deleteUser(this,\"Productos\",".$reg['Id'].")'></span></td></tr>";
				}
			}
			if($_POST["Tabla"] == "contactos"){
				$consulta = MySQLDriver::consulta("SELECT * FROM contactos where Nombre like '%".$_POST['Busqueda']."%' OR Email like '%".$_POST['Busqueda']."%' or Telefono like '%".$_POST['Busqueda']."%'");
				while($reg=mysql_fetch_array($consulta))
				{ 
					echo "<tr class='tr'><td align='center'>".$reg['Id']."</td><td>".$reg['Nombre']."</td><td>".$reg['Email']."</td><td>".$reg['Telefono']."</td><td align='right'><span class='flaticon-expand span-btn-admin' title='Detalles' onclick='expandDetails(this,\"Contactos\",".$reg['Id'].")'></span><span class='flaticon-black322 span-btn-admin' title='Editar' onclick='editRows(this,\"Contactos\",".$reg['Id'].")'></span><span class='flaticon-delete81 span-btn-admin' title='Borrar' onclick='deleteUser(this,\"Contactos\",".$reg['Id'].")'></span></td></tr>";
				}
			}
			if($_POST["Tabla"] == "compra"){
				$consulta = MySQLDriver::consulta("SELECT * FROM compra where nombretc like '%".$_POST['Busqueda']."%'");
				while($reg=mysql_fetch_array($consulta))
				{ 
					echo "<tr class='tr'><td>".$reg['id']."</td><td>".$reg['fecha']."</td><td>".$reg['idcliente']."</td><td>".$reg['nombretc']."</td><td>".$reg['estado']."</td><td align='right'><span class='flaticon-expand span-btn-admin' title='Detalles' onclick='expandDetails(this,\"compra\",".$reg['id'].")'></span><span class='flaticon-black322 span-btn-admin' title='Editar' onclick='editRows(this,\"compra\",".$reg['id'].")'></span><span class='flaticon-delete81 span-btn-admin' title='Borrar' onclick='deleteUser(this,\"compra\",".$reg['id'].")'></span></td></tr>";
				}
			}
		}
		function getDetails() {
			if($_POST['Tabla']=="Usuarios"){
				$consulta = MySQLDriver::consulta("SELECT * FROM usuarios where IdUsuario='$_POST[Id]'");
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
					  	<img src="../public/imagenes/Perfil/<?php echo ($reg['ImgPerfil']) ?>" >
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
				$consulta = MySQLDriver::consulta("SELECT * FROM productos where Id='$_POST[Id]'");
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
					  	<img src="../public/imagenes/Portadas/<?php echo ($reg['ImgPortada']) ?>" class="imgPortada">
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
			if($_POST['Tabla']=="Contactos"){
				$consulta = MySQLDriver::consulta("SELECT * FROM contactos where Id='$_POST[Id]'");
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
				$consulta = MySQLDriver::consulta("SELECT * FROM compra where id='$_POST[Id]'");
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
							$consulta = MySQLDriver::consulta("SELECT * FROM detallecompra where idcompra='$_POST[Id]'");
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
		}
		function editRows(){
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
					  	<img src="../public/imagenes/Perfil/<?php echo ($reg['ImgPerfil']) ?>" >
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
					  <form action="" enctype="multipart/form-data" id="formUploading" method="post">
					  <input type="hidden" name="Tabla" value="<?php echo $_POST['Tabla']; ?>">
					  <input type="hidden" name="Id" value="<?php echo $reg['Id'] ;?>">
				<table border="0" cellspacing="6" class="tableViewDetails">
					<tr>
					  <td>Titulo:</td>
					  <td><input type="text" name="Titulo" id="EditTitulo" value="<?php echo $_POST['Tabla']; ?>"></td>
					  <td rowspan="4" class="tdPortada">
					  	<div class="btnCambiarPort" onclick="getExplorerFile()">+</div>
					  	<img src="../public/imagenes/Portadas/<?php echo ($reg['ImgPortada']) ?>" class="imgPortada">
				    	<div class="divTipo_trianglar1"></div>
				    	<div class="divTipo"><?php echo "$ ".$reg["Precio"]; ?></div></div>
				    	<input type="file" name="archivo" class="imgFile" style="display:none;" onchange="EditarPortada(<?php echo $_POST['Id']; ?>)">
					  </td>
					</tr>
					<tr>
					  <td>Autor:</td>
					  <td><input type="text" name="Autor" id="EditAutor" value="<?php echo $reg["Autor"]; ?>"></td>
					</tr>
					<tr>
					  <td>Editorial:</td>
					  <td><input type="text" name="Editorial" id="EditEditorial" value="<?php echo $reg["Editorial"]; ?>"></td>
					</tr>
					<tr>
					  <td>Idioma:</td>
					  <td><input type="text" name="Idioma" id="EditIdioma" value="<?php echo $reg["Idioma"]; ?>"></td>
					</tr>
					<tr>
					  <td>Fecha Publicacion:</td>
					  <td><input type="text" name="FechaPublicacion" id="EditFechaPublicacion" value="<?php echo $reg["FechaPublicacion"]; ?>"></td>
					</tr>
					<tr>
					  <td>Precio:</td>
					  <td><input type="text" name="Precio" id="Precio" value="<?php echo $reg["Precio"]; ?>"></td>
					</tr>
					<tr>
					  <td colspan="3">Descripcion:</td>
					</tr>
					<tr>
					  <td colspan="3"><textarea rows="6" name="Descripcion" class="textareaDescripcionProductos"><?php echo $reg["Descripcion"]; ?></textarea></td>
					</tr>
				</table>
					 </form> 
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
		}
		function updateRows(){
			if($_POST['Tabla']=="Usuarios"){
				$consulta = mysql_query("UPDATE usuarios set tipoUsuario='$_POST[tipoUsuario]', Nombres='$_POST[Nombres]', Apellidos='$_POST[Apellidos]', Email='$_POST[Email]', Password='$_POST[Password]', Telefono='$_POST[Telefono]', FechaNacimiento='$_POST[FechaNacimiento]',Direccion='$_POST[Direccion]' where IdUsuario='$_POST[Id]'")or die(mysql_error());
			}
			if($_POST['Tabla']=="Productos"){
				if(isset($_FILES['archivo']['name'])){
					$ImgPortada=cPanel_model::generarNombre().".jpg";
					$file = $_FILES['archivo']['name'];
		    		//Comprobacion de subida del archivo
				    if ($file != "" && move_uploaded_file($_FILES['archivo']['tmp_name'],"public/imagenes/Portadas/".$ImgPortada))
				    {
						$consulta = mysql_query("UPDATE Productos set Titulo='$_POST[Titulo]', Autor='$_POST[Autor]', Editorial='$_POST[Editorial]', Idioma='$_POST[Idioma]', FechaPublicacion='$_POST[FechaPublicacion]', Precio='$_POST[Precio]',Descripcion='$_POST[Descripcion]', ImgPortada='$ImgPortada' where Id='$_POST[Id]'")or die(mysql_error());
					}
					else {
						$consulta = mysql_query("UPDATE Productos set Titulo='$_POST[Titulo]', Autor='$_POST[Autor]', Editorial='$_POST[Editorial]', Idioma='$_POST[Idioma]', FechaPublicacion='$_POST[FechaPublicacion]', Precio='$_POST[Precio]',Descripcion='$_POST[Descripcion]' where Id='$_POST[Id]'")or die(mysql_error());
					}
				}
			}
			if($_POST['Tabla']=="Cotizaciones"){
				$consulta = mysql_query("UPDATE cotizaciones set FechaDeCotizacion='$_POST[FechaCotizacion]', NombreCliente='$_POST[NombreCliente]', Informacion='$_POST[Informacion]' where IdCotizacion='$_POST[Id]'")or die(mysql_error());
			}
			if($_POST['Tabla']=="Contactos"){
				$consulta = mysql_query("UPDATE contactos set Nombre='$_POST[Nombre]', Email='$_POST[Email]', Telefono='$_POST[Telefono]', Mensaje='$_POST[Mensaje]' where Id='$_POST[Id]'")or die(mysql_error());
			}
			if(isset($consulta)){
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
		}
		function deleteRows(){
			if($_POST['Tabla']=="Usuarios"){
				mysql_query("DELETE FROM usuarios where IdUsuario='$_POST[Id]'")or die(mysql_error());
				echo "N° de filas afectadas: ".mysql_affected_rows();
			}
			else {
				mysql_query("DELETE FROM ".$_POST['Tabla']." where Id='$_POST[Id]'")or die(mysql_error());
				echo "N° de filas afectadas: ".mysql_affected_rows();
			}
		}
		function editarPortada(){
			cPanel_model::getBase64();
		}
	}
?>