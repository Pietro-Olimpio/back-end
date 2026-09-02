<?php declare(strict_types=1);
//array
$usuario = [
    "nome" => "Carlos Eduardo",
    "idade" => 28,
    "cidade" => "Americana",
    "estado" => "SP",
    "premium" => true
];
//regra de negocio  Se o usuário for premium (true), exiba uma estrela ⭐ ao lado do nome dele. Junte a cidade e o estado para exibir no formato "Americana - SP".
?>

<div class="card">
    <h2>
        <?php
        echo $usuario["nome"];

        if ($usuario["premium"] == true) {
            echo "⭐";
        }
        ?>
    </h2>

    <h2>
    
        <?php echo $usuario["cidade"] . " - " . $usuario["estado"]; ?>
</h2>
