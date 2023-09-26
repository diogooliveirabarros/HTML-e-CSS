<html>

<head>

</head>
	<title>Sistema de Irrigacao - Login</title>
	<style type="text/css">
	#geral{
		width: 1200px;
		margin: 0 auto;
		
	}
	.form{
		width: 200px;
		margin: 0 auto;
	}
	#imagem{
		margin: 100 auto;
	}
	
	#centro{
		position: absolute;
		top: 50%;
		left: 50%;
		margin-top: -50px;
		margin-left: -50px;
		}
	
	
	</style>
<body>
	
	<div id="imagem" align="center"><img src="logo.jpg" width="250" height="92"></div>
	<div id="geral">
	<form class="form" name="loginform" method="post" action="autenticar.php">
	E-mail: <input type="text" name="email"><br><br>
	Senha: <input type="password" name="senha"><br><br>
	<input type="submit" value="Entrar">
	
	</form>
	</div>
</body>


</html>