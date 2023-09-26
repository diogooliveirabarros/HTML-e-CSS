<!DOCTYPE html>

<html lang="pt-br">

<head>
    <meta charset="UTF-8"/>
    <title> Título </title>
</head>

<body>
<div>
    <?php
    $msg = "";
    $root = "root";
    $sua_senha = "";
    $nome_banco = "cadastro";

    $conexao = mysqli_connect("localhost","$root","$sua_senha","$nome_banco");
    if (mysqli_connect_errno()) {
        echo "Erro na conexão:".mysqli_connect_error();
    }
    ?>
</div>
</body>

</html>