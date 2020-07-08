FROM debian:buster

WORKDIR /tmp

RUN apt-get update && apt-get -y install \
    nginx \
        mariadb-server \
        mariadb client

COPY ./srcs/default /etc/nginx/sites-available
# EXPOSE 80

ENTRYPOINT  service nginx restart