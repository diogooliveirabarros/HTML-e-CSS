<?php
error_reporting (E_ALL & ~ E_NOTICE & ~ E_DEPRECATED);
class DB{
	public function conectar(){
		$host="localhost";
		$user="root";
		$pass="";
		$db="agricola";
		
		$conexao=mysql_connect($host,$user,$pass);
		$selectdb=mysql_select_db($db);
		
		return $conexao;
	}
}


?>