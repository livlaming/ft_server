# # Use the official image as a parent image.
FROM debian:buster

# # Set the working directory.
WORKDIR /var/www/html

# # Copy the srcs file from your host to your current location.
COPY srcs .

# # Update & install server + mariadb + php 
RUN apt-get update && apt-get -y install \
    nginx \
    php-fpm php-mysql \
    php-mbstring \
	php-gd \
    mariadb-server mariadb-client \
    wget \
    openssl 
    # sendmail

# # create user + database with Mariadb
RUN service mysql start && \
    mysql < ./mariadb.sql

# # Configuring Nginx to Use the PHP Processor
COPY ./srcs/default /etc/nginx/sites-available/default

# # install Phpmyadmin
RUN wget https://files.phpmyadmin.net/phpMyAdmin/5.0.2/phpMyAdmin-5.0.2-english.tar.gz && \
    tar -xvf phpMyAdmin-5.0.2-english.tar.gz && \
    rm phpMyAdmin-5.0.2-english.tar.gz && \
    mv phpMyAdmin-5.0.2-english /var/www/html/phpmyadmin 
    # mv config.inc.php /var/www/html/phpmyadmin/config.inc.php && \
    # chmod 660 /var/www/html/phpmyadmin/config.inc.php && \
    # chown -R www-data:www-data /var/www/html/phpmyadmin && \
    # service php7.3-fpm restart && \
    # service nginx restart

EXPOSE 80

CMD service nginx start && service mysql start && service php7.3-fpm start && bash
