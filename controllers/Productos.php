<?php 
	class Productos extends Controller {
		function __construct(){
			parent::__construct();
		}
		public function index(){
			$this->view->render($this,"index");
		}
		public function ObtenerProductos(){
			Productos_model::ObtenerProductos();
		}
		public function guardarLibro(){
			Productos_model::guardarLibro();
		}
		public function getBase64(){
			Productos_model::getBase64();
		}
	}
?>