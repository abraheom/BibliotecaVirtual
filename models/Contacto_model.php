<?php 
	class Contacto_model extends Model {
		function __construct() {
            parent::__construct();
        }
        function guardarMensaje(){
        	$Nombre = $_POST['Nombre'];
			$Email = $_POST['Email'];
			$Telefono = $_POST['Telefono'];
			$Mensaje = $_POST['Mensaje'];
			MySQLDriver::consulta("INSERT into contactos(Nombre, Email, Telefono, Mensaje) values('$Nombre','$Email','$Telefono','$Mensaje')");		
        }
	}
?>