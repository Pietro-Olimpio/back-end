# Arquitetura MVC e conceitos de desenvolvimento

**1. O Colapso do Código Espaguete**

Quando colocamos SQL, validações e HTML tudo no mesmo arquivo, o código
fica bagunçado e difícil de entender. Se precisar mudar alguma coisa,
podemos acabar afetando outras partes do sistema. Isso dificulta a
manutenção, a organização e o crescimento do projeto.

**2. A Tríade MVC**

-   **Model:** Cuida dos dados, do acesso ao banco e das regras de
    negócio.
-   **View:** É responsável pela parte visual do sistema, ou seja, o
    HTML que o usuário vê.
-   **Controller:** Recebe as requisições, chama os Models e envia os
    dados para as Views.

As regras de negócio devem ficar principalmente no **Model** (ou em uma
camada de serviços).

**3. O Papel do Composer**

O `composer.json` guarda as dependências e configurações do projeto. Já
o `composer.lock` registra as versões exatas das bibliotecas instaladas,
garantindo que todos usem as mesmas versões. A pasta `vendor/` não deve
ir para o Git porque contém as bibliotecas instaladas, que podem ser
baixadas novamente pelo Composer.

**4. A Especificação PSR-4**

O PSR-4 usa o namespace para encontrar o arquivo correto. Por exemplo,
quando encontra `App\\Controllers\\ProdutoController`, ele procura
dentro da pasta configurada para o namespace `App`, retirando o `App\\`
e transformando o restante no caminho
`src/Controllers/ProdutoController.php`.

**5. Front Controller**

A principal vantagem é a segurança, pois centraliza as requisições no
`public/index.php` e impede que arquivos internos, como configurações e
códigos-fonte, sejam acessados diretamente pelo navegador.

**6. Roteador HTTP**

O roteador verifica o método HTTP e a URL da requisição. Assim, ele
consegue diferenciar um `GET /produtos`, que serve para listar ou
consultar produtos, de um `POST /produtos`, que serve para cadastrar um
novo produto.

**7. Injeção de Dados na View**

A função `extract()` transforma as posições de um array em variáveis
PHP. Assim, quando o Controller envia os dados para a View, ela consegue
utilizar essas informações diretamente, sem precisar acessar o array
toda hora.

**8. Segurança contra XSS nas Views**

O `htmlspecialchars()` transforma caracteres especiais em entidades
HTML, impedindo que códigos maliciosos enviados por usuários sejam
interpretados pelo navegador. Isso ajuda a evitar ataques XSS.

**9. Single Responsibility no Controller**

Porque a responsabilidade do Controller é controlar o fluxo das
requisições, e não cuidar diretamente do banco de dados. Os comandos SQL
devem ficar nos Models ou DAOs, e a conexão deve ser centralizada. Isso
deixa o código mais organizado, seguro e fácil de manter.

**10. Transição para o Framework Laravel**

Vários conceitos são os mesmos, como MVC, rotas HTTP, Controllers,
Models, Views, Composer, Autoload PSR-4, separação de responsabilidades
e proteção contra XSS. A diferença é que o Laravel já traz essas
funcionalidades prontas, facilitando o desenvolvimento do sistema.
