<?php
declare(strict_types=1);

//Criar a Classe ContaPoupanca isenta de tarifas de saque e 
// se limite de cheque especial
//aplicação dos juros mensais no saldo 

final class ContaPoupanca extends ContaBancaria {
//puxa todos os  métodos e atributos da classe ContaBancaria

//precisa somente implementar o método de sacar
    #[Override]
    public function sacar(float $valor): void
    {
        if($valor<= 0.0){ // se valor negativo
            throw new ValorInvalidoException($valor);
        }
        if($valor > $this->saldo) { //se valor > saldo
            throw new SaldoInsuficienteException($this->saldo, $valor);
        }

        //se estiver tudo certo
        $this->saldo -= $valor;
    }

    //criar o método apra calcualr juros
    public function renderJuros(float $percentual):void {
        if($percentual <=0.0) {
            throw new ValorInvalidoException($percentual);
        }
        // se tudo estiver certo
        $rendimento = $this->saldo * ($percentual/100);
        $this->saldo += $rendimento;
    }

}