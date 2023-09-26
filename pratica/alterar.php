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

    $sql = "UPDATE usuario SET nome='Diogo Oliveira',idade ='22' WHERE cpf = '10953083438' ";
    if (mysqli_query($conexao,$sql)) {
        die(mysqli_error($conexao));
    }
    ?>
</div>
</body>

</html>
