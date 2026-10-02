<?php
declare(strict_types=1);

//Camada de acesso a dados (DAO) para almoxarifado
//essa camada é uma classe - usa Paradigma de programação orientada ao objeto

final class AlmoxarifadoDAO{
    //Atributos -> as caracteristicas do objeto
    private PDO $pdo;

    //metodos -> ações
    //metodo que toda classe tem -> construtor -> permite instanciar objetos
    public function __construct(PDO $pdo){
        $this->pdo = $pdo;
    }

    //metodo do CRUD


    //read
    //listar todos -> busca as informações no banco e retorna um vetor com essas informações
    public function listarTodos() : array {
        //criar o sql
        $sql = "SELECT * FROM pecas_industriais ORDER BY id DESC";
        //executar 
        $stmt = $this->pdo->query($sql);
        //devolver em formato de array
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
           //vai me retornar a busca no banco em um vetor php
        // [
        //     {$id=>1, $nome=>"nometal", $quantidade=>29}
        //     {$id=>2, $nome=>"nometal2", $quantidade=>99}            
        // ]
    }
    //listar uma peça especifica pelo id
    public function buscarPorId(int $id): ?array {
        //esperando o retorno de um array, porem aceita nulo tb,
        $sql = "SELECT * FROM pecas_industriais WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(":id",$id, PDO::PARAM_INT);//garantindo que o valor do parametro seja passado como um nº inteiro
        $stmt->execute();

        $resultado = $stmt->fetch(PDO ::FETCH_ASSOC);
        return $resultado ?: null;
    }

    //CREATE => salva informações no banco
    public function salvar(array $dados): bool {
        $sql = "INSERT INTO pecas_industriais
        (codigo_sku, descricao, categoria, quantidade, preco_unitario)
        VALUES (:sku, :descricao, :categoria, :quantidade, :preco)";

        //se tem entrade de dados com input, faz o prepare
        $stmt = $this->pdo->prepare($sql);
        
        $resultado = $stmt->execute([
            ":sku"          => strtoupper((trim($dados["codigo_sku"]))),
            ":descricao"    => trim($dados["descricao"]),
            ":categoria"    => trim($dados["categoria"]),
            ":quantidade"   => (int)$dados["quantidade"],//estou fazendo um "CAST" para inteiro -> convertendo o dados para um nº inteiro
            ":preco"        => (float)$dados["preco_utilitario"]// CAST para float
        ]);
        return $resultado; //retorna true or false
    }

    //update
    public function atualizar(int $id, array $dados):bool {
        $sql = "UPDATE pecas_industriais SET  
        codigo_sku = :sku,
        descricao = :descricao,
        categoria = :categoria,
        quantidade = :quantidade,
        preco = :preco
        WHERE id = :id";

        $stmt = $this->pdo->prepare($sql);
        
        $resultado = $stmt->execute([
            ":id"           => $id,
            ":sku"          => strtoupper((trim($dados["codigo_sku"]))),
            ":descricao"    => trim($dados["descricao"]),
            ":categoria"    => trim($dados["categoria"]),
            ":quantidade"   => (int)$dados["quantidade"],
            ":preco"        => (float)$dados["preco_utilitario"]
        ]);
        return $resultado; 

    }

    //Deletar

    public function excluir(int $id) : bool {
        $sql = "DELETE FROM pecas_industriais WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(":id", $id, PDO::PARAM_INT);
        $resultado = $stmt->execute();
        return $resultado;
    }

    //buscar produtos por termo => busca textual
    public function buscarPorTermo(string $termo):array{
        $sql = "SELECT * FROM pecas_industriais
                WHERE codigo_sku ILIKE :termo OR descricao 
                ILIKE :termo OR categoria ILIKE :termo
                ORDER BY descricao ASC";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([":termo" => "%" . trim($termo) . "%"]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);


    }
}


?>