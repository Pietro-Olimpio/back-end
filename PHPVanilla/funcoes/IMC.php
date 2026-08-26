<?php
declare(strict_types=1);

function calcularIMC (float $peso, float $altura): float{
    return $calculoIMC = $peso / ($altura * $altura);
}

$imc = calcularIMC(89.87, 1.91);
echo "Seu IMC é " . number_format($imc, 2, ',', '.');

?>