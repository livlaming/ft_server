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
    openssl \
    sendmail

# # Download + mv Phpmyadmin
RUN wget https://files.phpmyadmin.net/phpMyAdmin/5.0.2/phpMyAdmin-5.0.2-english.tar.gz && \
    tar -xvf phpMyAdmin-5.0.2-english.tar.gz && \
    rm phpMyAdmin-5.0.2-english.tar.gz && \
    mv ./phpMyAdmin-5.0.2-english phpmyadmin && \
    mv ./phpmyadmin /var/www/html/phpmyadmin && \
    chown -R www-data:www-data /var/www/html/phpmyadmin

# # Download + mv Wordpress
RUN wget https://wordpress.org/latest.tar.gz && \
    tar -xvf latest.tar.gz && \
    rm latest.tar.gz && \
    mv ./wordpress /var/www/html/

# # Configuring Nginx to Use the PHP Processor
COPY ./srcs/default /etc/nginx/sites-available/default

# # overwrite files from srcs-folder
# # php.ini sets post min&max size, memory limit, execution time, time zone
COPY ./srcs/php.ini /etc/php/7.3/fpm/php.ini

RUN service php7.3-fpm start


# RUN ln -s /usr/share/phpmyadmin /var/www/html/phpmyadmin
# # Configure phpmyadmin
COPY ./srcs/config.inc.php /var/www/html/phpmyadmin
# Install PHPMyAdmin config

# SSL
RUN openssl req -x509 -nodes -days 365 -newkey rsa:2048 -subj '/C=NL/ST=Noord-Holland/L=Amsterdam/O=Codam/CN=123' -keyout /etc/ssl/certs/localhost.key -out /etc/ssl/certs/localhost.crt
COPY ./srcs/mariadb.sql .

# # # create user + database with Mariadb & setup PHPMyAdmin config
# RUN service mysql start && \
#     mysql < ./mariadb.sql && \
#     chmod 660 /var/www/html/phpmyadmin/config.inc.php

RUN service mysql start && \
	mysql < /var/www/html/phpmyadmin/sql/create_tables.sql -u root && \
	mysql -e "GRANT ALL PRIVILEGES ON *.* TO 'admin'@'localhost' IDENTIFIED BY 'admin' WITH GRANT OPTION;FLUSH PRIVILEGES;" && \
	mysql -e "CREATE DATABASE wordpress;GRANT ALL PRIVILEGES ON wordpress.* TO 'admin'@'localhost' IDENTIFIED BY 'admin';FLUSH PRIVILEGES;" && \
	chmod 660 /var/www/html/phpmyadmin/config.inc.php

COPY ./srcs/wp-config.php /var/www/html/wordpress
COPY ./srcs/wp-cli.phar /tmp


# Install Wordpress
RUN service mysql start && \
    chmod +x /tmp/wp-cli.phar && \
    mv /tmp/wp-cli.phar /usr/local/bin/wp && \
	wp core install --url="https://localhost/wordpress"  --title="ft_server" --admin_user="lisa" --admin_password="password" --admin_email="livlamin@student.codam.nl" --allow-root --path="/var/www/html/wordpress"

# own webroot
RUN chown -R www-data:www-data /var/www/html/wordpress

EXPOSE 80 443

CMD service nginx start && service mysql start && service php7.3-fpm restart && service sendmail start && bash