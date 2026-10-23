<?php
declare(strict_types=1);

//Super Classe Abstrata de Conta Bancaria => Não permite Instanciamento

abstract class ContaBancaria {
    //atributo
    protected float $saldo;

    //construtor da classe usando property promotion (Declaro os atributos dentro do construtor)
    public function __construct(
        public readonly string $agencia, //atributo que recebera a agencia
        public readonly string $numeroConta, //atributo que recebera o nº da conta
        public readonly Titular $titular, //atributo que recebera os dados do titular (Classe Titular)
        float $saldoInicial = 0.0 // atributo que recebera o saldoInicial da conta e passara para o saldo 
    ) {
        if($saldoInicial < 0.0) { //lança uma excception caso valor do saldo inicial seja negativo
            throw new ValorInvalidoException($saldoInicial);
        }
        $this->saldo = $saldoInicial;
    }

    //método para depositar na conta (adicionar ao saldo) RN
    public function depositar(float $valor):void {
        if($valor <=0.0){ //se valor negativo lança uma exception
            throw new ValorInvalidoException($valor);
        }
        //se tudo der certo
        //$this->saldo = $this->saldo + $valor;
        $this->saldo += $valor;
    }

    //métoda abstrato: cada subclasse define sua politica de saque 
    abstract public function sacar(float $valor) : void;

    //Criar um método com polimorfismo
    //Método de Transferência entre Contas
    public function transferir (float $valor, ContaBancaria $contaDestino): void {
        if($this === $contaDestino) { //se a conta que estpu transferidno for igual a conta de destino lança uma exceptiom
            throw new ValorInvalidoException($valor);
        }

        //Se tudo der certo
        //realizar o saque da conta de origem
        $this->sacar($valor);
        //depositar na conta de Destino
        $contaDestino->depositar($valor);
    }

    //consulta o saldo (getter)
    public function getSaldo():float{
        return $this->saldo;
    }
}

