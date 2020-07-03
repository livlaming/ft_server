# # Use the official image as a parent image.
FROM debian:buster

# # Set the working directory.
WORKDIR /tmp

# # Update & install server + mariadb + php 
RUN apt-get update && apt-get -y install \
    nginx \
    php-fpm php-mysql \
    php-mbstring \
	php-gd \
    php-zip \
    php7.3-fpm \
    mariadb-server mariadb-client \
    wget \
    openssl 
    # sendmail

# # create user + database with Mariadb
COPY ./srcs/mariadb.sql .
RUN service mysql start && \
    mysql < ./mariadb.sql

# # Configuring Nginx to Use the PHP Processor
COPY ./srcs/default /etc/nginx/sites-available/default

# # overwrite php.ini from srcs-folder
# # php.ini sets post min&max size, memory limit, execution time, time zone
COPY ./srcs/php.ini /etc/php/7.3/fpm/php.ini

# # install Phpmyadmin
RUN wget https://files.phpmyadmin.net/phpMyAdmin/5.0.2/phpMyAdmin-5.0.2-english.tar.gz && \
    tar -xvf phpMyAdmin-5.0.2-english.tar.gz && \
    rm phpMyAdmin-5.0.2-english.tar.gz && \
    mv ./phpMyAdmin-5.0.2-english phpmyadmin && \
    mv ./phpmyadmin /var/www/html/

COPY ./srcs/config.inc.php /var/www/html/phpmyadmin/config.inc.php
    
RUN chmod 660 /var/www/html/phpmyadmin/config.inc.php && \
    chown -R www-data:www-data /var/www/html/phpmyadmin && \
    service php7.3-fpm start
    # service nginx reload

# # install WORDPRESS
RUN wget https://wordpress.org/latest.tar.gz && \
    tar -xvf latest.tar.gz && \
    rm latest.tar.gz && \
    mv ./wordpress/* /var/www/html/
    
COPY ./srcs/wp-config.php /var/www/html/

RUN  chmod 664 /var/www/html/wp-config.php

RUN chown -R www-data:www-data /var/www/

# # install en use wp cli
# RUN wget https://raw.githubusercontent.com/wp-cli/builds/gh-pages/phar/wp-cli.phar && \
#     tar -xvf wp-cli.phar && \
#     mv wp-cli.phar /var/www/html && \
#     chmod +x wp-cli.phar

# SSL
RUN openssl req -x509 -nodes -days 365 -newkey rsa:2048 -subj '/C=NL/ST=Noord-Holland/L=Amsterdam/O=Codam/CN=123' -keyout /etc/ssl/certs/localhost.key -out /etc/ssl/certs/localhost.crt

EXPOSE 80 443

CMD service nginx restart && service mysql start && service php7.3-fpm restart && bash
