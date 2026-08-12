<?php 
declare(strict_types=1);

//Motor de Análise de Créditos

// Regras do Negócio:
// Regra da Idade: O cliente precisa ter 18 anos ou mais e menos de 70 anos 
// Regra da Parcela (renda): O valor da parcela do empréstimo NÃO pode ser maior que 30% da renda mensal do cliente
// Regra VIP: Se o cliente tiver um "Score de Crédito" maior que 800, ele tem aprovação automática. ( as Regra de Idade e Renda não importam)
// Aprovação Final: O Crédito é liberado se (Regra1 e Regra2 forem Verdadeira) OU Se (Regra 3 for Verdadeira).

//1. Dados que vieram fo aplicativo do celular do Cliente
$idadeCliente = 25;
$rendaMEnsal = 4000.00;
$valorEmprestimo = 10000.00;
$numeroParcelas = 24;
$scoreCredito = 750; //pontuação vai de 0 a 1000

//2. Cálculos Aritméticos
$taxaJuros = 0.02; //Juros de 2º ao mês
$valorJurosTotal = $valorEmprestimo * $taxaJuros *$numeroParcelas; //Juros Simples
$valorTotalPagar = $valorEmprestimo + $valorJurosTotal;
$valorParcela = $valorTotalPagar / $numeroParcelas;

//3. O Cérebro da Operação: Avaliação das Regras do Negócio

//Regra 1: Maior Igual a 18 e Menor que 70
$idadeValida = ($idadeCliente>=18) && ($idadeCliente<70);

//Regra 2: Parcela não pode ser maior que 30% da renda (renda*0.30)
$limiteRenda = $rendaMEnsal * 0.30;
$rendaSuficiente = $valorParcela <= $limiteRenda;

//Regra 3: ClienteVIP (Score > 800)
$isClienteVip = $scoreCredito > 800;

//Aprovação Final = idade e renda Verdadeiras ou é clienteVIP
$aprovado = ($idadeCliente && $rendaSuficiente) || $isClienteVip;


?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Analise de creditos</title>
</head>
<body>
    <h2>Análise de creditos</h2>
    <hr>
    <?php echo "<h4> Valor da Parcela: R$ ".number_format($valorParcela,2,",","."). "</h4"; ?>
    <h4>Idade Válida: <?php echo ($idadeValida ? "sim" : "não") ?></h4>
    <h4>Renda suficiente: <?php echo ($rendaSuficiente ? "sim" : "não") ?></h4>
    <h4>Cliente vip: <?php echo ($isClienteVip ? "sim" : "não") ?></h4>
    <h4>Resultado Final: <?php echo ($aprovado ? "sim" : "não") ?></h4>
</body>
</html>