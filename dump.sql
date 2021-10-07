SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

CREATE TABLE `posts` (
  `id` int(11) NOT NULL,
  `userId` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `body` text NOT NULL,
  `date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `posts` (`id`, `userId`, `title`, `body`, `date`) VALUES
(1, 1, 'Hello World!', 'Hello World!', '2021-10-07 12:16:33');

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `users` (`id`, `username`, `password`) VALUES
(1, 'admin', '$2y$10$TEDuKBRRaHof8hYNUVHP5.sLo.Glc8u99oQ0C3bvBcT2I4eOS7q4a');

ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `posts_users` (`userId`);

ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

ALTER TABLE `posts`
  ADD CONSTRAINT `posts_users` FOREIGN KEY (`userId`) REFERENCES `users` (`id`);
COMMIT;
