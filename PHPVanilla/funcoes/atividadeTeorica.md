# 1.  Conceito de função: Explique com suas palavras o que é uma função e cite duas vantagens de dividir um programa em funções.
Uma função é uma parte do codigo que faz uma tarefa especifica, podendo utilizar varias vezes no codigo. 
Ela tbm em vez de repetir o mesmo código várias vezes, você cria uma função e so "chama" quando precisar daquela operação. Isso deixa o sistema mais limpo, organizado. Clean code.


## 2. Princípio DRY

Repetir o mesmo código em várias partes do sistema pode causar problemas porque, se for necessário fazer uma alteração, será preciso alterar todos os lugares onde o código aparece. Se esquecer algum, o sistema pode ficar com comportamentos diferentes.

Uma função ajuda porque podemos colocar o código repetido dentro dela e chamar a função sempre que precisarmos realizar aquela tarefa.

## 3. Parâmetros e retorno

Parâmetros são os valores que uma função recebe para realizar sua tarefa. Já o retorno é o resultado que a função devolve depois de executar o código.

```php
function calcularTotal(float $preco, int $quantidade): float {
    return $preco * $quantidade;
}

```

## 4. 
function → indica que ta criando uma função.
cadastrar → nome da função.
string $nome → variavel chamada $nome do tipo string.
int $idade → variavel chamada $idade do tipo int.
: bool → indica que a função deve retornar um valor booleano (true ou false).


## 5
Uma função que retorna string precisa devolver um texto usando return.

```php
function saudacao(): string {
    return "Olá!";
}
```
Já uma função void não retorna um valor. Ela pode apenas executar uma ação.

```php
function mostrarMensagem(): void {
    echo "Olá!";
}
```
A função saudacao() retorna "Olá!", enquanto mostrarMensagem() apenas exibe a mensagem.
Ou seja, uma retorna e a outra mostra.

## 6. ESCOPO
A função não consegue acessar $cliente diretamente porque a variável foi criada fora da função. uma variável criada fora tem um escopo global, enquanto a função tem seu próprio escopo.

Forma 1 — usando global

```php
$cliente = "Mariana";

function exibirCliente(): string {
    global $cliente;
    return $cliente;
}
```

Forma 2 — passando a variável como parâmetro

```php
$cliente = "Mariana";

function exibirCliente(string $cliente): string {
    return $cliente;
}

echo exibirCliente($cliente);
```
A forma mais recomendada é passar a variável como parâmetro, porque deixa a função mais independente e fácil de reutilizar.

## 7. 
Quando usamos:
```php
float &$valor
```
o & faz com que a função receba uma referência à variável original, e não apenas uma cópia dela.

Sem &:
```php
function alterar(float $valor): void {
    $valor = 50;
}
```
Apenas a cópia é alterada, então a variável original continua igual.

Com &:
```php
function alterar(float &$valor): void {
    $valor = 50;
}
```

## 8. 
Funções nativas
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


## 9. Previsão de saída
No codigo fica
```php
function aplicarDesconto(float $preco): float {
    return $preco * 0.90;
}

$valor = 100.00;
echo aplicarDesconto($valor);
echo $valor;
```
Saida:

`90100`

porque 100 × 0.90 = 90, então o primeiro echo exibe 90. Depois, $valor continua sendo 100, pq a função recebeu o valor como uma cópia e não alterou a variável original.
Como não existe espaço ou quebra de linha entre os dois echo, aparece 90100.

## 10. Documentação oficial do PHP — strlen()

A sintaxe é:

strlen(string $string): int
Parâmetro: $string, que deve ser uma string.
Retorno: int, representando a quantidade de bytes da string.
Finalidade: descobrir o tamanho de uma string.

Exemplo:
```php
$texto = "Hello Word";
echo strlen($texto);
```
A função conta o tamanho da string e retorna um número inteiro.