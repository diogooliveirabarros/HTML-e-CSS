<!DOCTYPE html>

<html lang="pt-br">

<head>
    <meta charset="UTF-8"/>
    <title> Título </title>
</head>

<body>
<div>
    <?php
    include "conexao.php";

    $nome = $_GET['nNome'];
    $idade = $_GET['nIdade'];
    $cpf = $_GET['nCpf'];

    $inserir = "INSERT INTO usuario(nome,idade,cpf)VALUES('$nome','$idade','$cpf')";
    if (mysqli_query($conexao,$inserir)) {
        die(mysqli_error($conexao));
    }

    /* mysqli_close($conexao); */
    ?>
</div>
</body>

</html>
