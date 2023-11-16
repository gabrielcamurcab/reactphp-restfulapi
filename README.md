# Projeto API Restful com ReactPHP e FastRoute

Bem-vindo ao projeto da API Restful desenvolvida com ReactPHP e FastRoute. Esta aplicação utiliza um servidor assíncrono para lidar com requisições de forma eficiente e o FastRoute para gerenciar as rotas da API.

## Instalação

Certifique-se de ter o PHP e o Composer instalados em seu sistema antes de prosseguir.

1. Clone o repositório para o seu ambiente local:

    ```bash
    git clone https://github.com/seu-usuario/api-restful-reactphp.git
    ```

2. Navegue até o diretório do projeto:

    ```bash
    cd reactphp-restfulapi
    ```

3. Instale as dependências usando o Composer:

    ```bash
    composer install
    ```

## Rodando o Servidor

### PHP

Para iniciar o servidor utilizando o PHP, execute o seguinte comando:

```bash
php server.php
```

O servidor será iniciado na porta padrão 8080. Acesse `http://localhost:8000` para testar as rotas.

### Nodemon

Se preferir usar o Nodemon para reiniciar automaticamente o servidor ao detectar alterações no código, primeiro, certifique-se de ter o Nodemon instalado globalmente:

```bash
npm install -g nodemon
```

Agora, inicie o servidor com o Nodemon:

```bash
nodemon server.php
```

O Nodemon estará observando as alterações nos arquivos e reiniciará automaticamente o servidor quando necessário.

## Rotas

As rotas da API podem ser configuradas no arquivo `routes.php`. O FastRoute é utilizado para definir os padrões de rota e associá-los aos controladores correspondentes.

```php
// Exemplo de rota no arquivo routes.php
$dispatcher->addRoute('GET', '/api/users', 'UserController@index');
```

## Contribuições

Sinta-se à vontade para contribuir com melhorias, correções de bugs ou novas funcionalidades. Basta criar um fork do repositório, fazer as alterações e enviar um pull request.

Obrigado por usar a API Restful com ReactPHP e FastRoute! Se tiver alguma dúvida ou problema, não hesite em criar uma issue neste repositório.
