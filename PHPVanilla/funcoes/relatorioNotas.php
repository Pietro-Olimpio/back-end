<?php declare(strict_types=1); 
// Exercício 7: Relatório de Notas
// Crie as funções calcularMedia(array $notas): float e verificarAprovacao(float $media): string. Use count() para calcular a média e if / else para retornar Aprovado quando a média for maior ou igual a 7, ou Reprovado caso contrário. Mostre também a maior e a menor nota usando max() e min().
 function calcularMedia(array $notas): float {
    return array_sum($notas) / count($notas);
 }



?>