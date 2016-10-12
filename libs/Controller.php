<?php 
	class Controller{
		function __construct(){
			Session::init();
			(new Model());
			$this->view = new View();
			$this->loadModel();
		}
		function loadModel(){
			$model = get_class($this)."_model";
			$path = "./models/".$model.".php";
			if(file_exists($path)){
				include($path);
				$this->model= new $model();
			}
		}
	}
?>