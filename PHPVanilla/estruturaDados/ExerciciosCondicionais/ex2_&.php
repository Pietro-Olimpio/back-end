<?php declare(strict_types=1); ?>

<?php 
$valorCompra = 25.5;

$satusFrete = ($valorCompra >=250.00) ? " Frete gratis" : "Frete R$ 25,00";
echo ($satusFrete);


?>

