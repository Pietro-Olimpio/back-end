<?php 
declare(strict_types=1);
?>

<?php 
$valorBase = 40.00;
$diaSemana = "Quarta";
$isEstudante = true;


$valorBase = match($diaSemana) {
    "Segunda", "Terça" => $valorBase*0.8,
    "Quarta" => $valorBase*0.5,
    default => $valorBase
};

$descontoDia = $valorBase;

if($isEstudante === true) {
    $descontoDia = $descontoDia*0.5;
} 

$valorFinal = $descontoDia;

echo "O valor final do ingresso ficou em R$ ". number_format($valorFinal,2,".");

?>