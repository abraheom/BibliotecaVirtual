<?php 
	class Login extends Controller {
		function __construct(){
			parent::__construct();
		}
		function index(){
			//...
		}
		function LogIn(){
			Login_model::LogIn();
		}
		function LogOut(){
			Login_model::LogOut();
		}
	}
?>