<!DOCTYPE html>

<html lang="pt-br">

<head>
    <meta charset="utf-8"/>
    <link rel="stylesheet" href="_css/estilo.css"/>

    <script type="text/javascript">

        function valida_numero() {
            var num = document.getElementById('nCpf').value;
            if (isNaN(num)){ // isNaN = is not a number
                alert('CPF tem que ser um numero!');
                return false; // bloqueia submissão/envio ao php
            }

            if
            (num == '00000000000' ||
                    num == '11111111111' ||
                    num == '22222222222' ||
                    num == '33333333333' ||
                    num == '44444444444' ||
                    num == '55555555555' ||
                    num == '66666666666' ||
                    num == '77777777777' ||
                    num == '88888888888' ||
                    num == '99999999999') {
                //alert("cpf invalido");
                alert ("Sequência de CPF inválida!");
                return false;
            }
        }
    </script>

</head>

<body>
<div id="interface">

    <h1> Preencha o Formulário </h1>

    <form method="get" action="funcao.php">
        <fieldset id="principal">
            <legend> Aluno </legend>
            <label for="iNome"> Nome: </label> <input type="text" id="iNome" name="nNome" size="20" maxlength="20" placeholder="Nome Completo"/> <br/>
            <label for="iIdade"> Idade: </label> <input type="number" id="iIdade" name="nIdade"/> <br/>
            <label for="iCpf"> CPF: </label> <input type="number" id="iCpf" name="nCpf"/>
            <br/>
            <input type="submit" value="Enviar"/>
        </fieldset>
    </form>
</div>
</body>

</html>