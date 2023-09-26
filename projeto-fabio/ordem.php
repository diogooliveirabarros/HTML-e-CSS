<?php
include('header.php');
include "conecta.php";

session_start();
if(!isset($_SESSION["email"]) || !isset($_SESSION["senha"])){
header("Location: loginteste.php");
exit;
}
?>

<html>

<head>
	<script type="text/javascript">
	function validaos(){
		if(document.getElementById('cli').selectedIndex == 0){
            alert("Selecione o cliente!"); 
            //form.st_contrato.focus();
            return false;
        }
		
		if(document.getElementById('cpf').selectedIndex == 0){
            alert("Informe o cpf do cliente!"); 
            //form.st_contrato.focus();
            return false;
        }
	}
	</script>
<meta charset="utf-8">
<link rel="stylesheet" type="text/css" href="style.css"></link>
<title>OS - Cadastro de OS</title>
</head>
	
<body>
	<div id="cadastrar"><a href="painel.php" title="Volte ao Painel Principal">SAIR</a></div>
	<div id ="cados">
		<div class="message bradius"><?php echo $msg;?></div>
		<div class="logo"><img src="logo.jpg" width="250" height="92"></div>
		<div class="acomodaros">
			<form action="?acao=gravaros" method="post">
			<select name="select_clientes" class="txt bradius">
				<option id="cli" value=0>Selecione o Cliente</option>
				<?php
				$sql = "select * from clientes";
				$resultsql = mysqli_query($conn,$sql);
				while($row_cli = mysqli_fetch_assoc($resultsql)){ ?>
				<option value="<?php echo $row_cli['nome']; ?>"><?php echo $row_cli['nome'];?></option> <?php
				} 
				?>
			</select>
			<div>
			<select name="select_cpf" class="txt bradius">
				<option id="cpf" value=0>Selecione o CPF do cliente</option>
				<?php
				$sql2 = "select * from clientes";
				$resultsql2 = mysqli_query($conn,$sql);
				while($row_cli2 = mysqli_fetch_assoc($resultsql2)){ ?>
				<option value="<?php echo $row_cli2['cpf']; ?>"><?php echo $row_cli2['cpf'];?></option> <?php
				} 
				?>
			</select></div>
			<div>
			<label for="sobrenome">Descricao da OS: </label>
			</div>
			<input id="email" type="text" name="descricaoos" class="txtcados bradius"></input>
			<div>
			<label for="email">Valor R$: </label>
			</div>
			
			<input id="email" type="text" name="valor" class="txt bradius"></input>
			<input type="submit" class="sb bradius" onclick="validaos()" value="Gravar OS"></input>
			
			</form>
		</div>
	</div>
	</body>


</html>