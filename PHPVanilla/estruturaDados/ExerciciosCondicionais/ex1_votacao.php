<?php declare(strict_types=1); ?>


<?php
$idade = 16;

// se a idade for menor que 16
if ($idade < 16) {
    echo "Voto Proibido";

//se a iade for entre 16 e 17 ou maior/igual a 70
} elseif (($idade >= 16 && $idade <= 17) || $idade >= 70) {

    echo "Voto Obrigatório";

// se a idade for entre 18 e 69
} else{
    echo "Voto Obrigatório";
}