<!DOCTYPE html>

<html lang="pt-br">

<head>
    <meta charset="UTF-8"/>
    <link rel="stylesheet" href="_css/estilo.css"/>

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

    <!-- Menu -->

    <nav id="menu">
        <ul type="disc">
            <li onmouseover="mudaFoto('_imagens/inicio.png')" onmouseout="mudaFoto('_imagens/planos-de-divulgacoes.png')"> <a href="index.php" target="_self"> Início </a> </li>
            <li onmouseover="mudaFoto('_imagens/quem-somos.png')" onmouseout="mudaFoto('_imagens/planos-de-divulgacoes.png')"> <a href="quem-somos.php"> Quem somos </a> </li>
            <li onmouseover="mudaFoto('_imagens/planos-de-divulgacoes.png')" onmouseout="mudaFoto('_imagens/planos-de-divulgacoes.png')"> <a href="planos-de-divulgacao.php" target="_self"> Planos de Divulgação </a> </li>
            <li onmouseover="mudaFoto('_imagens/fale-conosco.png')" onmouseout="mudaFoto('_imagens/planos-de-divulgacoes.png')"> <a href="fale-conosco.php" target="_self"> Fale Conosco </a> </li>
        </ul>
    </nav>

    <img id="icone" src="_imagens/planos-de-divulgacoes.png"/>

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
            <h2> Planos de Divulgação </h2>
            <img src="_imagens/planos.jpg" alt="Planos de Divulgação"/>
            <h3> Plano Simples: </h3>
            <p> O plano simples custa apenas 30 reais/mês, você terá sua divulgação no painel direito do site, em ANÛNCIOS.</p>
            <h3> Plano Avançado: </h3>
            <p> O plano avançado tem como valor 50 reais/mês, sua divulgação será no painel direito do site em ANÛNCIOS, e também no SLIDE. </p>
        </div>
    </section>

    <!-- Barra Lateral Direita -->

    <?php include "barra-lateral-direita.php"; ?>

    <!-- Rodapé -->

    <?php include "rodape.php"; ?>


</div>
</body>

</html>