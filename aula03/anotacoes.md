# Formato de escrita em php
O formato de escrita em php é da seguinte maneira:
```php
<?php 
    // utilização de Tag <?php "Aqui Vai o Código PHP" >
    // para imprimir algo usamos o código "echo"
    echo "Hello, World!!!"
    // Sera Exibido um parágrafo com o texto acima
    
    ?>
```
Sempre fechar as linhas de comando PHP com ";" => para o PHP entender que o comando foi finalziado

> Ou seja a principal formatação de escrita em php é a utilização de Tagm `<?php "aqui vai o codigo php" >`

Para iprimir algo usa o `echo`

### Comentario em php
Um comentario em php é em tanto "//" ou "#". `comentarios são muito importantes no seu codigo tanto para vc entender melhor quanto alguem qando pega seu codigo entender oque vc fez nele`

---

# Sintaxe de variaveis em PHP
- **Variaveis:** O valor pode mudar durante a execução do script. em PHP **todas** as variaveis começão co o simbulo de dolar(`$`)

EX:
```php
//Variaveis (Usa o padrão camelCase para nomes)
$nomeFuncionario = "Pietro Correa"; // uma variavel tipo string

$idade = 16; //variavel tipo number
```

---

- **Constante** O valor **nunca** muda. Ideal para taxas de imposto. URL, etc. Uma outra forma de utilziar a const é com o define. **NÃO** se é possivel redeclarar uma constante

EX:
```php
 
    // Constantes são representadas pela palavra "const" ou "define" seguida do nome da constante
    //Exemplos de constantes
    const PI = 3.14; //Constante do tipo Number (float)
    const EMPRESA = "Google"; //Constante do tipo String
    define("SITE", "www.google.com"); //Constante do tipo String
    const SITE = "www.googel.com.br"; //isso é um erro

//exibir as constantes na tela
echo "Valor de PI: PI <br>";
echo "Nome da empresa: EMPRESA <br>";
echo "Site: SITE <br>";

```

---

- **Variaveis tipo Boolean** é a quela variavel de true or false

EX:
```php
//Boolean é true or false sem aspas
$status = true; // variavel tipo booleam
```

---

- **Variavel tipo number (float)** quando um numero é quebrado, `numero com "," mas na hora de digitala é com "."`

EX:
```php
//float é quando um numero tem ","
$altura = 1.75; // variavel tipo number (float)
```

---

- **Variavel tipo null** é a quela variavel que n tem valor

EX:
```php
//null é quando vai buscar e não retorna nada, uma variavel nula
$email = null; //variavel tipo null
```

---

- **Variavel vazia** é quando n coloca nada, tipo com tipo number deixa 
0, ja com string coloca as aspas sem nada, ou seja deixe vazio

---


- **Variavel Undefined** `no php` não é possivel declarar uma variavel sem atribuir um valor para ela

EX:
```php
#$endereco; não é possivel declarar uma variavel sem atriuir um valor a ela, não existe Undefined em PHP
```

## Exibir variaveis na tela
exibir com php é usando o print

```php
    echo "Nome: $nome <br>";
    echo "Idade: $idade <br>";
    echo "Status: $status <br>";
    echo "Altura: $altura <br>";
    echo "Email: $email <br>";
```

**Regra de ouro:** sempre coloque a instrução `declare(string_types=1):` na **primeira linha** do seu codigo PHP. isso blida o seu sistema contra mistura de acidentais de tipo.
por exemplo quando vai somar 2 + 2 e retorna 22.

### TEXTOS E COMPARAÇÕES AVANÇADAS
Aspas Simples vs. Aspas Duplas
- **Aspas simples('  ')** é texto puro. Se quiser juntar variaveis use o ponto (**.**) para **concatenar**
- **Aspas Duplas(" ")** Permite **interpolação**, ou seja o PHP le as variaveis direto de dentro do texto

```php
$nome = "Carlos";

//concatenação (Aspas Simples)
echo 'Ola, ' . $nome . '! Bem-vindo.';

//concatenação (Aspas Duplas) -mais limpo (clean code)
echo "Ola, $nome ! Bem-vindo.";
```