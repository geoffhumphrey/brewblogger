-- SQL Changes: BrewBlogger 2.3.2
-- Created February 8, 2010 by gpzhumphrey
-- Modified September 10, 2010 by gpzhumphrey

INSERT INTO `brewingcss` (`id`, `theme`, `themeName`, `themeColor1`, `themeColor2`) VALUES
(NULL, 'SB12.css', 'SB12', '#dae2ec', '#c7d3e3');

ALTER TABLE `recipes` 
ADD `brewGrain10` VARCHAR ( 100 ) NULL AFTER `brewGrain9Weight`,
ADD `brewGrain10Weight` VARCHAR( 10 ) NULL AFTER `brewGrain10` ,
ADD `brewGrain11` VARCHAR( 100 ) NULL AFTER `brewGrain10Weight` ,
ADD `brewGrain11Weight` VARCHAR( 10 ) NULL AFTER `brewGrain11`, 
ADD `brewGrain12` VARCHAR( 100 ) NULL AFTER `brewGrain11Weight` ,
ADD `brewGrain12Weight` VARCHAR( 10 ) NULL AFTER `brewGrain12`, 
ADD `brewGrain13` VARCHAR( 100 ) NULL AFTER `brewGrain12Weight` ,
ADD `brewGrain13Weight` VARCHAR( 10 ) NULL AFTER `brewGrain13`, 
ADD `brewGrain14` VARCHAR( 100 ) NULL AFTER `brewGrain13Weight` ,
ADD `brewGrain14Weight` VARCHAR( 10 ) NULL AFTER `brewGrain14`, 
ADD `brewGrain15` VARCHAR( 100 ) NULL AFTER `brewGrain14Weight` ,
ADD `brewGrain15Weight` VARCHAR( 10 ) NULL AFTER `brewGrain15`, 

ADD `brewHops10` varchar(100)  NULL AFTER `brewHops9Form`,
ADD `brewHops10Weight` varchar(10) NULL AFTER `brewHops10`,
ADD `brewHops10IBU` varchar(10) NULL AFTER `brewHops10Weight`,
ADD `brewHops10Time` varchar(25) NULL AFTER `brewHops10IBU`,
ADD `brewHops10Use` varchar(25) NULL AFTER `brewHops10Time`,
ADD `brewHops10Type` varchar(25) NULL AFTER `brewHops10Use`,
ADD `brewHops10Form` varchar(25) NULL AFTER `brewHops10Type`,

ADD `brewHops11` varchar(100)  NULL AFTER `brewHops10Form`,
ADD `brewHops11Weight` varchar(10) NULL AFTER `brewHops11`,
ADD `brewHops11IBU` varchar(10) NULL AFTER `brewHops11Weight`,
ADD `brewHops11Time` varchar(25) NULL AFTER `brewHops11IBU`,
ADD `brewHops11Use` varchar(25) NULL AFTER `brewHops11Time`,
ADD `brewHops11Type` varchar(25) NULL AFTER `brewHops11Use`,
ADD `brewHops11Form` varchar(25) NULL AFTER `brewHops11Type`,

ADD `brewHops12` varchar(100)  NULL AFTER `brewHops11Form`,
ADD `brewHops12Weight` varchar(10) NULL AFTER `brewHops12`,
ADD `brewHops12IBU` varchar(10) NULL AFTER `brewHops12Weight`,
ADD `brewHops12Time` varchar(25) NULL AFTER `brewHops12IBU`,
ADD `brewHops12Use` varchar(25) NULL AFTER `brewHops12Time`,
ADD `brewHops12Type` varchar(25) NULL AFTER `brewHops12Use`,
ADD `brewHops12Form` varchar(25) NULL AFTER `brewHops12Type`,

ADD `brewHops13` varchar(100)  NULL AFTER `brewHops12Form`,
ADD `brewHops13Weight` varchar(10) NULL AFTER `brewHops13`,
ADD `brewHops13IBU` varchar(10) NULL AFTER `brewHops13Weight`,
ADD `brewHops13Time` varchar(25) NULL AFTER `brewHops13IBU`,
ADD `brewHops13Use` varchar(25) NULL AFTER `brewHops13Time`,
ADD `brewHops13Type` varchar(25) NULL AFTER `brewHops13Use`,
ADD `brewHops13Form` varchar(25) NULL AFTER `brewHops13Type`,

