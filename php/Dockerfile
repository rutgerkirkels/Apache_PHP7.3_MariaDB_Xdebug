FROM php:7.3.2-fpm-alpine3.9
MAINTAINER Rutger Kirkels <rutger@atention.nl>
RUN mv /usr/local/etc/php/php.ini-development /usr/local/etc/php/php.ini

# Install Xdebug
RUN apk --update --no-cache add autoconf g++ make git zip openldap-dev && \
    pecl install xdebug-beta && \
    docker-php-ext-enable xdebug && \
    apk del --purge autoconf g++ make

RUN docker-php-ext-install ldap pdo pdo_mysql

# Configure Xdebug to interact with PHPstorm
ENV XDEBUGINI_PATH=/usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini
ENV XDEBUG_CONFIG="remote_host=host.docker.internal"
ENV PHP_IDE_CONFIG="serverName=docker"
COPY xdebug.ini /tmp/xdebug.ini
RUN cat /tmp/xdebug.ini >> $XDEBUGINI_PATH

# Install Composer
RUN curl -o /tmp/composer-setup.php https://getcomposer.org/installer \
&& curl -o /tmp/composer-setup.sig https://composer.github.io/installer.sig \
# Make sure we're installing what we think we're installing!
&& php -r "if (hash('SHA384', file_get_contents('/tmp/composer-setup.php')) !== trim(file_get_contents('/tmp/composer-setup.sig'))) { unlink('/tmp/composer-setup.php'); echo 'Invalid installer' . PHP_EOL; exit(1); }" \
&& php /tmp/composer-setup.php --no-ansi --install-dir=/usr/local/bin --filename=composer --snapshot \
&& rm -f /tmp/composer-setup.*