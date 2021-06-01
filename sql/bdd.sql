-- ---
-- Globals
-- ---

-- SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
-- SET FOREIGN_KEY_CHECKS=0;

-- ---
-- Table 'produits'
-- 
-- ---

DROP TABLE IF EXISTS `produits`;
		
CREATE TABLE `produits` (
  `id` INTEGER NOT NULL AUTO_INCREMENT,
  `titre` VARCHAR(45) NOT NULL,
  `ref` VARCHAR(32) NOT NULL,
  `prix` FLOAT NOT NULL,
  `photo` VARCHAR(128) NULL,
  `description` VARCHAR(128) NULL DEFAULT NULL,
  `id_categorie` INTEGER NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
);

-- ---
-- Table 'paniers'
-- 
-- ---

DROP TABLE IF EXISTS `paniers`;
		
CREATE TABLE `paniers` (
  `id` INTEGER NOT NULL AUTO_INCREMENT,
  `date` DATETIME NOT NULL DEFAULT now(),
  `id_clients` INTEGER NOT NULL,
  PRIMARY KEY (`id`)
);

-- ---
-- Table 'produit_panier'
-- 
-- ---

DROP TABLE IF EXISTS `produit_panier`;
		
CREATE TABLE `produit_panier` (
  `id` INTEGER NOT NULL AUTO_INCREMENT,
  `id_paniers` INTEGER NOT NULL,
  `id_produits` INTEGER NOT NULL,
  `quantite` INTEGER NOT NULL,
  PRIMARY KEY (`id`)
);

-- ---
-- Table 'categories'
-- 
-- ---

DROP TABLE IF EXISTS `categories`;
		
CREATE TABLE `categories` (
  `id` INTEGER NOT NULL AUTO_INCREMENT,
  `titre` VARCHAR(45) NOT NULL,
  `description` VARCHAR(128) NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
);

-- ---
-- Table 'clients'
-- 
-- ---

DROP TABLE IF EXISTS `clients`;
		
CREATE TABLE `clients` (
  `id` INTEGER NOT NULL AUTO_INCREMENT,
  `nom` VARCHAR(32) NOT NULL,
  `prenom` VARCHAR(32) NOT NULL,
  `mail` VARCHAR(45) NOT NULL,
  `adresse` VARCHAR(45) NOT NULL,
  `mdp` VARCHAR(32) NOT NULL,
  `login` VARCHAR(32) NOT NULL,
  PRIMARY KEY (`id`)
);

-- ---
-- Foreign Keys 
-- ---

ALTER TABLE `produits` ADD FOREIGN KEY (id_categorie) REFERENCES `categories` (`id`);
ALTER TABLE `paniers` ADD FOREIGN KEY (id_clients) REFERENCES `clients` (`id`);
ALTER TABLE `produit_panier` ADD FOREIGN KEY (id_paniers) REFERENCES `paniers` (`id`);
ALTER TABLE `produit_panier` ADD FOREIGN KEY (id_produits) REFERENCES `produits` (`id`);

-- ---
-- Table Properties
-- ---

-- ALTER TABLE `produits` ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
-- ALTER TABLE `paniers` ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
-- ALTER TABLE `produit_panier` ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
-- ALTER TABLE `categories` ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
-- ALTER TABLE `clients` ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- ---
-- Test Data
-- ---

INSERT INTO `produits` (`titre`,`ref`,`prix`,`photo`,`description`,`id_categorie`) VALUES
('sablé normand','REF-SABLE','1','https://img.cuisineaz.com/660x660/2018-03-19/i136726-sables-de-saint-pee.jpeg','savoureux sablé de normandie','1'),
('gâche normande','REF-BRIOCHE','3','https://www.recettethermomix.com/wp-content/uploads/2019/05/La-Fallue-ou-Ga%CC%82che-Normande-au-thermomix.jpg','généreuse brioche de normandie','2');
INSERT INTO `paniers` (`id_clients`) VALUES
('1');
INSERT INTO `produit_panier` (`id_paniers`,`id_produits`,`quantite`) VALUES
('1','1','2');
INSERT INTO `categories` (`titre`,`description`) VALUES
('patisseries','patisseries fabriquées en Normandie'),
('viennoiseries','viennoiseries fabriquées en Normandie'),
('laitiers','produits laitiers fabriqués en Normandie');
INSERT INTO `clients` (`nom`, `prenom`, `mail`, `adresse`, `mdp`, `login`) VALUES
('CONGARD', 'Nicolas', 'coco@gmail.com', '10 rue bizarre Paris 75001', MD5('chelou'), 'NC'),
('ZIDANE', 'Zinedine', 'zizou@gmail.com', '0 rue de la boule à z Paris 75000', MD5('foot'), 'ZIZOU');

-- ---
-- SELECT
-- ---

SELECT `id`, `titre`, `description` FROM `categories`;
SELECT `id`, `titre`, `ref`, `prix`, `photo`, `description`, `id_categorie` FROM `produits`;
SELECT `id`, `nom`, `prenom`, `mail`, `adresse`, `mdp`, `login` FROM `clients`;
SELECT `id`, `date`, `id_clients` FROM `paniers`;

SELECT p.`id`, p.`titre`, p.`ref`, p.`prix`, p.`photo`, p.`description`, c.`id` AS cat_id, c.`titre` AS cat_titre, c.`description` AS cat_desc 
    FROM `produits` p, `categories` c WHERE c.`id` = p.`id_categorie`;
SELECT cl.`nom`, pp.`quantite`, c.`titre` AS cat_titre, p.`titre`, p.`prix`, p.`ref`, p.`photo`
    FROM `produit_panier` pp, `clients` cl, `categories` c, `produits` p, `paniers` pa 
    WHERE pp.`id_paniers` = pa.`id` AND pp.`id_produits` = p.`id` AND c.`id` = p.`id_categorie` AND cl.`id` = pa.`id_clients` AND pa.`id` = 1; 

-- ---
-- UPDATE
-- ---

UPDATE `produit_panier` SET `quantite` = '10' WHERE `id_paniers` = 1 AND `id_produits` = 1; 