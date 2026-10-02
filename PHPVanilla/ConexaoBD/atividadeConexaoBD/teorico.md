# Parte A: Exercícios Teóricos de Fixação

**1. Abstração de Dados**

O PDO é uma classe do PHP pra conectar com banco de dados. Ele é melhor que o pgsql antigo porque funciona com vários bancos, então se trocar de banco só muda o DSN e não precisa refazer o código. Ele também tem prepared statements, que ajudam contra SQL Injection, e usa exceções pros erros.

**2. Ciclo do DSN**

DSN é a string que fala pro PDO onde o banco está. No meu caso ficou `pgsql:host=127.0.0.1;port=5432;dbname=biblioteca_escola`. O host é o endereço do servidor, a port é a porta que o PostgreSQL usa e o dbname é o nome do banco que eu quero acessar.

**3. Padrão de Portas**

A porta padrão é a 5432. Na string de conexão ela vem em `port=5432`.

**4. Flags de Integridade**

Com o `ERRMODE_EXCEPTION`, quando dá erro o PDO lança uma PDOException e dá pra tratar com try/catch. Sem essa flag ele usa o modo padrão, que nas versões antigas do PHP era silencioso, ou seja, o erro acontecia e ninguém via.

**5. Fetch Mode**

O `FETCH_ASSOC` traz cada linha só com o nome das colunas. O padrão traz duas vezes (por nome e por número), então o ASSOC usa menos memória.

**6. Padrão Singleton**

Cada new PDO() abre uma conexão nova no PostgreSQL, e o servidor tem um limite de conexões ao mesmo tempo (o max_connections, que normalmente é 100). Se abrir uma a cada consulta, com vários usuários o limite acaba e ele começa a recusar conexão. No ex05 deu pra ver: o new PDO() deixou 50 conexões abertas e o Singleton só 1.

**7. Encapsulamento do Singleton**

O construtor é private pra ninguém conseguir dar new ConexaoBanco() fora da classe, assim só existe uma instância. Também tem que bloquear o `__clone()`, pra não copiar o objeto, e o `__wakeup()`, pra não criar outra pelo unserialize.

**8. Segurança de Credenciais**

Porque o código vai pro GitHub e é compartilhado, então quem vê o código vê a senha do banco. E mesmo se apagar depois, ela fica no histórico do Git. O certo é deixar num arquivo separado, tipo o database.ini, e não subir ele pro repositório.

**9. Tratamento de Exceções & LGPD**

A mensagem do erro pode mostrar coisa interna, como o servidor, o nome do banco, o usuário e até a consulta SQL. Isso ajuda um atacante a entender o sistema (Information Disclosure) e também vai contra a LGPD, que manda proteger os dados. O certo é guardar o erro num log com error_log e mostrar só uma mensagem genérica pro usuário.