<?php declare(strict_types=1); ?>

<?php 
// Você está fazendo o Back-End de um painel administrativo. O sistema tem dois tipos de usuários que podem acessar a área VIP: "Diretor" ou "Gerente".
// Crie as variáveis $cargoUsuario (string) e $senhaDigitada (string).
// Crie uma variável com a senha correta do sistema: $senhaSistema = "SenhaSegura123";.
// O acesso só é liberado SE a senha estiver correta E o cargo for "Diretor" OU "Gerente".
// Exiba "Acesso Liberado" ou "Acesso Negado". (Dica: Cuidado com o uso de parênteses para separar o AND do OR).

$cargoUsuario = "Diretor";
$senhaDigitada = "senha";
$senhaSistema = "SenhaSegura123";
if (($senhaDigitada === $senhaSistema && $cargoUsuario === "Diretor" || "Gerente")){
    echo "Acesso Liberado";
} else {

}
?>