<?php
declare(strict_types=1);

//criação da classe de acesso aos dados da tabela usuarios

final class UsuarioDAO{
    //atributos
    private PDO $pdo;

    public function __construct(PDO $pdo){
        $this->pdo = $pdo;
    }

    //metodos de manipulação de dados (DML)

    //Create -> Cadastrar
    public function Cadastrar(string $nome, string $email, string $senha, string $perfil = "OPERADOR"):bool{
        $sql = "INSERT INTO usuarios(nome, email, senha_hash, perfil)
            VALUES(:nome, :email, :hash, :perfil)";
        $stmt = $this->pdo->prepare($sql);

        //hash da senha
        $hash = password_hash($senha, PASSWORD_ARGON2ID);

        return $stmt->execute([
            ":nome"     => trim($nome),
            ":email"    => strtolower(trim($email)),
            ":hash"     => $hash,
            ":perfil"     => $perfil
        ]);
    }

    //buscar os dados do usuario pelo email

    // buscar os dados do usuário pelo email
    public function buscarPorEmail(string $email): ?array{
        $sql = "SELECT * FROM usuarios WHERE email = :email AND ativo = TRUE";

        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(":email", strtolower(trim($email)),PDO::PARAM_STR);
        $stmt->execute();

        $resultado = $stmt->fetch(PDO::FETCH_ASSOC);
        return $resultado ?: null;
    }

    //buscar um email cadastrado
    public function emailExiste(string $email): bool {
        //busca apenas a coluna do email apartir do email digitado
        $sql = "SELECT 1 FROM usuarios WHERE email = :email";
        $stmt =$this->pdo->prepare($sql);
        //ajusta o email digitado para minusculo e recorta os espaços em branco
        $stmt->bindValue(":email", strtolower(trim($email)), PDO::PARAM_STR);
        //executa a busca 
        $stmt->execute();
        //se email fo encontrado, retorna true, se não foi encontrado retorna false
        return (bool)$stmt->fetchColumn(); //(bool) => CAST para garantir que o resultado sera booleana
    }

    //faltando update

    // e um delete

}