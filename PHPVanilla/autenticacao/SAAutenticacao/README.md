# Situação de Aprendizagem Usando Sessão , Cookie e Autenticação

## Estrutura do Projeto

Organize sua pasta extamento com a seguinte árvores de arquivos

```text
SAAutenticacao/
├── config/
│   └── database.ini        <- Credenciais protegidas de acesso ao PostgreSQL
├── logs/
│   └── database.log        <- Logs do Banco de Dados
├── src/
│   ├── ConexaoBanco.php    <- Conexão Singleton PDO com PostgreSQL
│   ├── UsuarioDAO.php      <- Camada de persistência para consulta e cadastro
│   ├── AuthService.php     <- Serviço de gerenciamento de sessão e expiração
│   └── guard.php           <- Middleware interceptador de páginas restritas
├── schema.sql              <- Estrutura da tabela de usuários corporativos
├── login.php               <- Tela de autenticação pública
├── dashboard.php           <- Painel restrito protegido
├── logout.php              <- Encerramento seguro de sessão
├── cadastro.php              <- Pagina de cafastro de Usuarios
├── .gitignore              <- Arquivos não Versionados
└── README.md               <- Documentação do Projeto
```

## Criação da Tabela no banco de dados(PostgresSQL)

```sql
-- Criação da tabela devera ser dentro do banco almoxarifado_senai

CREATE TABLE IF NOT EXISTS usuarios (
    id SERIAL PRIMARY KEY,
    nome VARCHAR(80) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    senha_hash VARCHAR(255) NOT NULL,
    perfil VARCHAR(20) NOT NULL DEFAULT 'OPERADOR' CHECK (perfil IN ('ADMIN', 'OPERADOR')),
    ativo BOOLEAN NOT NULL DEFAULT TRUE,
    criado_em TIMESTAMP WITHOUT TIME ZONE DEFAULT CURRENT_TIMESTAMP
);
```

## Configurar os Dados do banco e criar a conexão Singelton

Configurar os dados do Banco de dados(`config/database.ini`)

```ini
; config/database.ini
[database]
db_driver   = pgsql
db_host     = 127.0.0.1
db_port     = 5432
db_name     = almoxarifado_senai
db_user     = postgres
db_pass     = postgres
```

Criar a Classe de Conexão com o Banco de dados em Formato Singleton (`src/ConexaoBanco.php`)
```php
<?php
declare(strict_types=1);

/**
 * Conexao Singleton com o PostgreSQL via PDO.
 */
final class ConexaoBanco {
    private static ?PDO $instancia = null;

    private function __construct() {}
    private function __clone(): void {}

    public function __wakeup(): void {
        throw new \Exception("Desserializacao proibida.");
    }

    public static function obterConexao(string $caminhoConfig): PDO {
        if (self::$instancia === null) {
            if(!file_exists($caminhoConfig)){
                throw new \RuntimeException("Arquivo de configuração não encontrado em {$caminhoConfig}");
            }
            $dados = parse_ini_file($caminhoConfig, true);
            if($dados === false || !isset($caminhoConfig, true)){
                throw new \RuntimeException("sessão [database] ausente no arquivo de configuracao");
            }
            $cfg = $dados['database'];
            $dsn = sprintf("%s:host=%s;port=%s;dbname=%s",
                $cfg['db_driver'], $cfg['db_host'], $cfg['db_port'], $cfg['db_name']);
            self::$instancia = new PDO($dsn, $cfg['db_user'], $cfg['db_pass'], [
                PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_EMULATE_PREPARES   => false
            ]);
        }
        return self::$instancia;
    }
}
```

## Camada de Acesso a Dados (`src/UsuarioDAO.php`)

isolar as operações de busca e cadastro de usuarios, aplicando o hashing de senha com `password_hash()`

criar os emtodos:
- Cadastrar (Create)
- Buscar por email (Read)
- Verificar se email já existe (Read)

## Fazer o Serviço de Autenticacao (`src/AuthService.php`)
