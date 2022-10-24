FROM php:7.4.8-fpm
COPY php.ini /usr/local/etc/php/
# COPY settings/php.ini /usr/local/etc/php/conf.d/php.ini
# RUN cp /usr/local/etc/php/php.ini-production /usr/local/etc/php/php.ini

RUN apt-get update \ 
    && docker-php-ext-install pdo_mysql \
    && apt-get install libmagickwand-dev -y --no-install-recommends \
    && pecl install imagick-3.4.3 \
    && docker-php-ext-enable imagick

RUN php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');" \
  && php -r "if (hash_file('sha384', 'composer-setup.php') === '55ce33d7678c5a611085589f1f3ddf8b3c52d662cd01d4ba75c0ee0459970c2200a51f492d557530c71c15d8dba01eae') { echo 'Installer verified'; } else { echo 'Installer corrupt'; unlink('composer-setup.php'); } echo PHP_EOL;" \
  && php composer-setup.php \
  && php -r "unlink('composer-setup.php');" \
  && mv composer.phar /usr/local/bin/composer