# # Use the official image as a parent image.
FROM debian:buster

# # Set the working directory.
WORKDIR /var/www/html

# # Copy the srcs file from your host to your current location.
COPY srcs .

# # 1. Update & install server
RUN apt-get update && apt-get -y install \
    nginx \
    php-fpm php-mysql \
    php-mbstring \
	php-gd \
    mariadb-server mariadb-client \
    wget \
    openssl \
    sendmail

# # 2. create user + database with Mariadb
RUN service mysql start && \
    mysql < ./mariadb.sql

RUN mv ./default /etc/nginx/sites-available/

# # 3. download phpmyadmin + wordpress
RUN wget https://files.phpmyadmin.net/phpMyAdmin/5.0.2/phpMyAdmin-5.0.2-english.tar.gz && \
    tar -xvf phpMyAdmin-5.0.2-english.tar.gz && \
    rm phpMyAdmin-5.0.2-english.tar.gz && \
    mv ./phpMyAdmin-5.0.2-english /usr/share/phpmyadmin &&\
    wget https://wordpress.org/latest.tar.gz && \
    tar -xvf latest.tar.gz && \
    rm latest.tar.gz
    # mv ./config.inc.php /var/www/html/phpmyadmin

# COPY ./php.ini /etc/php/7.3/fpm/php.ini
 
# COPY ./wp-config.php /var/www/html/wordpress && \
# RUN chown -R www-data:www-data /var/www/html/wordpress

# RUN mv ./srcs/wordpress.conf /etc/nginx/sites-available && \
#     ln -s /etc/nginx/sites-available/wordpress.conf /etc/nginx/sites-enabled && \
#     chown www-data:www-data /usr/share/nginx/html/ -R

# # SSL
# RUN openssl req -x509 -nodes -days 365 -newkey rsa:2048 -subj '/C=NL/ST=Noord-Holland/L=Amsterdam/O=Codam/CN=123' -keyout /etc/ssl/certs/localhost.key -out /etc/ssl/certs/localhost.crt

# # Inform Docker that the container is listening on the specified port at runtime.
EXPOSE 80 443

CMD service nginx start && service mysql start && service php7.3-fpm start && bash
