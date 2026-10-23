### modularização com funções

#### Principio do DRY ( `Don´t Repeat Yourself`)
Se uma lógica foi escrita duas vezes ou mais dentro de um código, essa lógica deve virar uma função.

#### Funções Nativas do PHP

O PHPH tem milhares de funções prontas, essa funções são chamadas de nativas. 

- **O que é uma Função?**

Uma função é como uma máquina: você coloca uma matéria-prima(Parâmetro), ela processa e devolve um produto final(Retorno)

Exemplo de Função Nativa:

```php 

$texto = "senai americana";

//str_replace(le abusca um pedaço do texto e substitui por outro)
$textoNovo = str_replace("americana","são paulo",$texto);

//strtoupper
echo strtoupper($textoNovo); // SENAI SÃO PAULO
```

##### Principais Funções Nativas ( Mais Utilizadas )

As funções abaixo já fazem parte do PHP e podem ser chamadas diretamente no código. Observe os parâmetros que cada uma recebe e o tipo de informação que ela retorna.

| Função | Categoria | O que faz | Como usar |
|---|---|---|---|
| `strlen()` | Strings | Retorna a quantidade de caracteres de um texto. | `$tamanho = strlen($texto);` |
| `strtoupper()` | Strings | Converte o texto para letras maiúsculas. | `$resultado = strtoupper($texto);` |
| `strtolower()` | Strings | Converte o texto para letras minúsculas. | `$resultado = strtolower($texto);` |
| `ucfirst()` | Strings | Converte a primeira letra do texto para maiúscula. | `$resultado = ucfirst($texto);` |
| `trim()` | Strings | Remove espaços e quebras de linha no início e no fim do texto. | `$limpo = trim($texto);` |
| `str_replace()` | Strings | Substitui uma parte do texto por outra. | `$novo = str_replace("-", "", $cpf);` |
| `substr()` | Strings | Extrai uma parte do texto a partir de uma posição. | `$inicio = substr($texto, 0, 3);` |
| `explode()` | Strings | Divide um texto e cria um array usando um separador. | `$palavras = explode(" ", $nome);` |
| `implode()` | Arrays | Junta os itens de um array em um único texto. | `$lista = implode(", ", $nomes);` |
| `count()` | Arrays | Conta a quantidade de itens de um array. | `$total = count($produtos);` |
| `in_array()` | Arrays | Verifica se um valor existe dentro de um array. | `$existe = in_array("SP", $estados, true);` |
| `array_push()` | Arrays | Adiciona um ou mais itens ao final de um array. | `array_push($nomes, "Ana");` |
| `array_pop()` | Arrays | Remove e retorna o último item de um array. | `$ultimo = array_pop($nomes);` |
| `sort()` | Arrays | Ordena um array em ordem crescente e reorganiza suas chaves. | `sort($notas);` |
| `array_keys()` | Arrays | Retorna um array contendo as chaves de outro array. | `$chaves = array_keys($produtos);` |
| `number_format()` | Números | Formata um número com casas decimais e separadores definidos. | `$preco = number_format($valor, 2, ',', '.');` |
| `round()` | Números | Arredonda um número para a quantidade de casas informada. | `$media = round($nota, 2);` |
| `max()` | Números | Retorna o maior valor de uma lista ou array. | `$maior = max($notas);` |
| `min()` | Números | Retorna o menor valor de uma lista ou array. | `$menor = min($notas);` |
| `is_numeric()` | Validação | Verifica se o valor é um número ou uma string numérica. | `if (is_numeric($entrada)) { ... }` |
| `isset()` | Validação | Verifica se uma variável existe e não possui valor `null`. | `if (isset($usuario)) { ... }` |
| `empty()` | Validação | Verifica se uma variável está vazia. | `if (empty($pedido)) { ... }` |
| `date()` | Data e hora | Formata uma data ou hora conforme uma máscara. | `$hoje = date('d/m/Y');` |
| `file_exists()` | Arquivos | Verifica se um arquivo ou diretório existe. | `if (file_exists('dados.txt')) { ... }` |
| `file_get_contents()` | Arquivos | Lê todo o conteúdo de um arquivo ou endereço. | `$conteudo = file_get_contents('dados.txt');` |
| `file_put_contents()` | Arquivos | Grava conteúdo em um arquivo, criando-o se necessário. | `file_put_contents('log.txt', $mensagem);` |

**Atenção:** algumas funções modificam o array original, como `sort()`, `array_push()` e `array_pop()`. Já outras retornam um novo valor, como `count()`, `explode()` e `str_replace()`. Em caso de dúvida, consulte a documentação oficial do PHP e verifique o retorno da função.

