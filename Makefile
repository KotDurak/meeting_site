up:
	docker-compose up -d; \
	 echo http://localhost:8080
down:
	docker-compose down -v
dev:
	docker-compose run --rm --service-ports npm run dev
build:
	docker-compose run --rm  npm run build
ch_build:
	sudo chmod -R 777 src/public/build/
migrate:
	docker-compose run --rm artisan migrate
install:
	docker-compose run --rm composer install
init:
	docker-compose run --rm composer create-project laravel/laravel:^10.0 .
npm_i:
	docker-compose run --rm npm install
unit:
	docker-compose run --rm artisan test --testsuite=Unit --stop-on-failure
