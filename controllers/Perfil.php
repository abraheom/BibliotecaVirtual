<?php 
	class Perfil extends Controller {
		function __construct(){
			parent::__construct();
		}
		function index(){
			$this->view->render($this,"index");
		}
		function listarCompras(){
			$IdUsuario = Session::getValue('IdUsuario');
			Perfil_model::listarCompras($IdUsuario);
		}
	}
?>