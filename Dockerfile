FROM php:8.2-cli

# install dependencies
RUN apt update \
        && apt install -y \
            git \
            libicu-dev \
            locales \
            locales-all \
            libzip-dev \
        && docker-php-ext-install \
            intl \
            opcache \
            fileinfo \
            bcmath \
            zip \
        && apt-get clean

# install composer
COPY --from=composer /usr/bin/composer /usr/bin/composer

# setup entrypoint
COPY entrypoint.sh /usr/local/bin/entrypoint.sh
ENTRYPOINT ["/usr/local/bin/entrypoint.sh"]
