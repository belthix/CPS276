CREATE TABLE files (
    file_id int NOT NULL AUTO_INCREMENT,
    file_name text NOT NULL,
    file_path text NOT NULL,
    PRIMARY KEY (file_id)
) ENGINE = InnoDB;