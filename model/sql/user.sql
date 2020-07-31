CREATE TABLE users (
  user_id int(11) NOT NULL,
  user_name varchar(200) NOT NULL,
  user_email varchar(100) not NULL,
  user_pass varchar(200) not null,
  PRIMARY KEY (user_id)
)
ALTER TABLE users
  MODIFY user_id int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

