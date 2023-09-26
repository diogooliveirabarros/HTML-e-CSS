<?php

session_start();
if(!isset($_SESSION["email"]) || !isset($_SESSION["senha"])){
header("Location: loginteste.php");
exit;
}

?>

<HTML>
	<head>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="style.css"></link>
	
	</head>
	<BODY>
	<div id="cadastrar"><a href="loginteste.php" title="Voltar a tela de Login">SAIR</a></div>
	<div id ="externa">
		<div id="interna"><img src="logo.jpg" width="250" height="92"></div>
		<div class="centro">
		<form name="formlogin" action="ordem.php" method="post">
		<input type="submit" class="btpainel bradius" value="ORDEM DE SERVICO" name="botao1"</input>
		</div>
		</form>
		<div class="centro">
		<form name="formlogin" action="clientes.php" method="post">
		<input type="submit" class="btpainel bradius" value="CADASTRO DE CLIENTES" name="botao1"</input>
		</div>
		</form>
		<div class="centro">
		<form name="formlogin" action="" method="post">
		<input type="submit" class="btpainel bradius" value="RELATORIOS" name="botao3"</input>
		</div>
		</form>
		<!--<div class="centro">
		<form name="formlogin" action="usuarios.php" method="post">
		<input type="submit" class="btpainel bradius" value="CADASTRO DE USUARIOS" name="botao"</input>
		</div>-->
		
		</form>
		
	</div>
	
	<!--<a href='logout.php'>SAIR</a>-->
	
	</BODY>

</HTML>