# Parte A: Exercícios Teóricos de Fixação

## Definição de CRUD: O que significa o acrônimo CRUD e qual é a correspondência direta de cada uma de suas letras com as instruções SQL no PostgreSQL?
**R:** A definição de CRUD é um acrônimo pra Create, Read, Update e Delete.
- Create: sendo o `INSERT` e o `VALUES`
- Read: è o listar, `SELECT * FROM pecas_industriais ORDER BY id DESC`, lista todos os valores da tabela
- Update: Atualizar os valores, no caso: `UPDATE` e o `SET` 
- Delete: excluir algum valor da tabela, que seria o: `DELETE`

## Anatomia do SQL Injection: Explique com suas próprias palavras como um atacante consegue alterar a lógica de uma consulta quando o código utiliza concatenação de strings com $_GET ou $_POST.
**R:** O SQL Injection acontece quando o sistema pega um valor enviado pelo usuário, como por `$_GET` ou `$_POST`, e coloca diretamente dentro de uma consulta SQL usando concatenação. O problema é que o usuário pode digitar algo que altere a estrutura da consulta. Dessa forma, o banco pode interpretar o que foi digitado como parte do comando SQL, e não apenas como um dado.

## Mecanismo das Prepared Statements: Por que o envio de uma consulta em duas etapas (prepare e depois execute) impede que um texto digitado pelo usuário seja executado como instrução SQL pelo banco?
**R:** O prepare() separa o comando SQL dos dados enviados pelo usuário. Assim, quando o execute() é executado, o texto digitado é tratado como um valor e não como parte do comando SQL, ajudando a evitar SQL Injection.
## Marcadores Nomeados: Qual é a vantagem de utilizar marcadores nomeados como :sku e :preco em vez de pontos de interrogação posicionais (?) em instruções SQL complexas?
**R:** Marcadores como :sku e :preco deixam a consulta mais organizada e fácil de entender, pois mostram qual valor corresponde a cada campo. Com vários ?, é necessário seguir a ordem dos valores, o que pode causar confusão em consultas complexas.
## Diferença entre Bindings: Explique a diferença de comportamento entre os métodos $stmt->bindValue() e $stmt->bindParam().
**R:** O bindValue() vincula o valor da variável naquele momento. Já o bindParam() vincula a própria variável por referência, então o valor dela pode ser alterado antes do execute().
## Tipagem no PDO: Qual é o risco de omitir o tipo de dado (ex: PDO::PARAM_INT) ao vincular uma variável que deveria ser estritamente numérica em uma cláusula LIMIT?
**R:** Se o tipo não for informado corretamente, o PDO pode tratar o valor de maneira diferente da esperada pelo banco. Em um LIMIT, por exemplo, isso pode causar erro ou comportamento inesperado. Por isso, é recomendado usar PDO::PARAM_INT para valores inteiros.
## Padrão DAO: Qual é o benefício do padrão Data Access Object (DAO) em termos de manutenibilidade de software e do princípio de responsabilidade única (SOLID)?
**R:** O DAO separa as operações do banco de dados do restante do sistema. Isso facilita a manutenção, porque cada classe fica responsável por uma função específica, seguindo o princípio da responsabilidade única (SRP) do SOLID.
## Operações de Update: Por que a ausência de uma cláusula WHERE em um comando UPDATE é considerada um incidente gravíssimo em ambientes de produção?
**R:** Sem o WHERE, o comando pode alterar todos os registros da tabela. Em produção, isso pode causar uma alteração ou perda de dados em massa, sendo um incidente muito grave.
## Impacto da LGPD: De acordo com a Lei Geral de Proteção de Dados (LGPD), quais são as penalidades e impactos que uma organização pode sofrer caso ocorra vazamento de dados de clientes por falha de SQL Injection?
**R:** Um vazamento de dados pessoais causado por SQL Injection pode gerar consequências para a organização, como multas, advertências, bloqueio ou eliminação dos dados e publicização da infração. A empresa também pode ter custos para corrigir o problema e pode responder por danos causados aos titulares.