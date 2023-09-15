## Desafio Softdesign - Alan

### Requisitos

- PHP 8.0 ou superior
- Composer
- Node.js e NPM
- Banco de Dados MySQL (ou outro de sua escolha)

### Configuração

1. Clone este repositório:

    ```bash
    git clone https://github.com/aquidornne/softdesign
    cd softdesign
    ```

2. Copie o arquivo `.env.example` para `.env`:

    ```bash
    cp .env.example .env
    ```

3. Configure o arquivo `.env` com as informações do seu banco de dados:

    ```makefile
    DB_CONNECTION=mysql
    DB_HOST=seu-host
    DB_PORT=3306
    DB_DATABASE=seu-banco-de-dados
    DB_USERNAME=seu-usuario
    DB_PASSWORD=sua-senha
    ```

4. Instale as dependências PHP com o Composer:

    ```bash
    composer install
    ```

5. Instale as dependências JavaScript com o NPM:

    ```bash
    npm install
    ```

6. Execute as migrações do banco de dados para criar as tabelas necessárias:

    ```bash
    php artisan migrate
    ```

7. Execute o seeder `LivroSeeder` para popular o banco com alguns dados iniciais (se aplicável):

    ```arduino
    php artisan db:seed --class=LivroSeeder
    ```

### Como Rodar

Para iniciar a aplicação, você pode usar o comando:

```bash
npm run watch-poll
```

```bash
php artisan serve
```

8. Link para Google Drive com evidências da aplicação rodando:

https://drive.google.com/drive/folders/10srF9VjVqcOzbAhCTJ-8ic-QQV7I7xwQ?usp=sharing
