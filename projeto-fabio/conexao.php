<?php
   $msg="";
   $root = "root";
   $pass = "";
   $banco = "agricola";
   $pdo = new PDO("mysql:host=localhost;dbname=$banco", "$root", "$pass");
   if(!$pdo){
       die('Erro ao criar a conexão');
   }else{
	   $msg="Conexao Realizada com Sucesso!";
   }
?>