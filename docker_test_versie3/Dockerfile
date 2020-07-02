# # Use the official image as a parent image.
FROM debian:buster

# # Set the working directory.
WORKDIR /tmp

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
    mv ./phpMyAdmin-5.0.2-english /var/www/html/phpmyadmin && \
    mv ./config.inc.php /var/www/html/phpmyadmin/config.inc.php && \
    chmod 660 /var/www/html/phpmyadmin/config.inc.php && \
    chown -R www-data:www-data /var/www/html/phpmyadmin && \
    service php7.3-fpm start 


# # install WORDPRESS
RUN wget https://wordpress.org/latest.tar.gz && \
    tar -xvf latest.tar.gz && \
    rm latest.tar.gz && \
    mv ./wordpress /var/www/html/wordpress && \
    mv ./wp-config.php /var/www/html/wordpress && \
    chown -R www-data:www-data /var/www/html/wordpress

# # overwrite php.ini from srcs-folder
# # php.ini sets post min&max size, memory limit, execution time, time zone
COPY ./srcs/php.ini /etc/php/7.3/fpm/php.ini

# SSL
RUN openssl req -x509 -nodes -days 365 -newkey rsa:2048 -subj '/C=NL/ST=Noord-Holland/L=Amsterdam/O=Codam/CN=123' -keyout /etc/ssl/certs/localhost.key -out /etc/ssl/certs/localhost.crt

EXPOSE 80 443

CMD service nginx restart && service mysql start && service php7.3-fpm restart && bash
