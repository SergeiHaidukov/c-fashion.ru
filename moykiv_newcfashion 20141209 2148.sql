--
-- Скрипт сгенерирован Devart dbForge Studio for MySQL, Версия 6.2.280.0
-- Домашняя страница продукта: http://www.devart.com/ru/dbforge/mysql/studio
-- Дата скрипта: 09.12.2014 21:48:54
-- Версия сервера: 5.5.41-log
-- Версия клиента: 4.1
--


-- 
-- Отключение внешних ключей
-- 
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;

-- 
-- Установить режим SQL (SQL mode)
-- 
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- 
-- Установка кодировки, с использованием которой клиент будет посылать запросы на сервер
--
SET NAMES 'utf8';

-- 
-- Установка базы данных по умолчанию
--
USE moykiv_newcfashion;

--
-- Описание для таблицы auth_rule
--
DROP TABLE IF EXISTS auth_rule;
CREATE TABLE auth_rule (
  name VARCHAR(64) NOT NULL,
  data TEXT DEFAULT NULL,
  created_at INT(11) DEFAULT NULL,
  updated_at INT(11) DEFAULT NULL,
  PRIMARY KEY (name)
)
ENGINE = INNODB
CHARACTER SET latin1
COLLATE latin1_swedish_ci;

--
-- Описание для таблицы Categories
--
DROP TABLE IF EXISTS Categories;
CREATE TABLE Categories (
  id_category INT(11) NOT NULL AUTO_INCREMENT,
  name VARCHAR(50) NOT NULL,
  PRIMARY KEY (id_category)
)
ENGINE = INNODB
AUTO_INCREMENT = 6
AVG_ROW_LENGTH = 5461
CHARACTER SET utf8
COLLATE utf8_general_ci;

--
-- Описание для таблицы Categories_Products
--
DROP TABLE IF EXISTS Categories_Products;
CREATE TABLE Categories_Products (
  id INT(11) NOT NULL AUTO_INCREMENT,
  id_category INT(11) NOT NULL,
  id_product INT(11) NOT NULL,
  PRIMARY KEY (id)
)
ENGINE = INNODB
AUTO_INCREMENT = 1
CHARACTER SET latin1
COLLATE latin1_swedish_ci;

--
-- Описание для таблицы Categorytree
--
DROP TABLE IF EXISTS Categorytree;
CREATE TABLE Categorytree (
  id INT(11) NOT NULL AUTO_INCREMENT,
  id_parent INT(11) NOT NULL,
  id_child INT(11) NOT NULL,
  PRIMARY KEY (id)
)
ENGINE = INNODB
AUTO_INCREMENT = 1
CHARACTER SET latin1
COLLATE latin1_swedish_ci;

--
-- Описание для таблицы Colors
--
DROP TABLE IF EXISTS Colors;
CREATE TABLE Colors (
  id_color INT(11) NOT NULL AUTO_INCREMENT,
  name VARCHAR(50) NOT NULL,
  PRIMARY KEY (id_color)
)
ENGINE = INNODB
AUTO_INCREMENT = 1
CHARACTER SET utf8
COLLATE utf8_general_ci;

--
-- Описание для таблицы Colors_Products
--
DROP TABLE IF EXISTS Colors_Products;
CREATE TABLE Colors_Products (
  ID INT(11) NOT NULL AUTO_INCREMENT,
  id_color INT(11) NOT NULL,
  id_product INT(11) NOT NULL,
  PRIMARY KEY (ID)
)
ENGINE = INNODB
AUTO_INCREMENT = 1
CHARACTER SET latin1
COLLATE latin1_swedish_ci;

--
-- Описание для таблицы Pictures
--
DROP TABLE IF EXISTS Pictures;
CREATE TABLE Pictures (
  id_picture INT(11) NOT NULL AUTO_INCREMENT,
  file_name VARCHAR(50) NOT NULL,
  PRIMARY KEY (id_picture)
)
ENGINE = INNODB
AUTO_INCREMENT = 12
AVG_ROW_LENGTH = 1489
CHARACTER SET utf8
COLLATE utf8_general_ci;

