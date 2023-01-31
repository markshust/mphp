CREATE TABLE `migrations` (
    `id` int NOT NULL AUTO_INCREMENT,
    `file` text,
    `created_at` datetime DEFAULT NULL,
    PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

INSERT INTO `migrations` (`id`, `file`, `created_at`) VALUES
    (1, 'create_migrations_table.sql', '2023-01-29 10:03:09');
