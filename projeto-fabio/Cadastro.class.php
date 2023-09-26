<?php


class Cadastro{
	
	public function cadastrar($nome,$sobrenome,$email,$senha){
	include 'DB.class.php';
	$conectar=new DB;
	$conectar=$conectar->conectar();
	
	//tratamento das variaveis
	$nome=ucwords(strtolower($nome));
	$sobrenome=ucwords(strtolower($sobrenome));
	$senha=sha1($senha."helptec");
	 
	//inserir dados
	$insert=mysql_query("INSERT INTO `usuarios`(`nome`, `sobrenome`, `email`, `senha`) VALUES('$nome','$sobrenome','$email','$senha')");
	var_dump($insert);
	if(isset($insert)){
		$flash="Cadastro realizado com sucesso!";
	}else{
		$flash="Erro ao tentar cadastrar!";
	}
	//retorno para o usuario
	echo $flash;
	}
	
}

?>