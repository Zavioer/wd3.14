CREATE TABLE permission (
    id SERIAL PRIMARY KEY,
    name varchar(255) UNIQUE NOT NULL
);

INSERT INTO permission (name)
VALUES 
('USER_ADD'), ('USER_DELETE'), ('USER_MODIFY'), ('USER_READ'),
('CLIENT_ADD'), ('CLIENT_DELETE'), ('CLIENT_MODIFY'), ('CLIENT_READ'),
('PRODUCT_ADD'), ('PRODUCT_DELETE'), ('PRODUCT_MODIFY'), ('PRODUCT_READ'),
('ORDER_ADD'), ('ORDER_DELETE'), ('ORDER_MODIFY'), ('ORDER_READ')
;

CREATE TABLE role (
    id SERIAL PRIMARY KEY,
    name varchar(255) UNIQUE NOT NULL
);

INSERT INTO role (name) VALUES ('admin'), ('salesman'), ('analyst');

CREATE TABLE role_permission (
    role_id int,
    permission_id int,
    FOREIGN KEY (role_id) REFERENCES role (id),
    FOREIGN KEY (permission_id) REFERENCES permission (id),
    PRIMARY KEY (role_id, permission_id)
);

insert into role_permission (role_id, permission_id)
select 1, p.id
from permission p
where p.name like 'USER%'
    or p.name like 'CLIENT%'
    or p.name like 'PRODUCT%'
    or p.name like 'ORDER%';

INSERT INTO role_permission (role_id, permission_id)
SELECT 2, p.id
FROM permission p
WHERE p.name IN ('ORDER_ADD', 'ORDER_READ', 'ORDER_MODIFY', 'ORDER_DELTE',
                 'CLIENT_READ', 'PRODUCT_READ');

INSERT INTO role_permission (role_id, permission_id)
SELECT 3, p.id
FROM permission p
WHERE p.name LIKE '%_READ';


CREATE TABLE user_account (
    id SERIAL PRIMARY KEY,
    first_name varchar(255) NOT NULL,
    last_name varchar(255) NOT NULL,
    email varchar(255) UNIQUE NOT NULL,
    password varchar(255) NOT NULL,
    license_code varchar(255) UNIQUE NOT NULL,
    city varchar(255) NOT NULL,
    street varchar(255) NOT NULL,
    house_number varchar(10) NOT NULL,
    postal_code varchar(6) NOT NULL,
    role_id int,
    FOREIGN KEY (role_id) REFERENCES role (id)    
);

CREATE TABLE user_session (
    session_id varchar(255) PRIMARY KEY,
    user_id int,
    login_time timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES user_account
);


CREATE TABLE client (
    id SERIAL PRIMARY KEY,
    first_name varchar(255) NOT NULL,
    last_name varchar(255) NOT NULL,
    city varchar(255) NOT NULL,
    street varchar(255) NOT NULL,
    house_number varchar(10) NOT NULL,
    postal_code varchar(6) NOT NULL,
    phone varchar(9),
    email varchar(255),
    UNIQUE (first_name, last_name, city, street, house_number, postal_code, phone, email)
);

CREATE TABLE client_archive (
    id int,
    first_name varchar(255) NOT NULL,
    last_name varchar(255) NOT NULL,
    city varchar(255) NOT NULL,
    street varchar(255) NOT NULL,
    house_number varchar(10) NOT NULL,
    postal_code varchar(6) NOT NULL,
    phone varchar(9),
    email varchar(255)
);

CREATE TABLE orders (
    id SERIAL PRIMARY KEY,
    client_id int,
    salesman_id int,
    creation_date TIMESTAMP NOT NULL,
    finish_date TIMESTAMP,
    total_price NUMERIC DEFAULT 0 NOT NULL CHECK (total_price >= 0),
    discount NUMERIC DEFAULT 0 CHECK (discount >= 0),
    state varchar(255) NOT NULL,
    FOREIGN KEY (client_id) REFERENCES client (id) ON DELETE SET NULL,
    FOREIGN KEY (salesman_id) REFERENCES user_account (id) ON DELETE SET NULL
);

CREATE TABLE product_type (
    id SERIAL PRIMARY KEY,
    name varchar(255) UNIQUE NOT NULL
);
INSERT INTO product_type (name) VALUES ('electronics'), ('photovoltaics');


CREATE TABLE product (
    id SERIAL PRIMARY KEY,
    name varchar(255) NOT NULL UNIQUE,
    upc varchar(255) NOT NULL UNIQUE,
    description TEXT,
    price NUMERIC NOT NULL CHECK (price >= 0),
    uom varchar(10) NOT NULL,
    img_path varchar(255) DEFAULT '',
    product_type_id int,
    FOREIGN KEY (product_type_id) REFERENCES product_type (id) ON UPDATE CASCADE
);

CREATE TABLE orders_product (
    id serial PRIMARY KEY,
    product_id int,
    orders_id int,
    amount NUMERIC NOT NULL CHECK (amount >= 0),
    FOREIGN KEY (product_id) REFERENCES product (id) ON DELETE SET NULL,
    FOREIGN KEY (orders_id) REFERENCES orders (id),
    UNIQUE (product_id, orders_id)
);

CREATE TABLE warehouse (
    id SERIAL PRIMARY KEY,
    product_id int,
    quantity NUMERIC NOT NULL CHECK (quantity >= 0),
    FOREIGN KEY (product_id) REFERENCES product (id) ON DELETE CASCADE
);
