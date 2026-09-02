<?php declare(strict_types=1);
$carrinho = [
    ["produto" => "Notebook", "preco" => 4000.00],
    ["produto" => "Mouse", "preco" => 150.00],
    ["produto" => "Teclado", "preco" => 300.00]
];

$carrinhoBlackFriday = array_map(fn($item) => $item["preco"] = $item["preco"]*0.80, $carrinho);

print_r($carrinhoBlackFriday)


?>