CREATE TABLE user(  
    username VARCHAR(255) NOT NULL PRIMARY KEY,
    passwd VARCHAR(255) NOT NULL
);

CREATE TABLE admin(  
    username VARCHAR(255) NOT NULL PRIMARY KEY,
    level VARCHAR(255) NOT NULL
);

CREATE TABLE cats(  
    id INTEGER PRIMARY KEY,
    username VARCHAR(255) NOT NULL,
    name VARCHAR(255),
    breed VARCHAR(255),
    age INT,
    sex VARCHAR(255),
    details VARCHAR(255),
    sterilization VARCHAR(255),
    FOREIGN KEY (username) REFERENCES user(username)
);

INSERT INTO user (username, passwd) VALUES ("Hamu", "Hamu346"), ("Muha", "Muha234");

INSERT INTO cats (username, name,breed,age,sex,details,sterilization) VALUES ("Hamu","Mishka","Burmese","2","male","docile and domestic cat","yes"),
("Muha","Ishi","Turkish Van","1","female","Wild, lots of energy","no");

INSERT INTO ADMIN (username, level) VALUES ("Hamu",1);

DROP TABLE cats;