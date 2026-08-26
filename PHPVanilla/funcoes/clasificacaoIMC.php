<?php
declare(strict_types=1);

function classificarIMC(float $imc): string {
    if ($imc < 18.5) {
        return "Abaixo do peso";

    } elseif ($imc == 18.5 || $imc == 24.9) {
        return "Peso normal";

    } elseif ($imc == 25.0 || $imc == 29.9) {
        return "Sobrepeso";

    } else {
        return "Obesidade";

    }
}

?>