<?php
declare(strict_types=1);

//Classe para Representar o titular ca conta bancaria

final class Titular {
    //Property Promotion
    //reandonly -> imutabilidade de variáveis pelo php , não permite alterar o valor , uma vez declarado não alterar
    public function __construct(
        public readonly string $nome,
        public readonly string $cpf
    )
    {
        $this->validarDados();
    }

    //Validar Dados de forma privada
    private function validarDados(): void {
        if(strlen(trim($this->nome)) < 3) {
            throw new InvalidArgumentException("O nome do titular deve possuir no mínimo 3 caracteres.");
        }
        
        //CPF -> remove todos os caracteres que não forem nº do CPF
        $cpfNumeros = preg_replace("/\D/", "",$this->cpf);
        if(strlen($cpfNumeros) !== 11) {
            throw new InvalidArgumentException("O CPF deve ter exatamente 11 dígitos numéricos");
        }
    }
}