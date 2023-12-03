CREATE TABLE food (
    id INT PRIMARY KEY AUTO_INCREMENT,
    food_name VARCHAR(255) NOT NULL,
    description VARCHAR(255) NOT NULL,
    category VARCHAR(255) NOT NULL,
    price VARCHAR(255) NOT NULL
);

CREATE TABLE restaurant (
    id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(255) NOT NULL,
    address VARCHAR(255) NOT NULL,
    city VARCHAR(255) NOT NULL,
    state VARCHAR(255) NOT NULL,
    zip_code VARCHAR(10) NOT NULL,
    phone VARCHAR(20) NOT NULL
);



CREATE TABLE attributes (
    id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(255) NOT NULL
);



INSERT INTO food (food_name, description, category, price)
VALUES ('Rice but not Fried', 'Yummy but sometimes',  'dinner/breakfast', '10.99');

INSERT INTO food (food_name, description, category, price)
VALUES ('Spaghetti Carbonara', ' pasta with bacon and eggs', 'Dinner', '10.9');

INSERT INTO food (food_name, description, category, price)
VALUES ('Margherita Pizza', ' tomato, mozzarella, and basil pizza', 'Dinner', '15.99');

INSERT INTO food (food_name, description, category, price)
VALUES ('Chicken ', ' fettuccine  with grilled chicken', 'Dinner', '10.99');

INSERT INTO food (food_name, description, category, price)
VALUES (' Burrito', 'Scrambled eggs, bacon, and cheese in a tortilla', 'Dinner', '6.99');

INSERT INTO food (food_name, description, category, price)
VALUES ('Grilled Salmon', 'Fresh salmon fillet with lemon butter sauce', 'Dinner', '11.99');

INSERT INTO food (food_name, description, category, price)
VALUES ('Caesar Salad', ' lettuce, croutons, and Caesar dressing', 'Lunch', '23.99');

INSERT INTO food (food_name, description, category, price)
VALUES ('Mushroom Risotto', 'Creamy rice dish with mushrooms and Parmesan', 'Dinner', '1400.99');

INSERT INTO food (food_name, description, category, price)
VALUES ('Pancake Stack', 'Fluffy pancakes served with maple syrup', 'Breakfast', '70.99');


INSERT INTO restaurant (name, address, city, state, zip_code, phone)
VALUES ('BIN BAN BOM', '130 Not cool ST', 'DIM DAM DON', 'CA', '69699', '(111) 222-1234');


INSERT INTO restaurant (name, address, city, state, zip_code, phone)
VALUES ('DI DA DO DU', '130 Cool ST', 'SKI BI DADDA YES YES', 'CA', '123456', '(999) 111-9876');



INSERT INTO attributes( name)
VALUES ('Breakfast');

INSERT INTO attributes( name)
VALUES ('Dinner');


INSERT INTO attributes( name)
VALUES ('Lunch');