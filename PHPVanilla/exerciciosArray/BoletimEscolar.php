<?php declare(strict_types=1);
$notas = [7.5, 8.0, 6.5, 9.0, 5.5];
$soma = 0;

//foreach pra percorrer e coloca valor na soma
foreach ($notas as $mediaNotas) { //adicionando valor a soma, tipo percorrer o array, mudar o nome da variavel, ai a variavel soma vai receber += $mediNotas
    $soma += $mediaNotas;
}
 
$media = $soma / count($notas); //Pra variavel media ela é igual a soma dividio pelo count($notas), ou seja é a soma dividido pela quantidade de valores no array

echo "A média final do aluno é $media";

//aprovado ou n com if
if ($media >= 7) {
    echo '<span style="color: green;">Aprovado</span>';
} else {
    echo '<span style="color: red;">Reprovado</span>';
}


?>