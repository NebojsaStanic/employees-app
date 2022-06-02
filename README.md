# Application Setup

## cp .env.example .env

## set your db credentials (DB_HOST=host.docker.internal optionally)

## docker-compose --env-file .env up --build

## run the app on: http://localhost:8000/

## list containers: docker ps

## run migrations: docker exec {{ your_container_name }}  php artisan migrate

## run tests: docker exec {{ your_container_name }}  vendor/bin/phpunit tests


