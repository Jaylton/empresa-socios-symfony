# Empresa e sócios

O sistema é uma aplicação web projetada para facilitar o gerenciamento de informações sobre empresas e seus respectivos sócios. Este sistema permite que usuários cadastrem novas empresas e associem os sócios.

## Funcionalidades Principais:

- Cadastro de Empresas: Permite a inclusão de novas empresas com informações como nome e CNPJ.
- Gerenciamento de Sócios: Usuários podem cadastrar, editar e excluir sócios, vinculando-os às empresas correspondentes.

## Documentação da API
- Importe o arquivo empresa-socios.postman_collection.json no Postman.

## Tecnologias Utilizadas

- Symfony (Backend)
- Angular (Frontend)
- Docker (Contêineres)
- PostgreSQL (Banco de dados)

## Pré-requisitos

Antes de começar, certifique-se de que você tem o seguinte instalado em sua máquina:

- [Docker](https://www.docker.com/products/docker-desktop) e [Docker Compose](https://docs.docker.com/compose/install/)
- [Node.js](https://nodejs.org/) (opcional, para desenvolvimento fora do Docker)

## Estrutura do Projeto
/empresa-socios-symfony ├── /backend (Symfony API) ├── /frontend (Angular) ├── docker-compose.yml

## Como Rodar a Aplicação

1. **Clone o repositório**

   ```sh
   git clone https://github.com/Jaylton/empresa-socios-symfony.git
   cd empresa-socios-symfony
   ```

2. **Construir e rodar os containers**
Execute o seguinte comando no diretório raiz do projeto para construir e iniciar os containers:
   ```sh
   docker-compose up --build
   ```
    Isso irá:
    - Construir as imagens Docker para o backend e frontend.
    - Iniciar os containers para o banco de dados, backend e frontend.
    
3. **Acessar a aplicação**

    - O frontend Angular estará disponível em: http://localhost:4200
    - O backend Symfony deve estar disponível em: http://localhost:8000
    
## Estrutura de Diretórios
 - /backend: Código da API em Symfony.
 - /frontend: Código da aplicação em Angular.
