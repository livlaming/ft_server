#! /bin/bash

if grep -nr "autoindex on;" /etc/nginx/sites-available/default > default

sed -i 's,^autoindex =.*$,autoindex off,' /etc/nginx/sites-available/default
