#### As SuperGlobais

As Variáveis SuperGlobais são arrays intrnos pré-definidos que estão sempre acessíveis em qualquer parte do script php, sem precisar declarar. 
- **$_GET**: Armazena dados passados pela URL via parêmetros de consulta(query string);
- **$_POST**: Recolhe dados enviados por formulários usando método HTTP POST.
- **$_SERVER**: Contém informações sobre o servidor, ambiente e caminhos de script

**Porque usar `??` para obter dados da SuperGlobal**?

Usamos o Operador de Nulidade (Coalescência Nula) para verificar se o valor da variável não é `null`, se caso for `null` atribuimos um outro valor para evitar erros no script.

**Exemplo de Uso**:

Na primeira vez que uma página é aberta, o formulário ainda não foi enviado. Portanto, a achave pode não existir no array.

```PHP
$nome = $_POST["nome"]; 
// escrevendo desta forma, o código pode gerar um aviso de erro. 

// a forma mais correta de escrita é 
$nome = $_POST["nome"] ?? "";
//Se $_POST["nome"] não existir, use uma string vazia. 
```

>obs: use htmlspecialchars() ao exibir valor em HTML => converte caracteres especiais em entidades correspondentes em HTML, evitando que o código seja interpretado erradamente pelo navegador. É usado principalmente na segurança web para evitar ataques Cross-Site-Scripting(XSS)

#### Validação de Dados no BACKEnd é Obrigatória.

Muitos desenvolvedores iniciantes acreditam que colocar atributos `required`, `type=email`ou `min=0`na <tag> do HTML é suficiente para proteger o sistema. **Isso é uma ilusão!**. Sempre fazer as validações de dados no código BackEnd


##### Funções Nativas Essenciais para Limpeza e Validação de Dados

A validação no Back-End deve acontecer sempre antes do processamento de qualquer dado recebido pelo usuário. Abaixo está uma tabela resumida das funções nativas do PHP usadas com frequência para limpar, verificar e validar entradas de formulário.

| Função | Descrição | Quando usar | Exemplo simples |
| :--- | :--- | :--- | :--- |
| `trim($valor)` | Remove espaços no início e no fim da string | Limpar texto digitado pelo usuário | `$nome = trim($_POST['nome'] ?? '');` |
| `htmlspecialchars($valor, ENT_QUOTES, 'UTF-8')` | Converte caracteres especiais em entidades HTML seguras | Exibir dados na tela sem risco de XSS | `echo htmlspecialchars($_POST['nome'] ?? '', ENT_QUOTES, 'UTF-8');` |
| `filter_var($valor, FILTER_VALIDATE_EMAIL)` | Valida formato de e-mail | Campos de e-mail | `filter_var($email, FILTER_VALIDATE_EMAIL)` |
| `filter_var($valor, FILTER_VALIDATE_INT)` | Verifica se o valor é inteiro válido | Idade, código, quantidade | `filter_var($_POST['idade'] ?? '', FILTER_VALIDATE_INT)` |
| `filter_var($valor, FILTER_VALIDATE_FLOAT)` | Verifica se o valor é número decimal válido | Preço, peso, altura, salário | `filter_var($_POST['preco'] ?? '', FILTER_VALIDATE_FLOAT)` |
| `isset($variavel)` | Verifica se uma variável existe e não é `null` | Garantir que o campo foi enviado | `if (isset($_POST['nome'])) { ... }` |
| `empty($valor)` | Verifica se o valor está vazio | Campos obrigatórios | `if (empty($_POST['senha'])) { ... }` |
| `strlen($valor)` | Retorna o tamanho da string | Exigir mínimo ou máximo de caracteres | `if (strlen($senha) < 6) { ... }` |
| `in_array($valor, $lista, true)` | Verifica se o valor pertence a uma lista permitida | `select`, `radio`, opções válidas | `in_array($categoria, ['A','B','C'], true)` |
| `is_numeric($valor)` | Confirma se o valor é numérico | Validação de número | `if (is_numeric($_POST['quantidade'])) { ... }` |
| `preg_match($padrao, $valor)` | Valida por expressão regular | CPF, CEP, telefone, senha forte | `preg_match('/^\d{5}-\d{3}$/', $cep)` |
| `filter_input(INPUT_POST, 'campo', FILTER_SANITIZE_SPECIAL_CHARS)` | Captura e limpa dados da requisição | Ler entradas com segurança | `$nome = filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_SPECIAL_CHARS);` |

#### PPreservação de Estado em Formulários (*Sticky Form*)

A técnica do **Sticky Form** consiste em imprimir de volta no atributo "value" do input os dados que o usuário acaba de digitar caso ocorra um erro de validação de dados. 

**Exemplo de Uso:**

```php
<div class="campo">
    <label for="nome">Nome Completo</label>
    <input type="text" id="nome" name="nome" 
        value="<?= htmlspecialchars($dadosFormulario["nome"] ?? "") ?>
        class="<?= isset($erro["nome"]) ? "input-erro" : "" ?>">
    <?php if (isset($erro["nome"])): ?>
        <span class="erro-texto"><?= $erro["nome"] ?></span>
    <?php endif; ?>
</div>
```