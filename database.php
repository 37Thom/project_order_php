<?php 

$db_host="localhost";
$db_user="root";
$db_password="";
$db_name="project_order";

$connection = new mysqli($db_host, $db_user, $db_password, $db_name);

if (mysqli_connect_error()) {
    die ("Chyba připojení" . mysqli_connect_error());
    
}



/* 
    Databáze: project_order

    Tabulka1: product
        CREATE TABLE `project_order`.`product` 
        (`id` INT NOT NULL AUTO_INCREMENT, 
        `name` VARCHAR(50) NOT NULL, 
        `price` INT NOT NULL, 
        `currency` VARCHAR(10) NOT NULL, 
        `description` TEXT NOT NULL, 
        PRIMARY KEY (`id`));

                INSERT INTO `product` (`id`, `name`, `price`, `currency`, `description`) 
                VALUES 
                    (NULL, 'Produkt 1', '1000', 'czk', 'lorem ipsum'),
                    (NULL, 'Produkt 2', '750', 'czk', 'lorem ipsum'),
                    (NULL, 'Produkt 3', '550', 'czk', 'lorem ipsum'),
                    (NULL, 'Produkt 15', '450', 'czk', 'lorem ipsum');

    Tabulka2: order_done
        CREATE TABLE `project_order`.`order_done` 
        (`id` INT NOT NULL AUTO_INCREMENT, 
        `date` TIMESTAMP NOT NULL, 
        `status` VARCHAR(30) NOT NULL, 
        PRIMARY KEY (`id`));

                INSERT INTO `order_done` (`id`, `date`, `status`)
                VALUES 
                    (NULL, '2025-01-10 22:36:37', 'Doručeno'),
                    (NULL, '2025-02-11 22:36:37', 'Odesláno'),
                    (NULL, '2025-02-20 22:36:37', 'Odesláno'),
                    (NULL, '2025-03-05 22:36:37', 'Zpracovává se');


    Tabulka3: order_product
        CREATE TABLE `project_order`.`order_product` 
        (`id` INT AUTO_INCREMENT PRIMARY KEY,
        `order_done_id` INT NOT NULL,
        `product_id` INT NOT NULL,
        `quantity` INT NOT NULL DEFAULT 1,
        `price` DECIMAL(10,2) NOT NULL,
        FOREIGN KEY (order_done_id) REFERENCES order_done(id) ON DELETE CASCADE,
        FOREIGN KEY (product_id) REFERENCES product(id) ON DELETE CASCADE);

                INSERT INTO `order_product` (`id`, `order_done_id`, `product_id`, `quantity`, `price`) 
                VALUES 
                    (NULL, '1', '2', '2'), 
                    (NULL, '1', '3', '1'),
                    (NULL, '2', '1', '1'), 
                    (NULL, '3', '4', '3'),
                    (NULL, '3', '3', '1'), 
                    (NULL, '3', '2', '1'),
                    (NULL, '4', '1', '2');
*/

?>