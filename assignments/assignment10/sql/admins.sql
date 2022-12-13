CREATE TABLE admins (
    id INTEGER NOT NULL AUTO_INCREMENT,
    name TEXT NOT NULL,
    email TEXT NOT NULL,
    password TEXT NOT NULL,
    status VARCHAR(5) NOT NULL,
    PRIMARY KEY (id)
) ENGINE = InnoDB;