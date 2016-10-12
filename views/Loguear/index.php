<?php
	//session_start();
	if(isset($_SESSION['IdUsuario']) and !empty($_SESSION['IdUsuario'])) {
			$IdUsuario=Session::getValue("IdUsuario");
			$consulta = MySQLDriver::consulta("SELECT Nombres,ImgPerfil FROM usuarios WHERE IdUsuario='$IdUsuario' LIMIT 1");
			$reg=mysql_fetch_array($consulta);
?>
		<div id="logeado">
			<table>
			<tr>
				<td>
					<div id="fotoPerfil">
						<a class="fotoPerfil-a" href="./Perfil"><img id="perfil" title="Ver perfil" <?php echo 'src="public/imagenes/Perfil/'.$reg['ImgPerfil'].'"'; ?>></a>
					</div>
				</td>
				<td style="vertical-align:middle;">
					<div id="infoCuenta">						
						<?php echo $reg['Nombres']; ?>
						<div class="icon-config" >
							<img src="public/imagenes/icons/settings.png" width="16">
							<div class="listOptionUser">
								<ul>
									<li>
										<a href="./Perfil">Perfil</a>
									</li>
									<li>
										<a onclick="logout()">
											Cerrar session
											<img width="25" id="loadingData" src="public/imagenes/loading.gif" style="position:absolute;visibility:hidden;">
										</a>
									</li>
								</ul>
							</div>
						</div>
						
						<img width="25" id="loadingData" src="public/imagenes/loading.gif" style="position:absolute;visibility:hidden;">
					</div>
				</td>
			</tr>
			</table>
		</div>
<?php	
	}
	else {
?>
			<form id="loginForm" method="post" action="#" onkeypress="keyPress(event)">
				<fieldset>
					<legend>Iniciar sesion</legend>
					<table>
						<tr>
							<td>Email:</td>
							<td><input type="text" id="loginEmail" name="email" placeholder="ejemplo@ejemplo.com"></td>
						</tr>
						<tr>
							<td>Contraseña:</td>
							<td><input type="password" id="loginPassword" placeholder="Contraseña"></td>
						</tr>
						<tr>
							<td colspan="2" align="center">
								<input type="button" onclick="Login()" value="Entrar">
								<img width="25" id="loadingData" src="public/imagenes/loading.gif" style="position:absolute;visibility:hidden;">
							</td>
						</tr>
						<tr>
							<td  colspan="2" align="center"><label id="loginLogs"></label></td>
						</tr>
					</table>
				</fieldset>
			</form>
<?php
}
?>