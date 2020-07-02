CREATE DATABASE wordpress;
CREATE DATABASE phpmyadmin;
CREATE USER 'lisa'@'localhost' identified by 'password';
GRANT ALL PRIVILEGES ON *.* TO 'lisa'@'localhost';
FLUSH PRIVILEGES;
