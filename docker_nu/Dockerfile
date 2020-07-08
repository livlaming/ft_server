# # Use the official image as a parent image.
FROM debian:buster

WORKDIR /tmp

RUN apt-get update && apt-get -y install \
        nginx \
        mariadb-server \
        mariadb-client \
        wget \
        openssl \
        php-fpm php-mysql \
        php-mbstring \
	    php-gd \
        php-zip \
        php-xml \
        php-pear \
        php-gettext \
        php-cgi \
        php7.3-fpm


# nginx installatie
COPY ./srcs/default /etc/nginx/sites-available/default

# config php
COPY ./srcs/php.ini etc/php/7.3/fpm/php.ini

# download phpmyadmin
RUN wget https://files.phpmyadmin.net/phpMyAdmin/5.0.2/phpMyAdmin-5.0.2-english.tar.gz &&\
    tar -xvf phpMyAdmin-5.0.2-english.tar.gz &&\
    rm phpMyAdmin-5.0.2-english.tar.gz &&\
    mv ./phpMyAdmin-5.0.2-english phpmyadmin &&\
    mv ./phpmyadmin /var/www/html/

# php configuration
COPY ./srcs/config.inc.php /var/www/html/phpmyadmin/

# RUN chmod 660 /var/www/html/phpmyadmin/config.inc.php &&\
#     chown -R www-data:www-data /var/www/html/phpmyadmin &&\
#     service nginx restart

RUN chown -R www-data:www-data /var/www/ &&\
    chmod -R 755 /var/www/html &&\
    service nginx restart

COPY ./srcs/mariadb.sql .
# # mysql installatie
RUN service mysql start &&\
        mysql < ./mariadb.sql
        # mysql phpmyadmin < var/www/html/phpmyadmin/sql/create_tables.sql
# system ngninx restart

EXPOSE 80 443

ENTRYPOINT service nginx start && service mysql start && service php7.3-fpm start && bash