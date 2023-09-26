<!DOCTYPE html>

<html lang="pt-br">

<head>
    <meta charset="UTF-8"/>
    <link href="_css/estilo.css"/>
    <title> Tabela </title>
</head>

<body>

<!-- Contagem de 1 até 10
$x=1;
while ($x <= 10) {
    echo "$x ";
    $x++;    /* Se for de 2 em 2 será assim $x += 2; */
}
-->

<!-- Contagem de 10 até 1
$x=10;
while ($x >= 1) {
    echo "$x ";
    $x--;
}
-->

<!--
 for ($i = 1; $i <= 10; $i++) {
            echo "$i ";
        }
-->

    <?php
    $arrayNome = array(
        1 => "Diogo",
        2 => "Mayara",
        3 => "Diego",
    );
    $arrayIdade = array(
        1 => "22",
        2 => "19",
        3 => "28",
    );
    $arrayCpf = array (
        1 => "10953083438",
        2 => "45468782780",
        3 => "06221276538",
    );

    echo "<table border='1' align='center' width='600'> <tr> <td bgcolor='yellow' width='73' align='center'> Nome </td> <td bgcolor='aqua' width='74' align='center'> Idade </td> <td bgcolor='yellow' width='76' align='center'> Cpf </td> </tr> </table>";

    for ($i = 1; $i <= 3; $i++) {
        echo "<table border='1' align='center' width='600'>
<tr>
<td bgcolor='yellow' width='80' align='center'> $arrayNome[$i] </td>
<td bgcolor='aqua' width='80' align='center'> $arrayIdade[$i] </td>
<td bgcolor='yellow' width='80' align='center'> $arrayCpf[$i] </td>
</tr>

</table>";
    }

    ?>

</body>

</html>