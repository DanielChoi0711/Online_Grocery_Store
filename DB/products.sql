CREATE DATABASE assignment1;
USE assignment1;

-- ----------------------------
-- Table structure for categories
-- ----------------------------
DROP TABLE IF EXISTS `categories`;
CREATE TABLE `categories` (
  `category_id` INT AUTO_INCREMENT PRIMARY KEY,
  `category_name` VARCHAR(50) NOT NULL
);

INSERT INTO categories (category_id, category_name) VALUES
(1, 'Fruits'),
(2, 'Vegetables'),
(3, 'Living Items'),
(4, 'Pet Supplies'),
(5, 'Dairy Products'),
(6, 'Frozen Food'),
(7, 'Beverages & Snacks'),
(8, 'Meats');

-- ----------------------------
-- Insert categories (1~8까지)
-- ----------------------------
INSERT INTO `categories` (category_name) VALUES ('Fruits');
INSERT INTO `categories` (category_name) VALUES ('Vegetables');
INSERT INTO `categories` (category_name) VALUES ('Living Items');
INSERT INTO `categories` (category_name) VALUES ('Pet Supplies');
INSERT INTO `categories` (category_name) VALUES ('Dairy Products');
INSERT INTO `categories` (category_name) VALUES ('Frozen Foods');
INSERT INTO `categories` (category_name) VALUES ('Meats');
INSERT INTO `categories` (category_name) VALUES ('Beverages and Snacks');

-- ----------------------------
-- Table structure for products
-- ----------------------------
DROP TABLE IF EXISTS `products`;
CREATE TABLE `products` (
  `product_id` INT(10) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  `product_name` VARCHAR(100) DEFAULT NULL,
  `unit_price` FLOAT(8,2) DEFAULT NULL,
  `unit_quantity` VARCHAR(15) DEFAULT NULL,
  `in_stock` INT(10) UNSIGNED DEFAULT NULL,
  `category_id` INT(10), -- Adding category_id to associate products with categories
  `image_path` VARCHAR(255) DEFAULT NULL,
  FOREIGN KEY (`category_id`) REFERENCES `categories`(`category_id`)
);

-- ----------------------------
-- Records of products (9번 카테고리 없애고 1~8로만 수정)
-- ----------------------------
INSERT INTO `products` (product_name, unit_price, unit_quantity, in_stock, category_id) VALUES 
('Fish Fingers', 2.55, '500 gram', 1500, 1),  -- Category 'Fruits'
('Fish Fingers', 5.00, '1000 gram', 750, 1),
('Hamburger Patties', 2.35, 'Pack 10', 1200, 8),  -- Category 'Meats'
('Shelled Prawns', 6.90, '250 gram', 300, 6),
('Tub Ice Cream', 1.80, 'I Litre', 800, 6),  -- Category 'Frozen Foods'
('Tub Ice Cream', 3.40, '2 Litre', 1200, 6),
('Panadol', 3.00, 'Pack 24', 2000, 3),  -- Category 'Beverages and Snacks'
('Panadol', 5.50, 'Bottle 50', 1000, 3),
('Bath Soap', 2.60, 'Pack 6', 500, 3),
('Garbage Bags Small', 1.50, 'Pack 10', 500, 3),
('Garbage Bags Large', 5.00, 'Pack 50', 300, 3),
('Washing Powder', 4.00, '1000 gram', 800, 3),
('Cheddar Cheese', 8.00, '500 gram', 1000, 5),  -- Category 'Dairy Products'
('Cheddar Cheese', 15.00, '1000 gram', 1000, 5),
('T Bone Steak', 7.00, '1000 gram', 200, 8),  -- Category 'Meats'
('Navel Oranges', 3.99, 'Bag 20', 200, 1),  -- Category 'Fruits'
('Bananas', 1.49, 'Kilo', 400, 1),
('Peaches', 2.99, 'Kilo', 500, 1),
('Grapes', 3.50, 'Kilo', 200, 1),
('Apples', 1.99, 'Kilo', 500, 1),
('Earl Grey Tea Bags', 2.49, 'Pack 25', 1200, 7),  -- Category 'Beverages and Snacks'
('Earl Grey Tea Bags', 7.25, 'Pack 100', 1200, 7),
('Earl Grey Tea Bags', 13.00, 'Pack 200', 800, 7),
('Instant Coffee', 2.89, '200 gram', 500, 7),
('Instant Coffee', 5.10, '500 gram', 500, 7),
('Chocolate Bar', 2.50, '500 gram', 300, 7),
('Dry Dog Food', 5.95, '5 kg Pack', 400, 4),  -- Category 'Pet Supplies'
('Dry Dog Food', 1.95, '1 kg Pack', 400, 4),
('Bird Food', 3.99, '500g packet', 200, 4),
('Cat Food', 2.00, '500g tin', 200, 4),
('Fish Food', 3.00, '500g packet', 200, 4),
('Laundry Bleach', 3.55, '2 Litre Bottle', 500, 3);  -- Category 'Beverages and Snacks'

