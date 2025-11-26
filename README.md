# VUTTR (Very Useful Tools To Remember)

## Sobre

VUTTR é uma API simples, feita com Laravel, que permite que os usuários tenham onde guardar e ter fácil acesso às ferramentas que eles julgam ser úteis.
Criado com o intuito de praticar conhecimentos, utilizando o [desafio de Backend da Bossabox](https://bossabox.notion.site/Back-end-0b2c45f1a00e4a849eefe3b1d57f23c6) como inspiração.

## Pré-requisitos

- Laravel 12

Renomeie o arquivo `.env.example` para `.env` e rode o seguinte comando no terminal:

```bash
php artisan key:generate
```

## Instruções de Instalação

Após clonar o projeto, entre na pasta raiz da aplicação e rode os comandos no terminal:

```bash
# Para instalar as dependências do projeto
composer install

# Para criar a database do projeto e rodar as migrations
php artisan migrate
# Responder "yes" quando perguntarem se deseja criar o database

# Para rodar o projeto
php artisan serve --port=3000
```

Se você estiver utilizando o Laravel Herd, é necessário configurar na sessão **Sites** no Herd a pasta clonada.

## Instruções de Uso

A documentação completa das rotas e do formato das requisições e respostas, se encontra no arquivo [doc.html](), na raiz do projeto.
