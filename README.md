## Nutrição – Sistema de Gerenciamento Nutricional

Aplicação desenvolvida para gerenciamento de informações relacionadas à **nutrição e alimentação**, permitindo o cadastro e controle de dados utilizados em um sistema nutricional.  

O projeto foi desenvolvido com foco em boas práticas de desenvolvimento backend, organização de código e utilização de recursos modernos do ecossistema PHP.  
Este sistema simula funcionalidades utilizadas em plataformas da área de saúde e nutrição, servindo como estudo prático de **CRUD, arquitetura MVC e integração entre backend e banco de dados.**

#### Funcionalidades

- Cadastro de usuários
- Registro de informações nutricionais
- CRUD completo de dados
- Validação de formulários
- Organização em arquitetura MVC
- Persistência de dados em banco relacional

#### Tecnologias utilizadas

- PHP
- Laravel
- Blade
- MySQL / PostgreSQL
- HTML
- CSS
- JavaScript

#### Principais recursos do framework utilizados:

- ORM Eloquent
- Migrations
- Controllers
- Middleware
- Validação de formulários
- Sistema de rotas
- Arquitetura MVC

### Como executar o projeto
1. Clonar o repositório  
`git clone https://github.com/andressa-mb/nutricao.git`
2. Entrar no diretório do projeto  
`cd nutricao`
3. Instalar dependências  
`composer install`
4. Copiar o arquivo de exemplo:  
`cp .env.example .env`  
  Configurar as credenciais do banco de dados no .env.  
5. Gerar a chave da aplicação  
`php artisan key:generate`
6. Executar migrations  
`php artisan migrate`
7. Iniciar o servidor  
`php artisan serve`

#### A aplicação estará disponível em:
```
http://localhost:8080
```
