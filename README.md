# Lista de Tarefas

Esta é uma aplicação simples de lista de tarefas (to-do list) desenvolvida com PHP, MySQL, HTML, CSS e JavaScript. A aplicação permite criar, ler, atualizar e excluir tarefas, implementando todas as funcionalidades de um CRUD completo.

## Funcionalidades

-   **Adicionar Tarefas:** Crie novas tarefas com título, descrição, data de vencimento e prioridade.
-   **Listar Tarefas:** Visualize todas as tarefas em uma lista organizada. A prioridade de cada tarefa é indicada por uma cor diferente.
-   **Editar Tarefas:** Atualize os detalhes de uma tarefa existente, incluindo seu status (pendente, em andamento, concluída).
-   **Excluir Tarefas:** Remova tarefas da lista com uma confirmação para evitar exclusões acidentais.
-   **Interface Responsiva:** O layout se adapta a diferentes tamanhos de tela, funcionando bem em desktops e dispositivos móveis.

## Tecnologias Utilizadas

-   **Frontend:**
    -   HTML5
    -   CSS3
    -   JavaScript
-   **Backend:**
    -   PHP
-   **Banco de Dados:**
    -   MySQL

## Como Executar o Projeto

Siga os passos abaixo para configurar e executar a aplicação em seu ambiente local.

### Pré-requisitos

-   Um servidor web local (como Apache, Nginx ou o servidor embutido do PHP)
-   PHP 8.0 ou superior
-   MySQL 8.0 ou superior
-   Um cliente de banco de dados (como phpMyAdmin, DBeaver, etc.)

### Passos

1.  **Clone o Repositório**

    ```bash
    git clone <url-do-repositorio>
    cd <nome-do-repositorio>
    ```

2.  **Crie o Banco de Dados**

    -   Acesse seu cliente MySQL e crie um novo banco de dados chamado `lista_tarefas`.

    ```sql
    CREATE DATABASE lista_tarefas;
    ```

3.  **Crie a Tabela `tarefas`**

    -   Execute o seguinte script SQL para criar a tabela `tarefas` com a estrutura necessária:

    ```sql
    USE lista_tarefas;

    CREATE TABLE tarefas (
        id INT AUTO_INCREMENT PRIMARY KEY,
        titulo VARCHAR(255) NOT NULL,
        descricao TEXT,
        data_criacao DATETIME NOT NULL,
        data_vencimento DATE,
        prioridade ENUM('baixa', 'media', 'alta') NOT NULL,
        status ENUM('pendente', 'em andamento', 'concluida') NOT NULL
    );
    ```

4.  **Configure a Conexão com o Banco de Dados**

    -   Abra o arquivo `banco.php`.
    -   Altere as variáveis `$servidor`, `$usuario`, `$senha` e `$banco` com as credenciais do seu banco de dados local. Por padrão, o usuário é `root` e a senha é vazia.

5.  **Inicie o Servidor**

    -   Navegue até o diretório raiz do projeto e inicie o servidor embutido do PHP:

    ```bash
    php -S localhost:8000
    ```

6.  **Acesse a Aplicação**

    -   Abra seu navegador e acesse `http://localhost:8000`.

Agora você pode usar a aplicação para gerenciar suas tarefas!
