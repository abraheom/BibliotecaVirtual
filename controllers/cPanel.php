<?php 
	class cPanel extends Controller {
		function __construct(){
			parent::__construct();
		}
		function index(){
			$this->view->render($this,"index");
		}
		function getForms($Form){
			cPanel_model::{"getForms".$Form}();
		}
		function getTableRows($Table){
			cPanel_model::getTableRows($Table);
		}
		function findRows(){
			cPanel_model::findRows();
		}
		function editarPerfil(){
			cPanel_model::editarPefil();
		}
		function changePassword(){
			cPanel_model::changePassword();
		}
		function getDetails(){
			cPanel_model::getDetails();
		}
		function editRows(){
			cPanel_model::editRows();
		}
		function updateRows(){
			cPanel_model::updateRows();
		}
		function deleteRows(){
			cPanel_model::deleteRows();
		}
		function editarPortada(){
			cPanel_model::editarPortada();
		}
	}
?>