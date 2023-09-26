<!DOCTYPE html>

<html lang="pt-br">

<head>
    <meta charset="UTF-8"/>

    <link rel="stylesheet" href="_css/estilo.css"/>
</head>

<body>
<div class="gallery autoplay items-3">
    <figure class="item">
        <a href="http://www.uol.com.br" target="_blank"> <img src="_imagens/slide01.png" alt="Imagem 1"/> </a>
    </figure>
    <figure class="item">
        <a href="http://www.uol.com.br" target="_blank"> <img src="_imagens/slide02.png" alt="Imagem 1"/> </a>
        </figure>
    <figure class="item">
        <a href="http://www.uol.com.br" target="_blank"> <img src="_imagens/slide03.png" alt="Imagem 1"/> </a>
        </figure>
</div>

<script>
    var myIndex = 0;
    carousel();

    function carousel() {
        var i;
        var x = document.getElementsByClassName("mySlides");
        for (i = 0; i < x.length; i++) {
            x[i].style.display = "none";
        }
        myIndex++;
        if (myIndex > x.length) {myIndex = 1}
        x[myIndex-1].style.display = "block";
        setTimeout(carousel, 2000); // Change image every 2 seconds
    }
</script>
<!--<div class="gallery autoplay items-3">-->
<!--    <div id="item-1" class="control-operator"></div>-->
<!--    <div id="item-2" class="control-operator"></div>-->
<!--    <div id="item-3" class="control-operator"></div>-->
<!---->
<!--    <figure class="item">-->
<!--        <a href="http://www.uol.com.br" target="_blank"> <img src="_imagens/slide01.png" alt="Imagem 1"/> </a>-->
<!--    </figure>-->
<!---->
<!--    <figure class="item">-->
<!--        <a href="http://www.uol.com.br" target="_blank"> <img src="_imagens/slide02.png" alt="Imagem 1"/> </a>-->
<!--    </figure>-->
<!---->
<!--    <figure class="item">-->
<!--        <a href="http://www.uol.com.br" target="_blank"> <img src="_imagens/slide03.png" alt="Imagem 1"/> </a>-->
<!--    </figure>-->
<!---->
<!--    <div class="controls">-->
<!--        <a href="#item-1" class="control-button">•</a>-->
<!--        <a href="#item-2" class="control-button">•</a>-->
<!--        <a href="#item-3" class="control-button">•</a>-->
<!--    </div>-->
<!--</div>-->
</body>

</html>