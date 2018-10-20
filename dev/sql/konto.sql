USE c9;

DROP TABLE IF EXISTS accounts;

CREATE TABLE accounts (
    id INT(11) NOT NULL AUTO_INCREMENT,
    username VARCHAR(255) NOT NULL,
    password VARCHAR(255) NOT NULL,
    PRIMARY KEY (id)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;

INSERT INTO accounts VALUES 
    (null, "admin", "password");