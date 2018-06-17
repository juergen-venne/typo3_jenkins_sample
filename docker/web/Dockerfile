FROM php:7.2-apache-stretch

# Setup locale
RUN apt-get update \
    && apt-get install -y \
        locales \
    && rm -rf /var/lib/apt/lists/*
RUN localedef -i de_DE -c -f UTF-8 de_DE.utf8

# Install common tools
RUN apt-get update \
    && apt-get install -y \
        wget \
        rsync \
        unzip \
    && rm -rf /var/lib/apt/lists/*

# Install mysql client
RUN apt-get update \
    && apt-get install -y \
        mysql-client \
    && rm -rf /var/lib/apt/lists/*

# Install imagemagick
RUN apt-get update \
    && apt-get install -y \
        imagemagick \
    && rm -rf /var/lib/apt/lists/*
ENV TYPO3_GFX_PROCESSOR_PATH=/usr/bin/
ENV TYPO3_GFX_PROCESSOR_PATH_LZW=/usr/bin/

# Install apcu caching
RUN pecl install apcu \
    && docker-php-ext-enable apcu

# Install PHP extensions
RUN apt-get update \
    && apt-get install -y \
        libxml2-dev libfreetype6-dev \
        libjpeg62-turbo-dev \
        libmcrypt-dev \
        zlib1g-dev \
        python3 \
        python3-setuptools \
    && rm -rf /var/lib/apt/lists/*

RUN docker-php-ext-install -j$(nproc) \
        mysqli \
        soap \
        zip \
        intl

# Install php redis client
RUN pecl install -o -f redis \
    &&  rm -rf /tmp/pear \
    &&  docker-php-ext-enable redis

# PHP gd
RUN docker-php-ext-configure gd --with-freetype-dir=/usr/include/ --with-jpeg-dir=/usr/include/
RUN docker-php-ext-install -j$(nproc) gd

# Link php binary where TYPO3 expects it
RUN ln -s /usr/local/bin/php /usr/bin/php

# Configure PHP
COPY typo3.ini /usr/local/etc/php/conf.d/typo3.ini




# Configure Apache
RUN a2enmod rewrite
ADD 000-default.conf /etc/apache2/sites-available/000-default.conf

# Add startup script
ADD startup.sh /startup.sh
CMD ["/bin/bash", "/startup.sh"]
WORKDIR /app
EXPOSE 80
