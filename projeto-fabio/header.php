<?php
$start="";
$msg="";
$acao="";
$scodif="";
$flash="";
$tipo="";
//GLOBAIS
if(isset($_GET["acao"])){
	$acao=$_GET["acao"];
	$start=1;
}

//metodo de para logar-----------------------------------------------
if($start == 1){	
	if($acao == "logar"){
		$email=$_POST["email"];
		$senha=$_POST["senha"]; 
		$scodif=md5($senha);
		//echo $scodif;
		//echo $email;
		//$email=$_POST["email"];
		//$senha=$_POST["senha"];
		
		if(empty($email) || empty($senha)){
		$msg="Preencha todos os campos!";
			
		}
			
			else{
			require 'banco.php';
			error_reporting (E_ALL & ~ E_NOTICE & ~ E_DEPRECATED);
			$link = mysql_connect("localhost","root","");
			mysql_select_db("agricola", $link);
			$result = mysql_query("SELECT * FROM usuarios WHERE email = '$email' and senha = '$scodif' and nivel = 1" , $link);
			$num_rows = mysql_num_rows($result);
			if($num_rows > 0){
			session_start();
			$_SESSION['email']=$_POST['email'];
			$_SESSION['senha']=$_POST['senha'];
			
			header("Location: painel.php");
				
			
			}else{
				$msg=" Email ou Senha invalidos!";
			}
			}
			
			/*Teste do acesso para usuario nao administrador*/
			
			if(empty($email) || empty($senha)){
			$msg="Preencha todos os campos!";
			}
			
			else{
			//require 'banco.php';
			error_reporting (E_ALL & ~ E_NOTICE & ~ E_DEPRECATED);
			$link = mysql_connect("localhost","root","");
			mysql_select_db("agricola", $link);
			$result = mysql_query("SELECT * FROM usuarios WHERE email = '$email' and senha = '$scodif' and nivel != 1" , $link);
			$num_rows = mysql_num_rows($result);
			if($num_rows > 0){
			session_start();
			$_SESSION['email']=$_POST['email'];
			$_SESSION['senha']=$_POST['senha'];
			
			header("Location: painel2.php");
			
			}else{
				$msg=" Email ou Senha invalidos!";
			}
			}
			
		}
		
		}
	

//metodo de para cadastrar usuario-----------------------------------------------	
	if($acao == "cadastrar"){
		$nome=ucwords(strtolower($_POST["nome"]));
		$sobrenome=ucwords(strtolower($_POST["sobrenome"]));
		$email=$_POST["email"];
		$pw=$_POST["senha"];
		$nivel=$_POST["select_niveis_acesso"];
		if($nivel == 1){
			$tipo = 'Administrador';
			
		}else{
			$tipo = 'Colaborador';
		}
		$senha = $pw;
		
		
		if(empty($nome) || empty($sobrenome) || empty($email) || empty($senha) || empty($nivel)){
		$msg="Preencha todos os campos!";}
		else{
			/*validar email*/
			if(filter_var($email,FILTER_VALIDATE_EMAIL)){
				if(strlen($senha)<8){
					$msg="Senha deve ter no minimo 8 caracteres!";
				}
			else{
				require 'banco.php';
				error_reporting (E_ALL & ~ E_NOTICE & ~ E_DEPRECATED);
				$senha = md5($pw);
				$con=new banco();
				$link = mysql_connect("localhost","root","");
				mysql_select_db("agricola", $link);
				$validaremail=mysql_query("SELECT * FROM usuarios WHERE email = '$email'");
				$contar=mysql_num_rows($validaremail);
					if($contar==0){
						$con=$con->inserirCadastro($nome,$sobrenome,$email,$senha,$nivel,$tipo);
						$msg="Cadastro realizado. Aguarde nossa autorizacao!";
						//$flash="Cadastro realizado com Sucesso. Aguarde nossa aprovacao!";
						}else{
							$msg = "Esse email ja existe em nosso cadastro!";
						}
			}
			}	
			ELSE{
				$msg="Digite seu email corretamente!";
			}
		}
		
	}
	
//metodo de para cadastrar ORDEM DE SERVICO-----------------------------------------------	
if($start == 1){
if($acao == "gravaros"){
		//$nome=ucwords(strtolower($_POST["nome"]));
		//$sobrenome=ucwords(strtolower($_POST["sobrenome"]));
		$cliente=$_POST["select_clientes"];
		$cpf=$_POST["select_cpf"];
		$descricao=$_POST["descricaoos"];
		$valor=$_POST["valor"];
				
		if(empty($cliente) || empty($cpf) || empty($descricao) || empty($valor)){
		$msg="Preencha todos os campos!";}
		
				else{
				require 'banco.php';
				error_reporting (E_ALL & ~ E_NOTICE & ~ E_DEPRECATED);
				$con=new banco();
				$link = mysql_connect("localhost","root","");
				mysql_select_db("agricola", $link);
				$con=$con->teste($cliente,$cpf,$descricao,$valor);
						$msg="Ordem de Servico gravada com sucesso!";
				}
			}
			
			}	
			
		
		

	
//metodo para cadastrar CLIENTE-----------------------------------------------	
if($start == 1){
if($acao == "cadcli"){
		//$nome=ucwords(strtolower($_POST["nome"]));
		//$sobrenome=ucwords(strtolower($_POST["sobrenome"]));
		$nome=$_POST["nome"];
		$sobrenome=$_POST["sobrenome"];
		$cpf=$_POST["cpf"];
		$telefone=$_POST["telefone"];
		$cidade=$_POST["cidade"];
		$bairro=$_POST["bairro"];
		$endereco=$_POST["endereco"];
		
		if(empty($nome) || empty($sobrenome) || empty($cpf) || empty($telefone) || empty($cidade) || empty($bairro) || empty($endereco)){
		$msg="Preencha todos os campos!";}
		else{
			/*validar cpf*/
				if(strlen($cpf)<11){
					$msg="CPF deve ter 11 digitos!";
				}
				
				else{
				require 'banco.php';
				error_reporting (E_ALL & ~ E_NOTICE & ~ E_DEPRECATED);
				$con=new banco();
				$link = mysql_connect("localhost","root","");
				mysql_select_db("agricola", $link);
				$validarcpf=mysql_query("SELECT * FROM clientes WHERE cpf = '$cpf'");
				$contar=mysql_num_rows($validarcpf);
					if($contar==0){
						$con=$con->CadCli($nome,$sobrenome,$cpf,$telefone,$cidade,$bairro,$endereco);
						//VAR_DUMP($con);
						$msg="Cadastro realizado com sucesso!";
						//$flash="Cadastro realizado com Sucesso. Aguarde nossa aprovacao!";
						}else{
							$msg = "Esse cpf/cliente ja existe em nosso cadastro!";
						}
			}
			
			}	
			
		}
		
}

?>