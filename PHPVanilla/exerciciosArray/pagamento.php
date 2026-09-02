<?php declare(strict_types=1);

$funcionarios = [
    ["id" => 1, "nome" => "Ana Souza", "cargo" => "Dev Front-End", "salario" => 4500.00],
    ["id" => 2, "nome" => "Bruno Costa", "cargo" => "Dev Back-End", "salario" => 5200.00],
    ["id" => 3, "nome" => "Carla Dias", "cargo" => "Tech Lead", "salario" => 8900.00],
    ["id" => 4, "nome" => "Daniel Silva", "cargo" => "Estagiário", "salario" => 1500.00],
];

$totalFolha = 0;

echo "<table border='1'>";
echo "<tr>";
echo "<th>ID</th>";
echo "<th>Nome</th>";
echo "<th>Cargo</th>";
echo "<th>Salário</th>";
echo "</tr>";
//foreach pra percorrer o array de funcionarios
foreach ($funcionarios as $funcionario) {

//criação da tabela 
    echo "<tr>";
    echo "<td>" . $funcionario["id"] . "</td>"; 
    echo "<td>" . $funcionario["nome"] . "</td>"; 
    echo "<td>" . $funcionario["cargo"] . "</td>"; 
    echo "<td>R$ " . number_format($funcionario["salario"], 2, ",", ".") . "</td>"; //formatar a moeda pra normal
    echo "</tr>";
//soma o salario do array e jogra pra totalfolha
    $totalFolha += $funcionario["salario"];
}
//fecha a tabela
echo "</table>";
//printa o total gasto
echo "<h3>Total do gasto da empresa foi di: R$ " . number_format($totalFolha, 2, ",", ".") . "</h3>";
?>

