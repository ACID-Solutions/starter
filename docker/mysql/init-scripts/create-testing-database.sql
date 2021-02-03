CREATE DATABASE testing CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
CREATE USER testing@'%' IDENTIFIED BY 'secret';
GRANT ALL PRIVILEGES ON *.* TO testing@'%';

FLUSH PRIVILEGES;