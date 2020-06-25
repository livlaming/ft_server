CREATE DATABASE wordpress;
CREATE DATABASE phpmyadmin;
CREATE USER 'lisa'@'localhost' identified by 'password';
GRANT ALL PRIVILEGES ON wpdb.* TO 'lisa'@'localhost';
FLUSH PRIVILEGES;
-- GRANT ALL ON *.* TO 'phpmyadmin'@'localhost' IDENTIFIED BY 'password' WITH GRANT OPTION;
-- CREATE DATABASE wordpress;
-- GRANT ALL ON wordpress.* TO 'admin'@'localhost' IDENTIFIED BY 'password' WITH GRANT OPTION;

-- SET PASSWORD FOR 'example_user'@localhost = PASSWORD("");