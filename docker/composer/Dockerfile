FROM app:latest

RUN set -eux; \
    apt-get update -y; \
    apt-get install -y --no-install-recommends libzip-dev; \
    rm -rf /var/lib/apt/lists/*

RUN set -eux; \
    docker-php-ext-install zip;

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer
