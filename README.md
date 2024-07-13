# Projeto Laravel API com JWT

Este projeto é uma API RESTful construída com Laravel, utilizando autenticação JWT para gerenciar usuários.

## Requisitos

- PHP >= 8.0
- Composer
- Laravel >= 11
- MySQL ou SQLite (para desenvolvimento/testes)

## Instalação

1. **Clone o repositório:**

   ```bash
   git clone https://github.com/Leozinho0/projetoapi.git
   cd projetoapi

2. **Instale as dependências:**

    composer install

3. **Configure o ambiente:**

Copie o arquivo .env.example para .env e ajuste as configurações conforme necessário.

    cp .env.example .env

4. **Gere a chave de aplicativo:**

    php artisan key:generate

5. **Gere o secret JWT**

    php artisan jwt:secret

6. **Execute as migrations:**

    php artisan migrate

## Uso da API  

1. **Autenticação:**

    Para obter um token JWT, faça uma requisição POST para /api/login com as credenciais do usuário (email e senha):

        POST /api/login
        Content-Type: application/json

        {
            "email": "usuario@example.com",
            "password": "sua_senha"
        }

    Se as credenciais estiverem corretas, você receberá um token JWT na resposta:

        {
            "access_token": "seu_token_jwt",
            "token_type": "bearer",
            "expires_in": 3600
        }

2. **Listar Usuários:**

    Para listar todos os usuários, faça uma requisição GET para /api/users, incluindo o token JWT no cabeçalho de autorização:

        GET /api/users
        Authorization: Bearer seu_token_jwt

3. **Mostrar Usuário:**

    Para mostrar um usuário específico, faça uma requisição GET para /api/users/{id}:

        GET /api/users/1
        Authorization: Bearer seu_token_jwt

## Executando Testes

Para executar os testes de integração, use o seguinte comando:

    php artisan test

Os testes verificam se a autenticação e os endpoints da API estão funcionando corretamente.

## Considerações Finais

Obrigado!