UPDATE products SET image_path = 'Fish_fingers_500.png' WHERE product_name = 'Fish Fingers' AND unit_quantity = '500 gram';
UPDATE products SET image_path = 'Fish_fingers_1000.png' WHERE product_name = 'Fish Fingers' AND unit_quantity = '1000 gram';
UPDATE products SET image_path = 'hamburger_patties.png' WHERE product_name = 'Hamburger Patties';
UPDATE products SET image_path = 'shelled_prawns.png' WHERE product_name = 'Shelled Prawns';
UPDATE products SET image_path = 'ice_cream_1l.png' WHERE product_name = 'Tub Ice Cream' AND unit_quantity = 'I Litre';
UPDATE products SET image_path = 'ice_cream_1l.png' WHERE product_name = 'Tub Ice Cream' AND unit_quantity = '2 Litre';
UPDATE products SET image_path = 'panadol_24.png' WHERE product_name = 'Panadol' AND unit_quantity = 'Pack 24';
UPDATE products SET image_path = 'panadol_50.png' WHERE product_name = 'Panadol' AND unit_quantity = 'Bottle 50';
UPDATE products SET image_path = 'bath_soap.png' WHERE product_name = 'Bath Soap';
UPDATE products SET image_path = 'garbage_bags_small.png' WHERE product_name = 'Garbage Bags Small';
UPDATE products SET image_path = 'garbage_bags_large.png' WHERE product_name = 'Garbage Bags Large';
UPDATE products SET image_path = 'washing_powder.png' WHERE product_name = 'Washing Powder';
UPDATE products SET image_path = 'cheddar_500g.png' WHERE product_name = 'Cheddar Cheese' AND unit_quantity = '500 gram';
UPDATE products SET image_path = 'cheddar_1000g.png' WHERE product_name = 'Cheddar Cheese' AND unit_quantity = '1000 gram';
UPDATE products SET image_path = 't_bone_steak.png' WHERE product_name = 'T Bone Steak';
UPDATE products SET image_path = 'navel_oranges.png' WHERE product_name = 'Navel Oranges';
UPDATE products SET image_path = 'bananas.png' WHERE product_name = 'Bananas';
UPDATE products SET image_path = 'peaches.png' WHERE product_name = 'Peaches';
UPDATE products SET image_path = 'grapes.png' WHERE product_name = 'Grapes';
UPDATE products SET image_path = 'apples.png' WHERE product_name = 'Apples';
UPDATE products SET image_path = 'earl_grey_25.png' WHERE product_name = 'Earl Grey Tea Bags' AND unit_quantity = 'Pack 25';
UPDATE products SET image_path = 'earl_grey_100.png' WHERE product_name = 'Earl Grey Tea Bags' AND unit_quantity = 'Pack 100';
UPDATE products SET image_path = 'earl_grey_200.png' WHERE product_name = 'Earl Grey Tea Bags' AND unit_quantity = 'Pack 200';
UPDATE products SET image_path = 'instant_coffee_200g.png' WHERE product_name = 'Instant Coffee' AND unit_quantity = '200 gram';
UPDATE products SET image_path = 'instant_coffee_500g.png' WHERE product_name = 'Instant Coffee' AND unit_quantity = '500 gram';
UPDATE products SET image_path = 'chocolate_bar.png' WHERE product_name = 'Chocolate Bar';
UPDATE products SET image_path = 'dry_dog_food.png' WHERE product_name = 'Dry Dog Food' AND unit_quantity = '5 kg Pack';
UPDATE products SET image_path = 'dry_dog_food.png' WHERE product_name = 'Dry Dog Food' AND unit_quantity = '1 kg Pack';
UPDATE products SET image_path = 'bird_food.png' WHERE product_name = 'Bird Food';
UPDATE products SET image_path = 'cat_food.png' WHERE product_name = 'Cat Food';
UPDATE products SET image_path = 'fish_food.png' WHERE product_name = 'Fish Food';
UPDATE products SET image_path = 'laundry_bleach.png' WHERE product_name = 'Laundry Bleach';