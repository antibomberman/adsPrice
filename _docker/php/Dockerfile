FROM php:8.1-fpm


 #Copy composer.lock and composer.json
#COPY  ./composer.json /var/www/

# Set working directory
WORKDIR /var/www/backend

# Install dependencies
RUN apt-get update && apt-get install -y \
    cron \
    nano \
    mc \
    build-essential \
    libpng-dev \
    libjpeg62-turbo-dev \
    libfreetype6-dev \
    locales \
    zip \
    jpegoptim optipng pngquant gifsicle \
    unzip \
    git \
    curl



RUN apt-get clean && rm -rf /var/lib/apt/lists/*

# Install PHP extensions
ADD https://github.com/mlocati/docker-php-extension-installer/releases/latest/download/install-php-extensions /usr/local/bin/

RUN chmod +x /usr/local/bin/install-php-extensions && sync && install-php-extensions mbstring pdo_mysql zip exif pcntl gd


#RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
#
#RUN curl -sL https://deb.nodesource.com/setup_18.x| bash -
#RUN apt-get install -y nodejs


RUN groupadd -g 1000 www
RUN useradd -u 1000 -ms /bin/bash -g www www

RUN chown -R www:www /var/www/backend

COPY --chown=www:www . /var/www/backend

USER www


EXPOSE 9000
CMD ["php-fpm"]
