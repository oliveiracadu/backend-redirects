# Como rodar o projeto
1 - com docker
    - 1.1 - montar a estrutura docker-compose up --build
    - 1.2 - copiar o arquivo .env.example .env
    - 1.3 - acessar a imagem docker-compose exec app bash
    - 1.4 - rodar composer install && php artisan key:generate

2 - com artisan(necessário composer instalado)
    - 1.1 = copiar aquivo .env.example .env
    - 1.2 - rodar composer install && php artisan key:generate
    - 1.3 - rodar php artisan serve
