<?php declare(strict_types=1); ?>

<?php

$siglaEstado = "PL";

$valorFrete = match ($siglaEstado) {
    "SP", "RJ", "MG", "ES" => 35.00,
    "PR", "SC", "RS" => 45.00,
    "BA", "CE", "PE" => 60.00,
    default => 80.00,
}; echo "Para o Estado {$siglaEstado}, o frete é de R$" . number_format($valorFrete, 2, ',', '.');