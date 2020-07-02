# # Use the official image as a parent image.
FROM debian:buster

# # Set the working directory.
WORKDIR /var/www/html

# # Copy the srcs file from your host to your current location.
COPY srcs ./srcs

# 1. Update & install server
RUN apt-get update && apt-get -y install \
    nginx \
    php-fpm php-mysql \
    php-mbstring \
	php-gd \
    mariadb-server mariadb-client \
    wget \
    openssl \
    sendmail

# 2. create user + database with Mariadb
RUN service mysql start && \
    mysql < ./srcs/mariadb.sql

# 3. configuring nginx to use the php processor
RUN mv ./srcs/nginx.conf /etc/nginx/sites-available/localhost

# # # RUN mv ./srcs/default /etc/nginx/sites-enabled

# # phpMyadmin 
# # Download & config & install  phpmyadmin
RUN wget https://files.phpmyadmin.net/phpMyAdmin/5.0.2/phpMyAdmin-5.0.2-english.tar.gz && \
    tar -xvf phpMyAdmin-5.0.2-english.tar.gz && \
    rm phpMyAdmin-5.0.2-english.tar.gz

RUN mv ./phpMyAdmin-5.0.2-english /usr/share/phpmyadmin
COPY ./srcs/config.inc.php /usr/share/phpmyadmin

RUN chown -R www-data:www-data /usr/share/phpmyadmin 
# RUN chmod 660 /var/www/html/phpmyadmin/config.inc.php

# # overwrite php.ini from srcs-folder
# # php.ini sets post min&max size, memory limit, execution time, time zone
COPY ./srcs/php.ini /etc/php/7.3/fpm/php.ini

# # install WORDPRESS
RUN wget https://wordpress.org/latest.tar.gz && \
    tar -xvf latest.tar.gz && \
    rm latest.tar.gz

COPY ./srcs/wp-config.php /var/www/html/wordpress
RUN  chown -R www-data:www-data /var/www/html/wordpress

# CONFIG NGINX FOR WORDPRESS && enable the newly created virtual block
COPY ./srcs/wordpress.conf /etc/nginx/sites-available
RUN ln -s /etc/nginx/sites-available/wordpress.conf /etc/nginx/sites-enabled && \
    chown www-data:www-data /usr/share/nginx/html/ -R

# # 
# RUN wget https://raw.githubusercontent.com/wp-cli/builds/gh-pages/phar/wp-cli.phar && \
#     chmod +x wp-cli.phar && \
#     mv ./wp-cli.phar /usr/local/bin/wp
#     ./srcs/wp-completion.bash /FULL/PATH/TO/wp-completion.bash 

# SSL
RUN openssl req -x509 -nodes -days 365 -newkey rsa:2048 -subj '/C=NL/ST=Noord-Holland/L=Amsterdam/O=Codam/CN=123' -keyout /etc/ssl/certs/localhost.key -out /etc/ssl/certs/localhost.crt

# # Inform Docker that the container is listening on the specified port at runtime.
EXPOSE 80 443

CMD service nginx start && service mysql start && service php7.3-fpm start && bash
# bash of tail -f /dev/null om de container te laten runnen
 
# CMD ["nginx", "-g", "daemon off;"]
