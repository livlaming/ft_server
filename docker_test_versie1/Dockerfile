# # Use the official image as a parent image.
FROM debian:buster

# # Set the working directory.
WORKDIR /tmp

# # Update & install
# # no upgrade & no maria-db client
RUN apt-get update && apt-get -y install \
        nginx \
        php-fpm php-mysql \
        php-mbstring \
	    php-gd \
        php-zip \
        php7.3-fpm \
        mariadb-server mariadb-client \
        wget \
        openssl \
        sendmail


# # phpMyadmin 
# # Download & config & install  phpmyadmin
RUN wget https://files.phpmyadmin.net/phpMyAdmin/5.0.2/phpMyAdmin-5.0.2-english.tar.gz && \
    tar -xvf phpMyAdmin-5.0.2-english.tar.gz && \
    rm phpMyAdmin-5.0.2-english.tar.gz && \
    mv ./phpMyAdmin-5.0.2-english /usr/share/phpmyadmin && \
    chown -R www-data:www-data /usr/share/phpmyadmin
    # chmod 660 /var/www/html/phpmyadmin/config.inc.php

COPY ./srcs/config.inc.php /usr/share/phpmyadmin

# PHP
COPY ./srcs/php.ini /etc/php/7.3/fpm/php.ini
COPY ./srcs/mariadb.sql .
COPY ./srcs/wp-config.php /var/www/html/wordpress

# Mariadb 
RUN service mysql start && \
    mysql < ./mariadb.sql

# WORDPRESS
RUN wget https://wordpress.org/latest.tar.gz && \
    tar -xvf latest.tar.gz && \
    rm latest.tar.gz && \
    chown -R www-data:www-data /var/www/html/wordpress

# DEFAULT
COPY ./srcs/default /etc/nginx/sites-available
COPY ./srcs/wordpress.conf /etc/nginx/sites-available

# CONFIG NGINX FOR WORDPRESS && enable the newly created virtual block
RUN ln -s /etc/nginx/sites-available/wordpress.conf /etc/nginx/sites-enabled

# SSL
RUN openssl req -x509 -nodes -days 365 -newkey rsa:2048 -subj '/C=NL/ST=Noord-Holland/L=Amsterdam/O=Codam/CN=123' -keyout /etc/ssl/certs/localhost.key -out /etc/ssl/certs/localhost.crt

# # Inform Docker that the container is listening on the specified port at runtime.
EXPOSE 80 443

# # Copy the rest of your app's source code from your host to your image filesystem.
# COPY script.sh /script.sh
CMD service nginx start && service mysql start && service php7.3-fpm start && bash
