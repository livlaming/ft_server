-- mariadb?
-- CREATE DATABASE wordpress;
CREATE DATABASE phpmyadmin;
GRANT ALL ON phpmyadmin.* TO 'lisa'@'localhost' IDENTIFIED BY 'password' WITH GRANT OPTION;
FLUSH PRIVILEGES;
-- CREATE USER 'lisa'@'localhost' identified by 'password';
-- GRANT ALL PRIVILEGES ON *.* TO 'lisa'@'localhost';


-- GRANT ALL ON *.* TO 'phpmyadmin'@'localhost' IDENTIFIED BY 'password' WITH GRANT OPTION;
-- CREATE DATABASE wordpress;
-- GRANT ALL ON wordpress.* TO 'admin'@'localhost' IDENTIFIED BY 'password' WITH GRANT OPTION;

-- SET PASSWORD FOR 'example_user'@localhost = PASSWORD("");