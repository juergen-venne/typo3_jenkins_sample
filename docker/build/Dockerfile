FROM ubuntu:18.04

ENV DEBIAN_FRONTEND=noninteractive

# Install common system tools
RUN apt-get update \
    && apt-get install -y \
        ca-certificates \
        gnupg \
        curl \
        wget \
        rsync \
        sudo \
        git \
        bzip2 \
    && rm -rf /var/lib/apt/lists/*

# Install composer
RUN apt-get update && apt-get install -y --no-install-recommends \
    php7.2-cli \
    php7.2-zip \
    php7.2-mbstring

RUN wget https://raw.githubusercontent.com/composer/getcomposer.org/1b137f8bf6db3e79a38a5bc45324414a6b1f9df2/web/installer -O - -q | php -- --quiet --install-dir=/usr/local/bin --filename=composer
ENV COMPOSER_ALLOW_SUPERUSER 1
ENV COMPOSER_NO_INTERACTION 1

WORKDIR /app

CMD ["/bin/bash", "-c", "/app/Build/install-dependencies.sh; /app/Build/build.sh"]
