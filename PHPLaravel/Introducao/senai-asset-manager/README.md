# Meu Primeiro Pojeto Laravel - SENAI Asset Manager (Sistema de gestão de ativos Industriais e Maquinários)

## 1. Criação da Aplicação

abrir o terminal do VScode na pasta desejada e add o projeto usando o composer

```bash
php --version #verifica a versão do php atual

composer --version #verifica a versão do composer atual

#cria o projeto dentro da pasta atual
composer create-project laravel/laravel nome-do-projeto

#acessa a pasta do projeto
cd nome-do-projeto
```

## 2. Configuração de Arquivo de Blindagem `.env`

- Abrir o arquivo e configurar os paraâmetros

- configurar as informações das variáveis de ambiente para o projeto

- inserir a chave de criptrografia caso nãp tenha

`php artisan key:generate`

## Criação de uma Classe Model

Gerar o Model para Representar as maquinas e equipamentos do sistema

criar uma classe chamada Ativo

`php artisan make:model Ativo`

`app/Models/Ativo.php` - arquivo criado

## 3. Criação de um Controller

Gerar um Controller para gerenciar as maquinas e equipamentos (Ativo)

`php artisan make:controller AtivoController --resource`

`app/Http/Controllers/AtivoController.php` - arquivo criado

## 4. Rotas de navegação da aplicação

`routes/web.php`

criação de duas rotas de tipo get

uma de ativos mokados
uma de status da infra

## 5. Camada de Visualização `Blade`

`resources/views/`

criar a pasta de ativos
e criar index.blade.php

- blade é a engine de visualização do laravel, que permite criar páginas web dinâmicas com sintaxe simples e direta
- faz uso do databind => é o processo de vincular dados do backend (controlador ou do modelo) a elementos da interface do usuários (UI)
- databind no blade é feito com a sintaxe `{{ $variavel }}`

## Inicialização e Homologação

Inspecionar 
`php artisan about`

Homolocar
`php artisan serve`
