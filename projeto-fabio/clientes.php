<?php
include('header.php');
include ('cpf.php');

session_start();
if(!isset($_SESSION["email"]) || !isset($_SESSION["senha"])){
header("Location: loginteste.php");
exit;
}
?>

<html>

<head>
	<meta charset="utf-8">
	<script type="text/javascript">
		
		function valida_numero() {
		var num = document.getElementById('cpf').value;
		if (isNaN(num)){ // isNaN = is not a number
		alert('CPF tem que ser um numero!');
		return false; // bloqueia submissão/envio ao php
		}
		
		if
			(num == '00000000000' || 
			 num == '11111111111' || 
			 num == '22222222222' || 
			 num == '33333333333' || 
			 num == '44444444444' || 
			 num == '55555555555' || 
			 num == '66666666666' || 
			 num == '77777777777' || 
			 num == '88888888888' || 
			 num == '99999999999') {
				//alert("cpf invalido");
				alert ("Sequência de CPF inválida!");
				return false;
				
			}
		var telef = document.getElementById('telefone').value;
		if (isNaN(telef)){ // isNaN = is not a number
		alert('Digite o numero de telefone corretamente!');
		return false; // bloqueia submissão/envio ao php
		}
   		}
		</script>
	<link rel="stylesheet" type="text/css" href="style.css"></link>
	<title>OS - Cadastro Cliente</title>
</head>
	
<body>
	<div id="cadastrar"><a href="painel.php" title="Voltar ao Painel Principal">SAIR</a></div>
	<div id ="cadcli">
		<div class="message bradius"><?php echo $msg;?></div>
		<div class="logo"><img src="logo.jpg" width="250" height="92"></div>
		<div class="acomodar">
			<form name="cliente" action="?acao=cadcli" method="post">
			<label for="nome">Nome: </label><input id="nome" type="text" name="nome" class="txt bradius" style="text-transform:uppercase;"></input>
			<label for="sobrenome">Sobrenome: </label><input id="sobrenome" type="text" name="sobrenome" class="txt bradius" style="text-transform:uppercase;"></input>
			<label for="cpf">CPF: </label><input id="cpf" type="text" name="cpf" class="txt bradius" maxlength="11"></input>
			<label for="telefone">Telefone: </label><input id="telefone" type="text" name="telefone" class="txt bradius" maxlength="12"></input>
			<label for="cidade">Cidade: </label><input id="cidade" type="text" name="cidade" class="txt bradius" style="text-transform:uppercase;"></input>
			<label for="bairro">Bairro: </label><input id="bairro" type="text" name="bairro" class="txt bradius" style="text-transform:uppercase;"></input>
			<label for="endereco">Endereco: </label><input id="endereco" type="text" name="endereco" class="txt bradius" style="text-transform:uppercase;"></input>
			<input type="submit" class="sb bradius" onclick="return valida_numero()" value="Cadastrar"></input>
			</form>
		</div>
	</div>
	</body>


</html>