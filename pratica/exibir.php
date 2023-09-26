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

    $select = "SELECT nome, idade, cpf FROM usuario;";
    if (mysqli_query($conexao,$select)) {
        die(mysqli_error($conexao));
    }
    ?>
</div>
</body>

</html>