ADD `brewHops14` varchar(100)  NULL AFTER `brewHops13Form`,
ADD `brewHops14Weight` varchar(10) NULL AFTER `brewHops14`,
ADD `brewHops14IBU` varchar(10) NULL AFTER `brewHops14Weight`,
ADD `brewHops14Time` varchar(25) NULL AFTER `brewHops14IBU`,
ADD `brewHops14Use` varchar(25) NULL AFTER `brewHops14Time`,
ADD `brewHops14Type` varchar(25) NULL AFTER `brewHops14Use`,
ADD `brewHops14Form` varchar(25) NULL AFTER `brewHops14Type`,

ADD `brewHops15` varchar(100)  NULL AFTER `brewHops14Form`,
ADD `brewHops15Weight` varchar(10) NULL AFTER `brewHops15`,
ADD `brewHops15IBU` varchar(10) NULL AFTER `brewHops15Weight`,
ADD `brewHops15Time` varchar(25) NULL AFTER `brewHops15IBU`,
ADD `brewHops15Use` varchar(25) NULL AFTER `brewHops15Time`,
ADD `brewHops15Type` varchar(25) NULL AFTER `brewHops15Use`,
ADD `brewHops15Form` varchar(25) NULL AFTER `brewHops15Type`;  

ALTER TABLE `brewing` 
ADD `brewGrain10` VARCHAR ( 100 ) NULL AFTER `brewGrain9Weight`,
ADD `brewGrain10Weight` VARCHAR( 10 ) NULL AFTER `brewGrain10` ,
ADD `brewGrain11` VARCHAR( 100 ) NULL AFTER `brewGrain10Weight` ,
ADD `brewGrain11Weight` VARCHAR( 10 ) NULL AFTER `brewGrain11`, 
ADD `brewGrain12` VARCHAR( 100 ) NULL AFTER `brewGrain11Weight` ,
ADD `brewGrain12Weight` VARCHAR( 10 ) NULL AFTER `brewGrain12`, 
ADD `brewGrain13` VARCHAR( 100 ) NULL AFTER `brewGrain12Weight` ,
ADD `brewGrain13Weight` VARCHAR( 10 ) NULL AFTER `brewGrain13`, 
ADD `brewGrain14` VARCHAR( 100 ) NULL AFTER `brewGrain13Weight` ,
ADD `brewGrain14Weight` VARCHAR( 10 ) NULL AFTER `brewGrain14`, 
ADD `brewGrain15` VARCHAR( 100 ) NULL AFTER `brewGrain14Weight` ,
ADD `brewGrain15Weight` VARCHAR( 10 ) NULL AFTER `brewGrain15`, 

ADD `brewHops10` varchar(100)  NULL AFTER `brewHops9Form`,
ADD `brewHops10Weight` varchar(10) NULL AFTER `brewHops10`,
ADD `brewHops10IBU` varchar(10) NULL AFTER `brewHops10Weight`,
ADD `brewHops10Time` varchar(25) NULL AFTER `brewHops10IBU`,
ADD `brewHops10Use` varchar(25) NULL AFTER `brewHops10Time`,
ADD `brewHops10Type` varchar(25) NULL AFTER `brewHops10Use`,
ADD `brewHops10Form` varchar(25) NULL AFTER `brewHops10Type`,

ADD `brewHops11` varchar(100)  NULL AFTER `brewHops10Form`,
ADD `brewHops11Weight` varchar(10) NULL AFTER `brewHops11`,
ADD `brewHops11IBU` varchar(10) NULL AFTER `brewHops11Weight`,
ADD `brewHops11Time` varchar(25) NULL AFTER `brewHops11IBU`,
ADD `brewHops11Use` varchar(25) NULL AFTER `brewHops11Time`,
ADD `brewHops11Type` varchar(25) NULL AFTER `brewHops11Use`,
ADD `brewHops11Form` varchar(25) NULL AFTER `brewHops11Type`,

