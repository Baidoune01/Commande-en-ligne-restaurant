drop if exists database restaurant;
create database restaurant;
use restaurant;

create table client (
    cid integer not null auto_increment primary key,
    cname varchar(255) not null,
    cemail VARCHAR(255) NOT NULL,
    cpassword varchar(255) not null
);

drop table diches;
CREATE TABLE dishes (
    did INT PRIMARY KEY AUTO_INCREMENT,
    dname VARCHAR(255) NOT NULL,
    price float,
    ddescription TEXT NOT NULL,
    dtype ENUM('sandwich', 'plat', 'portion', 'demi-portion') NOT NULL,
    is_dish_of_day BOOLEAN NOT NULL
);

create table orders (
    cid integer,
    did integer,
    status ENUM('En attente', 'En cours de préparation', 'En cours de livraison', 'Livrée') NOT NULL,
    foreign key (cid) references client(cid),
    foreign key (did) references diches(did),
    primary key (cid, did)
);

INSERT INTO dishes (dname, price, ddescription, dtype, is_dish_of_day)
VALUES ('Hamburger', 8.99, 'Pain, viande, fromage, tomate, salade, sauce', 'sandwich', 0),
       ('Pizza Margherita', 12.99, 'Tomate, mozzarella, basilic', 'plat', 1),
        ('Frites', 3.99, 'Pommes de terre coupées en bâtonnets et frites', 'portion', 0),
       ('Salade César', 9.99, 'Salade, poulet, croûtons, parmesan, sauce césar', 'plat', 0),
      ('Poulet rôti', 15.99, 'Poulet rôti entier, pommes de terre rôties, légumes de saison', 'plat', 0),
        ('Tartare de saumon', 14.99, 'Saumon frais, avocat, coriandre, oignon rouge, sauce soja', 'plat', 0),
       ('Glace vanille', 3.99, 'Glace à la vanille, chantilly', 'demi-portion', 0);