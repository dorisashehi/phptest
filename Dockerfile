FROM php:8.1-apache


# Install dependencies
RUN apt-get update && \
    apt-get install -y npm libpq-dev libfreetype6-dev libjpeg62-turbo-dev libpng-dev libzip-dev zip libmagickwand-dev --no-install-recommends && \
    rm -rf /var/lib/apt/lists/*\
    apt-get install nano

# install mysqli
RUN docker-php-ext-install mysqli

# Increase memory limit
RUN echo "memory_limit=256M" > /usr/local/etc/php/conf.d/memory-limit.ini

# Install imagick
RUN mkdir -p /usr/src/php/ext/imagick; \
    curl -fsSL https://github.com/Imagick/imagick/archive/06116aa24b76edaf6b1693198f79e6c295eda8a9.tar.gz | tar xvz -C "/usr/src/php/ext/imagick" --strip 1;

# Install PHP extensions
RUN docker-php-ext-configure gd --with-freetype --with-jpeg && \
    docker-php-ext-install -j$(nproc) pdo pdo_pgsql pgsql gd zip imagick 

# Set up Apache virtual host
ENV APACHE_DOCUMENT_ROOT=/var/www/html/public
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf

# COPY apache-site.conf /etc/apache2/sites-available/000-default.conf
RUN a2enmod rewrite

# Install Composer
RUN php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');" && \
    php -r "if (hash_file('sha384', 'composer-setup.php') === '$(curl -sS https://composer.github.io/installer.sig)') { echo 'Installer verified'; } else { echo 'Installer corrupt'; unlink('composer-setup.php'); } echo PHP_EOL;" && \
    php composer-setup.php --quiet && \
    mv composer.phar /usr/local/bin/composer && \
    chmod +x /usr/local/bin/composer && \
    rm composer-setup.php


# RUN . $NVM_DIR/nvm.sh && \
#     nvm install --lts && \
#     nvm use --lts