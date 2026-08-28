<?php
declare(strict_types=1);

function buscarCliente(array $clientes, string $nome): ?array
{
    foreach ($clientes as $cliente) {
        if ($cliente['nome'] === $nome) {
            return $cliente;
        }
    }

    return null;
}

$clientes = [
    [
        'nome' => 'João',
        'email' => 'joao@email.com'
    ],
    [
        'nome' => 'Maria',
        'email' => 'maria@email.com'
    ],
    [
        'nome' => 'Carlos',
        'email' => 'carlos@email.com'
    ]
];

$resultado = buscarCliente($clientes, 'Maria');

if ($resultado !== null) {
    print_r($resultado);
} else {
    echo "Cliente não encontrado." . "\n";
}


$resultado = buscarCliente($clientes, 'Ana');

if ($resultado !== null) {
    print_r($resultado);
} else {
    echo "Cliente não encontrado." . "\n";
}
?>