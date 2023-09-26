<!DOCTYPE html>

<html lang="pt-br">

<head>
    <meta charset="UTF-8"/>
    <link rel="stylesheet" href="_css/estilo.css"/>

    <link rel="stylesheet" href="_css/gallery.css"/>
    <link rel="stylesheet" href="_css/gallery.theme.css"/>
    <link rel="stylesheet" href="_css/normalize.css"/>
    <link rel="stylesheet" href="_css/formulario.css"/>
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
            <li onmouseover="mudaFoto('_imagens/inicio.png')" onmouseout="mudaFoto('_imagens/fale-conosco.png')"> <a href="index.php" target="_self"> Início </a> </li>
            <li onmouseover="mudaFoto('_imagens/quem-somos.png')" onmouseout="mudaFoto('_imagens/fale-conosco.png')"> <a href="quem-somos.php"> Quem somos </a> </li>
            <li onmouseover="mudaFoto('_imagens/planos-de-divulgacoes.png')" onmouseout="mudaFoto('_imagens/fale-conosco.png')"> <a href="planos-de-divulgacao.php" target="_self"> Planos de Divulgação </a> </li>
            <li onmouseover="mudaFoto('_imagens/fale-conosco.png')" onmouseout="mudaFoto('_imagens/fale-conosco.png')"> <a href="fale-conosco.php" target="_self"> Fale Conosco </a> </li>
        </ul>
    </nav>

    <img id="icone" src="_imagens/fale-conosco.png"/>

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
            <h2> Fale Conosco </h2>
            <img src="_imagens/contato.jpg"/>

            <form method="post" id="contato" action="mailto:dob@suporte.com.br">
                <fieldset id="usuario"> <legend>Identificação do Usuário</legend>
                    <p> <label for="cNome"> Nome: </label>
                    <input type="text" name="tNome" id="cNome" size="20" maxlength="30" placeholder="Nome Completo"/> </p>

                    <p> <label for="cEmail">E-mail:</label>
                        <input type="email" name="tEmail" id="cEmail" size="20" maxlength="40" placeholder="E-mail"/> </p>

                    <fieldset id="mensagem"> <legend>Mensagem do Usuário</legend>
                        <p> <label for="cMsg">Mensagem:</label>
                            <textarea name="tMsg" id="cMsg" cols="35" rows="5" placeholder="Deixe aqui sua mensagem"></textarea> </p>
                    </fieldset>
                    <br/>
                    <input type="submit" value="Enviar"/>
                </fieldset>
            </form>
        </div>
    </section>

    <!-- Barra Lateral Direita -->

    <?php include "barra-lateral-direita.php"; ?>

    <!-- Rodapé -->

    <?php include "rodape.php"; ?>

</div>
</body>

</html>