ADD `brewHops12` varchar(100)  NULL AFTER `brewHops11Form`,
ADD `brewHops12Weight` varchar(10) NULL AFTER `brewHops12`,
ADD `brewHops12IBU` varchar(10) NULL AFTER `brewHops12Weight`,
ADD `brewHops12Time` varchar(25) NULL AFTER `brewHops12IBU`,
ADD `brewHops12Use` varchar(25) NULL AFTER `brewHops12Time`,
ADD `brewHops12Type` varchar(25) NULL AFTER `brewHops12Use`,
ADD `brewHops12Form` varchar(25) NULL AFTER `brewHops12Type`,

ADD `brewHops13` varchar(100)  NULL AFTER `brewHops12Form`,
ADD `brewHops13Weight` varchar(10) NULL AFTER `brewHops13`,
ADD `brewHops13IBU` varchar(10) NULL AFTER `brewHops13Weight`,
ADD `brewHops13Time` varchar(25) NULL AFTER `brewHops13IBU`,
ADD `brewHops13Use` varchar(25) NULL AFTER `brewHops13Time`,
ADD `brewHops13Type` varchar(25) NULL AFTER `brewHops13Use`,
ADD `brewHops13Form` varchar(25) NULL AFTER `brewHops13Type`,

ADD `brewHops14` varchar(100)  NULL AFTER `brewHops13Form`,
ADD `brewHops14Weight` varchar(10) NULL AFTER `brewHops14`,
ADD `brewHops14IBU` varchar(10) NULL AFTER `brewHops14Weight`,
ADD `brewHops14Time` varchar(25) NULL AFTER `brewHops14IBU`,
ADD `brewHops14Use` varchar(25) NULL AFTER `brewHops14Time`,
ADD `brewHops14Type` varchar(25) NULL AFTER `brewHops14Use`,
ADD `brewHops14Form` varchar(25) NULL AFTER `brewHops14Type`,

ADD `brewHops15` varchar(100)  NULL AFTER `brewHops14Form`,
ADD `brewHops15Weight` varchar(10) NULL AFTER `brewHops15`,
ADD `brewHops15IBU` varchar(10) NULL AFTER `brewHops15Weight`,
ADD `brewHops15Time` varchar(25) NULL AFTER `brewHops15IBU`,
ADD `brewHops15Use` varchar(25) NULL AFTER `brewHops15Time`,
ADD `brewHops15Type` varchar(25) NULL AFTER `brewHops15Use`,
ADD `brewHops15Form` varchar(25) NULL AFTER `brewHops15Type`;  

