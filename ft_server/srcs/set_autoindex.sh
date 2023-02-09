#! /bin/bash

if [ "$1" == "off" ]
then
    sed -i 's/autoindex on/autoindex off/' /etc/nginx/sites-available/default && \
    service nginx restart
elif [ "$1" == "on" ]
then
    sed -i 's/autoindex off/autoindex on/' /etc/nginx/sites-available/default && \
    service nginx restart
fi