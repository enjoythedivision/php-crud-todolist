CREATE DATABASE todolist;

CREATE TABLE `users` (
 `id` int(11) NOT NULL AUTO_INCREMENT,
 `user_name` varchar(254) NOT NULL,
 `email` varchar(254) DEFAULT NULL,
 `password` varchar(100) NOT NULL,
 PRIMARY KEY (`id`),
 UNIQUE KEY `user_name` (`user_name`)
);

CREATE TABLE `tasks` (
 `id` int(11) NOT NULL AUTO_INCREMENT,
 `user_id` int(11) DEFAULT NULL,
 `title` varchar(255) NOT NULL,
 `description` text DEFAULT NULL,
 `type` enum('normal', 'urgent') NOT NULL DEFAULT 'normal',
 `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
 `status` enum('pending','in_progress','done') NOT NULL DEFAULT 'pending',
 PRIMARY KEY (`id`),
 KEY `user_id` (`user_id`),
 CONSTRAINT `tasks_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
); 

CREATE TABLE `notes` (
 `id` int(11) NOT NULL AUTO_INCREMENT,
 `user_id` int(11) DEFAULT NULL,
 `content` text NOT NULL,
 `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
 PRIMARY KEY (`id`),
 KEY `user_id` (`user_id`),
 CONSTRAINT `notes_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
);



-- add data to database
INSERT INTO users (user_name, email, password)
VALUES ('demo_user1', 'user1@example.com', 'demo_pass1'),
       ('demo_user2', 'user2@example.com', 'demo_pass2'),
       ('demo_user3', 'user3@example.com', 'demo_pass3');



INSERT INTO tasks (user_id, title, description, type, status)
VALUES (1, 'Make this page prettier', 'It looks a bit empty right now', 'normal', 'in_progress'),
       (1, 'Test', 'Description...', 'normal', 'pending'),
       (1, 'Another test', 'Description...', 'normal', 'done'),
       (1, 'Send project to somebody', 'I hope everything works', 'normal', 'done'),
       (1, 'Another test', 'Description...', 'urgent', 'done'),
       (2, 'Make this page prettier', 'It looks a bit empty right now', 'normal', 'in_progress'),
       (2, 'Test', 'Description...', 'urgent', 'pending'),
       (2, 'Another test', 'Description...', 'urgent', 'done'),
       (2, 'Send project to someone', 'I hope everything works', 'normal', 'done'),
       (2, 'Another test', 'Description...', 'urgent', 'pending');



INSERT INTO notes (user_id, content)
VALUES (1, 'This is a note'),
       (1, 'Another note'),
       (2, 'Note 1'),
       (2, 'Note 2'),
       (2, 'Note 3'),
       (3, 'Test');



