# Wally's Widgets

Wally's Widget Company is a widget wholesaler. They sell widgets in a variety of different pack sizes.

## Installation for local development
Copy `.env.example` to `.env` and configure environment variables.

Build and run Docker Compose:
```
docker-compose up -d
```

Ensure composer dependencies are installed:
```
docker-compose exec composer install
```

Prepare the database:
```
docker-compose exec app artisan migrate --seed
```

## Testing
To run the test suite:
```
docker-compose exec app vendor/bin/phpunit
```

To lint the code:
```
docker-compose exec app vendor/bin/phpcs
```
