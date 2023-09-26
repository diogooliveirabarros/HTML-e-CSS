<!DOCTYPE html>

<html lang="pt-br" xmlns="http://www.w3.org/1999/html">

<head>
    <meta charset="UTF-8"/>
    <link rel="stylesheet" href="../_css/estilo-form.css"/>
    <title> D.O.B Divulgações </title>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
</head>

<body id="moto">
<div id="form-option">
    <h2> Moto </h2>
    <h3> Preencha todos os campos corretamente e com informações verdadeiras! </h3>
    <fieldset id="fieldset-maior"> <legend> Dados Pessoais </legend>
        <table>
            <tr>
                <td> <label for="iNome"> Nome: </label>
                    <input type="text" name="nNome" id="iNome" placeholder="Nome" maxlength="20"/> </td>
                <td> <label for="iSobrenome"> Sobrenome: </label>
                    <input type="text" name="nSobrenome" id="iSobrenome" placeholder="Sobrenome" maxlength="20"/> </td>
                <td> <label for="iTelefone"> Telefone para Contato: </label>
                    <input type="number" name="nTelefone" id="iTelefone" placeholder="Ex: 08798199-9999"/> </td>
            </tr>
        </table>
    </fieldset>


    <br/>
    <form method="post" action="" oninput="">


            <fieldset id="fieldset-maior"> <legend> Dados do Produto </legend>
                <label class="form__label" for="vehicle_brand">Marca</label>
                <select name="nMarca" id="iMarca"  onchange="if (this.options.selectedIndex == 0) { this.form.iModelo.disabled = 'disabled'; }else {this.form.iModelo.disabled = '';}" >
                    <option >Escolher</option>
                    <option disabled="disabled">---------------</option>
                    <option value="20">ADLY</option>
                    <option value="38">AGRALE</option>
                    <option value="14">AMAZONAS</option>
                    <option value="17">APRILIA</option>
                    <option value="32">ATALA</option>
                    <option value="36">BAJAJ</option>
                    <option value="69">Benelli</option>
                    <option value="66">BETA</option>
                    <option value="42">BIMOTA</option>
                    <option value="53">BMW</option>
                    <option value="51">BRANDY</option>
                    <option value="76">BRAVA</option>
                    <option value="77">BRP</option>
                    <option value="2">BUELL</option>
                    <option value="59">BUENO</option>
                    <option value="73">byCristo</option>
                    <option value="34">CAGIVA</option>
                    <option value="63">CALOI</option>
                    <option value="13">DAELIM</option>
                    <option value="23">DAFRA</option>
                    <option value="46">DAYANG</option>
                    <option value="47">DAYUN</option>
                    <option value="19">DERBI</option>
                    <option value="1">DUCATI</option>
                    <option value="62">EMME</option>
                    <option value="5">FOX</option>
                    <option value="55">FYM</option>
                    <option value="57">GARINNI</option>
                    <option value="50">GAS GAS</option>
                    <option value="48">GREEN</option>
                    <option value="58">HAOBAO</option>
                    <option value="28">HARLEY-DAVIDSON</option>
                    <option value="61">HARTFORD</option>
                    <option value="16">HERO</option
                    ><option value="15">HONDA</option>
                    <option value="54">HUSABERG</option>
                    <option value="40">HUSQVARNA</option>
                    <option value="82">INDIAN</option>
                    <option value="8">IROS</option>
                    <option value="60">JIAPENG VOLCANO</option>
                    <option value="24">JOHNNYPAG</option>
                    <option value="18">JONNY</option>
                    <option value="4">KAHENA</option>
                    <option value="41">KASINSKI</option>
                    <option value="21">KAWASAKI</option>
                    <option value="44">KIMCO</option>
                    <option value="3">KTM</option>
                    <option value="11">L'AQUILA</option>
                    <option value="64">LANDUM</option>
                    <option value="67">LAVRALE</option>
                    <option value="56">LERIVO</option>
                    <option value="35">LIFAN</option>
                    <option value="43">Lon-V</option>
                    <option value="65">MAGRÃO TRICICLOS</option>
                    <option value="37">Malaguti</option>
                    <option value="49">MIZA</option>
                    <option value="33">MOTO GUZZI</option>
                    <option value="81">MOTOCAR</option>
                    <option value="80">MOTORINO</option>
                    <option value="6">MRX</option>
                    <option value="30">MV AGUSTA</option>
                    <option value="26">MVK</option>
                    <option value="22">ORCA</option>
                    <option value="29">PEGASSI</option>
                    <option value="31">PEUGEOT</option>
                    <option value="25">PIAGGIO</option>
                    <option value="27">REGAL RAPTOR</option>
                    <option value="79">RIGUETE</option>
                    <option value="78">Royal Enfield</option>
                    <option value="52">SANYANG</option>
                    <option value="75">SHINERAY</option>
                    <option value="68">SIAMOTO</option>
                    <option value="12">SUNDOWN</option>
                    <option value="9">SUZUKI</option>
                    <option value="70">TARGOS</option>
                    <option value="72">TIGER</option>
                    <option value="39">TRAXX</option>
                    <option value="10">TRIUMPH</option>
                    <option value="71">VENTO</option>
                    <option value="74">WUYANG</option>
                    <option value="7">YAMAHA</option>
                    <option disabled="disabled">---------------</option>
                    <option value="">Outros</option>
                </select>
                 <label for="iModelo"> Modelo: </label>
                    <input type="text" name="nModelo" id="iModelo" placeholder="Ex: MTT Turbine Superbike Y2K" onchange="if($('#iModelo').val()!= ''){$('#iAno').attr('disabled', '')}else{$('#iAno').attr('disabled', ''disabled')}" />
               <script> </script>

                <label for="ano">Ano</label>
                <select name="nAno" id="iAno" aria-required="true"  onchange="if (this.options.selectedIndex == 0) { this.form.iCilindrada.disabled = 'disabled'; }else {this.form.iCilindrada.disabled = '';}">
                    <option value="">Escolher</option>
                    <option value="2017">2017</option>
                    <option value="2016">2016</option>
                    <option value="2015">2015</option>
                    <option value="2014">2014</option>
                    <option value="2013">2013</option>
                    <option value="2012">2012</option>
                    <option value="2011">2011</option>
                    <option value="2010">2010</option>
                    <option value="2009">2009</option>
                    <option value="2008">2008</option>
                    <option value="2007">2007</option>
                    <option value="2006">2006</option>
                    <option value="2005">2005</option>
                    <option value="2004">2004</option>
                    <option value="2003">2003</option>
                    <option value="2002">2002</option>
                    <option value="2001">2001</option>
                    <option value="2000">2000</option>
                    <option value="1999">1999</option>
                    <option value="1998">1998</option>
                    <option value="1997">1997</option>
                    <option value="1996">1996</option>
                    <option value="1995">1995</option>
                    <option value="1994">1994</option>
                    <option value="1993">1993</option>
                    <option value="1992">1992</option>
                    <option value="1991">1991</option>
                    <option value="1990">1990</option>
                    <option value="1989">1989</option>
                    <option value="1988">1988</option>
                    <option value="1987">1987</option>
                    <option value="1986">1986</option>
                    <option value="1985">1985</option>
                    <option value="1985">1980</option>
                    <option value="1985">1985</option>
                    <option value="1985">1985</option>
                    <option value="1950">1950 ou anterior</option>
                </select>
                <label for="iCilindrada">Cilindrada:</label>
                <select name="nCilindrada" id="iCilindrada" aria-required="true" disabled="disabled">
                    <option value="">Escolher</option>
                    <option value="1">50</option>
                    <option value="22">100</option>
                    <option value="2">125</option>
                    <option value="7">150</option>
                    <option value="8">200</option>
                    <option value="3">250</option>
                    <option value="9">300</option>
                    <option value="10">350</option>
                    <option value="11">400</option>
                    <option value="12">450</option>
                    <option value="4">500</option>
                    <option value="13">550</option>
                    <option value="14">600</option>
                    <option value="15">650</option>
                    <option value="16">700</option>
                    <option value="5">750</option>
                    <option value="17">800</option>
                    <option value="18">850</option>
                    <option value="19">900</option>
                    <option value="20">950</option>
                    <option value="6">1000</option>
                    <option value="21">Acima de 1.000</option>
                 </select>
                <label for="iKm">Quilometragem:</label>
                <input type="text" name="nKm" id="iKm" placeholder="Ex: 0 Km" />


    </fieldset>
    <fieldset id="fieldset-menor2"> <legend> Observações </legend>
        <p> <label for="cMsg">Mensagem:</label>
            <textarea name="tMsg" id="cMsg" cols="35" rows="5" placeholder="Deixe aqui sua mensagem"></textarea> </p>
    </fieldset>
        <br>

    <fieldset id="fieldset-maior"> <legend> Quanto custa a sua moto? </legend>
        <label for="iValor"> Valor total de venda (R$): </label>
        <input type="number" name="nValor" id="iValor" placeholder="Ex: 25.500"/>
    </fieldset>
        <br>
    <fieldset> <legend> Envie as fotos </legend>
        <form method="post" action="upload-page.php" enctype="multipart/form-data">
            <input name="filesToUpload[]" id="filesToUpload" type="file" multiple="3" />
        </form>
    </fieldset>
    </form>
</div>
</body>


</html>
