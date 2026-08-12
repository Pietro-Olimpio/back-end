<?php 
// 1. blindagem de operações entre variáveis de tipos diferentes
declare(strict_types=1);

// Criar um cálculo de Holerite em PHP

// 2. Declaração da Constantes

const TAXA_INSS = 0.08; //8% => 8/100
const DESCONTO_VT = 150.00;

// 3. Declarar as Variáveis
//Dados do Funcionário
$nomeFuncionario = "João Silva";
$salarioBase = 3200.00;
$horasExtras = 10; //10 horas extras no mês

//declaração de variáveis usando o lowerCamelCase
// regra -> primeira palavra toda minúsculo e depois as demais palavras usa-se maiúculas na primeira letra
// exemplo: $hojeEstaUmDiaBonito

// 4. Cálculos do Salário
// Valor da Hora Extra (1.6 da hora normal)
$valorHoraExtra = ($salarioBase/220) * 1.6;
// -> Crie uma variável $totalHorasExtras
$totalHoraExtra = $valorHoraExtra * $horasExtras;
// -> Crie uma variável $salarioBruto
$salarioBruto = $salarioBase + $totalHoraExtra;
// -> Criar a variável $descontoInss
$descontoInss = $salarioBruto * TAXA_INSS;
// -> Criar a variável $salarioLiquido
$salarioLiquido = ($salarioBruto - $descontoInss) - DESCONTO_VT ;

?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Holerite <?php echo $nomeFuncionario ?></title>
    <!-- folha de estilização CSS -->
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h2>Demonstrativo de Pagamento</h2>
    <!-- Saída de Dados Misturando HTML e PHP em uma Tabela-->
    <table>
        <tr>
            <th>Colaborador(a):</th>
            <td><?php echo $nomeFuncionario; ?></td>
        </tr>
        <tr>
            <th>Salário Base:</th>
            <td>R$ <?php echo number_format($salarioBase, 2, ",", "."); ?></td>
            <!-- usando uma função chamada number_format (formata a saída de números) -->
        </tr>
        <!-- fazer as demais linhas da tabela utilizando as variáveis criadas -->
         <tr>
            <th>Horas extras:</th>
            <td><?php echo $horasExtras ?></td>
         </tr>
         <tr>
            <th>Valor da hora extra:</th>
            <td>R$ <?php echo number_format($valorHoraExtra, 2, ",", "."); ?></td>
         </tr>
         <tr>
            <th>Salario bruto:</th>
            <td>R$ <?php echo number_format($salarioBruto, 2, ",", "."); ?></td>
         </tr>
         <tr>
            <th>Desconto INSS:</th>
            <td><?php echo TAXA_INSS ?></td>
         </tr>
         <tr>
            <th>Desconto Vale Trasnporte:</th>
            <td>R$ <?php  echo number_format(DESCONTO_VT, 2, ",", ".") ?></td>
         </tr>
         <tr>
            <th>Salario Liquido:</th>
            <td> R$ <?php  echo number_format($salarioLiquido, 2, ",", ".") ?></td>
         </tr>
    </table>
    
</body>
</html>