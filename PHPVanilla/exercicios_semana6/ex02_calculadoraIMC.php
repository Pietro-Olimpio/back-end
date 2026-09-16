<?php
declare(strict_types=1);

$erros = [];
$mensagemSucesso = "";

$nome = "";
$peso = "";
$altura = "";

$imc = null;
$classificacao = "";
$classeIMC = "";

function calcularIMC(float $peso, float $altura): float
{
    return $peso / ($altura ** 2);
}

function classificarIMC(float $imc): string
{
    if ($imc < 18.5) {
        return "Abaixo do peso";
    }

    if ($imc < 25) {
        return "Normal";
    }

    if ($imc < 30) {
        return "Sobrepeso";
    }

    return "Obesidade";
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $nome = trim((string) ($_POST["nome"] ?? ""));
    $pesoTexto = trim((string) ($_POST["peso"] ?? ""));
    $alturaTexto = trim((string) ($_POST["altura"] ?? ""));

    // Validação do nome
    if ($nome === "") {
        $erros["nome"] = "Informe o nome.";
    }

    // Validação do peso
    $peso = filter_var($pesoTexto, FILTER_VALIDATE_FLOAT);

    if ($peso === false) {
        $erros["peso"] = "Informe um peso válido.";
        $peso = "";
    } elseif ($peso < 20 || $peso > 300) {
        $erros["peso"] = "O peso deve estar entre 20 e 300 kg.";
    }

    // Validação da altura
    $altura = filter_var($alturaTexto, FILTER_VALIDATE_FLOAT);

    if ($altura === false) {
        $erros["altura"] = "Informe uma altura válida.";
        $altura = "";
    } elseif ($altura < 0.5 || $altura > 2.5) {
        $erros["altura"] = "A altura deve estar entre 0,5 e 2,5 metros.";
    }

    // Se n ter erros, calcula o IMC
    if ($erros === []) {

        $imc = calcularIMC((float) $peso, (float) $altura);

        $classificacao = classificarIMC($imc);

        if ($imc < 25) {
            $classeIMC = "normal";
        } elseif ($imc < 30) {
            $classeIMC = "sobrepeso";
        } else {
            $classeIMC = "obesidade";
        }

        $mensagemSucesso = "Cálculo realizado com sucesso!";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Cálculo de IMC</title>
    <style>.resultado {
    padding: 15px;
    margin-top: 20px;
    border-radius: 8px;
}

.normal {
    background-color: #d4edda;
    color: #155724;
}

.sobrepeso {
    background-color: #fff3cd;
    color: #856404;
}

.obesidade {
    background-color: #f8d7da;
    color: #721c24;
}

.erro {
    color: #dc3545;
    margin: 5px 0 10px;
}

.sucesso {
    color: #155724;
    margin-top: 15px;
}
</style>
</head>

<body>

<main>

    <h1>Cálculo de IMC</h1>

    <section>

        <h2>Cadastro</h2>

        <form action="index.php" method="POST">

            <label for="nome">Nome</label>

            <input
                type="text"
                name="nome"
                id="nome"
                placeholder="Digite seu nome"
                value="<?= htmlspecialchars($nome) ?>"
            >

            <?php if (isset($erros["nome"])): ?>
                <div class="erro">
                    <?= htmlspecialchars($erros["nome"]) ?>
                </div>
            <?php endif; ?>


            <label for="peso">Peso (kg)</label>

            <input
                type="number"
                name="peso"
                id="peso"
                step="0.01"
                min="20"
                max="300"
                placeholder="Ex: 80"
                value="<?= htmlspecialchars((string) $peso) ?>"
            >

            <?php if (isset($erros["peso"])): ?>
                <div class="erro">
                    <?= htmlspecialchars($erros["peso"]) ?>
                </div>
            <?php endif; ?>


            <label for="altura">Altura (m)</label>

            <input
                type="number"
                name="altura"
                id="altura"
                step="0.01"
                min="0.5"
                max="2.5"
                placeholder="Ex: 1.80"
                value="<?= htmlspecialchars((string) $altura) ?>"
            >

            <?php if (isset($erros["altura"])): ?>
                <div class="erro">
                    <?= htmlspecialchars($erros["altura"]) ?>
                </div>
            <?php endif; ?>


            <button type="submit">
                Calcular IMC
            </button>

        </form>


        <?php if ($mensagemSucesso !== ""): ?>

            <div class="sucesso">
                <?= htmlspecialchars($mensagemSucesso) ?>
            </div>

        <?php endif; ?>


        <?php if ($imc !== null): ?>

            <div class="resultado <?= $classeIMC ?>">

                <h2>Resultado</h2>

                <p>
                    Nome:
                    <?= htmlspecialchars($nome) ?>
                </p>

                <p>
                    IMC:
                    <?= number_format($imc, 2, ',', '.') ?>
                </p>

                <p>
                    Classificação:
                    <?= htmlspecialchars($classificacao) ?>
                </p>

            </div>

        <?php endif; ?>

    </section>

</main>

</body>
</html>