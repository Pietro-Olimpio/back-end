<?php declare(strict_types=1);

$extrato = [
    ["data" => "2026-09-01", "descricao" => "Salário", "tipo" => "Entrada", "valor" => 4000.00],
    ["data" => "2026-09-02", "descricao" => "Supermercado", "tipo" => "Saida", "valor" => 450.50],
    ["data" => "2026-09-05", "descricao" => "Pix João", "tipo" => "Entrada", "valor" => 200.00],
    ["data" => "2026-09-10", "descricao" => "Conta de Luz", "tipo" => "Saida", "valor" => 120.00],
    ["data" => "2026-09-12", "descricao" => "Cinema", "tipo" => "Saida", "valor" => 65.00]
];

// 1. Cálculo dos totais
$totalEntradas = 0;
$totalSaidas = 0;

foreach ($extrato as $transacao) {

    if ($transacao["tipo"] === "Entrada") {
        $totalEntradas += $transacao["valor"];
    }

    if ($transacao["tipo"] === "Saida") {
        $totalSaidas += $transacao["valor"];
    }
}

$saldoAtual = $totalEntradas - $totalSaidas;


// 2. Filtro de gastos altos
$gastosAltos = array_filter($extrato, function ($transacao) {
    return $transacao["tipo"] === "Saida" && $transacao["valor"] > 100;
});


// Regra da cor do saldo
$corSaldo = $saldoAtual < 0 ? "red" : "green";

?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <title>Extrato Bancário</title>

</head>

<body>

    <h1>Extrato Bancário</h1>

    <!-- card -->
    <div class="cards">

        <div class="card">
            <h2>Entradas</h2>
            <p class="valor">
                R$ <?= number_format($totalEntradas, 2, ',', '.') ?>
            </p>
        </div>

        <div class="card">
            <h2>Saídas</h2>
            <p class="valor">
                R$ <?= number_format($totalSaidas, 2, ',', '.') ?>
            </p>
        </div>

        <div class="card">
            <h2>Saldo Atual</h2>
            <p class="valor" style="color: <?= $corSaldo ?>;">
                R$ <?= number_format($saldoAtual, 2, ',', '.') ?>
            </p>
        </div>

    </div>


    <!-- Tabelinha -->
    <h2>Transações</h2>

    <table>
        <tr>
            <th>Data</th>
            <th>Descrição</th>
            <th>Tipo</th>
            <th>Valor</th>
        </tr>

        <?php foreach ($extrato as $transacao): ?>

            <tr>
                <td><?= $transacao["data"] ?></td>

                <td><?= $transacao["descricao"] ?></td>

                <td>
                    <?php if ($transacao["tipo"] === "Entrada"): ?>
                        <span class="entrada">Entrada</span>
                    <?php else: ?>
                        <span class="saida">Saída</span>
                    <?php endif; ?>
                </td>

                <td>
                    R$ <?= number_format($transacao["valor"], 2, ',', '.') ?>
                </td>
            </tr>

        <?php endforeach; ?>

    </table>


    <!-- Gastos altos -->
    <div class="gastos-altos">

        <h2>Gastos Altos do Mês</h2>

        <table>

            <tr>
                <th>Data</th>
                <th>Descrição</th>
                <th>Valor</th>
            </tr>

            <?php foreach ($gastosAltos as $gasto): ?>

                <tr>
                    <td><?= $gasto["data"] ?></td>
                    <td><?= $gasto["descricao"] ?></td>
                    <td class="saida">
                        R$ <?= number_format($gasto["valor"], 2, ',', '.') ?>
                    </td>
                </tr>

            <?php endforeach; ?>

        </table>

    </div>

</body>

</html>