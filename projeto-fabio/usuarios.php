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
	function validanivel()
	//function valida_numero() {
	//var nivel = document.getElementById('eu').value;
	if(document.getElementById('eu').selectedIndex == 0){
            alert("Informe o nível do usuario!"); 
            //form.st_contrato.focus();
            return false;
        }
</script>
<link rel="stylesheet" type="text/css" href="style.css"></link>
<title>OS - Cadastro de Usuarios</title>
<meta charset="utf-8">
</head>
	
<body>
	<div id="cadastrar"><a href="painel.php" title="Voltar ao Painel Principal">SAIR</a></div>
	<!--<div id="flash"><?php echo $flash;?></div>-->
		
	<div id ="login">
		<div class="message bradius"><?php echo $msg;?></div>
		<div class="logo"><img src="logo.jpg" width="250" height="92"></div>
		<div class="acomodar">
			<form name="formuser" action="?acao=cadastrar" method="post">
			<label for="nome">Nome: </label><input id="email" type="text" name="nome" class="txt bradius" style="text-transform:uppercase;"></input>
			<label for="sobrenome">Sobrenome: </label><input id="email" type="text" name="sobrenome" class="txt bradius" style="text-transform:uppercase;"></input>
			<label for="email">E-Mail: </label><input id="email" type="text" name="email" class="txt bradius"></input>
			<label for="senha">Senha: </label><input id="senha" type="password" name="senha" class="txt bradius"></input>
			<label for="usuario">Nível do Usuário: </label>
			<!--<input id="senha" type="password" name="usuario" class="txt bradius"></input>-->
			<select name="select_niveis_acesso" class="txt bradius">
			<option id="eu" value=0>Selecione</option>
				<?php
				$result_niveis_acessos = "select * from nivelacesso";
				$resultado_niveis_acesso = mysqli_query($conn,$result_niveis_acessos);
				while($row_niveis_acessos = mysqli_fetch_assoc($resultado_niveis_acesso)){ ?>
				<option value="<?php echo $row_niveis_acessos['id'];?>"><?php echo $row_niveis_acessos['nivel']; ?></option> <?php
				} 
				?>
			</select>
			<input type="submit" class="sb bradius" onclick="validanivel()" value="Cadastrar"></input>
			</form>
		</div>
	</div>
	</body>


</html>