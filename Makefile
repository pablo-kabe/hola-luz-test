BASE_MAKEFILE_DIR := $(shell dirname $(realpath $(firstword $(MAKEFILE_LIST))))

setup:
	cp $(BASE_MAKEFILE_DIR)/.env.dist $(BASE_MAKEFILE_DIR)/.env
	cp $(BASE_MAKEFILE_DIR)/phpunit.xml.dist $(BASE_MAKEFILE_DIR)/phpunit.xml

init:
	@docker-compose up -d
	@docker-compose exec php composer install

test:
	@docker-compose exec php bin/phpunit

run:
	@docker-compose exec php bin/console app:import_file /app/resources/2016-readings.csv
