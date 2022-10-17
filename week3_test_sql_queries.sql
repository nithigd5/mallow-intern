create table products
(
    id          int auto_increment,
    name        varchar(100) not null,
    description text         not null,
    price       float8       not null,
    seller      int          not null,
    in_stock    boolean      null,
    qty         int          null,
    category    tinytext     not null,
    constraint product_pk
        primary key (id)
);



INSERT INTO products(id, name, description, price, seller, in_stock, qty, category)
VALUES (1, "iPhone 13", "ROM: 256 GB, RAM: 16 GB", 59999.99, 1, true, 10, 'Smartphone');

INSERT INTO products(id, name, description, price, seller, in_stock, qty, category)
VALUES (2, "Macbook Pro M1", "ROM: 1024 GB, RAM: 32 GB", 159999.99, 1, true, 20, 'Laptop');

INSERT INTO products(id, name, description, price, seller, in_stock, qty, category)
VALUES (3, "Asus ROG 8", "ROM: 2048 GB, RAM: 64 GB", 259999.99, 2, true, 2, 'Laptop');


INSERT INTO products(id, name, description, price, seller, in_stock, qty, category)
VALUES (4, "Asus ROG PHONE 8", "ROM: 256 GB, RAM: 16 GB", 69999.99, 2, true, 5, 'Smartphone');


UPDATE products
SET name = "Asus ROG R8",
    qty  = 4 and in_stock = false
WHERE id = 3;

DELETE
FROM products
WHERE id = 2;

SELECT *
FROM products ORDER BY id DESC;

SELECT *
FROM products
WHERE seller = 1;

SELECT *
FROM products
WHERE category = 'Laptop';