# # Use the official image as a parent image.
FROM debian:buster

# # Set the working directory.
# WORKDIR ./root

# # Copy the file from your host to your current location.
#COPY srcs .

# # Run the command inside your image filesystem.
RUN apt-get update -y && apt-get upgrade -y

# instal all 
RUN apt-get -y install \
    nginx \
    # php-fpm php-mysql \
    # mariadb-server mariadb-client \
    wget

# NGINX
# RUN service nginx start
# ADD command instead of copy?
COPY srcs/nginx.conf /usr/local/nginx/conf

# MARIADB
# RUN service mysql start


# PHP
# RUN apt-get install php-fpm php-mysql

# WORDPRESS
RUN wget https://wordpress.org/latest.tar.gz
RUN tar -xzvf latest.tar.gz

# RUN apt-get install -y wordpress
#apt-get install -y mariadb-server mariadb-client

# # Inform Docker that the container is listening on the specified port at runtime.
# EXPOSE 80 

# # Run the specified command within the container.
#CMD ["echo", "hello world"]

# # Copy the rest of your app's source code from your host to your image filesystem.
# COPY script.sh /script.sh

COPY srcs/script.sh ~/script.sh

# ENTRYPOINT ["/bin/bash", "~/script.sh"] of 
CMD ["~/script.sh"]

# service nginx enable

# service mysql start   (starts mariadb)

# chown www-data:www-data /usr/share/nginx/html/ -R
