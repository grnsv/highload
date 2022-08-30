CREATE USER 'slave_read_user'@'%' IDENTIFIED BY 'Password@123';
GRANT REPLICATION SLAVE ON *.* TO slave_read_user@'%';
FLUSH PRIVILEGES;
