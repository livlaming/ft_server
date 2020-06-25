CREATE DATABASE wordpress;
GRANT ALL ON wordpress.* TO 'admin'@'admin' IDENTIFIED BY 'password' WITH GRANT OPTION;
FLUSH PRIVILEGES;
ALTER USER 'root'@'localhost' IDENTIFIED WITH mysql_native_password BY ''