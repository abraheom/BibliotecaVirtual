<?php 
class Carrito extends Controller {
	static function verCarrito(){
		Carrito_model::verCarrito();
	}
	static function agregaCar(){
		Carrito_model::agregaCar();
	}
	static function borrarCar(){
		Carrito_model::borrarCar();
	}
	static function pagarCompra(){
		Carrito_model::pagarCompra();
	}
	static function guardarCompra(){
		Carrito_model::guardarCompra();
	}
}
?>