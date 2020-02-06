SHELL=/bin/bash -e

.DEFAULT_GOAL := help

COMPOSE_PROJECT_NAME="Fighting For Artifacts"

help: ## This help
	@awk 'BEGIN {FS = ":.*?## "} /^[a-zA-Z_-]+:.*?## / {printf "\033[36m%-30s\033[0m %s\n", $$1, $$2}' $(MAKEFILE_LIST)

build: ## Билд проекта
	@docker-compose build --build-arg user_uid=$$(id -u) app
	@docker-compose build --build-arg user_uid=$$(id -u) web

up:
	@docker-compose up -d

down:
	@docker-compose kill

composer-install:
	@docker-compose exec app composer install

env:
	@docker-compose exec app bash -c '[ -e "/var/www/.env" ] && echo "Env file exists" || cp /var/www/.env.example /var/www/.env'

key:
	@docker-compose exec app php artisan key:generate

migrate:
	@docker-compose exec app php artisan migrate

prepare-db:
	@docker-compose exec app mkdir ./dbdata
	@docker-compose exec app touch ./dbdata/local.db
	@docker-compose exec app touch ./dbdata/test.db

prepare-app: up composer-install env key prepare-db migrate

run-tests: up
	@@docker-compose exec app bash -c ./vendor/bin/phpunit

bash:
	@docker-compose exec app bash

default: help
