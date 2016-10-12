<?php 
	class Login_model extends Model {
		function __construct() {
            parent::__construct();
        }
        function LogIn(){
			if(isset($_POST["Email"]) && isset($_POST["Pass"])) {
				$res = MySQLDriver::consulta("select * from usuarios where Email='$_POST[Email]'");
				if($reg = mysql_fetch_array($res)){
					if($reg["Password"]==$_POST["Pass"]) {
						Session::SetValue("IdUsuario",$reg["IdUsuario"]);
						Session::SetValue("TipoUsuario",$reg["tipoUsuario"]);
						echo 2;
					}
					else 
						echo 1;
				}
				else 
					echo 0;
			}
		}
		function LogOut(){
			Session::destroy();
			echo 2;
		}
	}

?>