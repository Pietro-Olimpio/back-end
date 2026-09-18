# Parte A: Exercícios Teóricos de Fixação


### Conceituação OWASP: O que significa a sigla XSS e por que ela é classificada como uma vulnerabilidade no lado do cliente (Client-Side) que deve ser prevenida pelo Back-End?

### Reflected vs Stored: Qual é a diferença entre um ataque XSS Refletido e um XSS Gravado (Stored)? Qual dos dois apresenta maior potencial de estrago para uma empresa e por quê?

### Mecanismo de Escapamento: Explique detalhadamente a transformação que a função htmlspecialchars() realiza nos caracteres < e >. Por que o navegador não executa o código após essa transformação?

### Flags de Proteção: Qual é a função da flag ENT_QUOTES na chamada de htmlspecialchars()? O que pode acontecer se essa flag for omitida em um campo <input value="...">?

### Anti-Alucinação PHP: Por que não devemos utilizar o filtro FILTER_SANITIZE_STRING em projetos modernos desenvolvidos em PHP 8.3?

### Validação de E-mail: Qual é a diferença prática entre verificar um e-mail com empty($email) e verificar com filter_var($email, FILTER_VALIDATE_EMAIL)?

### Roubo de Sessão: Como um atacante pode usar uma brecha XSS para capturar o cookie de sessão de um usuário logado?

### Segurança em Camadas: Por que sanitizar na entrada (ex: com strip_tags) não elimina a necessidade de codificar na saída com htmlspecialchars()?
