-- --------------------------------- BASE DE DADOS DO GESPED ------------------------------------
-- ----------------------------------------------------------------------------------------------
-- Drop schema if exists gesped;
create schema if not exists gesped;

use gesped;
 -- -- -------------------------------------------- ESTADOS   -- -- -------------------------------------------------
INSERT INTO `gesped`.`statuses` (`id`, `desc`,`created_at`, `updated_at`) 
VALUES 
('1', 'Activo', NOW(), NOW()),
('2', 'Inactivo', NOW(), NOW());

-- ALTER TABLE orders MODIFY COLUMN total decimal(15,2);

 -- -- -------------------------------------------- PERMISSÕES  -- -- -------------------------------------------------
INSERT INTO `gesped`.`permissions` (`id`, `permission`,`created_at`, `updated_at` )
 VALUES 
 ('1', 'admin', NOW(), NOW()),
 ('2', 'manage-user', NOW(), NOW()),
 ('3', 'user', NOW(), NOW());
 
 -- -- -------------------------------------------- EMPRESA  -- -- -------------------------------------------------
INSERT INTO `gesped`.`companies` (`id`, `name`, `description`, `site`, `email`, `nif`, `phone`,`created_at`, `updated_at`)
 VALUES 
('1', 'TechSolutions', 'Empresa de Tecnologia e Sistemas De Informação', 'techsolutions.com', 'techconnetsolutions@gmail.com', '007420639ZE046','244 931954086',  NOW(), NOW());


 -- -- -------------------------------------------- DEPARTAMENTOS  -- -- --------------------------------------------
INSERT INTO `gesped`.`departments` (`id`, `name`, `description`, `company_id`,`created_at`, `updated_at`) 
VALUES 
-- ------------------------------------------------- -- ------------------------------
('1', 'Finanças', 'Departamento Financeiro', '1' , NOW(), NOW()),
('2', 'Comércio', 'Departamento Comercial', '1'  , NOW(), NOW()),
('3', 'Jurídico', 'Departamento Jurídico', '1'   , NOW(), NOW()),
('4', 'TI', 'Departamento de Tecnologia da Informação', '1' , NOW(), NOW());
-- Adicione mais conforme necessário -- 


 -- -- -------------------------------------------- USUÁRIOS   -- -- -------------------------------------------------
INSERT INTO `users` (`name`, `email`, `email_verified_at`, `password`, `image`,  `department_id`,  `status_id`, `created_at`, `updated_at`)
VALUES 
('Osvaldo Ventura', 'osvaldoventura931@gmail.com', NOW(), '$2y$12$mMOOQkocvqB3fS8HNCRPmuIyZfjOWJX7xWm5j5o7F9u46lJxpd0Ja', 'osvaldo.jpeg', '1', '1', NOW(), NOW()),
('Mariana Almeida', 'marianaalmeida@gmail.com', NOW(), '$2y$12$mMOOQkocvqB3fS8HNCRPmuIyZfjOWJX7xWm5j5o7F9u46lJxpd0Ja', 'default.png', '1','1', NOW(), NOW()),
('Vilma Bunga', 'vilmabunga@gmail.com', NOW(), '$2y$12$mMOOQkocvqB3fS8HNCRPmuIyZfjOWJX7xWm5j5o7F9u46lJxpd0Ja', 'vilma.jpeg','1', '1', NOW(), NOW());
-- ('Gustavo José', 'gustavojose@gmail.com', NOW(), '$2y$12$mMOOQkocvqB3fS8HNCRPmuIyZfjOWJX7xWm5j5o7F9u46lJxpd0Ja', 'default.png', '1', NOW(), NOW());


 -- -- -------------------------------------------- PIVO PERMISSÕES USER -- -- ----------------------------------------
INSERT INTO `gesped`.`permission_user` (`permission_id`, `user_id`,`created_at`, `updated_at`)
VALUES 
('1', '1', NOW(), NOW()),
('2', '2', NOW(), NOW()),
('3', '3', NOW(), NOW());
-- -------------------------------------------------------------------------------------


INSERT INTO `gesped`.`provinces` (`id`, `name`, `created_at`, `updated_at`) 
VALUES ('1', 'Luanda', NOW(), NOW());

INSERT INTO `gesped`.`municipalities` (`id`, `name`, `province_id`, `created_at`, `updated_at`) 
VALUES ('1', 'Samba', '1', NOW(), NOW());

INSERT INTO `gesped`.`neighborhoods` (`id`, `name`, `municipality_id`, `created_at`, `updated_at`) 
VALUES ('1', 'Rocha Pinto', '1', NOW(), NOW());

-- -------------------------- CATAEGORIAS ---------------------------------------
INSERT INTO `gesped`.`categories` (`description`, `created_at`, `updated_at`) 
VALUES 
('Eletrônicos', NOW(), NOW());
-- -------------------------------------------------------------------------------------



-- ---------------------------------  PRODUTOS  ---------------------------------------
INSERT INTO gesped.products (name, price, desce, qtd, qtd_min, image, brand, category_id, created_at, updated_at) 
VALUES 
('Mouse', 300.00, 'Logitech G203 LIGHTSYNC Mouse óptico para jogos com fio com sensor 
de 8.000 DPI preto', 50, 5, 'default.png', 'DELL', 1, NOW(), NOW()), 
('Portátil', 800000.00, 'Computador Portátil Lenovo ThinkPad L15', 50, 5, 'default.png', 'Lenovo', 1, NOW(), NOW()), 
('Fone', 6500.00, 'O Fone Bluetooth W600BT EDIFIER tem duração de bateria de 30 horas e foram projetados com 
detalhes elegantes.', 50, 5, 'default.png', 'Eddier', 1, NOW(), NOW());
-- -------------------------------------------------------------------------------------


INSERT INTO `gesped`.`customers` (`name`, `nif`, `email`, `gender`, `house`, `street`, `town`, `state`, `created_at`, `updated_at`)
VALUES 
('Fernando Ventura', '0075693ZE001', 'fernando@example.com', 'Masculino', 'Casa 1', 'Rua Principal', 'Cidade A', 'Estado A', NOW(), NOW()),
('Vilma Bunga', '0075693ZE002', 'vilma@example.com', 'Feminino', 'Casa 2', 'Avenida Central', 'Cidade B', 'Estado B', NOW(), NOW()),
('Alexandre André', '0075693ZE003', 'alexandre@example.com', 'Masculino', 'Apartamento 3', 'Rua Secundária', 'Cidade C', 'Estado C', NOW(), NOW());


INSERT INTO `gesped`.`order_types` (`name`, `description`, `created_at`, `updated_at`) 
VALUES 
('Pedidos de Serviços',  'Prestação de Servços',   NOW(), NOW()),
('Pedidos de Vendas',    'Realização de Vendas',  NOW(), NOW());
