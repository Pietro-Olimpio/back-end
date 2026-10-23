# Situação de Aprendizagem - Programação Orientada a Objetos(POO) - SENAI Bank

## Estrutura de Diretórios do Projeto

Crie a árvores de arquivos e diretórios da seguinte forma:

```text
SAPOO/
├── src/
│   ├── Dominio/
│   │   ├── Titular.php                     <- Entidade imutável do correntista
│   │   ├── ContaBancaria.php               <- Superclasse abstrata
│   │   ├── ContaCorrente.php               <- Subclasse com cheque especial e taxa
│   │   └── ContaPoupanca.php               <- Subclasse com rendimento e sem taxa
│   └── Exceptions/
│       ├── ContaException.php              <- Exceção base do domínio
│       ├── SaldoInsuficienteException.php  <- Falha por fundos insuficientes
│       └── ValorInvalidoException.php      <- Valores negativos ou nulos
├── app_banco.php                           <- Simulador visual de operações bancárias
└── README.md                               <- Documentação e testes
```


## Criação da Exception de Dominio

### Conta Exception (`src/Exceptions/ContaException.php`)

## Entidade de Titularidade (`src/Dominio/Titular.php`)

## SuperClasse Chamada ContaBancaria -> Abstrata


