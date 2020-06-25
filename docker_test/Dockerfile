# # Use the official image as a parent image.
FROM debian:buster

# # Set the working directory.
WORKDIR /var/www/html

# # Copy the srcs file from your host to your current location.
COPY srcs .

# # Run the command inside your image filesystem.
# no upgrada & no maria-db client
RUN apt-get update && apt-get -y install \
    nginx \
    php-fpm php-mysql \
    php-mbstring \
	php-gd \
    mariadb-server mariadb-client \
    wget

# Mariadb 
RUN service mysql start && mysql < ./mariadb.sql

# PHP
RUN cp ./php.ini /etc/php/7.3/fpm/php.ini

# phpMyadmin
RUN wget https://files.phpmyadmin.net/phpMyAdmin/5.0.2/phpMyAdmin-5.0.2-english.tar.gz && \
    tar -xvf phpMyAdmin-5.0.2-english.tar.gz && \
    rm phpMyAdmin-5.0.2-english.tar.gz

# WORDPRESS
RUN wget https://wordpress.org/latest.tar.gz && \
    tar -xvf latest.tar.gz && \
    rm latest.tar.gz && \
    cp ./wp-config.php /var/www/html/wordpress && \
    chown -R www-data:www-data /var/www/html/wordpress

# DEFAULT
RUN cp ./default /etc/nginx/sites-enabled/

# CONFIG NGINX FOR WORDPRESS && enable the newly created virtual block
RUN cp ./wordpress.conf /etc/nginx/sites-available && \
    ln -s /etc/nginx/sites-available/wordpress.conf /etc/nginx/sites-enabled
    
RUN cp ./nginx.conf /etc/nginx/sites-available

# # Inform Docker that the container is listening on the specified port at runtime.
EXPOSE 80

# # Copy the rest of your app's source code from your host to your image filesystem.
# COPY script.sh /script.sh
CMD service nginx start && service mysql start && service php7.3-fpm start bash


# onzekerheden
# chown www-data:www-data /usr/share/nginx/html/ -R


# # old run met bash command
# COPY srcs/script.sh ~/script.sh

# CMD ["sh", "~/script.sh"]

# ADD command instead of copy?