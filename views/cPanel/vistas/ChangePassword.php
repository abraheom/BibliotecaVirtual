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
				<input type="button" class="btnSaveBook" onclick="ChangePassword()" value="Cambiar Contraseña"><img class="loadingData" src='../imagenes/loading1.gif' style='margin-left:9px;margin-top:8px;position:absolute;width:40px;visibility:hidden;'>
			</td>
		</tr>
	</table>
</form>