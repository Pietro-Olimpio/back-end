<?php declare(strict_types=1); ?>

<?php 
$valorCompra = 500;

$statusFrete  = ($valorCompra >=250.00) ? " Frete gratis" : "Frete R$ 25,00";
echo $statusFrete;


?>