--
-- Описание для таблицы Pictures_Products
--
DROP TABLE IF EXISTS Pictures_Products;
CREATE TABLE Pictures_Products (
  ID INT(11) NOT NULL AUTO_INCREMENT,
  id_picture INT(11) NOT NULL,
  id_product INT(11) NOT NULL,
  is_miniature TINYINT(1) NOT NULL DEFAULT 0 COMMENT 'Это миниатюра',
  PRIMARY KEY (ID)
)
ENGINE = INNODB
AUTO_INCREMENT = 12
AVG_ROW_LENGTH = 1489
CHARACTER SET latin1
COLLATE latin1_swedish_ci;

--
-- Описание для таблицы Products
--
DROP TABLE IF EXISTS Products;
CREATE TABLE Products (
  id_product INT(11) NOT NULL AUTO_INCREMENT,
  name VARCHAR(50) NOT NULL,
  price DOUBLE DEFAULT NULL,
  oldprice DOUBLE DEFAULT NULL,
  url VARCHAR(255) NOT NULL COMMENT 'Транслитерация name для отображения урл',
  isview TINYINT(1) DEFAULT 1 COMMENT 'Отображать товар в выдаче',
  description TEXT DEFAULT NULL,
  PRIMARY KEY (id_product)
)
ENGINE = MYISAM
AUTO_INCREMENT = 2
AVG_ROW_LENGTH = 40
CHARACTER SET utf8
COLLATE utf8_general_ci;

--
-- Описание для таблицы Sizes
--
DROP TABLE IF EXISTS Sizes;
CREATE TABLE Sizes (
  id_size INT(11) NOT NULL AUTO_INCREMENT,
  name VARCHAR(50) NOT NULL,
  PRIMARY KEY (id_size)
)
ENGINE = INNODB
AUTO_INCREMENT = 1
CHARACTER SET utf8
COLLATE utf8_general_ci;

--
-- Описание для таблицы Sizes_Products
--
DROP TABLE IF EXISTS Sizes_Products;
CREATE TABLE Sizes_Products (
  ID INT(11) NOT NULL AUTO_INCREMENT,
  id_size INT(11) NOT NULL,
  id_product INT(11) NOT NULL,
  PRIMARY KEY (ID)
)
ENGINE = INNODB
AUTO_INCREMENT = 1
CHARACTER SET latin1
COLLATE latin1_swedish_ci;

--
-- Описание для таблицы auth_item
--
DROP TABLE IF EXISTS auth_item;
CREATE TABLE auth_item (
  name VARCHAR(64) NOT NULL,
  type INT(11) NOT NULL,
  description TEXT DEFAULT NULL,
  rule_name VARCHAR(64) DEFAULT NULL,
  data TEXT DEFAULT NULL,
  created_at INT(11) DEFAULT NULL,
  updated_at INT(11) DEFAULT NULL,
  PRIMARY KEY (name),
  INDEX rule_name (rule_name),
  INDEX type (type),
  CONSTRAINT auth_item_ibfk_1 FOREIGN KEY (rule_name)
    REFERENCES auth_rule(name) ON DELETE SET NULL ON UPDATE CASCADE
)
ENGINE = INNODB
CHARACTER SET latin1
COLLATE latin1_swedish_ci;

--
-- Описание для таблицы auth_assignment
--
DROP TABLE IF EXISTS auth_assignment;
CREATE TABLE auth_assignment (
  item_name VARCHAR(64) NOT NULL,
  user_id VARCHAR(64) NOT NULL,
  created_at INT(11) DEFAULT NULL,
  PRIMARY KEY (item_name, user_id),
  CONSTRAINT auth_assignment_ibfk_1 FOREIGN KEY (item_name)
    REFERENCES auth_item(name) ON DELETE CASCADE ON UPDATE CASCADE
)
ENGINE = INNODB
CHARACTER SET latin1
COLLATE latin1_swedish_ci;

