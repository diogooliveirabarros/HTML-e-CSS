<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "devweb2016";

$conn = mysqli_connect($servername, $username, $password);

/* CHECK CONNECTION */
if (mysqli_connect_errno()) {
    printf("<p style='color: red;'>Conexão falhou: %s\n</p>", mysqli_connect_error());
    exit();
} else {
	printf("<p style='color: blue;'>Conectado ao bando de dados.<p/>");
}

/* DELETE DATABASE IF EXISTS */
if (mysqli_query($conn, "DROP DATABASE IF EXISTS $database")) {
    printf("<p style='color: blue;'>Banco de dados apagado.<p/>");
} else {
	printf("<p style='color: red;'>Não consigo apagar o bando de dados.<p/>" . mysqli_error($conn));
    exit();
}

/* CREATE DATABASE */
if (mysqli_query($conn, "CREATE DATABASE $database")) {
    printf("<p style='color: blue;'>Banco de dados $database criado.<p/>");
} else {
	printf("<p style='color: red;'>Não consigo criar o bando de dados.<p/>" . mysqli_error($conn));
    exit();
}


/* SELECT DATABASE */
if (mysqli_select_db($conn, $database)) {
    printf("<p style='color: blue;'>Banco de dados selecionado.<p/>");
} else {
	printf("<p style='color: red;'>Não consigo selecionar o bando de dados.<p/>" . mysqli_error($conn));
    exit();
}

/* CREATE TABLE PLANETAS */
$sql = "CREATE TABLE planetas (
			id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY, 
			nome VARCHAR(255),
			tipo VARCHAR(10),
			tamanho FLOAT,
			descricao TEXT
		)";

if (mysqli_query($conn, $sql)) {
    printf("<p style='color: blue;'>Tabela planetas criada.<p/>");
} else {
	printf("<p style='color: red;'>Não consigo criar a tabela planetas.<p/>" . mysqli_error($conn));
    exit();
}

/* CREATE TABLE SISTEMAS */
$sql = "CREATE TABLE sistemas (
			id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY, 
			nome VARCHAR(255),
			planetas INT(2),
			massa FLOAT,
			constelacao VARCHAR(255)
		)";

if (mysqli_query($conn, $sql)) {
    printf("<p style='color: blue;'>Tabela sistemas criada.<p/>");
} else {
	printf("<p style='color: red;'>Não consigo criar a tabela sistemas.<p/>" . mysqli_error($conn));
    exit();
}
?>