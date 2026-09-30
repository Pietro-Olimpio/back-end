<?php
declare(strict_types=1);

//Camada de acesso a dados (DAO) para almoxarifado
//essa camada é uma classe - usa Paradigma de programação orientada ao objeto

final class AlmoxarifadoDAO{
    //Atributos -> as caracteristicas do objeto
    private PDO $pdo;

    //metodos -> ações
    //metodo que toda classe tem -> construtor -> permite instanciar objetos
    public function __constructor(PDO $pdo){
        $this->$pdo = $pdo;
    }

    //metodo do CRUD
    
}