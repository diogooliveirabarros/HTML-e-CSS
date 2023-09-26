<!DOCTYPE html>

<html lang="pt-br">

<head>
    <meta charset="UTF-8"/>
    <title> Título </title>
</head>

<body>
<div>
    <?php

    $servidor= "localhost";
    $usuario = "root";
    $senha   = "";
    $banco = "banco";
    $conexao = mysql_connect($servidor, $usuario, $senha, $banco);
    $conecta = mysql_select_db($banco);

    if (!$conecta) {
        echo "Não foi possível se conectar ao banco!";
    } //else {
    //echo "Conectado com sucesso ao banco <strong>$banco!</strong>";
    //}
    ?>

</div>
</body>

</html>
