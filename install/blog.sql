SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

CREATE TABLE `posts` (
  `id` int(11) NOT NULL,
  `user_fk` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `body` text NOT NULL,
  `date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `posts` (`id`, `user_fk`, `title`, `body`, `date`) VALUES
(1, 1, 'Hello World', 'This is the first blog post!', '2021-11-04 12:00:00');

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `users` (`id`, `username`, `password`) VALUES
(1, 'admin', '$2y$10$D5Xy0fbHmIz1i0Scu3mD0Oa/eKUaaW/c6Zz0eu1kqsmLM76Cfxdry');

ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `posts_users` (`user_fk`);

ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);
  
ALTER TABLE `posts`
  ADD CONSTRAINT `posts_users` FOREIGN KEY (`user_fk`) REFERENCES `users` (`id`);
COMMIT;