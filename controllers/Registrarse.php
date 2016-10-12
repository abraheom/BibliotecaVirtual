<?php 
	class Registrarse extends Controller {
		function __construct(){
			parent::__construct();
		}
		function index(){
			$this->view->render($this,"index");
		}
		function guardarUsuario(){
			Registrarse_model::guardarUsuario();
		}
	}
?>