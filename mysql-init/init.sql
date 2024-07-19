CREATE DATABASE IF NOT EXISTS todoapp;

GRANT ALL PRIVILEGES ON todoapp.* TO 'user'@'%';

USE todoapp;

CREATE TABLE IF NOT EXISTS User (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    mail_address VARCHAR(255) NOT NULL,
    password VARCHAR(255) NOT NULL,
    group_id INT,
    INDEX (group_id)  -- ここで group_id 列にインデックスを追加
);

CREATE TABLE IF NOT EXISTS tasks (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT,
    group_id INT,
    title VARCHAR(255) NOT NULL,
    description TEXT,
    type ENUM('personal', 'group') NOT NULL,
    completed BOOLEAN DEFAULT FALSE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES User(id) ON DELETE CASCADE,
    FOREIGN KEY (group_id) REFERENCES User(group_id) ON DELETE CASCADE
);

INSERT INTO User (name, mail_address, password, group_id) VALUES
('佐藤 一郎', 'sato@example.com', MD5('password123'), 1),
('田中 太郎', 'tanaka@example.com', MD5('password456'), 1);

INSERT INTO tasks (user_id, group_id, title, description, type) VALUES 
(1, 1, 'Sample Personal Task', 'This is a personal task for John Doe', 'personal'),
(2, 1, 'Sample Group Task', 'This is a group task for group 1', 'group');
