DROP DATABASE IF EXISTS myLibrary;
CREATE DATABASE myLibrary;
use myLibrary;

-- Book Table
  DROP TABLE IF EXISTS book;
  CREATE TABLE book (
    `id` SMALLINT UNSIGNED NOT NULL AUTO_INCREMENT,
    `title` VARCHAR(100) NOT NULL,
    `price` SMALLINT UNSIGNED NOT NULL,
    PRIMARY KEY (`id`),
    `author` VARCHAR(255),
    `year` SMALLINT UNSIGNED
  );


-- Insert some books
INSERT INTO book (`title`, `price`, `author`, `year`)
        VALUES 
            ("I Malavoglia", 19, "Giovanni Verga", 1881),
            ("Uno nessuno centomila", 11, "Luigi Pirandello", 1926),
            ("Pride and Prejudice", 9, "Jane Austen", 1813);
