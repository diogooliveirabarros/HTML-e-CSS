<!DOCTYPE html>

<html lang="pt-br">

<head>
    <meta charset="UTF-8"/>
    <title> Aula 02 -POO </title>
</head>

<body>
<div>
    <?php
    require_once 'Caneta.php';
    $c1 = new Caneta;
    $c1->modelo = "BIC cristal";
    $c1->cor = "Azul";
    //$c1->ponta = 0.5;
    //$c1->carga = 99;
    //$c1->tampada = true;
    $c1->tampar();
    $c1->destampar();
    var_dump($c1);
    $c1->rabiscar();
    ?>
</div>
</body>

</html>
