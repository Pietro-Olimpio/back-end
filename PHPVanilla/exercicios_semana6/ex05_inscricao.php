<?php
declare(strict_types=1);

$erros = [];

$nomeCandidato = "";
$idade = "";
$cursoDesejado = "";
$aceiteTermos = false;

$cursosPermitidos = [
    "Desenvolvimento de Sistemas",
    "Mecatrônica",
    "Redes"
];

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $nomeCandidato = trim(
        (string) ($_POST["nome_candidato"] ?? "")
    );

    $idadeTexto = (int) ($_POST["idade"] ?? "");

    $cursoDesejado = trim(
        (string) ($_POST["curso_desejado"] ?? "")
    );

    $aceiteTermos = isset($_POST["aceite_termos"]);


    // Validação do nome
    if (strlen($nomeCandidato) < 5) {
        $erros["nome_candidato"] =
            "O nome deve ter pelo menos 5 caracteres.";
    }


    // Validação da idade
    $idade = filter_var(
        $idadeTexto,
        FILTER_VALIDATE_INT
    );

    if ($idade === false) {
        $erros["idade"] =
            "Informe uma idade válida.";
    } elseif ($idade < 16) {
        $erros["idade"] =
            "A idade deve ser maior ou igual a 16 anos.";
    }


    // Validação do curso
    if (
        $cursoDesejado === "" ||
        !in_array($cursoDesejado, $cursosPermitidos, true)
    ) {
        $erros["curso_desejado"] =
            "Selecione um curso válido.";
    }


    // Validação dos termos
    if (!isset($_POST["aceite_termos"])) {
        $erros["aceite_termos"] =
            "Você deve aceitar os termos para realizar a inscrição.";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>Inscrição SENAI</title>

    <style>
        .erro {
            color: red;
            margin-top: 5px;
            margin-bottom: 10px;
        }

        .sucesso {
            color: green;
            margin-top: 20px;
        }
    </style>
</head>

<body>

<main>

    <h1>Inscrição para Curso Técnico</h1>

    <form method="POST">

        <!-- Nome -->

        <label for="nome_candidato">
            Nome do candidato
        </label>

        <input
            type="text"
            name="nome_candidato"
            id="nome_candidato"
            placeholder="Digite seu nome"
            value="<?= htmlspecialchars($nomeCandidato) ?>"
        >

        <?php if (isset($erros["nome_candidato"])): ?>

            <div class="erro">
                <?= htmlspecialchars($erros["nome_candidato"]) ?>
            </div>

        <?php endif; ?>


        <!-- Idade -->

        <label for="idade">
            Idade
        </label>

        <input
            type="number"
            name="idade"
            id="idade"
            min="16"
            placeholder="Digite sua idade"
            value="<?= htmlspecialchars((string) $idade) ?>"
        >

        <?php if (isset($erros["idade"])): ?>

            <div class="erro">
                <?= htmlspecialchars($erros["idade"]) ?>
            </div>

        <?php endif; ?>


        <!-- Curso -->

        <label for="curso_desejado">
            Curso desejado
        </label>

        <select
            name="curso_desejado"
            id="curso_desejado"
        >

            <option value="">
                Selecione um curso
            </option>

            <?php foreach ($cursosPermitidos as $curso): ?>

                <option
                    value="<?= htmlspecialchars($curso) ?>"
                    <?= $cursoDesejado === $curso ? "selected" : "" ?>
                >
                    <?= htmlspecialchars($curso) ?>
                </option>

            <?php endforeach; ?>

        </select>

        <?php if (isset($erros["curso_desejado"])): ?>

            <div class="erro">
                <?= htmlspecialchars($erros["curso_desejado"]) ?>
            </div>

        <?php endif; ?>


        <!-- Termos -->

        <label>
            <input
                type="checkbox"
                name="aceite_termos"
                value="1"
                <?= $aceiteTermos ? "checked" : "" ?>
            >

            Aceito os termos da inscrição
        </label>

        <?php if (isset($erros["aceite_termos"])): ?>

            <div class="erro">
                <?= htmlspecialchars($erros["aceite_termos"]) ?>
            </div>

        <?php endif; ?>


        <button type="submit">
            Inscrever-se
        </button>

    </form>


    <?php if ($_SERVER["REQUEST_METHOD"] === "POST" && $erros === []): ?>

        <div class="sucesso">

            <h2>Inscrição realizada com sucesso!</h2>

            <p>
                Candidato:
                <?= htmlspecialchars($nomeCandidato) ?>
            </p>

            <p>
                Idade:
                <?= htmlspecialchars((string) $idade) ?>
            </p>

            <p>
                Curso:
                <?= htmlspecialchars($cursoDesejado) ?>
            </p>

        </div>

    <?php endif; ?>

</main>

</body>

</html>
