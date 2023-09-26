<?php
//globais

$startaction="0";
echo $startaction;
if(isset($_GET["acao"])){
	$acao=$_GET["acao"];
	$startaction=1;
	echo $startaction;
}
/*
//metodo de cadastro

if($startaction==1){
	if($acao=="cadastrar"){
	$nome=S_POST['nome'];
	$sobrenome=S_POST['sobrenome'];
	$email=S_POST['email'];
	$senha=S_POST['senha'];	
	
	if(empty($nome)) || (empty($nome)) || (empty($nome)) || (empty($nome)){
		$msg="Preencha todos os campos!";
	}
	}

}


include('conexao.php');




if(!empty($nome)) || (!empty($sobrenome)) || (!empty($email)) || (!empty($senha)){
$query  = "INSERT INTO usuarios (nome,sobrenome,email,senha) VALUES ('$nome','$sobrenome','$email','$senha')";
$executa = $pdo->query("$query");	
} 
   if($executa){
      echo 'Dados inseridos com sucesso!';
   }
   else{
      print_r($pdo->errorInfo());
   }
   */
 ?>
