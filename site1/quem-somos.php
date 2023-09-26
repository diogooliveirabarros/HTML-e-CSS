<!DOCTYPE html>

<html lang="pt-br" xmlns="http://www.w3.org/1999/html">

<head>

    <meta charset="UTF-8"/>
    <link rel="icon" href="_imagens/imagem-externa.png" type="image/png">
    <link rel="stylesheet" href="_css/estilo.css"/>
    <link rel="stylesheet" href="_css/estilo-form.css"/>

    <link rel="stylesheet" href="_css/gallery.css"/>
    <link rel="stylesheet" href="_css/gallery.theme.css"/>
    <link rel="stylesheet" href="_css/normalize.css"/>
    <script src="_javascript/prefixfree.min.js"></script>

    <script language="JavaScript" src="_javascript/funcoes.js"></script>

    <title> D.O.B Divulgações </title>
</head>

<body>
<div id="interface">

    <!-- Imagem que fica no topo e meio fora do site -->

    <div id="imagem-externa">
        <img src="_imagens/imagem-externa.png"/>
    </div>
    <img id="icone" src="_imagens/inicio.png"/>
    <!-- Menu -->
    <!--    movito para /cabecalho.php-->

    <!-- Cabeçalho -->

    <?php include "cabecalho.php"; ?>

    <!-- Barra Lateral Esquerda -->

    <?php include "barra-lateral-esquerda.php"; ?>

    <!-- Painel de Avisos -->

    <?php include "painel-de-avisos.php"; ?>

    <!-- Slide / Tamanho: width-761px height-280 -->

    <?php include "slide.php"; ?>

    <!-- Corpo do site -->

    <section id="corpo">
        <div class="conteudo">
            <h2> Quem Somos </h2>
            <img src="_imagens/quem-somos.jpg" alt="Quem Somos"/>
            <p> (Explicação de cada componente do projeto) </p>
            <p> Este projeto começou em 07/11/2016, com o intuito de facilitar à compra e venda de casas, carros e motos. Um site funcional, projetado com uma interface de fácil interação com os seus usuários. </p>
        </div>
    </section>

    <!-- Barra Lateral Direita -->

    <?php include "barra-lateral-direita.php"; ?>

    <!-- Rodapé -->

    <?php include "rodape.php"; ?>

</div>
</body>

</html>