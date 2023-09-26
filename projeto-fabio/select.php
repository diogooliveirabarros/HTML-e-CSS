<?php


$cliente="";
$dados="";
?>
<html>
<head>
<meta charset="utf-8">

</head>


<select name="clientes">
			<option>Selecione</option>
			<?php
			$sql = "select * from clientes";
			$resultsql = mysqli_query($conn,$sql);
			while($row_clientes = mysqli_fetch_assoc($resultsql)){ ?>
			<option><?php echo $row_clientes['nome']; ?></option> <?php
			} 
			?>
			
			
</select>
			
</html>