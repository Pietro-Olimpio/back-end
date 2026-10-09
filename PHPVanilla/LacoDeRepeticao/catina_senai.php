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


     //match

    $acao = match ($opcao) {
        1 => "listar",
        2 => "adicionar",
        3 => "resumo",
        4 => "finalizar",
        0 => "sair",
        default => "invalida"
    };

    //invalida a opção
    if ($acao == "invalida") {

        echo "\nOpção inválida!\n";

        continue;
    }

   //listar produtos
    if ($acao == "listar") {

        echo "\n--- PRODUTOS DISPONÍVEIS ---\n";

        foreach ($produtos as $codigo => $produto) {

            echo "Código: " . $codigo . "\n";
            echo "Nome: " . $produto["nome"] . "\n";
            echo "Preço: R$ " .
                number_format($produto["preco"], 2, ",", ".") . "\n";
            echo "Estoque: " . $produto["estoque"] . "\n";
            echo "----------------------------\n";
        }
    }

    //add produto
    elseif ($acao == "adicionar") {

        echo "\n--- ADICIONAR PRODUTO ---\n";

        $codigo = (int) readline("Digite o código do produto: ");

       //ve se existe o produto
        if (!isset($produtos[$codigo])) {

            echo "Produto não encontrado!\n";

            continue;
        }

        //verifica se tem no estoque
        if ($produtos[$codigo]["estoque"] <= 0) {

            echo "Produto sem estoque!\n";

            continue;
        }

        echo "Produto escolhido: " .
            $produtos[$codigo]["nome"] . "\n";

        //while pra validar quantidade
        $quantidade = (int) readline("Digite a quantidade: ");

        while (
            $quantidade <= 0 ||
            $quantidade > $produtos[$codigo]["estoque"]
        ) {

            if ($quantidade <= 0) {

                echo "Quantidade inválida!\n";

            } elseif ($quantidade > $produtos[$codigo]["estoque"]) {

                echo "Quantidade maior que o estoque disponível!\n";
            }

            $quantidade = (int) readline(
                "Digite uma quantidade válida: "
            );
        }

        //diminui estoque
        $produtos[$codigo]["estoque"] =
            $produtos[$codigo]["estoque"] - $quantidade;

        //add pedido
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
    }

    //resumo do pedido
    elseif ($acao == "resumo") {

        echo "\n--- RESUMO DO PEDIDO ---\n";

        if (empty($pedido)) {

            echo "Nenhum produto foi adicionado.\n";

        } else {

           //foreach pra cada item
            foreach ($pedido as $item) {

                $subtotal =
                    $item["preco"] * $item["quantidade"];

                echo "Produto: " . $item["nome"] . "\n";
                echo "Quantidade: " . $item["quantidade"] . "\n";
                echo "Preço unitário: R$ " .
                    number_format($item["preco"], 2, ",", ".") . "\n";
                echo "Subtotal: R$ " .
                    number_format($subtotal, 2, ",", ".") . "\n";

                echo "----------------------------\n";
            }

           //for pra quantidade
            $itens = array_values($pedido);
            $total = 0;

            for ($i = 0; $i < count($itens); $i++) {

                $subtotal =
                    $itens[$i]["preco"] *
                    $itens[$i]["quantidade"];

                $total = $total + $subtotal;
            }

            echo "Total: R$ " .
                number_format($total, 2, ",", ".") . "\n";
        }
    }

  //finalzia a compra
    elseif ($acao == "finalizar") {

        if (empty($pedido)) {

            echo "\nVocê não adicionou nenhum produto.\n";

            continue;
        }

        echo "\n--- FINALIZANDO COMPRA ---\n";

        //for pra calcula o total
        $itens = array_values($pedido);
        $total = 0;

        for ($i = 0; $i < count($itens); $i++) {

            $subtotal =
                $itens[$i]["preco"] *
                $itens[$i]["quantidade"];

            $total = $total + $subtotal;
        }

        echo "Total da compra: R$ " .
            number_format($total, 2, ",", ".") . "\n";

        echo "\nEscolha a forma de pagamento:\n";
        echo "1 - Pix (5% de desconto)\n";
        echo "2 - Cartão (sem desconto)\n";
        echo "3 - Dinheiro (3% de desconto)\n";

        $pagamento = (int) readline("Digite a opção: ");

       //match pra pagamento
        $formaPagamento = match ($pagamento) {
            1 => "Pix",
            2 => "Cartão",
            3 => "Dinheiro",
            default => "inválido"
        };

        //invalido
        if ($formaPagamento == "inválido") {

            echo "Forma de pagamento inválida!\n";

            continue;
        }

        //desconto
        if ($pagamento == 1) {

            $desconto = $total * 0.05;

        } elseif ($pagamento == 2) {

            $desconto = 0;

        } else {

            $desconto = $total * 0.03;
        }

        $totalFinal = $total - $desconto;

        echo "\nPagamento: " . $formaPagamento . "\n";
        echo "Desconto: R$ " .
            number_format($desconto, 2, ",", ".") . "\n";
        echo "Total final: R$ " .
            number_format($totalFinal, 2, ",", ".") . "\n";

        echo "\nCompra finalizada com sucesso!\n";
        echo "Obrigado por comprar na Cantina SENAI!\n";

        break;
    }

  //sair 
    elseif ($acao == "sair") {

        echo "\nSaindo do programa...\n";

        break;
    }

} while (true);

echo "\nPrograma encerrado.\n";

?>
