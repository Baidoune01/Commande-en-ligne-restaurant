drop if exists database restaurant_database_lbd4;
create database restaurant_database_lbd4;

use restaurant_database_lbd4;

CREATE TABLE `users` (
  `id` int NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `email` varchar(100) NOT NULL UNIQUE,
  `password` varchar(100) NOT NULL,
  `role` enum('client', 'restaurateur') NOT NULL
);


CREATE TABLE `dishes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `description` text,
  `type` enum('sandwich', 'plat', 'portion', 'demi-portion') NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `is_dish_of_the_day` boolean NOT NULL DEFAULT false,
  PRIMARY KEY (`id`)
);

CREATE TABLE `orders` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `dish_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `status` enum('En attente', 'En cours de préparation', 'En cours de livraison', 'Livré') NOT NULL,
  `created_at` datetime NOT NULL,
  PRIMARY KEY (`id`),
  FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  FOREIGN KEY (`dish_id`) REFERENCES `dishes` (`id`)
);
drop table if exists ratings;
CREATE TABLE `ratings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `dish_id` int(11) NOT NULL,
  `rating` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  FOREIGN KEY (`dish_id`) REFERENCES `dishes` (`id`)
);

INSERT INTO `dishes` (`name`, `description`, `type`, `price`, `is_dish_of_the_day`) VALUES
('Spaghetti Bolognese', 'A classic Italian pasta dish with a delicious meat sauce.', 'plat', 12.99, false),
('Margherita Pizza', 'A simple and delicious pizza with tomato, mozzarella, and basil.', 'plat', 10.99, false),
('Grilled Salmon', 'Fresh salmon fillet, grilled to perfection.', 'plat', 15.99, false),
('Caesar Salad', 'Crispy romaine lettuce, parmesan cheese, and homemade Caesar dressing.', 'portion', 7.99, false),
('Chicken Sandwich', 'Grilled chicken breast with lettuce, tomato, and mayo on a toasted bun.', 'sandwich', 9.99, false),
('Beef Burger', 'Juicy beef patty with lettuce, tomato, pickles, and our special sauce on a toasted bun.', 'sandwich', 10.99, true);