INSERT INTO `adjuncts` (`id`, `adjunctName`, `adjunctType`, `adjunctOrigin`, `adjunctSupplier`, `adjunctLovibond`, `adjunctInfo`, `adjunctCategory`, `adjunctYield`) 
VALUES 
(NULL, 'Fruit - Blackberries, Raw or Frozen', 'Sugar', NULL, NULL, NULL, NULL, NULL, '201'),
(NULL, 'Fruit - Raspberries, Raw or Frozen', 'Sugar', NULL, NULL, NULL, NULL, NULL, '201'),
(NULL, 'Fruit - Marionberries, Raw or Frozen', 'Sugar', NULL, NULL, NULL, NULL, NULL, '201'),
(NULL, 'Fruit - Blueberries, Raw or Frozen', 'Sugar', NULL, NULL, NULL, NULL, NULL, '201'),
(NULL, 'Fruit - Cherries, Raw or Frozen', 'Sugar', NULL, NULL, NULL, NULL, NULL, '201'),
(NULL, 'Fruit - Cranberries, Raw or Frozen', 'Sugar', NULL, NULL, NULL, NULL, NULL, '201'),
(NULL, 'Fruit - Strawberries, Raw or Frozen', 'Sugar', NULL, NULL, NULL, NULL, NULL, '201'),
(NULL, 'Fruit - Watermellon, Raw or Frozen', 'Sugar', NULL, NULL, NULL, NULL, NULL, '201'),
(NULL, 'Fruit - Apples, Raw or Frozen', 'Sugar', NULL, NULL, NULL, NULL, NULL, '201'),
(NULL, 'Fruit - Grapes, Raw or Frozen', 'Sugar', NULL, NULL, NULL, NULL, NULL, '201'),
(NULL, 'Fruit - Peaches, Raw or Frozen', 'Sugar', NULL, NULL, NULL, NULL, NULL, '201'),
(NULL, 'Fruit - Blackberries, Dried', 'Sugar', NULL, NULL, NULL, NULL, NULL, '200'),
(NULL, 'Fruit - Raspberries, Dried', 'Sugar', NULL, NULL, NULL, NULL, NULL, '200'),
(NULL, 'Fruit - Marionberries, Dried', 'Sugar', NULL, NULL, NULL, NULL, NULL, '200'),
(NULL, 'Fruit - Blueberries, Dried', 'Sugar', NULL, NULL, NULL, NULL, NULL, '200'),
(NULL, 'Fruit - Cherries, Dried', 'Sugar', NULL, NULL, NULL, NULL, NULL, '200'),
(NULL, 'Fruit - Cranberries, Dried', 'Sugar', NULL, NULL, NULL, NULL, NULL, '200'),
(NULL, 'Fruit - Strawberries, Dried', 'Sugar', NULL, NULL, NULL, NULL, NULL, '200'),
(NULL, 'Fruit - Watermellon, Dried', 'Sugar', NULL, NULL, NULL, NULL, NULL, '200'),
(NULL, 'Fruit - Apples, Dried', 'Sugar', NULL, NULL, NULL, NULL, NULL, '200'),
(NULL, 'Fruit - Raisins', 'Sugar', NULL, NULL, NULL, NULL, NULL, '200'),
(NULL, 'Fruit - Peaches, Dried', 'Sugar', NULL, NULL, NULL, NULL, NULL, '200'),
(NULL, 'Fruit - Prunes', 'Sugar', NULL, NULL, NULL, NULL, NULL, '200'),
(NULL, 'Juice - Apple', 'Sugar', NULL, NULL, NULL, NULL, NULL, '202'),
(NULL, 'Juice - Grape', 'Sugar', NULL, NULL, NULL, NULL, NULL, '203'),
(NULL, 'Juice - Orange', 'Sugar', NULL, NULL, NULL, NULL, NULL, '204'),
(NULL, 'Juice - Pineapple', 'Sugar', NULL, NULL, NULL, NULL, NULL, '205'),
(NULL, 'Juice - Lemon', 'Sugar', NULL, NULL, NULL, NULL, NULL, '206'),
(NULL, 'Juice - Grapefruit', 'Sugar', NULL, NULL, NULL, NULL, NULL, '207'),
(NULL, 'Juice - Cranberry', 'Sugar', NULL, NULL, NULL, NULL, NULL, '208'),
(NULL, 'Juice - Other', 'Sugar', NULL, NULL, NULL, NULL, NULL, '202');

-- Derived from averages at http://winemaking.jackkeller.net/sugar.asp --

INSERT INTO `sugar_type` (`id`, `sugarName`, `sugarPPG`) VALUES
(200, 'Fruit - Dried', '38'),
(201, 'Fruit - Raw, Fresh/Frozen, No Sugar Added', '13'),
(202, 'Juice - Apple, No Sugar Added', '11'),
(203, 'Juice - Grape, No Sugar Added', '14'),
(204, 'Juice - Orange, No Sugar Added', '11'),
(205, 'Juice - Pineapple, No Sugar Added', '12'),
(206, 'Juice - Lemon, No Sugar Added', '3'),
(207, 'Juice - Grapefruit, No Sugar Added', '6'), 
(208, 'Juice - Cranberry, No Sugar Added', '13');

ALTER TABLE `preferences`
ADD `hopPelletFactor` FLOAT NOT NULL DEFAULT '1.06' COMMENT 'Pellet factor compared to whole/plug';