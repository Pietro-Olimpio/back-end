# Semana 06: formularios html, metodos get/post e processamento HTTP

#### Anatomia de um Formulário HTML para BackEnd
Anted do PHP processar qualquer informação, precisamos coletar informações no ForntEnd através de um `<form>`

**Exemplo de `<form>` HTML**

```html
<form action ="procesar.php" method="POST">
    <label>Nome Completo</label>
    <input type:"text" id="campoNome" name="nomeUsuario" placeholder="Digite seu Nome">
    <button type="submit">Cadastrar</button>
</form>
```
**Os 3 Pilares de um formulário**
1. action="processa.php" -> O Destino : Define qual script PHP no servidor recebrá os dados
2. method="POST" -> O Transporte: Define a via de protocolo HTTP que será usada (GET ou POST)
3. name="nomeUsuario" -> A etiqueta do dado : É o nome da chave que o php usara no array associativo ($_POST["nomeUsuario"])

>obs: NUNCA!!! confundir `id` com `name` no input, o php ignora o `id`.

#### O protocolo HTTP

Quando o usuario clica no botão `"type=submit"`, o navegador compila todas as informações dos campos preenchidos e dispara um pacote de comunicação padronizado pelo **Protocolo HTTP (HyperText Transfer Protocol)**

**Os formatos de Transferencia**

- **Método GET**: solicitar informações públicas e realizar buscas, mas altamente arriscado para dados privados.

- **Método POST**: As informações viajam guardadas dentro do protocolo.

#### Testar o uso dos Protocolos HTTP

OK

#### GET vs. POST

1. O Método GET(Consultas e Filtros)

O  método `GET`é utilizado quando a intenção do cliente é **buscar ou filtrar dados** sem alterar o estado do servidor. Os dados enviados via `GET` são anexados diretamente ao final da URL na forma de uma **Query String** 

2. O Método POST (Envio de Cargas Úteis e Mutações)

O método `POST` é utilizado quando o formulário envia dados que devem ser processados para **criar ou modificar registros** no sistema (EX: cadastro de usuários, finalizações de compra, upload de arquivos)

