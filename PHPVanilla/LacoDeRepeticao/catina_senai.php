<?php

$produtos = [
    1 => ["nome" => "Coxinha", "preco" => 6.00, "estoque" => 10],
    2 => ["nome" => "Suco", "preco" => 5.00, "estoque" => 8],
    3 => ["nome" => "Sanduíche", "preco" => 12.00, "estoque" => 5],
    4 => ["nome" => "Bolo", "preco" => 7.50, "estoque" => 6]
];

$pedido = [];
$opcao = 0;

do {

    echo "\n==============================\n";
    echo "       CANTINA SENAI\n";
    echo "==============================\n";
    echo "1 - Listar produtos\n";
    echo "2 - Adicionar produto ao pedido\n";
    echo "3 - Exibir resumo do pedido\n";
    echo "4 - Finalizar compra\n";
    echo "0 - Sair sem finalizar\n";
    echo "==============================\n";

    $opcao = (int) readline("Escolha uma opção: ");

    if ($opcao == 1) {

        echo "\n--- PRODUTOS DISPONÍVEIS ---\n";

        foreach ($produtos as $codigo => $produto) {

            echo "Código: " . $codigo . "\n";
            echo "Nome: " . $produto["nome"] . "\n";
            echo "Preço: R$ " . number_format($produto["preco"], 2, ",", ".") . "\n";
            echo "Estoque: " . $produto["estoque"] . "\n";
            echo "----------------------------\n";
        }

    } elseif ($opcao == 2) {

        echo "\n--- ADICIONAR PRODUTO ---\n";

        $codigo = (int) readline("Digite o código do produto: ");

        if (isset($produtos[$codigo])) {

            if ($produtos[$codigo]["estoque"] > 0) {

                echo "Produto escolhido: " . $produtos[$codigo]["nome"] . "\n";

                $quantidade = (int) readline("Digite a quantidade: ");

                if ($quantidade > 0) {

                    if ($quantidade <= $produtos[$codigo]["estoque"]) {

                        $produtos[$codigo]["estoque"] =
                            $produtos[$codigo]["estoque"] - $quantidade;

                        if (isset($pedido[$codigo])) {

                            $pedido[$codigo]["quantidade"] =
                                $pedido[$codigo]["quantidade"] + $quantidade;

                        } else {

                            $pedido[$codigo] = [
                                "nome" => $produtos[$codigo]["nome"],
                                "preco" => $produtos[$codigo]["preco"],
                                "quantidade" => $quantidade
                            ];
                        }

                        echo "Produto adicionado ao pedido!\n";

                    } else {

                        echo "Quantidade maior que o estoque!\n";
                    }

                } else {

                    echo "Quantidade inválida!\n";
                }

            } else {

                echo "Produto sem estoque!\n";
            }

        } else {

            echo "Produto não encontrado!\n";
        }

    } elseif ($opcao == 3) {

        echo "\n--- RESUMO DO PEDIDO ---\n";

        if (empty($pedido)) {

            echo "Nenhum produto foi adicionado.\n";

        } else {

            $total = 0;

            foreach ($pedido as $item) {

                $subtotal = $item["preco"] * $item["quantidade"];

                echo "Produto: " . $item["nome"] . "\n";
                echo "Quantidade: " . $item["quantidade"] . "\n";
                echo "Preço: R$ " .
                    number_format($item["preco"], 2, ",", ".") . "\n";
                echo "Subtotal: R$ " .
                    number_format($subtotal, 2, ",", ".") . "\n";

                echo "----------------------------\n";

                $total = $total + $subtotal;
            }

            echo "Total: R$ " .
                number_format($total, 2, ",", ".") . "\n";
        }

    } elseif ($opcao == 4) {

        if (empty($pedido)) {

            echo "\nVocê não adicionou nenhum produto.\n";

        } else {

            echo "\n--- FINALIZANDO COMPRA ---\n";

            $total = 0;

            foreach ($pedido as $item) {

                $subtotal = $item["preco"] * $item["quantidade"];

                $total = $total + $subtotal;
            }

            echo "Total da compra: R$ " .
                number_format($total, 2, ",", ".") . "\n";

            echo "\nEscolha a forma de pagamento:\n";
            echo "1 - Pix (5% de desconto)\n";
            echo "2 - Cartão (sem desconto)\n";
            echo "3 - Dinheiro (3% de desconto)\n";

            $pagamento = (int) readline("Digite a opção: ");

            if ($pagamento == 1) {

                $desconto = $total * 0.05;
                $totalFinal = $total - $desconto;

                echo "\nPagamento: Pix\n";
                echo "Desconto: R$ " .
                    number_format($desconto, 2, ",", ".") . "\n";
                echo "Total final: R$ " .
                    number_format($totalFinal, 2, ",", ".") . "\n";

                echo "Compra finalizada com sucesso!\n";
                echo "Obrigado por comprar na Cantina SENAI!\n";

                $opcao = 4;

            } elseif ($pagamento == 2) {

                $desconto = 0;
                $totalFinal = $total;

                echo "\nPagamento: Cartão\n";
                echo "Desconto: R$ 0,00\n";
                echo "Total final: R$ " .
                    number_format($totalFinal, 2, ",", ".") . "\n";

                echo "Compra finalizada com sucesso!\n";
                echo "Obrigado por comprar na Cantina SENAI!\n";

                $opcao = 4;

            } elseif ($pagamento == 3) {

                $desconto = $total * 0.03;
                $totalFinal = $total - $desconto;

                echo "\nPagamento: Dinheiro\n";
                echo "Desconto: R$ " .
                    number_format($desconto, 2, ",", ".") . "\n";
                echo "Total final: R$ " .
                    number_format($totalFinal, 2, ",", ".") . "\n";

                echo "Compra finalizada com sucesso!\n";
                echo "Obrigado por comprar na Cantina SENAI!\n";

                $opcao = 4;

            } else {

                echo "Forma de pagamento inválida!\n";
            }
        }

    } elseif ($opcao == 0) {

        echo "\nSaindo do programa...\n";

    } else {

        echo "\nOpção inválida!\n";
    }

} while ($opcao != 0 && $opcao != 4);

echo "\nPrograma encerrado.\n";

?>