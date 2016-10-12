<?php 
	class MySQLDriver {
		static function init(){
			mysql_connect(DB_Host,DB_User,DB_Pass) or die(mysql_error());
			mysql_select_db(DB_Name)or die(mysql_error());
		}
		static function consulta($sql){
			$res = mysql_query($sql)or die(mysql_error());
			return $res;
		}	
		static function affectedRows(){
			if(mysql_affected_rows())
				return true;
			else
				return false;
		}		
	}
?>