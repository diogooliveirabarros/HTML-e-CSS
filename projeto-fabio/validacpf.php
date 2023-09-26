<html>
<head>

<script type="text/javascript">
	function verifica_seq(){
	
	var valor = document.getElementById('cpf').value;
	
	if (valor == '00000000000' || 
        valor == '11111111111' || 
        valor == '22222222222' || 
        valor == '33333333333' || 
        valor == '44444444444' || 
        valor == '55555555555' || 
        valor == '66666666666' || 
        valor == '77777777777' || 
        valor == '88888888888' || 
        valor == '99999999999') {
        //alert("cpf invalido");
		alert ("sequencia invalida!");
		return false;
     
     }
	}
	
	 
	</script>
	

</head>

<body>


<?php




	/*else{
	$n[1]=substr($valor,0,1);
	$n[2]=substr($valor,1,1);
	$n[3]=substr($valor,2,1);
	$n[4]=substr($valor,3,1);
	$n[5]=substr($valor,4,1);
	$n[6]=substr($valor,5,1);
	$n[7]=substr($valor,6,1);
	$n[8]=substr($valor,7,1);
	$n[9]=substr($valor,8,1);
	$n[10]=substr($valor,9,1);
	$n[11]=substr($valor,10,1);
	
	$soma1=($n[1]*10)+($n[2]*9)+($n[3]*8)+($n[4]*7)+($n[5]*6)+($n[6]*5)+($n[7]*4)+($n[8]*3)+($n[9]*2);
	$dgt1=11-($soma1%11);
	
	if($dgt1==10 or $dgt1==11){
		$dgt1=0;
	}
	
	$soma2=(($n[1]*11)+($n[2]*10)+($n[3]*9)+($n[4]*8)+($n[5]*7)+($n[6]*6)+($n[7]*5)+($n[8]*4)+($n[9]*3)+($dgt1*2));
	
	$dgt2=11-($soma2%11);
	
	if($dgt2==10 or $dgt2==11){
		$dgt2=0;
	}
	if($dgt1<>$n[10] OR $dgt2<>$n[11]){
		$erro=true;
	}
	else{
			$erro=false;
		}
		return $erro;
	}
	
	
	}*/
	/*if(verifica_cpf($cpf)){
		print "Numero de cpf Invalido! <br></br>";
	}else{
	echo "pegou!";
	}*/

?>
	<form method="post">
	<input type="text" name="cpf" id="cpf"></input>
	<input type="submit" name="teste" onclick="return verifica_seq()"></input>
	</form>

</body>

	


</html>