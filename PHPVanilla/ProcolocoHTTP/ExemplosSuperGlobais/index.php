<?php declare(strict_types=1); 
//aplicação de pagina unica utilizando as variaveis superglobais ($_GET, $_POST, $_SERVER)junto com formularios html de metodo GET e POST

//Dados simulados para aplicação

$produtos = [
    ['nome' => 'Teclado USB', 'categoria' => 'Eletrônicos', 'preco' => 80.00],
    ['nome' => 'Mouse sem fio', 'categoria' => 'Eletrônicos', 'preco' => 65.00],
    ['nome' => 'Caderno', 'categoria' => 'Papelaria', 'preco' => 25.00],
    ['nome' => 'Caneta azul', 'categoria' => 'Papelaria', 'preco' => 3.50],
    ['nome' => 'Monitor 24 polegadas', 'categoria' => 'Eletrônicos', 'preco' => 899.90],
];
$cadastros = [
    ["nome" => "Jose", "email" => "jose@email.com"]
];
//Declarar variaveis

$mensagemSucesso = ""; //serve pra apresentar uma mensagem quando um usuario for cadastrado
$erros = [];//array pra armazenar erros caso necessarios e devolver para o usuarios os erros de validação

$nome = ""; //recebera o valor do camo nome para cafastro de usuarios
$email = ""; //recebera o valor do campo email para cafastro de email

//criando o processo de GET => buscar na lista de produtos e retornar um uma lista filtrada
// busca pelo name e atribui valor a superglobal ($_GET) 
$buscaProduto = trim((string) ($_GET["produto"] ?? ""));
//verificação/operador de nulidade de uma variavel (coalescência nula)

$precoMaximoTexto = trim((string) ($_GET["preco_maximo"])); //recebe o valor do input preco_maximo


$produtosFiltrados = $produtos; //copiando a lista de produtos filtrados

//criar o mecanismo de filtragem para produtps
if($buscaProduto !== "" || $precoMaximoTexto !== ""){ // se algum dos inputs for difernte de vazio
    $produtosFiltrado = array_filter($produtos, function (array $produto) use ($buscaProduto,$precoMaximoTexto): bool {
        $nomeStatus = true;
        $precoStatus = true;
        //verificação se no nome do produto contem o termo de busca, se iver retorna true
        if($buscaProduto !== ""){
            $nomeStatus = str_contains(strtolower($produto["nome"]),strtolower($buscaProduto));
        }
    

        // verificar o preco de um produto e filtra se o produto for menor que preco maximo determinado
        if($precoMaximoTexto !== ""){
            $precoMaximo = filter_var($precoMaximoTexto, FILTER_VALIDATE_FLOAT);
            $precoStatus = $precoMaximo !== false && $produto["preco"] <= $precoMaximo;
        }

        return $nomeStatus && $precoStatus;


    });
}

//processamento do metodo POST => permiri o cadastro FAKE de um cliente -> exibir os dados na tela

//verificar o status da superGlobal $_SERVER e prosegue se for um post
if($_SERVER["REQUEST_METHOD"] === "POST") {
    //recuperar os dados do formulario

    $nome = trim((string) ($_POST["nome"] ?? "")); //recebe o valor do nome do input HTML
    $email = trim((string) ($_POST["email"] ?? "")); //recebe o valor do email do input HTML

    //validação de dados ao lado do servidor
    //enviar uma mensagem de erro se a variavel nome for menor que 3 caracteres
    if(strlen($nome)<3){
        $erros["nome"] = "informe um nome com pelomenos 3 caracteres";

    }
    //validar email usuario
    if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
        $erros["email"] = "informe um email valido!!!!";

    };

    //SE não existir erros,  o cadastro sera realizado
    if($erros === []){
        $mensagemSucesso = "Cadastro Realizado com Sucesso!!";
        $usuario = ["nome" => $nome, "email" => $email];
        array_push($cadastros, $usuario);

    }

}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Exemplo de GET e POST no PHP</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <main>
        <h1>Exemplo prático: GET e POST</h1>

        <section>
            <h2>Utilização de filtro pela URL (GET)</h2>

            <form action="index.php" method="GET">
                <label for="produto">Nome do Produto</label>
                <input type="text" name="produto" id="produto" placeholder="Buscar Produto">

                <label for="preco_maximo">Preço Máximo</label>
                <input type="number" name="preco_maximo" id="preco_maximo" step="0.01" placeholder="100">

                <button type="submit">Pesquisar</button>
            </form>

            <h2>Lista de Produtos Filtrados</h2>
            <p>Observem que os dados da pesquisa aparecem na URL</p>

            <?php if ($produtosFiltrados === []): ?>
                <p class="vazio">Nenhum produto encontrado.</p>
            <?php else: ?>
                <table>
                    <thead>
                        <tr>
                            <th>Produto</th>
                            <th>Categoria</th>
                            <th>Preço</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($produtosFiltrados as $produto): ?>
                            <tr>
                                <td><?= $produto['nome'] ?></td>
                                <td><?= $produto['categoria'] ?></td>
                                <td>
                                    R$ <?= number_format($produto['preco'], 2, ',', '.') ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php endif; ?>

        </section>

        <section>
            <h2>Cadastro de Alunos com POST</h2>
            <p>Os dados serão enviados no corpo(body) da requisição e não aparecem na URL</p>

            <?php if($mensagemSucesso !== ""):?>
                <div class="sucesso">
                    <?=  $nome ?><br>
                    <?= $email ?>
                </div>
            <?php endif; ?>

            <form action="index.php" method="POST">
                <label for="nome">Nome</label>
                <input type="text" name="nome" id="nome" placeholder="Digite seu Nome">
                <?php if(isset($erros["nome"])): ?>
                    <div class="erro">
                        <?= $erros["nome"] ?>
                    </div>
                <?php endif; ?>

                <label for="email">Email</label>
                <input type="text" name="email" id="email" placeholder="Digite seu Email">
                <?php if(isset($erros["email"])): ?>
                    <div class="erro">
                        <?= $erros["email"] ?>
                    </div>
                <?php endif; ?>

                <button type="submit">Cadastrar</button>  

            </form>

        </section>
    </main>
    
</body>
</html>