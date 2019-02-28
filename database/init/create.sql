CREATE USER IF NOT EXISTS 'homestead'@'%' IDENTIFIED BY 'secret';
CREATE DATABASE IF NOT EXISTS homestead;
GRANT ALL ON `homestead`.* TO 'homestead'@'%' IDENTIFIED BY 'secret';

