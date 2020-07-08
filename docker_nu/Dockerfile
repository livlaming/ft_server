# # Use the official image as a parent image.
FROM debian:buster

WORKDIR /tmp

RUN apt-get update && apt-get -y install \
        nginx

COPY ./srcs/default /etc/nginx/sites-available/default
RUN chown -R www-data:www-data /var/www/html/

EXPOSE 80 443

ENTRYPOINT service nginx start && bash