# Parte A: Exercícios Teóricos de Fixação


### Conceituação OWASP: O que significa a sigla XSS e por que ela é classificada como uma vulnerabilidade no lado do cliente (Client-Side) que deve ser prevenida pelo Back-End?
R: É uma vulnerabilidade em que um atacante consegue inserir código, geralmente JavaScript, em uma página que será exibida para outros usuários.


### Reflected vs Stored: Qual é a diferença entre um ataque XSS Refletido e um XSS Gravado (Stored)? Qual dos dois apresenta maior potencial de estrago para uma empresa e por quê?
R: XSS Refletido: o código malicioso é enviado em uma requisição, como em uma URL ou formulário, e é imediatamente devolvido pela aplicação na resposta. Normalmente depende de a vítima acessar um link ou enviar uma requisição preparada.
XSS Stored (Gravado): o código malicioso é armazenado no servidor, por exemplo em um banco de dados, comentário ou mensagem. Depois, ele é exibido para outros usuários que acessarem aquela página.


### Mecanismo de Escapamento: Explique detalhadamente a transformação que a função htmlspecialchars() realiza nos caracteres < e >. Por que o navegador não executa o código após essa transformação?
A função htmlspecialchars() transforma caracteres especiais do HTML em entidades HTML. Isso impede que o navegador interprete <script> como uma tag HTML real.

### Flags de Proteção: Qual é a função da flag ENT_QUOTES na chamada de htmlspecialchars()? O que pode acontecer se essa flag for omitida em um campo <input value="...">?
flag ENT_QUOTES faz com que htmlspecialchars() também escape aspas simples (') e aspas duplas (").

### Anti-Alucinação PHP: Por que não devemos utilizar o filtro FILTER_SANITIZE_STRING em projetos modernos desenvolvidos em PHP 8.3?
Não devemos usar FILTER_SANITIZE_STRING em projetos modernos porque esse filtro foi descontinuado no PHP 8.1 e removido no PHP 8.3. Além disso, sanitização não deve ser usada como substituta da validação e da codificação de saída. O ideal depende do contexto: validar os dados recebidos e, ao exibi-los em HTML, utilizar htmlspecialchars().


### Validação de E-mail: Qual é a diferença prática entre verificar um e-mail com empty($email) e verificar com filter_var($email, FILTER_VALIDATE_EMAIL)?
empty($email) verifica apenas se a variável está vazia ou possui um valor considerado vazio pelo PHP. Ela n verifica se aquilo realmente é um email.


### Roubo de Sessão: Como um atacante pode usar uma brecha XSS para capturar o cookie de sessão de um usuário logado?
Se uma aplicação possui uma vulnerabilidade XSS, um atacante pode conseguir executar JavaScript no navegador de um usuário. Se o cookie de sessão estiver acessível via JavaScript, um código malicioso poderia tentar acessar informações armazenadas em document.cookie e enviá-las para outro servidor. Com o cookie de sessão, o atacante poderia tentar se passar pelo usuário enquanto aquela sessão ainda fosse válida.


### Segurança em Camadas: Por que sanitizar na entrada (ex: com strip_tags) não elimina a necessidade de codificar na saída com htmlspecialchars()?
Sanitizar os dados na entrada não elimina a necessidade de protegê-los na saída porque um mesmo dado pode ser utilizado em diferentes contextos.
