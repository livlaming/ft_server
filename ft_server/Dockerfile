# Use the official image as a parent image.
FROM debian:buster

# Set the working directory.
WORKDIR /tmp

# Copy the file from your host to your current location.
COPY ./srcs/* ./

# Update & install server + mariadb + php 
RUN apt-get update && apt-get -y install \
    nginx \
    php7.3-fpm \
    php-mysql \
    php-mbstring \
    mariadb-server \
    wget \
    openssl \
    sendmail

# Download + mv Phpmyadmin
RUN wget https://files.phpmyadmin.net/phpMyAdmin/5.0.2/phpMyAdmin-5.0.2-english.tar.gz && \
    tar -xvf phpMyAdmin-5.0.2-english.tar.gz && \
    rm phpMyAdmin-5.0.2-english.tar.gz && \
    mv ./phpMyAdmin-5.0.2-english phpmyadmin && \
    mv ./phpmyadmin /var/www/html/

# Download + mv Wordpress
RUN wget https://wordpress.org/latest.tar.gz && \
    tar -xvf latest.tar.gz && \
    rm latest.tar.gz && \
    mv ./wordpress/* /var/www/html

# overwrite files from srcs-folder
# default -> Configuring Nginx to Use the PHP Processor
# php.ini sets post min&max size, memory limit, execution time, time zone, etc
# phpmyadmin config -> config.inc.php -> contains the data to connect to a database
# wp-config.php -> contains your website’s base configuration details, such as database connection information.
# sets autoindex on or off with docker exec (run container in -d mode, check with docker exec)
RUN mv ./default /etc/nginx/sites-available/default && \
    mv ./php.ini /etc/php/7.3/fpm/php.ini && \
    mv ./config.inc.php /var/www/html/phpmyadmin/config.inc.php && \
    mv ./wp-config.php /var/www/html/ && \
    mv ./set_autoindex.sh /var/www/html/ && \
    chmod +x /var/www/html/set_autoindex.sh

# create user + database with Mariadb + create tables
RUN service mysql start && \
    mysql < ./mariadb.sql && \
    mysql phpmyadmin < /var/www/html/phpmyadmin/sql/create_tables.sql

# WP-CLI is the command-line interface for WordPress. You can update plugins, 
# configure multisite installations and much more, without using a web browser.
RUN service mysql start && \
    chmod +x /tmp/wp-cli.phar && \
    mv /tmp/wp-cli.phar /usr/local/bin/wp && \
	wp core install --url="https://localhost/"  --title="ft_server" --admin_user="lisa" --admin_password="password" --admin_email="livlamin@student.codam.nl" --allow-root --path="/var/www/html"

# SSL
RUN openssl req -x509 -nodes -days 365 -newkey rsa:2048 -subj '/C=NL/ST=Noord-Holland/L=Amsterdam/O=Codam/CN=123' -keyout /etc/ssl/certs/localhost.key -out /etc/ssl/certs/localhost.crt

# chown rights owner:group
RUN chmod 660 /var/www/html/phpmyadmin/config.inc.php && \
    chmod 664 /var/www/html/wp-config.php && \
    chown -R www-data:www-data /var/www/html

# Inform Docker that the container is listening on the specified port at runtime.
EXPOSE 80 443

CMD service php7.3-fpm start && \
	service nginx start && \
	service mysql start && \
	echo "$(hostname -i) $(hostname) $(hostname).localhost" >> /etc/hosts && \
	service sendmail start && \
    tail -f /dev/null