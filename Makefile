DCF=docker-compose -f docker-compose.production.yml

build-prod:
	$(DCF) build

start-prod:
	$(DCF) up

stop:
	$(DCF) stop $(c)

restart:
	$(DCF) restart $(c)

down:
	$(DCF) down $(tag)

logs:
	$(DCF) logs --tail=100 -f $(c)

bash:
	$(DCF) exec $(c) bash

artisan:
	$(DCF) exec app php artisan $(c)

app-command:
	$(DCF) exec app $(c)

docker-command:
	$(DCF) $(c)
