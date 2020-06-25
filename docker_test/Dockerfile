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
    mariadb-server mariadb-client \
    # php-cgi \
	# php-common \
	# php-fpm \
	# php-pear \
	# php-mbstring \
	# php-zip \
	# php-net-socket \
	# php-gd \
	# php-xml-util \
	# php-gettext \
	# php-mysql \
	# php-bcmath \
    #mariadb-client?
    wget

# NGINX
# ADD command instead of copy?
# COPY ./srcs/nginx.conf . 
# RUN service nginx enable

#/usr/local/nginx/conf

# MARIADB
#COPY ./srcs/mariadb.sql .
RUN service mysql start && mysql < ./mariadb.sql

# PHP
RUN cp ./php.ini /etc/php/7.3/fpm/php.ini

# phpMyadmin
RUN wget https://files.phpmyadmin.net/phpMyAdmin/5.0.2/phpMyAdmin-5.0.2-english.tar.gz && \
    tar -xvf phpMyAdmin-5.0.2-english.tar.gz

# WORDPRESS
RUN wget https://wordpress.org/latest.tar.gz && \
    tar -xvf latest.tar.gz && \
    cp ./wp-config.php /var/www/html/wordpress && \
    chown -R www-data:www-data /var/www/html/wordpress

# cp ./wp-config.php . ?

# CONFIG NGINX FOR WORDPRESS && enable the newly created virtual block
RUN cp ./nginx.conf /etc/nginx/sites-available/localhost && \
    ln -s /etc/nginx/sites-available/localhost /etc/nginx/sites-enabled/localhost && \
    cp ./wordpress.conf /etc/nginx/sites-available/ 

# # Inform Docker that the container is listening on the specified port at runtime.
EXPOSE 80 

# # Run the specified command within the container.
#CMD ["echo", "hello world"]

# # Copy the rest of your app's source code from your host to your image filesystem.
# COPY script.sh /script.sh

CMD service nginx start && service mysql start && service php7.3-fpm start 

# service nginx enable

# service mysql start   (starts mariadb)

# chown www-data:www-data /usr/share/nginx/html/ -R


# # old run met bash command
# COPY srcs/script.sh ~/script.sh

# CMD ["sh", "~/script.sh"]