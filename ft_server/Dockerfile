# # Use the official image as a parent image.
FROM debian:buster

# # Set the working directory.
# WORKDIR ./root

# # Copy the file from your host to your current location.
#COPY srcs .

# # Run the command inside your image filesystem.
RUN apt-get update -y

# NGINX
RUN apt-get -y install nginx
#COPY ./srcs/nginx.conf /usr/local/nginx/conf

# MARIADB
RUN apt-get -y install mariadb-server

# WORDPRESS
RUN apt-get install -y wordpress
#apt-get install -y mariadb-server mariadb-client


# WORDPRESS
RUN apt 

#RUN nginx
#sed -e 's/# \.*multiverse$\)/\1\g' /etc/apt/sources.list 

# # Inform Docker that the container is listening on the specified port at runtime.
#EXPOSE 80 

# # Run the specified command within the container.
#CMD ["echo", "hello world"]

# # Copy the rest of your app's source code from your host to your image filesystem.
#COPY script.sh /script.sh

#CMD ["/script.sh"]
#CMD [bash]

# service nginx start    (nginx start)
# service nginx enable

# chown www-data:www-data /usr/share/nginx/html/ -R
