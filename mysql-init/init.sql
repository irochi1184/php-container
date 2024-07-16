CREATE DATABASE IF NOT EXISTS todoapp;

GRANT ALL PRIVILEGES ON todoapp.* TO 'user'@'%';

USE todoapp;

CREATE TABLE IF NOT EXISTS tasks (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    description TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

INSERT INTO tasks (title, description) VALUES 
('Sample Task 1', 'This is the first sample task'),
('Sample Task 2', 'This is the second sample task');

CREATE TABLE IF NOT EXISTS User (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    mail_address VARCHAR(255) NOT NULL,
    password VARCHAR(255) NOT NULL
);

INSERT INTO User (name, mail_address, password) VALUES
('佐藤 一郎', 'sato@example.com', MD5('password123')),
('木下 たかし', 'kinoshita@example.com', MD5('password456'));
