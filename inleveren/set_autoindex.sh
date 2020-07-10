#! /bin/bash

if grep -nr "autoindex on;" /etc/nginx/sites-available/default > default

sed -i 's,^autoindex =.*$,autoindex off,' /etc/nginx/sites-available/default
sed -i "26s/autoindex.*/autoindex on;/g" /etc/nginx/sites-available/default