CREATE USER 'lisa'@'localhost' identified by 'password';
CREATE DATABASE wordpress;
CREATE DATABASE phpmyadmin;
GRANT ALL PRIVILEGES ON *.* TO 'lisa'@'localhost' IDENTIFIED BY 'password';
FLUSH PRIVILEGES;