--
-- Описание для таблицы auth_item_child
--
DROP TABLE IF EXISTS auth_item_child;
CREATE TABLE auth_item_child (
  parent VARCHAR(64) NOT NULL,
  child VARCHAR(64) NOT NULL,
  PRIMARY KEY (parent, child),
  INDEX child (child),
  CONSTRAINT auth_item_child_ibfk_1 FOREIGN KEY (parent)
    REFERENCES auth_item(name) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT auth_item_child_ibfk_2 FOREIGN KEY (child)
    REFERENCES auth_item(name) ON DELETE CASCADE ON UPDATE CASCADE
)
ENGINE = INNODB
CHARACTER SET latin1
COLLATE latin1_swedish_ci;

-- 
-- Вывод данных для таблицы auth_rule
--

-- Таблица moykiv_newcfashion.auth_rule не содержит данных

-- 
-- Вывод данных для таблицы Categories
--
INSERT INTO Categories VALUES
(3, 'Вечерние платья'),
(4, 'Коктейльные платья'),
(5, 'Повседневные платья');

-- 
-- Вывод данных для таблицы Categories_Products
--

-- Таблица moykiv_newcfashion.Categories_Products не содержит данных

-- 
-- Вывод данных для таблицы Categorytree
--

-- Таблица moykiv_newcfashion.Categorytree не содержит данных

-- 
-- Вывод данных для таблицы Colors
--

-- Таблица moykiv_newcfashion.Colors не содержит данных

-- 
-- Вывод данных для таблицы Colors_Products
--

-- Таблица moykiv_newcfashion.Colors_Products не содержит данных

-- 
-- Вывод данных для таблицы Pictures
--
INSERT INTO Pictures VALUES
(1, 'img/1_2cab98057ad10e421d2d3f7bc5f26313.jpg'),
(2, 'img/1_557ec70f25a45df04b7d00c1ca6557cc.jpg'),
(3, '1_b126569080dd438704eb2dd49275da10.jpg'),
(4, '1_f285911188c0e730b1d0af731eb10a7f.jpg'),
(5, '1_4c886a6420d97a42c9438145c1589ead.jpg'),
(6, '1_1a7533ab1e21454945a5bbe1e2dd3c0b.jpg'),
(7, '1_2b190c9b8bc129a730654c01a207352e.jpg'),
(8, '1_e2e27767818817e41dc33a9c29903fa0.jpg'),
(9, '1_807128e422573e4fb8cba26477d1e921.jpg'),
(10, '1_ebf6141d50f9f73ac4bafb1c9dc390b7.jpg'),
(11, '1_23200286382a19a71a21756967620f68.jpg');

-- 
-- Вывод данных для таблицы Pictures_Products
--
INSERT INTO Pictures_Products VALUES
(1, 1, 1, 0),
(2, 1, 1, 0),
(3, 1, 1, 0),
(4, 1, 1, 0),
(5, 5, 1, 0),
(6, 6, 1, 0),
(7, 7, 1, 0),
(8, 8, 1, 0),
(9, 9, 1, 0),
(10, 10, 1, 0),
(11, 11, 1, 0);

-- 
-- Вывод данных для таблицы Products
--
INSERT INTO Products VALUES
(1, 'платье тест', NULL, NULL, 'werqwr', 1, '');

-- 
-- Вывод данных для таблицы Sizes
--

-- Таблица moykiv_newcfashion.Sizes не содержит данных

-- 
-- Вывод данных для таблицы Sizes_Products
--

-- Таблица moykiv_newcfashion.Sizes_Products не содержит данных

-- 
-- Вывод данных для таблицы auth_item
--

-- Таблица moykiv_newcfashion.auth_item не содержит данных

-- 
-- Вывод данных для таблицы auth_assignment
--

-- Таблица moykiv_newcfashion.auth_assignment не содержит данных

-- 
-- Вывод данных для таблицы auth_item_child
--

-- Таблица moykiv_newcfashion.auth_item_child не содержит данных

-- 
-- Восстановить предыдущий режим SQL (SQL mode)
-- 
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;

-- 
-- Включение внешних ключей
-- 
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;