<!DOCTYPE html>

<html lang="pt-br">

<head>
    <meta charset="UTF-8"/>
    <link rel="stylesheet" href="../_css/estilo-form.css"/>
    <title> D.O.B Divulgações </title>
</head>

<body id="carro">
<div id="form-option">
    <h2> Carro </h2>
    <h3> Preencha todos os campos corretamente e com informações verdadeiras! </h3>

    <form method="post" action="">

        <fieldset id="fieldset-maior"> <legend> Dados Pessoais </legend>
            <table>
                <tr>
                    <td> <label for="iNome"> Nome: </label>
                        <input type="text" name="nNome" id="iNome" placeholder="Nome" maxlength="10"/> </td>
                    <td> <label for="iSobrenome"> Sobrenome: </label>
                        <input type="text" name="nSobrenome" id="iSobrenome" placeholder="Sobrenome" maxlength="20"/> </td>
                    <td> <label for="iTelefone"> Telefone para Contato: </label>
                        <input type="text" name="nTelefone" id="iTelefone" placeholder="Ex: 08798199-9999" size="13" maxlength="13"/> </td>
                </tr>
            </table>
        </fieldset>
        <br/>
        <fieldset id="fieldset-maior"> <legend> Dados do Produto </legend>
            <table>
                <tr> <td> <label for="iModelo"> Fabricante/Modelo: </label>
                        <input type="text" name="nModelo" id="iModelo" placeholder="Ex: Fiat Uno" maxlength="30"/> </td>
                    <td> <label for="iQuiRodados"> Quilometros Rodados: </label>
                        <input type="text" name="nQuiRodados" id="iQuiRodados" placeholder="Ex: 14.000" size="9" maxlength="9"/> </td>
                    <td> <label for="iAno"> Ano: </label>
                        <input type="text" name="nAno" id="iAno" placeholder="Ex: 2015" size="4" maxlength="4"/> </td>
                </tr>
                <tr></tr>
                <tr>
                    <td> <label for="iMotor"> Motor: </label>
                        <input type="text" name="nMotor" id="iMotor" placeholder="Ex: 2.0" size="3" maxlength="3"/> </td>
                    <td>
                        <label> Câmbio: </label>
                        <select>
                            <option> Manual </option>
                            <option> Automático </option>
                        </select>
                    </td>
                    <td>
                        <label> Pneus: </label>
                        <select>
                            <option> Seminovos </option>
                            <option> Novos </option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label> Blindagem: </label>
                        <select>
                            <option> Não </option>
                            <option> Sim </option>
                        </select>
                    </td>
                    <td>
                        <label> Combustível: </label>
                        <select>
                            <option> Gasolina </option>
                            <option> Etanol </option>
                            <option> Diesel </option>
                            <option> Flex </option>
                        </select>
                    </td>
                </tr>
            </table>
        </fieldset>

        <fieldset id="fieldset-menor1"> <legend> Características do seu carro </legend>
            <table>
                <tr>
                    <td>
                        <label> Ar-Condicionado: </label>
                        <select>
                            <option> Não </option>
                            <option> Sim </option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label> Trava Automática: </label>
                        <select>
                            <option> Não </option>
                            <option> Sim </option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label> Vidro Elétrico: </label>
                        <select>
                            <option> Não </option>
                            <option> Sim </option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label> Direção Hidraulica: </label>
                        <select>
                            <option> Não </option>
                            <option> Sim </option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label> Air-Bag: </label>
                        <select>
                            <option> Não </option>
                            <option> Sim </option>
                        </select>
                    </td>
                </tr>
            </table>
        </fieldset>

        <fieldset id="fieldset-menor2"> <legend> Observações </legend>
            <p> <label for="cMsg">Mensagem:</label>
                <textarea name="tMsg" id="cMsg" cols="35" rows="5" placeholder="Deixe aqui sua mensagem"></textarea> </p>
        </fieldset>

        <fieldset id="fieldset-maior"> <legend> Quanto custa o seu Carro? </legend>
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
