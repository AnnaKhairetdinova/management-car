# Управление автомобилями

## Как запустить

1. Клонировать репозиторий
2. Установить зависимости:
```bash
composer install
```
3. Скопировать .env.example в .env
4. Внести переменные базы данных и redis в .env:
```bash
DB_CONNECTION=pgsql
DB_HOST=127.0.0.1
DB_PORT=5432
DB_DATABASE=management_car
DB_USERNAME=
DB_PASSWORD=

REDIS_HOST=127.0.0.1
REDIS_PASSWORD=
REDIS_PORT=6379
REDIS_DB=0
```
5. Запустить docker-compose:
```bash
docker-compose up -d
```
6. Запустить миграции:
```bash
php artisan migrate
```
7. Запустить сервер:
```bash
php artisan serve
```

### Для удобства прикреплены постман коллекция и swagger
