<?php


class Banco{

	private function conectar(){
	
		try{
		
		$host="localhost";
		$user="root";
		$pass="";
		$banco="agricola";
		
		$dsn="mysql:host=$host;dbname=$banco;";
		
		$con=new PDO($dsn,$user,$pass);
		
		}catch(PDOException $e){
		
		//echo "<pre>";
		//var_dump($e);
		die();
		
		}
	return $con;
	}

	public function inserirCadastro($nome,$sobrenome,$email,$senha,$nivel,$tipo){
		
		$con=$this->conectar();
		$query="INSERT INTO usuarios(nome,sobrenome,email,senha,nivel,tipo) VALUES (:nome,:sobrenome,:email,:senha,:nivel,:tipo)";
		$exec=$con->prepare($query);
		$exec->bindValue(":nome","$nome");
		$exec->bindValue(":sobrenome","$sobrenome");
		$exec->bindValue(":email","$email");
		$exec->bindValue(":senha","$senha");
		$exec->bindValue(":nivel","$nivel");
		$exec->bindValue(":tipo","$tipo");
		
		
		$exec->execute();
		return $exec->rowCount();
	}
	
	public function CadCli($nome,$sobrenome,$cpf,$telefone,$cidade,$bairro,$endereco){
		
		$con=$this->conectar();
		$query="INSERT INTO clientes (nome,sobrenome,cpf,telefone,cidade,bairro,endereco) VALUES (:nome,:sobrenome,:cpf,:telefone,:cidade,:bairro,:endereco)";
		$exec=$con->prepare($query);
		$exec->bindValue(":nome","$nome");
		$exec->bindValue(":sobrenome","$sobrenome");
		$exec->bindValue(":cpf","$cpf");
		$exec->bindValue(":telefone","$telefone");
		$exec->bindValue(":cidade","$cidade");
		$exec->bindValue(":bairro","$bairro");
		$exec->bindValue(":endereco","$endereco");
				
		$exec->execute();
		return $exec->rowCount();
	}
	
	
	
	public function validaEmail($email){
		
		$con=$this->conectar();
		$query=mysql_query("SELECT email FROM usuarios WHERE email = '$email'");
		$exec=$con->prepare($query);
		$exec->bindValue(":email","$email");
		$exec->execute();
		return $exec->rowCount();
	}
	
	
	public function selecionaClientes($nome){
		
		$con=$this->conectar();
		$query=mysql_query("SELECT * FROM clientes");
		$exec=$con->prepare($query);
		$exec->bindValue(":nome","$nome");
		$exec->execute();
		return $exec->rowCount();
	}
	
	public function teste($cliente,$cpf,$descricao,$valor){
		
		$con=$this->conectar();
		$query="INSERT INTO ordem(cliente,cpf,descricao,valor) VALUES (:cliente,:cpf,:descricao,:valor)";
		$exec=$con->prepare($query);
		$exec->bindValue(":cliente","$cliente");
		$exec->bindValue(":cpf","$cpf");
		$exec->bindValue(":descricao","$descricao");
		$exec->bindValue(":valor","$valor");
		
		$exec->execute();
		return $exec->rowCount();
	
}
}

?>
