## 9. LISTA DE EXERCÍCIOS DE FIXAÇÃO E PRÁTICA

### Parte A: Questões Teóricas de Fixação

1. **Procedural vs. OO:** Quais são os três principais riscos técnicos de manter regras financeiras críticas implementadas puramente através de arrays associativos e scripts procedurais?

R. Manter regras financeiras críticas implementadas puramente através de scripts procedurais e arrays associativos expõe sistemas de missão crítica a sérios problemas de estabilidade e integridade dos dados, Ocupam memoria desnecessaria, não tem como deixar privado ou protegido as classes ou seus atributos, em uma manutenção, teria de alterar o código inteiro e ainda tem a margem do erro de "arrumar a parte errada" e também permitir que outras variavel herdem caracterirsticas dessa classe abstrata.

2. **Ciclo de Vida do Objeto:** O que ocorre na memória Heap do servidor quando a instrução `new ContaCorrente(...)` é executada? Qual é o papel do método `__construct()` nesse processo?
R. 2. O PHP aloca espaço na memória Heap para a nova instância. O método `__construct()` é chamado imediatamente a seguir para inicializar o estado do objeto (atribuir dependências e valores iniciais), garantindo que ele nasça válido e pronto para uso.

3. **A Pseudo-Variável `$this`:** Explique por que o comando `$this->saldo` é obrigatório para acessar um atributo dentro da classe, diferenciando-o de uma variável local `$saldo`.

R. O `$this->saldo` serve para acessar o saldo que pertence ao objeto. Já o `$saldo` sozinho é uma variável comum, que pode existir apenas dentro de um método. Então, usamos o `$this` para mostrar que estamos trabalhando com o atributo do próprio objeto, e não com uma variável separada.

```php
class Finaceiro {
    //atributo
    private float $saldo;

    //método de Acesso
    public function setSaldo(float $valor) {
        $saldo = $valor;
        $this->saldo += $saldo;
    }
}
```
 
4. **Encapsulamento e Invariantes:** Por que um desenvolvedor sênior de back-end nunca deve criar um método `public function setSaldo(float $novoSaldo)` para uma conta bancária?

R. Devemos evitar um método setSaldo() porque ele permitiria alterar o saldo diretamente, sem verificar as regras da conta bancária. Isso poderia deixar o saldo com um valor inválido e comprometer a segurança do sistema. O correto é usar métodos como depositar() e sacar(), que verificam as regras antes de modificar o saldo.
 
5. **Modificadores de Acesso:** Qual é a diferença prática entre os modificadores `private` e `protected` quando subclasses entram em cena através do `extends`?

R. O `private` é visível apenas dentro da classe que o declarou, então a subclasse não consegue acessá-lo. O `protected` é visível na classe que o declarou e também nas subclasses. Na prática, `private` é o padrão mais seguro, e `protected` deve ser usado só quando a subclasse realmente precisa acessar ou estender aquele dado, pois quanto mais exposto o membro, mais difícil mudar a classe pai depois sem quebrar as filhas.
 
6. **Constructor Property Promotion:** Como o recurso de promoção de propriedades introduzido no PHP 8 reduz o *boilerplate* e melhora a legibilidade do código?

R. Antes do PHP 8 era necessário escrever o mesmo nome três vezes: declarar a propriedade, receber o parâmetro no construtor e atribuir um ao outro. Com a promoção, basta colocar o modificador de acesso (`public`, `protected` ou `private`) direto no parâmetro do construtor, e o PHP declara a propriedade e faz a atribuição automaticamente. O resultado é menos código repetitivo, menos chance de erro de digitação e uma classe mais curta e fácil de ler.
 
7. **Propriedades `readonly`:** Explique o mecanismo de segurança proporcionado pela palavra-chave `readonly` em atributos de classes de valor como `Titular` ou `CPF`.

R. Uma propriedade `readonly` só pode ser inicializada uma única vez, normalmente no construtor. Depois disso, qualquer tentativa de alterá-la lança um erro. Isso garante imutabilidade: o CPF ou o nome do titular não mudam durante a vida do objeto, e ele nunca fica em estado inconsistente. Como é o próprio PHP que bloqueia a alteração, a propriedade pode ficar `public` com segurança, sem precisar de getter. O recurso exige PHP 8.1 ou superior.
 
8. **Classes Abstratas:** Por que faz todo sentido no modelo bancário que a classe `ContaBancaria` seja declarada como `abstract` enquanto `ContaCorrente` e `ContaPoupanca` são classes concretas?

R. Porque na vida real não existe uma conta "genérica", existem tipos específicos de conta. Criar um objeto `ContaBancaria` direto não faz sentido para o negócio, e declarar a classe como `abstract` impede isso, transformando-a em um modelo base. Ela guarda o que é comum a todas as contas (saldo, depósito) e obriga as filhas a implementar o que é diferente (como cada tipo realiza o saque). Apenas as classes concretas, que têm todas as regras definidas, podem virar objetos.
 
9. **Polimorfismo:** Como o método `transferir(float $valor, ContaBancaria $destino)` consegue operar transferências entre quaisquer tipos de contas filhas sem precisar saber qual é a classe exata da conta de destino?

R. Porque o método depende da abstração (`ContaBancaria`) e não de uma classe específica. Toda filha, como `ContaCorrente`, `ContaPoupanca` ou uma futura `ContaSalario`, é uma `ContaBancaria` e garante possuir os métodos `sacar()` e `depositar()`. Em tempo de execução, o PHP chama a versão correta de cada método de acordo com a classe real do objeto. Assim, se surgir um novo tipo de conta, `transferir()` continua funcionando sem nenhuma alteração.
 
10. **Exceções de Domínio:** Por que é uma péssima prática retornar `false` ou `null` quando uma operação de saque é rejeitada por falta de saldo?

R. Primeiro, o retorno pode ser ignorado silenciosamente: se quem chamou esquecer de verificá-lo, o código segue como se o saque tivesse dado certo, o que é desastroso em sistema financeiro. Segundo, `false` ou `null` não explicam o motivo da falha (saldo insuficiente, valor inválido, conta bloqueada). Terceiro, o método passa a ter tipos de retorno misturados, exigindo um `if` em toda chamada. Por fim, em fluxos compostos como `transferir()`, se o saque falhar sem avisar, o depósito no destino acontece mesmo assim e o dinheiro surge do nada. Uma exceção de domínio interrompe o fluxo, carrega o motivo, tem significado de negócio e não pode ser ignorada sem tratamento explícito.
 
---
