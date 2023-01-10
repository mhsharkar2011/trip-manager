FROM php:8.1-apache

# 1. development packages
RUN apt-get update && apt-get install -y --no-install-recommends \
  apt-utils \
  g++ \
  zip \
  unzip \
  dh-make \
  libicu-dev \
  libbz2-dev \
  libssl-dev \
  libpng-dev \
  libonig-dev \
  libzip-dev \
  libjpeg-dev \
  libxml2-dev \
  libc-client-dev \
  libkrb5-dev \
  libreadline-dev \
  libmcrypt-dev \
  libfreetype6-dev \
  libonig-dev && \
  # cleanup
  apt-get clean && \
  apt-get autoclean && \
  rm -rf /var/lib/apt/lists/* && \
  curl -sSLo pickle https://github.com/FriendsOfPHP/pickle/releases/latest/download/pickle.phar && \
  chmod +x pickle && \
  mv ./pickle /usr/local/bin/ && \
  # Hide PHP version header
  { echo 'expose_php = Off'; } > $PHP_INI_DIR/conf.d/expose_php.ini && \
  # Hide Apache version
  { \
  echo ''; \
  echo '# Hide Apache version'; \
  echo 'ServerTokens ProductOnly'; \
  echo 'ServerSignature Off'; \
  } >> $APACHE_CONFDIR/apache2.conf && \
  mv "$PHP_INI_DIR/php.ini-development" "$PHP_INI_DIR/php.ini" && \
  docker-php-ext-configure imap --with-kerberos --with-imap-ssl && \
  docker-php-ext-configure gd --with-freetype=/usr/include/ --with-jpeg=/usr/include/ && \
  docker-php-ext-install soap bz2 intl iconv bcmath opcache calendar mbstring pdo_mysql mysqli gd zip phar imap exif sockets && \
  pickle install mcrypt && \
  pickle install xmlrpc && \
  docker-php-ext-enable mcrypt xmlrpc && \
  a2enmod rewrite headers ssl proxy_http proxy_ajp proxy_html proxy_connect deflate proxy_balancer xml2enc && \
  # composer
  cd /tmp && curl -sS https://getcomposer.org/installer | php && mv composer.phar /usr/local/bin/composer

