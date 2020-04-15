-- CREATE TABLE user_login (
--   id int(11) NOT NULL AUTO_INCREMENT,
--   username varchar(255) NOT NULL,
--   Password varchar(100) NOT NULL,
--   PRIMARY KEY (id),
--   UNIQUE KEY username (username)
-- );

INSERT INTO user_login (username,Password) VALUES ('test','test@123');

-- in the form, enter password -> ' or 1 = '1 to demonstrate successful login without mysqli_real_escape_string being used in the corresponding php code (authen_login.php at /var/www/html), without this, valid passwords for existing users (entries in the mysql table user_login in database sql_injection_testing) also work, with mysql_real_escape_string being used, the above password results into invalid login credentials but even valid passwords do not work for existing users
-- TODO find out why this happens in case of valid passwords which do not have any special characters to be escaped (for passwords like password and test@123)
