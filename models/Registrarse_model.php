<?php 
	class Registrarse_model extends Model {
		function guardarUsuario(){
			$Nombres = $_POST['nombres']; 
			$Apellidos = $_POST['apellidos'];
			$Email = $_POST['email']; 
			$Password = $_POST['password']; 
			$Telefono = $_POST['telefono']; 
			$FechaNacimiento = $_POST['fechaNacimiento'];
			$Direccion = $_POST['direccion'];
			if(!is_null($Nombres) && !is_null($Apellidos)) {
				MySQLDriver::consulta("INSERT INTO usuarios(tipoUsuario, Nombres, Apellidos, Email, Password, Telefono, FechaNacimiento, Direccion,ImgPerfil) VALUES('Cliente','$Nombres','$Apellidos','$Email','$Password','$Telefono','$FechaNacimiento','$Direccion','profile_default.png')");
			}
		}
	}

?>