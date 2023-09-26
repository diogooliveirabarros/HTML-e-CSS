<?php
include('header.php');
?>

<html>

<head>
<meta charset="utf-8">

<link rel="stylesheet" type="text/css" href="style.css"></link>
<title>OS - Login</title>
</head>
	
<body>
	<!--<div id="cadastrar"><a href="cadastro.php" title="Cadastre-se e conheca o sistema">Cadastre-se &raquo;</a></div>-->
	<div id ="login" class="bradius" style="top:150px;">
		<div class="message bradius"><?php echo $msg;?></div>
		<div class="logo"><img src="logo.jpg" width="250" height="92"></div>
		<div class="acomodar">
			<form name="formlogin" action="?acao=logar" method="post">
			<label for="email">E-Mail: </label><input id="email" type="text" name="email" class="txt bradius" value=""></input>
			<label for="senha">Senha: </label><input id="senha" type="password" name="senha" class="txt bradius" value=""></input>
			<input type="submit" class="sb bradius" value="Entrar" name="botao"</input>
			</form>
		</div>
	</div>

</body>


</html>

