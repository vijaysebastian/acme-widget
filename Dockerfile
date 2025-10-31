FROM php:8.3-cli-alpine

WORKDIR /app

RUN docker-php-ext-install -j$(nproc) bcmath || true

COPY . /app

CMD ["php", "-v"]