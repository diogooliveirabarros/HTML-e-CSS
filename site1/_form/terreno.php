<!DOCTYPE html>

<html lang="pt-br">

<head>
    <meta charset="UTF-8"/>
    <link rel="stylesheet" href="../_css/estilo-form.css"/>
    <title> D.O.B Divulgações </title>

    <script>
        function calc_total() {
            var larg = parseInt(document.getElementById('iLargura').value);
            var compri = parseInt(document.getElementById('iComprimento').value);

            tot = larg * compri;
            document.getElementById('iArea').value = tot;
        }
    </script>
</head>

<body id="terreno">
<div id="form-option">
    <h2> Terreno </h2>
    <h3> Preencha todos os campos corretamente e com informações verdadeiras! </h3>

    <form method="post" action="" oninput="calc_total();">

        <fieldset id="fieldset-maior"> <legend> Dados Pessoais </legend>
            <table>
                <tr>
                    <td> <label for="iNome"> Nome: </label>
                        <input type="text" name="nNome" id="iNome" placeholder="Nome" maxlength="10"/> </td>
                    <td> <label for="iSobrenome"> Sobrenome: </label>
                        <input type="text" name="nSobrenome" id="iSobrenome" placeholder="Sobrenome" maxlength="20"/> </td>
                    <td> <label for="iTelefone"> Telefone para Contato: </label>
                        <input type="number" name="nTelefone" id="iTelefone" placeholder="Ex: (087) 9 9999-9999"/> </td>
                </tr>
            </table>
        </fieldset>
        <br/>
        <fieldset id="fieldset-maior"> <legend> Dados do Produto </legend>
            <table>
                <tr> <td> <label for="iEndereco"> Endereço: </label>
                        <input type="text" name="nEndereco" id="iEndereco" placeholder="Endereço" maxlength="40"/> </td>
                    <td> <label for="iComplemento"> Complemento: </label>
                        <input type="text" name="nComplemento" id="iComplemento" placeholder="" maxlength="30"/> </td>
                </tr>
            </table>
            <br/>
            <table>
                <tr> <td> <label for="iBairro"> Bairro: </label>
                        <input type="text" name="nBairro" id="iBairro" placeholder="Bairro" maxlength="30"/> </td>
                </tr>
            </table>
        </fieldset>

        <fieldset id="fieldset-menor1"> <legend> Medidas do Terreno </legend>
            <table>
                <tr>
                    <td> <label for="iComprimento"> Comprimento: </label>
                        <input type="number" name="nComprimento" id="iComprimento" placeholder="" min="0" max="3"/> </td>
                    <td> <label for="iLargura"> Largura: </label>
                        <input type="number" name="nLargura" id="iLargura" placeholder="" min="0" max="3"/> </td>
                </tr>
            </table
            <br/>
            <table>
                <tr> <!-- Área Total -->
                    <td> <label for="iComprimento"> Área Total: </label>
                        <input type="number" name="nArea" id="iArea" placeholder="" min="0" max="10"/> m² </td>
                </tr>
            </table>
        </fieldset>

        <fieldset id="fieldset-menor2"> <legend> Observações </legend>
            <p> <label for="cMsg">Mensagem:</label>
                <textarea name="tMsg" id="cMsg" cols="35" rows="5" placeholder="Deixe aqui sua mensagem"></textarea> </p>
        </fieldset>

        <fieldset id="fieldset-maior"> <legend> Quanto custa seu terreno? </legend>
            <label for="iValor"> Valor total de venda (R$): </label>
            <input type="number" name="nValor" id="iValor" placeholder="Ex: 25.500"/>
        </fieldset>

        <fieldset> <legend> Envie as fotos </legend>
            <form method="post" action="upload-page.php" enctype="multipart/form-data">
                <input name="filesToUpload[]" id="filesToUpload" type="file" multiple="3" />
            </form>
        </fieldset>
    </form>
    <a href="../index.php"> <img src="../_imagens/voltar.png"/> </a>
</div>
</body>

</html>
