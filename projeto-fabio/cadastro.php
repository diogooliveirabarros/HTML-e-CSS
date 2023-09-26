<?php
include('header.php');
?>

<html>

<head>
<link rel="stylesheet" type="text/css" href="style.css"></link>
<title>Sistema Irrigacao - Cadastro</title>
</head>
	
<body>
	<div id="cadastrar"><a href="loginteste.php" title="Volte a tela de Login do sistema">Login &raquo;</a></div>
	<!--<div id="flash"><?php echo $flash;?></div>-->
		
	<div id ="login">
		<div class="message bradius"><?php echo $msg;?></div>
		<div class="logo"><img src="logo.jpg" width="250" height="92"></div>
		<div class="acomodar">
			<form action="?acao=cadastrar" method="post">
			<label for="nome">Nome: </label><input id="email" type="text" name="nome" class="txt bradius"></input>
			<label for="sobrenome">Sobrenome: </label><input id="email" type="text" name="sobrenome" class="txt bradius"></input>
			<label for="email">E-Mail: </label><input id="email" type="text" name="email" class="txt bradius"></input>
			<label for="senha">Senha: </label><input id="senha" type="password" name="senha" class="txt bradius"></input>
			<input type="submit" class="sb bradius" value="Cadastrar"></input>
			</form>
		</div>
	</div>
	</body>


</html>