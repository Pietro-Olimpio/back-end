<?php
declare(strict_types=1);

function retirarEstoque(array &$produto, int $quantidade): bool
{
    if ($quantidade <= 0 || $quantidade > $produto['estoque']) {
        return false;
    }

    $produto['estoque'] -= $quantidade;
    return true;
}

$produto = [
    'nome' => 'coxinha',
    'estoque' => 10
];

// Retirada permitida
if (retirarEstoque($produto, 3)) {
    echo "Retirada permitida. Estoque atual: {$produto['estoque']}" . "\n";
} else {
    echo "Retirada recusada." . "\n";
}

// Retirada recusada
if (retirarEstoque($produto, 20)) {
    echo "Retirada permitida. Estoque atual: {$produto['estoque']}" . "\n";
} else {
    echo "Retirada recusada. Estoque atual: {$produto['estoque']}" . "\n";
}
?>