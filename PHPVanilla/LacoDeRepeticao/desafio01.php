<?php

$cliente = "A";
$divida = 1598.10;

$taxa = match ($cliente) {
    "A" => 0.01,
    "B" => 0.02,
    "C" => 0.03,
    default => 0.05
};
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dívida do Cliente</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 40px; }
        table { border-collapse: collapse; width: 400px; }
        th, td { border: 1px solid #ccc; padding: 8px; text-align: left; }
        th { background: #eee; }
        .isento { background: #fff3cd; }
    </style>
</head>
<body>

    <h1>Dívida do Cliente <?php echo $cliente; ?></h1>
    <p>Dívida inicial: R$ <?php echo number_format($divida, 2, ',', '.'); ?></p>

    <table>
        <tr>
            <th>Mês</th>
            <th>Dívida</th>
        </tr>

        <?php
        for ($mes = 1; $mes <= 12; $mes++) {

            // mês 6 pula o cálculo
            if ($mes == 6) {
                echo "<tr class='isento'>";
                echo "<td>$mes</td>";
                echo "<td>Isenção de juros</td>";
                echo "</tr>";
                continue;
            }

            $jurosDoMes = $divida * $taxa;
            $divida = $divida + $jurosDoMes;

            echo "<tr>";
            echo "<td>$mes</td>";
            echo "<td>R$ " . number_format($divida, 2, ',', '.') . "</td>";
            echo "</tr>";
        }
        ?>
    </table>

</body>
</html>