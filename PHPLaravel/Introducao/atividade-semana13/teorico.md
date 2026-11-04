# Laravel 11: Respostas de Estudo

## 1. Evolução Arquitetural (MVC artesanal → Laravel 11)

Ao construir o MVC na mão, você aprende na prática os mecanismos que o Laravel apenas automatiza:

- **Front Controller:** um único `index.php` recebe todas as requisições (via reescrita de URL no `.htaccess`).
- **Router:** mapeia método HTTP + URI para uma ação de controller.
- **Separação de responsabilidades:** Model (dados), View (apresentação) e Controller (orquestração).
- **Autoload (PSR-4) e Composer:** classes carregadas por namespace, sem `require` manual.
- **Container/injeção de dependências**, ainda que simples, e **configuração via variáveis de ambiente**.

Quando você chega ao Laravel, nada é "mágica": `routes/web.php` é o seu router, `app/Http/Controllers` são seus controllers, o Eloquent é um model mais sofisticado e o Blade é uma view com sintaxe melhor. Você reconhece o padrão e só aprende a sintaxe.

---

## 2. A Nova Arquitetura do Laravel 11

O Laravel 11 enxugou o esqueleto da aplicação:

- Foram removidos o `app/Http/Kernel.php`, o `app/Console/Kernel.php` e o `app/Exceptions/Handler.php`.
- Vários *service providers* foram consolidados em um só (`AppServiceProvider`).
- Arquivos de configuração deixaram de vir todos publicados; você publica só o que precisa (`php artisan config:publish`).
- Rotas de API e broadcasting passaram a ser opcionais (`php artisan install:api`).

**O novo ponto central é o `bootstrap/app.php`**, onde você configura roteamento, **middlewares** (`->withMiddleware(...)`) e tratamento de **exceções** (`->withExceptions(...)`), tudo de forma fluente. Antes, isso ficava espalhado entre Kernels e Handler.

---

## 3. Padrão 12-Factor App e o `config/database.php`

O 12-Factor manda separar **configuração** (que muda entre ambientes) do **código**. Gravar a senha em `config/database.php`:

- Faz o segredo ir para o **repositório Git**, ficando no histórico para sempre, mesmo se for apagado depois.
- Expõe a credencial a qualquer pessoa com acesso ao código (colegas, repositório público, vazamentos).
- Obriga a **mudar código** para trocar de ambiente (dev, teste, produção) e dificulta rotacionar a senha.

O `.env` fica **fora do versionamento** (`.gitignore`), e o `config/database.php` só lê `env('DB_PASSWORD')`.

---

## 4. O Papel da APP_KEY

A `APP_KEY` é usada para **criptografar e assinar** dados (`encrypt()`, cookies, sessões, tokens de reset, URLs assinadas). Se você trocá-la com a aplicação já em uso:

- **Todos os dados cifrados antes ficam ilegíveis** (erro `DecryptException`), incluindo campos que você tenha cifrado no banco.
- **Sessões e cookies ativos são invalidados**: os usuários são deslogados e perdem o "lembrar-me".
- Links assinados e tokens pendentes deixam de funcionar.

Dados cifrados **sem a chave antiga são perdidos**. Por isso, em produção, a chave nunca deve ser regenerada casualmente (`key:generate` só no setup inicial). O Laravel permite `APP_PREVIOUS_KEYS` para rotação segura.

---

## 5. Isolamento de Diretórios (`public/`)

A raiz do projeto contém `.env`, `config/`, `app/`, `vendor/`, `storage/` e `database/`. Se o servidor apontar para a raiz:

- O `.env` (com senhas e `APP_KEY`) pode ser **baixado pela URL** (`/.env`).
- O código-fonte e os arquivos de configuração ficam acessíveis.

Com `public/` como *document root*, só o `index.php` (front controller) e os assets (CSS, JS, imagens) ficam expostos. Todo o resto fica **fora do alcance do navegador**, e as requisições passam pelo framework.

---

## 6. Artisan CLI: `php arquivo.php` vs `php artisan`

- `php arquivo.php` executa um script isolado: ele não conhece o framework e você precisa carregar tudo manualmente (autoload, configuração, banco).
- `php artisan` **inicializa a aplicação inteira** (container, configurações, `.env`, banco, serviços) e despacha um comando registrado.

Na prática, o Artisan oferece geradores (`make:controller`, `make:model`, `make:migration`), `migrate`, `serve`, `route:list`, `tinker`, e você pode criar comandos próprios, com acesso a models e serviços da aplicação.

---

## 7. O Arquivo `.env.example`

Como o `.env` **não vai para o Git**, o `.env.example` é o **contrato** das variáveis que o projeto precisa. Mantê-lo atualizado:

- Permite que um colega clone o projeto, rode `cp .env.example .env` e saiba **exatamente o que configurar**.
- Evita erros do tipo "na minha máquina funciona", causados por variável nova que só existe no `.env` de um dev.
- Serve de documentação para o deploy e para CI.

Ele deve conter **só os nomes e valores de exemplo**, nunca segredos reais.

---

## 8. Blade: `{{ $variavel }}` vs `{!! $variavel !!}`

- `{{ $variavel }}` **escapa** o conteúdo (usa `htmlspecialchars`): `<script>` vira `&lt;script&gt;` e é exibido como texto. **Protege contra XSS**.
- `{!! $variavel !!}` imprime o conteúdo **sem escapar**: se vier de um usuário e contiver `<script>alert(1)</script>`, o navegador **executa** o código. Isso abre a porta para **XSS**.

**Regra:** use sempre `{{ }}`. Use `{!! !!}` apenas com HTML que você controla ou já higienizou.

---

## 9. Responsabilidade do Controller (≤ 20 linhas)

O controller deve só **receber a requisição, delegar e devolver a resposta**. Colocar SQL cru e regras de negócio nele causa:

- **Violação do SRP** (responsabilidade única): o controller passa a fazer várias coisas.
- **Dificuldade de teste** e de **reaproveitamento** (a mesma regra em uma API, um comando Artisan ou um job).
- **Código difícil de ler e manter**, com maior risco de bugs e de SQL Injection em consultas cruas.

O correto é: validação em *Form Requests*, regras de negócio em *Services/Actions*, acesso a dados em *Models/Eloquent* (ou Repositories).

---

## 10. A Ferramenta Tinker

O `php artisan tinker` é um **console interativo (REPL)** com a aplicação Laravel carregada. Você digita código PHP e executa na hora, com acesso a models, helpers e banco. Economiza tempo em laboratório para:

- **Testar consultas Eloquent** (`User::where('ativo', true)->get()`) sem criar rota ou controller.
- **Criar registros rápidos** de teste (`User::create([...])`) ou usar factories.
- **Verificar relacionamentos**, configurações (`config('app.name')`) e helpers.
- **Depurar** uma lógica antes de colocá-la no código definitivo.