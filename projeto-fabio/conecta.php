<?php
error_reporting (E_ALL & ~ E_NOTICE & ~ E_DEPRECATED);
$servidor = "localhost";
$usuario = "root";
$senha = "";
$dbname = "agricola";

$conn = mysqli_connect($servidor,$usuario,$senha,$dbname);

if(!$conn){
	die("Falha na conexao: ". mysqli_connect_error());
}

?>