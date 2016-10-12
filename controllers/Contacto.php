<?php 
	class Contacto extends Controller {
		function __construct(){
			parent::__construct();
		}
		function index(){
			$this->view->render($this,"index");
		}
		function guardarMensaje(){
			Contacto_model::guardarMensaje();
		}
	}
?>