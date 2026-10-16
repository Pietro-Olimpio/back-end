<?php
declare(strict_types=1);

use DomainException; //Biblioteca de Erros/Exception do PHP

class ContaException extends DomainException {
    //Herdando as Exception da Biblioteca DomainException
    #[Override]
    public function __construct(string $message = "Falha na operação bancaria")
    {
        return parent::__construct($message);
    }

}