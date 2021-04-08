#!make
include .env

#.PHONY: help
help:
	@awk 'BEGIN {FS = ":.*?## "} /^[a-zA-Z_-]+:.*?## / {printf "\033[36m%-30s\033[0m %s \n", $$1, $$2}' $(MAKEFILE_LIST)

## network
network: ## create rito-network
	docker network ls | grep rito-network > /dev/null || docker network create --driver bridge rito-network

## app
docker-compose = docker-compose -f $(MAKE_DOCKER_COMPOSE_FILES)

ps: ## docker-compose -f docker-compose.yml ps
	$< $(docker-compose) ps

build: ## docker-compose -f docker-compose.yml build
	$< $(docker-compose) build

up: ## docker-compose -f docker-compose.yml up -d
	$< $(docker-compose) up -d

stop: ## docker-compose -f docker-compose.yml stop
	$< $(docker-compose) stop

logs: ## docker-compose -f docker-compose.yml logs -f --tail=100
	$< $(docker-compose) logs -f --tail=100

top: ## docker-compose -f docker-compose.yml top
	$< $(docker-compose) top

php:  ## docker-compose -f docker-compose.yml exec -u www-data php-fpm bash
	$< $(docker-compose) exec -u www-data php-fpm bash

