FROM ubuntu:20.04

# Setup pre-requisites

ENV DEBIAN_FRONTEND noninteractive

ARG APP_REGION
ENV APP_REGION $APP_REGION

WORKDIR /var/www

# Setup server timezone
RUN ln -snf /usr/share/zoneinfo/UTC /etc/localtime && echo UTC > /etc/timezone

# Install system dependencies
RUN apt-get update \
    && apt-get install -y \
        wget curl apt-transport-https \
        software-properties-common dirmngr  \
        lsb-release libpng-dev libonig-dev \
        libxml2-dev gnupg gosu ca-certificates \
        zip unzip git rsync sqlite3 libcap2-bin python3

RUN mkdir -p ~/.gnupg \
    && chmod 600 ~/.gnupg \
    && echo "disable-ipv6" >> ~/.gnupg/dirmngr.conf \
    && apt-key adv --homedir ~/.gnupg --keyserver hkp://keyserver.ubuntu.com:80 --recv-keys E5267A6C \
    && apt-key adv --homedir ~/.gnupg --keyserver hkp://keyserver.ubuntu.com:80 --recv-keys C300EE8C \
    && echo "deb http://ppa.launchpad.net/ondrej/php/ubuntu $(lsb_release -sc) main" | tee /etc/apt/sources.list.d/php.list \
    && wget -q https://packages.sury.org/php/apt.gpg -O- | apt-key add - \
    && apt-get update

RUN apt-get install -y \
        php7.4 php7.4-fpm \
        php7.4-cli php7.4-dev php7.4-sqlite3 \
        php7.4-gd php7.4-curl php7.4-memcached php7.4-imap php7.4-mysql \
        php7.4-mbstring php7.4-xml php7.4-zip php7.4-bcmath php7.4-soap \
        php7.4-intl php7.4-readline php7.4-msgpack php7.4-igbinary \
        php7.4-ldap php7.4-redis

RUN php -r "readfile('http://getcomposer.org/installer');" | php -- --install-dir=/usr/bin/ --filename=composer \
    && curl -sL https://deb.nodesource.com/setup_16.x | bash - \
    && apt-get install -y \
        build-essential nodejs \
    && apt-get -y autoremove \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/*

RUN curl -sS http://dl.yarnpkg.com/debian/pubkey.gpg | apt-key add - \
    && echo "deb http://dl.yarnpkg.com/debian/ stable main" > /etc/apt/sources.list.d/yarn.list \
    && apt-get update

RUN pecl channel-update https://pecl.php.net/channel.xml \
    && pecl install swoole \
    && pecl clear-cache \
    && rm -rf /tmp/* /var/tmp/*

RUN setcap "cap_net_bind_service=+ep" /usr/bin/php7.4

# Install application dependencies

RUN npm install -g pm2 \
    && pm2 startup \
    && rm /etc/php/7.4/fpm/pool.d/www.conf

# FINAL FILES

COPY bootstrap /usr/local/bin/app.bootstrap
COPY php.ini /etc/php/7.4/cli/conf.d/99-app.ini
COPY php-fpm-pool.conf /etc/php/7.4/fpm/pool.d/www.conf
RUN chmod +x /usr/local/bin/app.bootstrap

########################################################################################################################

RUN apt-get install -y php7.4-xdebug
RUN echo "[xdebug]" > /etc/php/7.4/cli/conf.d/20-xdebug.ini; \
    echo "zend_extension=xdebug.so" >> /etc/php/7.4/cli/conf.d/20-xdebug.ini; \
    echo "xdebug.mode=coverage" >> /etc/php/7.4/cli/conf.d/20-xdebug.ini

########################################################################################################################

ENTRYPOINT ["/usr/local/bin/app.bootstrap"]