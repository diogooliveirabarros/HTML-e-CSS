<html>
<head>

    <title>...</title>

    <script type="text/javascript">

        function selecionaForm(opcao){

            var valor = document.getElementById('selectNivel').options[opcao].id;

            switch(valor){
                // Iniciante em PHP
                //case'iniciante': document.getElementById('form').innerHTML = '<?php echo"<form>Formulário Iniciante</form>"; //include('iniciante.php'); ?>';

                //Iniciante em Javascript
                case'iniciante': document.getElementById('form').innerHTML = '<form method="get">Iniciante<br>Nome<input type="editbox" name="nome"><input type="submit" value="Enviar"></form>';
                    break;


                case'intermediario': document.getElementById('form').innerHTML = '<?php echo"<form>Formulário Intermediário</form>"; //include('iniciante.php');?>';
                    break;
                case'avancado': document.getElementById('form').innerHTML = '<?php echo"<form>Formulário Avançado</form>"; //include('iniciante.php');?>';
                    break;

            }

        }

    </script>

</head>
<body>

<select id="selectNivel" onchange="javascript:selecionaForm(this.selectedIndex)">

    <option></option>
    <option id='iniciante'>Iniciante</option>
    <option id='intermediario'>Intermediário</option>
    <option id='avancado'>Avançado</option>

</select>

<div id='form'>
</div>

</body>
</html>

