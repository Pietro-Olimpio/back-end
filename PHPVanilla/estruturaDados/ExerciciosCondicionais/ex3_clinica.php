<?php declare(strict_types=1); ?>

<?php 
// Crie as variáveis $peso (ex: 85.5) e $altura (ex: 1.75).
// Calcule o IMC usando a fórmula: IMC = Peso / (Altura * Altura).
// Use if / elseif / else para exibir a classificação exata:
// Abaixo de 18.5 ➔ "Abaixo do Peso"
// De 18.5 a 24.9 ➔ "Peso Normal"
// De 25.0 a 29.9 ➔ "Sobrepeso"
// De 30.0 a 34.9 ➔ "Obesidade Grau I"
// 35.0 ou mais ➔ "Obesidade Grau II ou III"

$peso = 85.5;
$altura = 1.75;
$IMC = $peso / ($altura * $altura);

if ($peso < 18.5){
    echo "Abaixo do peso";

    //peso normal
} elseif (($IMC >= 18.5 && $IMC <= 24.9 )){
    echo "Peso normal";

    //sobrepeso
}elseif (($IMC >= 25.0 && $IMC <= 29.9)){
    echo "Sobrepeso";

    //obesidade Grau 1"
} elseif (($IMC >= 30.0 && $IMC <= 34.9)){
    echo "Obesidade grau 1";

    //obesidade grau 2 ou 3
}else {
    echo "Obesidade grau 2 ou 3";   
}



?>