##### Documentação PHP

[Acesse a documentação oficial do PHP em português](https://www.php.net/manual/pt_BR/)

Consulte também a [referência de funções do PHP](https://www.php.net/manual/pt_BR/funcref.php) para pesquisar a sintaxe, os parâmetros eos valores por cada função.

#### Funções Customizadas (Criando suas próprias máquinas)

Quando o PHP não tem a função que queremos, nós a criamos!

**A Regra de Ouro:** Uma função deve focar em `return`(retornar um valor), e não imprimir (`echo`).

Veja a diferença nesse exemplo:
```php

function calcularTotal($preco, $quantidade){
    //a função calcula e rotna o resultado, mas não imprime nada
    return $preco * $quantidade;
}

$total = calcularTotal(25.00, 3);

echo "Total da compra: R$ " . number_format($total, 2, ",", ".");
// Total da compra: R$ 75,00

```
A função `calcularTotal()`pode ser reutilizada em uma página, relatório ou teste.O `echo`aparece somente fora da função, no momento de apresentar o resultado ao usuário

##### Padrão de Uso Corporativo (PHP 8 Strict Types)

No merdado de trabalho, exigimos que a função avise extamente o **TIPO** de dado que ela espera receber e o **TIPO** que ela vai devolver.

Isso é chamado de **tipagem de funções**. Ao declara os tipos, o código fica mais fácil de entender e o PHP consegue identificar alguns erros antes que eles causem problemas maiores no sistema.

Os tipos mais usados:

* `int`: número inteiro, `10` ou `1024`.
* `float`: número decimal ou ponto flutuante, `10.50`.
* `string`: texto, como `"Maria"`
* `bool`: valor lógico, `true` ou `false`.
* `void`: identifica que a função não devolve nenhum valor

O tipo deve ser escrito antes do nome de cada parâmetro e o tipo da função deve ser escrito após os parênteses, precedito po `:`, informando o que a função vai devolver.

Exemplo de uso de função e parâmetros tipados:

```php
function apresentarProduto(string $nome, float $preco): string{
    return "$nome custa R$ $preco";
}

$mensagem = apresentaproduto("Caderno", 25.90);
echo $mensagem;
// Caderno custa R$ 25.90

```

> **Resumo**: os tipos dos parâmetros documetam as entradas da função, o tipo após `:` documeta a saída da função

##### O Tipo Mágico : `void`

Se uma função faz um trabalho interno e **não retrona NADA**, dizemos que o retorno dela é "vazio" (`void`).

Exemplo de função sem retorno:

```php
function registroLog(string $mensagem): void{
    //apenas salvar em um arquivo de texto, não devolver nenhuma variável
    file_put_contents("erro.log",$mensagem);
}
```

#### Escopo e Referência (O segredo da memória)

##### O que é Escopo? (A Regra de Las Vegas)

*O que acontece dentro da função, fica dentro da função*. Uma variável criada fora  nã existe lá dentro, e uma criada lá dentro morre quando a função acaba.

**Escopo** é o local do programa onde a variável pode ser armazenada/acessada. Em PHP, uma variável criada fora de uma função pertende ao **escopo global**. uma variável criada dentro de uma função pertence ao **escopo local**.

```php 
$nomeSistema = "CRM Senai"; //Variável global

function criarMensagem():string{
    $mensagem = "Bem-Vindo!"; //Variável local
    return $mensagem;
}

echo $nomeSistema; //Correto: esta no escopo global
echo criarMensagem(); //Correto: a função devolve sua variável local.
echo $mensagem; // Incorreto: $mensagem só existe dentro da função, não é acessada fora
```

* Como enviar dados para uma função?

A forma mais segura e organizada é enviar os dados por **parâmetros**. Assim, a função não precisa acessar diretamento variáveis globais:

```php
function saudar(string $nome):string{
    return "Olá, $nome!";
}

$nomeCliente = "João";
echo saudar($nomeCliente); // Olá, João!
```

Nesse caso, `$nomeCliente` continua no escopo global, mas seu valor é enviado para o parâmetro local `$nome`. A função recebe uma informação, processa e retorna o resultado.

Exemplo Incorreto:

```php
$nome = "João";
function saudar():string{
    return "Olá, $nome";
}
```
A função `saudar()`não conhece a variável globla `$nome`

> **Resumo:** variáveis protegem os dados internos da função; parâmetros são o caminho recomendado para evitar Erros e enviar Informações, e `return`é usado para devolver um resultado ao código que chamou a função.


---

# Alguns comandos pra funções
## trim($variavel)
ele remove espaços do comeco e do final do codigo