--
-- Updates to the structure of the 'malt' table.
--

-- Create a copy of the 'malt' table and work on that first.
CREATE TABLE malt_copy LIKE malt;
INSERT INTO malt_copy SELECT * FROM malt;
ALTER TABLE malt_copy MODIFY id MEDIUMINT UNSIGNED AUTO_INCREMENT;
ALTER TABLE malt_copy MODIFY maltName VARCHAR(100) NOT NULL;
ALTER TABLE malt_copy CHANGE maltYield maltPPG DECIMAL(5,2) UNSIGNED NOT NULL DEFAULT 0.00;
ALTER TABLE malt_copy MODIFY maltOrigin VARCHAR(100);
ALTER TABLE malt_copy MODIFY maltSupplier VARCHAR(100);

-- Add high and low lovibond fields, copy the old data over.
ALTER TABLE malt_copy ADD maltLovibondLow DECIMAL(5,2) UNSIGNED NOT NULL DEFAULT 0.00;
ALTER TABLE malt_copy ADD maltLovibondHigh DECIMAL(5,2) UNSIGNED NOT NULL DEFAULT 0.00;
UPDATE malt_copy SET maltLovibondLow = maltLovibond;
ALTER TABLE malt_copy DROP maltLovibond;

-- These fields are unused anywhere in BB.
ALTER TABLE malt_copy DROP maltType;
ALTER TABLE malt_copy DROP maltCategory;

-- Remove the dependency on the 'sugar_type' table.
UPDATE malt_copy,sugar_type SET malt_copy.maltPPG = sugar_type.sugarPPG WHERE malt_copy.maltPPG = sugar_type.id;

-- Now drop the 'malt' table and move the copy into place.
DROP TABLE malt;
ALTER TABLE malt_copy RENAME TO malt;

--
-- Updates to the structure of the 'extract' table.
--

-- Create a copy of the 'extract' table and work on that first.
CREATE TABLE extract_copy LIKE extract;
INSERT INTO extract_copy SELECT * FROM extract;
ALTER TABLE extract_copy MODIFY id TINYINT UNSIGNED AUTO_INCREMENT;
ALTER TABLE extract_copy MODIFY extractName VARCHAR(100) NOT NULL;
ALTER TABLE extract_copy CHANGE extractYield extractPPG DECIMAL(5,2) UNSIGNED NOT NULL DEFAULT 0.00;
ALTER TABLE extract_copy MODIFY extractOrigin VARCHAR(100);
ALTER TABLE extract_copy MODIFY extractSupplier VARCHAR(100);
ALTER TABLE extract_copy ADD extractLME BOOL NOT NULL DEFAULT 0;
UPDATE extract_copy SET extractLME = 1 WHERE (id > 4 AND id <= 11);

-- Add high and low lovibond fields, copy the old data over.
ALTER TABLE extract_copy ADD extractLovibondLow DECIMAL(5,2) UNSIGNED NOT NULL DEFAULT 0.00;
ALTER TABLE extract_copy ADD extractLovibondHigh DECIMAL(5,2) UNSIGNED NOT NULL DEFAULT 0.00;
UPDATE extract_copy SET extractLovibondLow = extractLovibond;
ALTER TABLE extract_copy DROP extractLovibond;

-- These fields are unused anywhere in BB.
ALTER TABLE extract_copy DROP extractType;
ALTER TABLE extract_copy DROP extractCategory;

-- Remove the dependency on the 'sugar_type' table.
UPDATE extract_copy,sugar_type SET extract_copy.extractPPG = sugar_type.sugarPPG WHERE extract_copy.extractPPG = sugar_type.id;

-- Now drop the 'extract' table and move the copy into place.
DROP TABLE extract;
ALTER TABLE extract_copy RENAME TO extract;

--
-- Updates to the structure of the 'adjunct' table.
--

-- Create a copy of the 'adjuncts' table and work on that first.
CREATE TABLE adjuncts_copy LIKE adjuncts;
INSERT INTO adjuncts_copy SELECT * FROM adjuncts;
ALTER TABLE adjuncts_copy MODIFY id MEDIUMINT UNSIGNED AUTO_INCREMENT;
ALTER TABLE adjuncts_copy MODIFY adjunctName VARCHAR(100) NOT NULL;
ALTER TABLE adjuncts_copy MODIFY adjunctOrigin VARCHAR(100);
ALTER TABLE adjuncts_copy MODIFY adjunctSupplier VARCHAR(100);
ALTER TABLE adjuncts_copy CHANGE adjunctYield adjunctPPG DECIMAL(5,2) UNSIGNED NOT NULL DEFAULT 0.00;

-- Add high and low lovibond fields, copy the old data over.
ALTER TABLE adjuncts_copy ADD adjunctLovibondLow DECIMAL(5,2) UNSIGNED NOT NULL DEFAULT 0.00;
ALTER TABLE adjuncts_copy ADD adjunctLovibondHigh DECIMAL(5,2) UNSIGNED NOT NULL DEFAULT 0.00;
UPDATE adjuncts_copy SET adjunctLovibondLow = adjunctLovibond;
ALTER TABLE adjuncts_copy DROP adjunctLovibond;

-- These fields are unused anywhere in BB.
ALTER TABLE adjuncts_copy DROP adjunctType;
ALTER TABLE adjuncts_copy DROP adjunctCategory;

-- Remove the dependency on the 'sugar_type' table.
UPDATE adjuncts_copy,sugar_type SET adjuncts_copy.adjunctPPG = sugar_type.sugarPPG WHERE adjuncts_copy.adjunctPPG = sugar_type.id;

-- Now drop the 'adjuncts' table and move the copy into place.
DROP TABLE adjuncts;
ALTER TABLE adjuncts_copy RENAME TO adjuncts;

-- Fix Lactose and Raw Barley in adjuncts since neither had sugar_type values (bug)
UPDATE adjuncts SET adjunctPPG = 28.00 WHERE adjunctName = "Raw Barley" AND adjunctPPG = 83.00;
UPDATE adjuncts SET adjunctPPG = 43.00 WHERE adjunctName = "Lactose (Milk Sugar)" AND adjunctPPG = 84.00;

--
-- Don't drop sugar_type table yet. Leave it for reference in case we run in to bugs in this update.
--