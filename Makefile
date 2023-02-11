.PHONY: install
install:
	docker-compose up -d --build

.PHONY: up
up:
	docker-compose up -d

.PHONY: exec-php
exec-php:
	docker-compose exec php sh

.PHONY: down
down:
	docker-compose down