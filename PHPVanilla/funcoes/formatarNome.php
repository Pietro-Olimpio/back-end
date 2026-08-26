<?php declare(strict_types=1);

function formatarNome(string $nome): string{
    return (ucfirst(strtolower(trim($nome))));
}
echo FormatarNome("       MAria          ");


?>