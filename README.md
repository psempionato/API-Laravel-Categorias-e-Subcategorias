### Projeto Laravel com API de Categorias e Subcategorias
Este projeto é uma aplicação Laravel que expõe uma API para gerenciamento de categorias e subcategorias. 
A aplicação utiliza Docker para containerização e Laravel Sanctum para autenticação de APIs.

## Requisitos
- Docker
- Docker Compose
- PHP 8.1
- Composer

## Estrutura do Projeto
Backend: Implementado com Laravel, expõe uma API para gerenciamento de categorias e subcategorias.
Banco de Dados: PostgreSQL, gerenciado via Docker.
Autenticação: Laravel Sanctum para autenticação de APIs.

## Configuração do Ambiente
1 - Execute o comando: docker-compose up --build
2 - Acesse o container: docker-compose exec -it <container-name> bash
3 - Dentro do container acesse: cd api
4 - Execute as migrations: php artisan migrate


## Rotas da API
## Login de Usuário
Endpoint: /api/login
Método: POST

#Dados: 
{
  "name": "Nome do Usuário",
  "email": "email@exemplo.com",
  "password": "senha123"
}

# Resposta:
{
  "token": "seu_token_aqui"
}

## Autenticação
Utilize o token retornado na resposta do login para autenticar outras requisições. 
Adicione o token ao cabeçalho Authorization como um Bearer Token.
