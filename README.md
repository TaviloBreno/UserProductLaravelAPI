# UserProductLaravelAPI 🚀

## Introdução ℹ️

Bem-vindo ao projeto UserProductLaravelAPI! Esta é uma API RESTful desenvolvida com o framework Laravel para gerenciar usuários e produtos.

## Configuração 🛠️

1. Certifique-se de ter o PHP e o Composer instalados.
2. Clone este repositório para o seu ambiente local.
3. No diretório do projeto, execute `composer install` para instalar as dependências.
4. Crie um arquivo `.env` na raiz do projeto e configure as variáveis de ambiente, incluindo a conexão com o banco de dados.
5. Execute `php artisan key:generate` para gerar a chave de aplicação.
6. Execute `php artisan migrate` para migrar as tabelas do banco de dados.
7. Execute `php artisan serve` para iniciar o servidor de desenvolvimento.

## Rotas da API 🛣️

A API oferece várias rotas para operações CRUD de usuários e produtos, bem como para upload de imagens. Consulte a documentação completa das rotas no arquivo `API_Documentation.md`.

## Autenticação 🔒

A API utiliza autenticação Sanctum para proteger determinadas rotas. Para acessar rotas protegidas, você precisará enviar um token de autenticação válido no cabeçalho da solicitação.

## Contribuição 🤝

Contribuições são bem-vindas! Sinta-se à vontade para abrir uma issue para relatar problemas ou enviar um pull request com melhorias.

## Recursos Adicionais ℹ️

- [Documentação do Laravel](https://laravel.com/docs)
- [Documentação do Postman](https://learning.postman.com/docs/getting-started/introduction/)

Divirta-se explorando a API! 😊
