# # Use the official image as a parent image.
FROM debian:buster

# # Set the working directory.
WORKDIR /var/www/html

# # Copy the srcs file from your host to your current location.
COPY srcs .

# # Run the command inside your image filesystem.
RUN apt-get update && apt-get -y install \
    nginx \
    php-fpm php-mysql \
    # php7.3 php7.3-fpm php7.3-mysql \
    # php-common php7.3-cli php7.3-common \
    # php7.3-json php7.3-opcache php7.3-readline
    mariadb-server \
    #mariadb-client?
    wget

# NGINX
# ADD command instead of copy?
# COPY ./srcs/nginx.conf .
RUN cp ./nginx.conf /etc/nginx/sites-available/localhost && \
    ln -s /etc/nginx/sites-available/localhost /etc/nginx/sites-enabled/localhost

#/usr/local/nginx/conf

# MARIADB
#COPY ./srcs/mariadb.sql .
# RUN service mysql start && mysql < ./mariadb.sql

# phpMyadmin
# RUN wget https://files.phpmyadmin.net/phpMyAdmin/5.0.2/phpMyAdmin-5.0.2-english.tar.gz && \
#     tar -xvf phpMyAdmin-5.0.2-english.tar.gz

# WORDPRESS
RUN wget https://wordpress.org/latest.tar.gz && \
    tar -xvf latest.tar.gz

# RUN apt-get install -y wordpress
#apt-get install -y mariadb-server mariadb-client

# # Inform Docker that the container is listening on the specified port at runtime.
# EXPOSE 80 

# # Run the specified command within the container.
#CMD ["echo", "hello world"]

# # Copy the rest of your app's source code from your host to your image filesystem.
# COPY script.sh /script.sh

CMD service nginx start && service mysql start && bash

# service nginx enable

# service mysql start   (starts mariadb)

# chown www-data:www-data /usr/share/nginx/html/ -R


# # old run met bash command
# COPY srcs/script.sh ~/script.sh

# CMD ["sh", "~/script.sh"]