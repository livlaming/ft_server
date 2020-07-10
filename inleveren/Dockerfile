# # Use the official image as a parent image.
FROM debian:buster

# # Set the working directory.
WORKDIR /tmp

COPY ./srcs/* ./

# # Update & install server + mariadb + php 
RUN apt-get update && apt-get -y install \
    nginx \
    php7.3-fpm \
    php-mysql \
    php-mbstring \
    mariadb-server \
    wget \
    openssl \
    sendmail

# # Download + mv Phpmyadmin
RUN wget https://files.phpmyadmin.net/phpMyAdmin/5.0.2/phpMyAdmin-5.0.2-english.tar.gz && \
    tar -xvf phpMyAdmin-5.0.2-english.tar.gz && \
    rm phpMyAdmin-5.0.2-english.tar.gz && \
    mv ./phpMyAdmin-5.0.2-english phpmyadmin && \
    mv ./phpmyadmin /var/www/html/

# # Download + mv WORDPRESS
RUN wget https://wordpress.org/latest.tar.gz && \
    tar -xvf latest.tar.gz && \
    rm latest.tar.gz && \
    mv ./wordpress/* /var/www/html

# # default -> Configuring Nginx to Use the PHP Processor
# # overwrite files from srcs-folder
# # php.ini sets post min&max size, memory limit, execution time, time zone
# # phpmyadmin config -> confif.inc 
# # wp config ->wp-condig.php
RUN mv ./default /etc/nginx/sites-available/default && \
    mv ./php.ini /etc/php/7.3/fpm/php.ini && \
    mv ./config.inc.php /var/www/html/phpmyadmin/config.inc.php && \
    mv ./wp-config.php /var/www/html/

# # create user + database with Mariadb + create tables
RUN service mysql start && \
    mysql < ./mariadb.sql && \
    mysql phpmyadmin < /var/www/html/phpmyadmin/sql/create_tables.sql

RUN service mysql start && \
    chmod +x /tmp/wp-cli.phar && \
    mv /tmp/wp-cli.phar /usr/local/bin/wp && \
	wp core install --url="https://localhost/"  --title="ft_server" --admin_user="lisa" --admin_password="password" --admin_email="livlamin@student.codam.nl" --allow-root --path="/var/www/html"

# # SSL
RUN openssl req -x509 -nodes -days 365 -newkey rsa:2048 -subj '/C=NL/ST=Noord-Holland/L=Amsterdam/O=Codam/CN=123' -keyout /etc/ssl/certs/localhost.key -out /etc/ssl/certs/localhost.crt

# # chown rights owner:group
RUN chmod 660 /var/www/html/phpmyadmin/config.inc.php && \
    chmod 664 /var/www/html/wp-config.php && \
    chown -R www-data:www-data /var/www/html

# # only for documentation
EXPOSE 80 443

CMD service php7.3-fpm start && \
	service nginx start && \
	service mysql start && \
	echo "$(hostname -i) $(hostname) $(hostname).localhost" >> /etc/hosts && \
	service sendmail start && \
	bash
