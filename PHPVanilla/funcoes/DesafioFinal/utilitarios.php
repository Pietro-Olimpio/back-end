<?php
// utilitarios.php
declare(strict_types=1);

/**
 * 1. Formata um número para moeda Brasileira
 */
function formatarMoeda(float $valor): string { //=> valor de Entrada 10345.9
    return "R$ " . number_format($valor, 2, ',', '.'); // "R$ 10.345,90" ==> valor de Saida
}

/**
 * 2. Remove pontos e traços (Deixa só os números)
 */
function limparDocumento(string $docSujeira): string { // "13.478-098" / 123.456.789-00
    return str_replace(['.', '-'], '', $docSujeira);// "13478098" / "12345678900"
}

/**
 * 3. Aplica desconto na variável original usando Referência (&)
 */
function aplicarDesconto(float &$preco, float $porcentagem): void {// 100 - 10%
    $desconto = $preco * ($porcentagem / 100); //10
    $preco -= $desconto; //100-10 => 90
}

// ==========================================
// SUA MISSÃO COMEÇA AQUI:
// Crie uma função chamada gerarIniciais()
// Ela deve receber uma $string (ex: "Diogo Barbosa")
// E retornar uma $string com a primeira letra de cada palavra (ex: "DB")
// DICA: Pesquise no Google como usar explode(), substr() e strtoupper() no PHP!
// ==========================================

function gerarIniciais(string $nomeCompleto): string {
    // Escreva sua lógica aqui!
    // Entradada da Função => "Maria Eduarda Pereira" => Saída: MEP
    $palavras = explode(" ",$nomeCompleto); // => ["Maria", "Eduarada", "Pereira"]

    $iniciais = ""; // => M + E + P
    //Percorrer o Vetor -> item por item e Pegar a Letra Inicial de Cada Item
    foreach($palavras as $palavra){
        //para cada palavra
        if($palavra !== ""){
            $letra = substr($palavra, 0, 1);
            //concaternar a $iniciais
            $iniciais .= $letra;
        }
    }

    //retornar o resultado
    return strtoupper($iniciais); // converte as iniciais para UpperCase 
}

