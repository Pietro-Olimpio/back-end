<?php
declare(strict_types=1);

$produtos = [
    ['nome' => 'Teclado USB', 'categoria' => 'Eletrônicos', 'preco' => 80.00],
    ['nome' => 'Mouse sem fio', 'categoria' => 'Eletrônicos', 'preco' => 65.00],
    ['nome' => 'Caderno', 'categoria' => 'Papelaria', 'preco' => 25.00],
    ['nome' => 'Caneta azul', 'categoria' => 'Papelaria', 'preco' => 3.50],
    ['nome' => 'Monitor 24 polegadas', 'categoria' => 'Eletrônicos', 'preco' => 899.90],
    ['nome' => '3ds', 'categoria' => 'VideoGame', 'preco' => 1000.00]
];


$buscaProduto = trim((string) ($_GET["produto"] ?? ""));
$precoMaximoTexto = trim((string) ($_GET["preco_maximo"] ?? ""));

$produtosFiltrado = $produtos;

if ($buscaProduto !== "" || $precoMaximoTexto !== "") {

    $produtosFiltrado = array_filter(
        $produtos,
        function (array $produto) use (
            $buscaProduto,
            $precoMaximoTexto,
        ): bool {

            $nomeStatus = true;
            $precoStatus = true;

            // Filtro pelo nome
            if ($buscaProduto !== "") {
                $nomeStatus = str_contains(
                    strtolower($produto["nome"]),
                    strtolower($buscaProduto)
                );
            }

            // Filtro pelo preço máximo
            if ($precoMaximoTexto !== "") {
                $precoMaximo = filter_var(
                    $precoMaximoTexto,
                    FILTER_VALIDATE_FLOAT
                );

                $precoStatus =
                    $precoMaximo !== false &&
                    $produto["preco"] <= $precoMaximo;
            }

            return $nomeStatus && $precoStatus;
        }
    );
};
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ex01</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <main>
        <h1>ex01</h1>

        <section>
            <h2>Utilização de filtro pela URL (GET)</h2>

            <form method="GET">
                <label for="produto">Nome do Produto</label>
                <input type="text" name="produto" id="produto" placeholder="Buscar Produto">

                <label for="preco_maximo">Preço Máximo</label>
                <input type="number" name="preco_maximo" id="preco_maximo" step="0.01" placeholder="100">

                <button type="submit">Pesquisar</button>
            </form>

            <h2>Lista de Produtos Filtrados</h2>

            <?php if ($produtosFiltrado === []): ?>
                <p class="vazio">Nenhum produto encontrado.</p>
            <?php else: ?>
                <table>
                    <thead>
                        <tr>
                            <th>Produto</th>
                            <th>Preço</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($produtosFiltrado as $produto): ?>
                            <tr>
                                <td><?= $produto['nome'] ?></td>
                                <td><?= $produto['categoria'] ?></td>
                                <td>
                                    R$ <?= number_format($produto['preco'], 2, ',', '.') ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php endif; ?>

        </section>
    </main>
    
</body>
</html>