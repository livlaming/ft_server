CREATE DATABASE wordpress;
GRANT ALL ON wordpress.* TO 'admin'@'admin' IDENTIFIED BY 'password' WITH GRANT OPTION;
FLUSH PRIVILEGES;
exit