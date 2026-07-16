FROM php:8.3-fpm

# Install system dependencies, PHP extensions, and debugging tools
RUN apt-get update && apt-get install -y \
    git \
    unzip \
    curl \
    wget \
    dnsutils \
    iputils-ping \
    libicu-dev \
    libzip-dev \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    libsodium-dev \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j$(nproc) \
    intl \
    pdo \
    pdo_mysql \
    zip \
    gd \
    bcmath \
    sodium

# Set timezone for PHP
RUN echo "date.timezone = Europe/Paris" >> /usr/local/etc/php/conf.d/docker-php-ext-timezone.ini

# Create and set permissions for /tmp (required for Faker)
RUN mkdir -p /tmp && chmod 1777 /tmp

# Create necessary directories and set permissions
RUN mkdir -p /var/www/symfony/var/tmp && \
    chown -R www-data:www-data /var/www/symfony/var/tmp && \
    chmod -R 777 /var/www/symfony/var/tmp

# Align the UID of www-data with the host user (1000)
RUN usermod -u 1000 www-data

# Install Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# For local development
RUN curl -sS https://get.symfony.com/cli/installer | bash && \
    mv /root/.symfony5/bin/symfony /usr/local/bin/symfony

# Set the working directory as safe for Git
RUN git config --global --add safe.directory /var/www/symfony

# Create the uploads directory and set permissions
RUN mkdir -p /var/www/symfony/public/uploads/figures && \
    chown -R www-data:www-data /var/www/symfony/public/uploads/figures && \
    chmod -R 775 /var/www/symfony/public/uploads/figures

ARG APP_DIR=/var/www/symfony
WORKDIR ${APP_DIR}