<?php

$cliente = "A";
$divida = 1598.10;
//match das caegorias
$taxa = match ($cliente) {
    "A" => 0.01,
    "B" => 0.02,
    "C" => 0.03,
    default => 0.05
};

for ($mes = 1; $mes <= 12; $mes++) { 
//mes 6 te q pula
    if ($mes == 6) {
        echo "\nMês 6: Isenção de juros\n";
        continue;
    }
//calculo dos mes
    $jurosDoMes = $divida * $taxa;
    $divida = $divida + $jurosDoMes;

    echo "\nMês $mes: Sua Divida de R$ " . number_format($divida, 2, ',', '.');
}
?>

