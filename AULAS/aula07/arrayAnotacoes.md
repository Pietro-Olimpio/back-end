# array e manpulação avançada de dados

Um array(tambem conhecido como vetor) é uma estrutura de dado usadas para armazenar varios valores em uma unica variavel.

**tipos de array**
- Indexados/ordenado(numerica): usam numeros inteiros como indices que começao com 0 pr padrão
- associativos/nãoOdenados(string): sam chaves tipo string para identificar valores;
- multidimensionais: conte um ou mais arrays dentro de outro array.

**exemplos de array:**

```php
//array indexadp
$frutas = ['maça','banana','laraja'];

//array associativo
$captais = [
    "SP" => "São Paulo",
    "RJ" => "Rio de Janeiro",
    "MG" => "Belo Horizonte",
    "ES" => "Vitória",
];

//acessando os dados dos array

echo $frutas[1]; //banan
echo $captais["MG"] //belo horizonte
```
> OBS: Em arrays associativos, nos trocamos os nº do indice por nomes(chaves/keys). Na declaração do vetor usamos setinha(=>) que siginifica "recebe"

#### array multidmensionais (banco de dados na memoria)

aqui que o "backEnd" começa de verdade. o array mulidimensional é o formato como os bancos de dados e apis respondem as solicitações feitas pelo Back.

**Exemplo de array multidimensional:**
```php
$cliente = [
    ["id" =>1, "nome" => "ana", "email" =>, "ana@email.com", "ativo" => true],
    ["id" =>2, "nome" => "bruno", "email" =>, "bruno@email.com", "ativo" => false],
    ["id" =>3, "nome" => "diogo", "email" =>, "Diogo@email.com", "ativo" => true],
];
//como acessar o email do diogo
echo $cliente[2["email"]]// Diogo@email.com

```
#### Melhor amigo do array: `o Foreach`

O laço de repetição especial para arrays. O `foreach` percorre cada elementos de um array

**Exemplo de Aplicação:**

```php
foreach($clientes as $clienteAtual){
    echo $clienteAtual["nome"];
    echo $clienteAtual["email"];
};
//vai imprimir o nome e email de todos os clientes do array
```

#### transformação de arrays e  arrow function `.(FN)`

Tranforação de arrays são usadas para modificar ou filtrar informações de um aray existente

- `array_filter`
serve para buscar dados em um aray e devolver apenas os dados que passarem pelo filtro
```php
$clientesAtivos = array_filter($clientes, fn($c) => $c["ativo"]===true);
//novo array, tera apenas os clientes qe a chave ativo for igual a true
```

- `array_map`
serve para alterar todos os dados de um array de uma unica vez

```php
$produtos = [
    ["id"=>1,"preco"=10.00,"setor"=>"jardim"],
    ["id"=>2,"preco"=17.80,"setor"=>"ferramenta"],
    ["id"=>3,"preco"=25.40,"setor"=>"jardim"],
]
//ajustar o preço dos produtos de todos os produtos em 10% de aumento

$produtosAjustados = array_map(fn($p) => $p["preco"] = $p["preco"]*1.1, $produtos);


```

> Obs: para a função de filtragem, primeiro selecionamos a array e depois criamos a função de filtro. Para a função de mapeamento, primeiro criamos a função de transformação e depois aplicamos no array.

#### Debugando um Array (Kit de PRimeiros Socorros)

- `print_r`
função usada para exibir informações sobre um array de forma legível em liguagem natural

```php
echo print_r($frutas);
//array
(
    [0] => "maça",
    [1] => "banana",
    [2] => "laranja"
)
```

- `var_dump`
Exibi com mais detalhes as informações de um array ou variável em PHP

```php
echo var_dump($frutas);
//mostrar tudo: tipo de dado, o tamanho e o valor da variavel.

```