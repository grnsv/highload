CHANGE MASTER TO MASTER_HOST='db-master', MASTER_USER='slave_read_user', MASTER_PASSWORD='Password@123';
-- RESET SLAVE;
START SLAVE;