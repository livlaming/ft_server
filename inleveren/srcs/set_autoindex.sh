#! /bin/bash

if [ "$1" == "off" ]
    sed -i 's/autoindex on/autoindex off/' /etc/nginx/sites-available/default && \
    service nginx restart
else if [ "$1" == "on" ]
    sed -i 's/autoindex off /autoindex on/' /etc/nginx/sites-available/default && \
    service nginx restart
fi