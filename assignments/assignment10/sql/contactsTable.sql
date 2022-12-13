CREATE TABLE contacts (
    id INTEGER NOT NULL AUTO_INCREMENT,
    name TEXT NOT NULL,
    address TEXT NOT NULL,
    city TEXT NOT NULL,
    state VARCHAR(2) NOT NULL,
    phone VARCHAR(12) NOT NULL,
    email TEXT NOT NULL,
    dob VARCHAR(10) NOT NULL,
    contacts TEXT NOT NULL,
    age VARCHAR(5) NOT NULL,
    PRIMARY KEY (id)
) ENGINE = InnoDB;