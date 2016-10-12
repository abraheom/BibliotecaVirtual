<?php 
require("config.php");
$url = (isset($_GET["url"])) ? $_GET["url"]: "Index/index";
$url = explode("/",$url);
if(isset($url[0])){$controller = $url[0];}
if(isset($url[1]) && $url[1] != ""){$method 	= $url[1];}
if(isset($url[2]) && $url[2] != ""){$params 	= $url[2];}
//print_r($url);

//Incluir todos los archivos(Librerias) de la carpeta "libs"
spl_autoload_register(function($archivo){
	if(file_exists(LIBS.$archivo.".php")){
		include(LIBS.$archivo.".php");
	}
});

//Incluir el controlador
$path = "./controllers/".$controller.".php";
if(file_exists($path)){
	include($path);
	$controller = new $controller();
	if(isset($method)){
		if(method_exists($controller, $method)){
			if(isset($params))
				$controller->{$method}($params);
			else
				$controller->{$method}();
		}
		else {
			echo "No existe el metodo";
		}
	} 
	else {
		$controller->index();
	}
}
else
	echo "El controlador no existe...";
?>