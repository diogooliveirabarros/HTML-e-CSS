<!DOCTYPE html>
<html>
	<head>
		<title>Universo Digital</title>
		<link rel="stylesheet" type="css/text" href="estilo.css" />
	<head>
	
	<body>
	  <div id="container">
	  
		<div id="left">
			<header><h1><span>Universo Digital<span></h1></header>
			<section>
				<nav>
					<a href="#">planetas</a> | 
					<a href="#">estrelas</a> | 
					<a href="#">sistemas</a>
				</nav>
				<div class="clear"></div>
			<section>
			<footer><em>Produzido para o EAD Pernambuco.</em></footer>
		</div>
		
		<div id="right">
			<header><h2><span>Planetas<span></h2></header>
			<section>
				<p>Um planeta � um corpo celeste que orbita uma estrela ou um remanescente de estrela, com massa suficiente para se tornar esf�rico pela sua pr�pria gravidade, mas n�o ao ponto de causar fus�o termonuclear, e que tenha limpo de planetesimais a sua regi�o vizinha (domin�ncia orbital).</p>
				<p>Fonte: <a href="https://pt.wikipedia.org/wiki/Planeta">https://pt.wikipedia.org/wiki/Planeta</a></p>
				
				<form action="" method="">
					<p><strong>Insira um novo planeta no sistema: </strong></p>
					Nome: <input type="text" name="nome" /><br />
					Tipo: 
					<select name="tipo">
						<option value="terrestre">Terrestre</option>
						<option value="gasoso">Gigante Gasoso</option>
						<option value="an�o">Planeta An�o</option>
					</select><br />
					Di�metro Equatorial: <input type="text" name="tamanho" /><br />
					Descri��o:
					<textarea name="descricao"></textarea>
					<input type="submit" value="enviar" />
				</form>
				
				<p><strong>Planetas</strong></p>
				<table>
					<tr>
						<th>Nome</th>
						<th>Tipo</th>
						<th>Di�metro Equatorial</th>
					</tr>
					<tr>
						<td>Terra</td>
						<td>terrestre</td>
						<td>1,0</td>
					</tr>
					<tr>
						<td>Terra</td>
						<td>terrestre</td>
						<td>1,0</td>
					</tr>
					<tr>
						<td>Terra</td>
						<td>terrestre</td>
						<td>1,0</td>
					</tr>
				</table>
			</section>
			<footer></footer>
		</div>
		
		<div class="clear"></div>
	  </div>
	</body>
</html>