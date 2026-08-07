# Como Funciona na Prática o BackEnd

- **Ação do Usuário**: Envia uma Solicitação pela UI(Interface do Usuário). Exemplo de UI: Tela do Celular, Navegador da Internet, Alexa, IOT ...
- **Enviar uma requisição**: A UI transforma ação do Usuário em uma Requisição HTTP
- **O Processamento Backend**: o codigo backend recebe o pedido, valida os dados e decide oque faze. EX: `consultar uma informação no BD(Base de dados).`
- **Resposta**: O servidor devolve o resultado para a UI. Ex: `Um loguin Autorizado, Confirmaçãode uma compra...`

#### Tipos de requisições HTTP

Os tipos de requisição HTTP indicao a ação que o usuario deseja executar no servidor. As principais ações são:

- **GET**: pede dados de um lugar espeifico do servidor. `Não faz alterações no Servidor` 
- **DELETE**: Apaga um dado do servidor.
- **POST**: Envia dados novos para `Criar` algo ou processar informações no servidor
- **PUT/PATCH**: Atualizações ou modificar um dado já existente.

---
### Iniciando o PHP

**PHP** (HyperText PreProcessor) é uma linguagem de programação interpretada e open source, focada no desenvolvimento de sistemas para web, pode ser usada junto com HTML para criação de páginas web dinâmicas.

O PHP de fato é yma das linguagens de programação mais populares da atualidade. Ela permite que você crie aplicações web robustas, de uma maneira mto simplificada e direta. A linguagem tem diversos `recursos que facilitam e aceleram o prcesso de desenvolvimento de sites e sistemas web.` Ealem do mais, ela ainda tem um otimo ecossistema, uma exelente comunidade e um grande mercado de trabalho.

##### Instalando o PHP

- Fazer o Download do PHP (php.net)
- ZIP - NTS(Non Thread Safe) 8.5
- Descompactar o Arquivo do PHP na pasta C:src\php (Para Descompactar usar o 7Zip = Melhor) => nunca salvar arquivo ou programas na raiz do sistema(C:)
- Adicionar a Pasta do PHP(C:\src\php) as Variáveis de Ambiente do Sistema (PATH)
- Verificar a Instalação rodando o comando `php --version`

---

### Principais extenções pra PHP
![alt text](image.png)

Desabilitar o php do vscode e habilitei o intelephence pesquisando nas extenções do vscode: `@builtin php`


---


##### Criando Minha Primeira Aplicação em PHP

Para criar uma aplicação em PHP vamos precisar usar a estrutura do html, pq querendo ou não o php da vida ao html com o seguinte sintaxe:

```php
 <?php 
    echo "Hello, World!!!"
    ?> 
//sera exibito um paragrafo com o texto acima
```

