-- --------------------------------------------------------

--
-- Table structure for table `adjuncts`
--

CREATE TABLE IF NOT EXISTS `adjuncts` (
  `id` int(8) NOT NULL auto_increment,
  `adjunctName` varchar(250) default NULL,
  `adjunctType` varchar(255) default NULL,
  `adjunctOrigin` varchar(255) default NULL,
  `adjunctSupplier` varchar(255) default NULL,
  `adjunctLovibond` varchar(10) default NULL,
  `adjunctInfo` text,
  `adjunctCategory` char(1) default NULL,
  `adjunctYield` varchar(250) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM;

--
-- Dumping data for table `adjuncts`
--

INSERT INTO `adjuncts` (`id`, `adjunctName`, `adjunctType`, `adjunctOrigin`, `adjunctSupplier`, `adjunctLovibond`, `adjunctInfo`, `adjunctCategory`, `adjunctYield`) VALUES
(1, 'Flaked Barley', NULL, NULL, NULL, '1.6', '<p>Helps head retention, imparts creamy smoothness. For porters and stouts.</p>', '3', '4'),
(2, 'Flaked Corn', NULL, NULL, NULL, '1', 'Lightens body and color. For light American pilsners and ales.', '3', '3'),
(3, 'Flaked Oats', NULL, NULL, NULL, '1', 'Adds body and creamy head. For stouts and oat ales.', '3', '2'),
(4, 'Flaked Rye', NULL, NULL, NULL, '2', 'Imparts a dry, crisp character. Use in rye beers.', '3', '80'),
(5, 'Flaked Wheat', NULL, NULL, NULL, '2', 'Imparts a wheat flavor and hazy color. For wheat beers and Belgian white beers.', '3', '5'),
(6, 'Grits', NULL, NULL, NULL, '1', 'Imparts a corn/grain taste. Use in American lagers.', '3', '68'),
(7, 'Oats (Steel Cut)', NULL, NULL, NULL, '10', 'Imparts oatmeal flavor for stouts.', '3', '2'),
(8, 'Flaked Rice', NULL, NULL, NULL, '1', 'Imparts a light, crisp finish.', '3', '6'),
(9, 'Rice Hulls', NULL, NULL, NULL, '1', 'Used as a filtering bed after mashing.', '3', '81'),
(10, 'Honey', NULL, NULL, NULL, '1', NULL, '3', '8'),
(11, 'Sucrose (Table Sugar)', NULL, NULL, NULL, '0', NULL, '1', '46.00'),
(14, 'Molasses', NULL, NULL, NULL, '45', NULL, '1', '15'),
(16, 'Maple Syrup (Light)', NULL, NULL, NULL, '20', NULL, '1', '16'),
(17, 'Maple Syrup (Dark)', NULL, NULL, NULL, '45', NULL, '1', '16'),
(18, 'Raw Barley', NULL, NULL, NULL, '2.0', 'Raw, unmalted barley can be used to add body to your beer. Use in homebrew requires very fine milling combined with a decoction or multi-stage mash. Performs best when used in small quantities with well modified grains.', NULL, '83'),
(19, 'Torrified Wheat', NULL, NULL, NULL, '1.7', 'Raw wheat that has been "popped" open to open kernels. Used in place of raw barley for faster conversion and higher yields. High in haze producing protein. ', NULL, '71'),
(20, 'Brown Sugar, Dark', NULL, NULL, NULL, '50', 'Imparts a rich sweet flavor. Used in Scottish ales, holiday ales and some old ales.', NULL, '12'),
(21, 'Brown Sugar, Light', NULL, NULL, NULL, '8', 'Used in Scottish ales, holiday ales and some old ales.', NULL, '12'),
(22, 'Candi Sugar, Amber', NULL, NULL, NULL, '75', 'Crystalized Candi Sugar (Sucrose) used in many Belgian Tripels, Dubbels, and holiday ales. Adds head retention and sweet aroma to beer. Adds color.', NULL, '72'),
(23, 'Candi Sugar, Clear', NULL, NULL, NULL, '0.5', 'Crystalized Candi Sugar (Sucrose) used in many Belgian Tripels, Dubbels, and holiday ales. Adds head retention and sweet aroma to beer.', NULL, '70'),
(24, 'Candi Sugar, Dark', NULL, NULL, NULL, '275', 'Crystalized Candi Sugar (Sucrose) used in many Belgian Tripels, Dubbels, and holiday ales. Adds head retention and sweet aroma to beer. Adds color.', NULL, '73'),
(25, 'Beet Sugar', NULL, NULL, NULL, '0', 'Common household baking sugar. Lightens flavor and body of beer. Can contribute a cider-like flavor to the beer if not cold-fermented or used in large quantities.', NULL, '11'),
(26, 'Dextrose (Corn Sugar)', NULL, NULL, NULL, '0', 'Increases gravity without adding much body. Commonly used for priming in bottles.', NULL, '10'),
(27, 'Corn Syrup', NULL, NULL, NULL, '1', 'Syrup derived from corn with many of the same properties as corn sugar. May be used to enhance gravity without adding much body or flavor. Limit percentage in batch to avoid wine or cider flavors. ', NULL, '13'),
(28, 'Dememera Sugar', 'Adjunct', NULL, NULL, '2', '<p>Unrefined dark sugar. Contains molasses.</p>', NULL, '74'),
(29, 'Lactose (Milk Sugar)', NULL, NULL, NULL, '0', 'Not fully fermentable, so it adds lasting sweetness. Lactose can be added to lend sweetness to Sweet Stouts and Porters.', NULL, '84'),
(30, 'Molasses', NULL, NULL, NULL, '80', 'mparts a strong, sweet flavor. Used primarily in stouts and porters. ', NULL, '15'),
(31, 'Turinado Sugar', NULL, NULL, NULL, '10', 'Light, raw brown sugar. May be used in British pale ales or high gravity Belgian ales. Limit percentage used to avoid undesirable flavors. Similar to Demerara sugar.', NULL, '76');

-- --------------------------------------------------------

--
-- Table structure for table `awards`
--

CREATE TABLE IF NOT EXISTS `awards` (
  `id` int(8) NOT NULL auto_increment,
  `awardBrewID` varchar(10) default NULL,
  `awardContest` varchar(250) default NULL,
  `awardContestURL` varchar(250) default NULL,
  `awardDate` date default NULL,
  `awardStyle` varchar(250) default NULL,
  `awardPlace` varchar(250) default NULL,
  `brewBrewerID` varchar(250) default NULL,
  `awardBrewName` varchar(250) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM;

-- --------------------------------------------------------

--
-- Table structure for table `brewer`
--

CREATE TABLE IF NOT EXISTS `brewer` (
  `id` tinyint(4) NOT NULL auto_increment,
  `brewerFirstName` varchar(200) default NULL,
  `brewerLastName` varchar(200) default NULL,
  `brewerMiddleName` varchar(200) default NULL,
  `brewerPrefix` varchar(200) default NULL,
  `brewerSuffix` varchar(200) default NULL,
  `brewerAge` varchar(200) default NULL,
  `brewerCity` varchar(200) default NULL,
  `brewerState` varchar(200) default NULL,
  `brewerCountry` varchar(200) default NULL,
  `brewerAbout` text,
  `brewerLogName` varchar(200) NOT NULL default '',
  `brewerTagline` varchar(200) default NULL,
  `brewerFavStyles` varchar(200) default NULL,
  `brewerPrefMethod` varchar(200) default NULL,
  `brewerClubs` text,
  `brewerOther` text,
  `brewerImage` varchar(200) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM;

--
-- Dumping data for table `brewer`
--

INSERT INTO `brewer` (`id`, `brewerFirstName`, `brewerLastName`, `brewerMiddleName`, `brewerPrefix`, `brewerSuffix`, `brewerAge`, `brewerCity`, `brewerState`, `brewerCountry`, `brewerAbout`, `brewerLogName`, `brewerTagline`, `brewerFavStyles`, `brewerPrefMethod`, `brewerClubs`, `brewerOther`, `brewerImage`) VALUES
(1, 'Joe', 'Brewer', 'B.', 'Dr.', 'II', '42', 'Anytown', 'Colorado', 'USA', '<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Morbi erat. Mauris in arcu. Suspendisse potenti. Nunc ultricies eros non ipsum. Aliquam nec quam a tellus accumsan porta. Nullam sodales, odio ut ultrices sollicitudin, urna lectus cursus felis, et varius nisi ante eu ligula. Nulla dignissim eros porta lorem. Mauris accumsan, enim sed placerat dapibus, ante lorem accumsan metus, non nonummy dui elit sed leo. Duis pharetra egestas justo. Curabitur vel turpis et dolor semper aliquam. Nunc luctus dapibus nulla. Integer nisi nunc, sollicitudin eget, ullamcorper non, egestas eget, nunc. Vivamus turpis. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos hymenaeos. Vestibulum metus. Aliquam justo. Maecenas eu erat eu lacus suscipit eleifend.</p>\r\n<p>Sed elementum. Curabitur tellus eros, gravida et, rhoncus id, dapibus sed, mauris. Ut feugiat lobortis enim. Aliquam non ligula. Praesent vel nisi. Donec vitae tellus. Quisque vitae erat. Vestibulum mollis turpis at massa. Ut nibh. Fusce ante metus, nonummy sit amet, porta a, rhoncus ac, risus. Etiam commodo auctor lacus. Nullam vitae leo vitae tortor malesuada lacinia. Vestibulum tristique facilisis sapien. Suspendisse potenti. Aenean vitae enim eget orci cursus convallis.</p>', 'BrewBlogger 2.3', 'The web-based homebrew log and calculation suite', 'American Pale Ale, Scottish Export', 'All Grain', 'Anytown Brewer''s Guild', '<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Morbi erat. Mauris in arcu. Suspendisse potenti. Nunc ultricies eros non ipsum. Aliquam nec quam a tellus accumsan porta. Nullam sodales, odio ut ultrices sollicitudin, urna lectus cursus felis, et varius nisi ante eu ligula. Nulla dignissim eros porta lorem. Mauris accumsan, enim sed placerat dapibus, ante lorem accumsan metus, non nonummy dui elit sed leo. Duis pharetra egestas justo. Curabitur vel turpis et dolor semper aliquam. Nunc luctus dapibus nulla. Integer nisi nunc, sollicitudin eget, ullamcorper non, egestas eget, nunc. Vivamus turpis. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos hymenaeos. Vestibulum metus. Aliquam justo. Maecenas eu erat eu lacus suscipit eleifend.</p>\r\n<p>Sed elementum. Curabitur tellus eros, gravida et, rhoncus id, dapibus sed, mauris. Ut feugiat lobortis enim. Aliquam non ligula. Praesent vel nisi. Donec vitae tellus. Quisque vitae erat. Vestibulum mollis turpis at massa. Ut nibh. Fusce ante metus, nonummy sit amet, porta a, rhoncus ac, risus. Etiam commodo auctor lacus. Nullam vitae leo vitae tortor malesuada lacinia. Vestibulum tristique facilisis sapien. Suspendisse potenti. Aenean vitae enim eget orci cursus convallis.</p>', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `brewerlinks`
--

CREATE TABLE IF NOT EXISTS `brewerlinks` (
  `id` int(8) NOT NULL auto_increment,
  `brewerLinkName` varchar(200) default NULL,
  `brewerLinkURL` varchar(200) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM;

--
-- Dumping data for table `brewerlinks`
--

INSERT INTO `brewerlinks` (`id`, `brewerLinkName`, `brewerLinkURL`) VALUES
(1, 'Beer Judge Certification Program (BJCP)', 'http://www.bjcp.org'),
(2, 'BrewBlogger', 'http://www.brewblogger.net'),
(3, 'John Palmer''s <em>How To Brew</em> Online Book', 'http://www.howtobrew.com/intro.html');

-- --------------------------------------------------------

--
-- Table structure for table `brewing`
--

CREATE TABLE IF NOT EXISTS `brewing` (
  `id` int(8) NOT NULL auto_increment,
  `brewName` varchar(250) default NULL,
  `brewStyle` varchar(250) default NULL,
  `brewBatchNum` varchar(100) default NULL,
  `brewCondition` varchar(100) default NULL,
  `brewDate` date NOT NULL default '0000-00-00',
  `brewYield` varchar(10) default NULL,
  `brewMethod` varchar(200) default NULL,
  `brewCost` varchar(10) default NULL,
  `brewLink1` varchar(250) default NULL,
  `brewLink1Name` varchar(250) default NULL,
  `brewLink2` varchar(250) default NULL,
  `brewLink2Name` varchar(250) default NULL,
  `brewInfo` text,
  `brewExtract1` varchar(100) default NULL,
  `brewExtract1Weight` varchar(10) default NULL,
  `brewExtract2` varchar(100) default NULL,
  `brewExtract2Weight` varchar(10) default NULL,
  `brewExtract3` varchar(100) default NULL,
  `brewExtract3Weight` varchar(4) default NULL,
  `brewExtract4` varchar(100) default NULL,
  `brewExtract4Weight` varchar(10) default NULL,
  `brewExtract5` varchar(100) default NULL,
  `brewExtract5Weight` varchar(10) default NULL,
  `brewGrain1` varchar(100) default NULL,
  `brewGrain1Weight` varchar(10) default NULL,
  `brewGrain2` varchar(100) default NULL,
  `brewGrain2Weight` varchar(10) default NULL,
  `brewGrain3` varchar(100) default NULL,
  `brewGrain3Weight` varchar(10) default NULL,
  `brewGrain4` varchar(100) default NULL,
  `brewGrain4Weight` varchar(10) default NULL,
  `brewGrain5` varchar(100) default NULL,
  `brewGrain5Weight` varchar(4) default NULL,
  `brewGrain6` varchar(100) default NULL,
  `brewGrain6Weight` varchar(10) default NULL,
  `brewGrain7` varchar(100) default NULL,
  `brewGrain7Weight` varchar(10) default NULL,
  `brewGrain8` varchar(100) default NULL,
  `brewGrain8Weight` varchar(10) default NULL,
  `brewGrain9` varchar(100) default NULL,
  `brewGrain9Weight` varchar(10) default NULL,
  `brewAddition1` varchar(100) default NULL,
  `brewAddition1Amt` varchar(20) default NULL,
  `brewAddition2` varchar(100) default NULL,
  `brewAddition2Amt` varchar(20) default NULL,
  `brewAddition3` varchar(100) default NULL,
  `brewAddition3Amt` varchar(20) default NULL,
  `brewAddition4` varchar(100) default NULL,
  `brewAddition4Amt` varchar(20) default NULL,
  `brewAddition5` varchar(100) default NULL,
  `brewAddition5Amt` varchar(20) default NULL,
  `brewAddition6` varchar(100) default NULL,
  `brewAddition6Amt` varchar(20) default NULL,
  `brewAddition7` varchar(100) default NULL,
  `brewAddition7Amt` varchar(20) default NULL,
  `brewAddition8` varchar(100) default NULL,
  `brewAddition8Amt` varchar(20) default NULL,
  `brewAddition9` varchar(100) default NULL,
  `brewAddition9Amt` varchar(20) default NULL,
  `brewMisc1Name` varchar(250) default NULL,
  `brewMisc2Name` varchar(250) default NULL,
  `brewMisc3Name` varchar(250) default NULL,
  `brewMisc4Name` varchar(250) default NULL,
  `brewMisc1Type` varchar(25) default NULL,
  `brewMisc2Type` varchar(25) default NULL,
  `brewMisc3Type` varchar(25) default NULL,
  `brewMisc4Type` varchar(25) default NULL,
  `brewMisc1Use` varchar(25) default NULL,
  `brewMisc2Use` varchar(25) default NULL,
  `brewMisc3Use` varchar(25) default NULL,
  `brewMisc4Use` varchar(25) default NULL,
  `brewMisc1Time` varchar(25) default NULL,
  `brewMisc2Time` varchar(25) default NULL,
  `brewMisc3Time` varchar(25) default NULL,
  `brewMisc4Time` varchar(25) default NULL,
  `brewMisc1Amount` varchar(25) default NULL,
  `brewMisc2Amount` varchar(25) default NULL,
  `brewMisc3Amount` varchar(25) default NULL,
  `brewMisc4Amount` varchar(25) default NULL,
  `brewHops1` varchar(100) default NULL,
  `brewHops1Weight` varchar(10) default NULL,
  `brewHops1IBU` varchar(10) default NULL,
  `brewHops1Time` varchar(25) default NULL,
  `brewHops2` varchar(100) default NULL,
  `brewHops2Weight` varchar(10) default NULL,
  `brewHops2IBU` varchar(10) default NULL,
  `brewHops2Time` varchar(25) default NULL,
  `brewHops3` varchar(100) default NULL,
  `brewHops3Weight` varchar(10) default NULL,
  `brewHops3IBU` varchar(10) default NULL,
  `brewHops3Time` varchar(25) default NULL,
  `brewHops4` varchar(100) default NULL,
  `brewHops4Weight` varchar(10) default NULL,
  `brewHops4IBU` varchar(10) default NULL,
  `brewHops4Time` varchar(25) default NULL,
  `brewHops5` varchar(100) default NULL,
  `brewHops5Weight` varchar(10) default NULL,
  `brewHops5IBU` varchar(10) default NULL,
  `brewHops5Time` varchar(25) default NULL,
  `brewHops6` varchar(100) default NULL,
  `brewHops6Weight` varchar(10) default NULL,
  `brewHops6IBU` varchar(10) default NULL,
  `brewHops6Time` varchar(25) default NULL,
  `brewHops7` varchar(100) default NULL,
  `brewHops7Weight` varchar(10) default NULL,
  `brewHops7IBU` varchar(10) default NULL,
  `brewHops7Time` varchar(25) default NULL,
  `brewHops8` varchar(100) default NULL,
  `brewHops8Weight` varchar(10) default NULL,
  `brewHops8IBU` varchar(10) default NULL,
  `brewHops8Time` varchar(25) default NULL,
  `brewHops9` varchar(100) default NULL,
  `brewHops9Weight` varchar(10) default NULL,
  `brewHops9IBU` varchar(10) default NULL,
  `brewHops9Time` varchar(25) default NULL,
  `brewHops1Use` varchar(25) default NULL,
  `brewHops2Use` varchar(25) default NULL,
  `brewHops3Use` varchar(25) default NULL,
  `brewHops4Use` varchar(25) default NULL,
  `brewHops5Use` varchar(25) default NULL,
  `brewHops6Use` varchar(25) default NULL,
  `brewHops7Use` varchar(25) default NULL,
  `brewHops8Use` varchar(25) default NULL,
  `brewHops9Use` varchar(25) default NULL,
  `brewHops1Type` varchar(25) default NULL,
  `brewHops2Type` varchar(25) default NULL,
  `brewHops3Type` varchar(25) default NULL,
  `brewHops4Type` varchar(25) default NULL,
  `brewHops5Type` varchar(25) default NULL,
  `brewHops6Type` varchar(25) default NULL,
  `brewHops7Type` varchar(25) default NULL,
  `brewHops8Type` varchar(25) default NULL,
  `brewHops9Type` varchar(25) default NULL,
  `brewHops1Form` varchar(25) default NULL,
  `brewHops2Form` varchar(25) default NULL,
  `brewHops3Form` varchar(25) default NULL,
  `brewHops4Form` varchar(25) default NULL,
  `brewHops5Form` varchar(25) default NULL,
  `brewHops6Form` varchar(25) default NULL,
  `brewHops7Form` varchar(25) default NULL,
  `brewHops8Form` varchar(25) default NULL,
  `brewHops9Form` varchar(25) default NULL,
  `brewYeast` varchar(250) default NULL,
  `brewYeastMan` varchar(250) default NULL,
  `brewYeastForm` varchar(25) default NULL,
  `brewYeastType` varchar(25) default NULL,
  `brewYeastAmount` varchar(25) default NULL,
  `brewLabelImage` varchar(250) default NULL,
  `brewOG` varchar(10) default NULL,
  `brewFG` varchar(10) default NULL,
  `brewGravity1` varchar(10) default NULL,
  `brewGravity1Days` varchar(10) default NULL,
  `brewGravity2` varchar(10) default NULL,
  `brewGravity2Days` varchar(10) default NULL,
  `brewProcedure` text,
  `brewSpecialProcedure` text,
  `brewPrimary` varchar(10) default NULL,
  `brewPrimaryTemp` varchar(10) default NULL,
  `brewSecondary` varchar(10) default NULL,
  `brewSecondaryTemp` varchar(10) default NULL,
  `brewTertiary` varchar(10) default NULL,
  `brewTertiaryTemp` varchar(10) default NULL,
  `brewLager` varchar(10) default NULL,
  `brewLagerTemp` varchar(10) default NULL,
  `brewAge` varchar(10) default NULL,
  `brewAgeTemp` varchar(10) default NULL,
  `brewBitterness` varchar(10) default NULL,
  `brewIBUFormula` varchar(250) default NULL,
  `brewLovibond` varchar(10) default NULL,
  `brewComments` text,
  `brewMashType` varchar(250) default NULL,
  `brewMashGrainWeight` varchar(10) default NULL,
  `brewMashGrainTemp` char(2) default NULL,
  `brewMashTunTemp` char(3) default NULL,
  `brewMashSpargAmt` varchar(20) default NULL,
  `brewMashSpargeTemp` char(3) default NULL,
  `brewMashEquipAdjust` varchar(10) default NULL,
  `brewMashPH` varchar(5) default NULL,
  `brewMashStep1Name` varchar(250) default NULL,
  `brewMashStep1Desc` varchar(250) default NULL,
  `brewMashStep1Temp` varchar(10) default NULL,
  `brewMashStep1Time` varchar(10) default NULL,
  `brewMashStep2Name` varchar(250) default NULL,
  `brewMashStep2Desc` varchar(250) default NULL,
  `brewMashStep2Temp` varchar(10) default NULL,
  `brewMashStep2Time` varchar(10) default NULL,
  `brewMashStep3Name` varchar(250) default NULL,
  `brewMashStep3Desc` varchar(250) default NULL,
  `brewMashStep3Temp` varchar(10) default NULL,
  `brewMashStep3Time` varchar(10) default NULL,
  `brewMashStep4Name` varchar(250) default NULL,
  `brewMashStep4Desc` varchar(250) default NULL,
  `brewMashStep4Temp` varchar(10) default NULL,
  `brewMashStep4Time` varchar(10) default NULL,
  `brewMashStep5Name` varchar(250) default NULL,
  `brewMashStep5Desc` varchar(250) default NULL,
  `brewMashStep5Temp` varchar(10) default NULL,
  `brewMashStep5Time` varchar(10) default NULL,
  `brewWaterName` varchar(250) default NULL,
  `brewWaterAmount` varchar(25) default NULL,
  `brewWaterCalcium` varchar(25) default NULL,
  `brewWaterBicarb` varchar(25) default NULL,
  `brewWaterSulfate` varchar(25) default NULL,
  `brewWaterChloride` varchar(25) default NULL,
  `brewWaterMagnesium` varchar(25) default NULL,
  `brewWaterPH` varchar(25) default NULL,
  `brewWaterNotes` text,
  `brewWaterSodium` varchar(25) default NULL,
  `brewEfficiency` varchar(10) default NULL,
  `brewPPG` varchar(10) default NULL,
  `brewStatus` varchar(250) default NULL,
  `brewTapDate` date default NULL,
  `brewMashGravity` varchar(10) default NULL,
  `brewPreBoilAmt` varchar(10) default NULL,
  `brewBrewerID` varchar(250) default NULL,
  `brewTargetOG` varchar(250) default NULL,
  `brewTargetFG` varchar(250) default NULL,
  `brewMashProfile` int(5) default NULL,
  `brewWaterProfile` int(5) default NULL,
  `brewYeastProfile` int(5) default NULL,
  `brewEquipProfile` int(5) default NULL,
  `brewBoilTime` int(4) default NULL,
  `brewFeatured` char(1) default NULL,
  `brewWaterRatio` varchar(8) default NULL,
  `brewArchive` varchar(8) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM;

--
-- Dumping data for table `brewing`
--

INSERT INTO `brewing` (`id`, `brewName`, `brewStyle`, `brewBatchNum`, `brewCondition`, `brewDate`, `brewYield`, `brewMethod`, `brewCost`, `brewLink1`, `brewLink1Name`, `brewLink2`, `brewLink2Name`, `brewInfo`, `brewExtract1`, `brewExtract1Weight`, `brewExtract2`, `brewExtract2Weight`, `brewExtract3`, `brewExtract3Weight`, `brewExtract4`, `brewExtract4Weight`, `brewExtract5`, `brewExtract5Weight`, `brewGrain1`, `brewGrain1Weight`, `brewGrain2`, `brewGrain2Weight`, `brewGrain3`, `brewGrain3Weight`, `brewGrain4`, `brewGrain4Weight`, `brewGrain5`, `brewGrain5Weight`, `brewGrain6`, `brewGrain6Weight`, `brewGrain7`, `brewGrain7Weight`, `brewGrain8`, `brewGrain8Weight`, `brewGrain9`, `brewGrain9Weight`, `brewAddition1`, `brewAddition1Amt`, `brewAddition2`, `brewAddition2Amt`, `brewAddition3`, `brewAddition3Amt`, `brewAddition4`, `brewAddition4Amt`, `brewAddition5`, `brewAddition5Amt`, `brewAddition6`, `brewAddition6Amt`, `brewAddition7`, `brewAddition7Amt`, `brewAddition8`, `brewAddition8Amt`, `brewAddition9`, `brewAddition9Amt`, `brewMisc1Name`, `brewMisc2Name`, `brewMisc3Name`, `brewMisc4Name`, `brewMisc1Type`, `brewMisc2Type`, `brewMisc3Type`, `brewMisc4Type`, `brewMisc1Use`, `brewMisc2Use`, `brewMisc3Use`, `brewMisc4Use`, `brewMisc1Time`, `brewMisc2Time`, `brewMisc3Time`, `brewMisc4Time`, `brewMisc1Amount`, `brewMisc2Amount`, `brewMisc3Amount`, `brewMisc4Amount`, `brewHops1`, `brewHops1Weight`, `brewHops1IBU`, `brewHops1Time`, `brewHops2`, `brewHops2Weight`, `brewHops2IBU`, `brewHops2Time`, `brewHops3`, `brewHops3Weight`, `brewHops3IBU`, `brewHops3Time`, `brewHops4`, `brewHops4Weight`, `brewHops4IBU`, `brewHops4Time`, `brewHops5`, `brewHops5Weight`, `brewHops5IBU`, `brewHops5Time`, `brewHops6`, `brewHops6Weight`, `brewHops6IBU`, `brewHops6Time`, `brewHops7`, `brewHops7Weight`, `brewHops7IBU`, `brewHops7Time`, `brewHops8`, `brewHops8Weight`, `brewHops8IBU`, `brewHops8Time`, `brewHops9`, `brewHops9Weight`, `brewHops9IBU`, `brewHops9Time`, `brewHops1Use`, `brewHops2Use`, `brewHops3Use`, `brewHops4Use`, `brewHops5Use`, `brewHops6Use`, `brewHops7Use`, `brewHops8Use`, `brewHops9Use`, `brewHops1Type`, `brewHops2Type`, `brewHops3Type`, `brewHops4Type`, `brewHops5Type`, `brewHops6Type`, `brewHops7Type`, `brewHops8Type`, `brewHops9Type`, `brewHops1Form`, `brewHops2Form`, `brewHops3Form`, `brewHops4Form`, `brewHops5Form`, `brewHops6Form`, `brewHops7Form`, `brewHops8Form`, `brewHops9Form`, `brewYeast`, `brewYeastMan`, `brewYeastForm`, `brewYeastType`, `brewYeastAmount`, `brewLabelImage`, `brewOG`, `brewFG`, `brewGravity1`, `brewGravity1Days`, `brewGravity2`, `brewGravity2Days`, `brewProcedure`, `brewSpecialProcedure`, `brewPrimary`, `brewPrimaryTemp`, `brewSecondary`, `brewSecondaryTemp`, `brewTertiary`, `brewTertiaryTemp`, `brewLager`, `brewLagerTemp`, `brewAge`, `brewAgeTemp`, `brewBitterness`, `brewIBUFormula`, `brewLovibond`, `brewComments`, `brewMashType`, `brewMashGrainWeight`, `brewMashGrainTemp`, `brewMashTunTemp`, `brewMashSpargAmt`, `brewMashSpargeTemp`, `brewMashEquipAdjust`, `brewMashPH`, `brewMashStep1Name`, `brewMashStep1Desc`, `brewMashStep1Temp`, `brewMashStep1Time`, `brewMashStep2Name`, `brewMashStep2Desc`, `brewMashStep2Temp`, `brewMashStep2Time`, `brewMashStep3Name`, `brewMashStep3Desc`, `brewMashStep3Temp`, `brewMashStep3Time`, `brewMashStep4Name`, `brewMashStep4Desc`, `brewMashStep4Temp`, `brewMashStep4Time`, `brewMashStep5Name`, `brewMashStep5Desc`, `brewMashStep5Temp`, `brewMashStep5Time`, `brewWaterName`, `brewWaterAmount`, `brewWaterCalcium`, `brewWaterBicarb`, `brewWaterSulfate`, `brewWaterChloride`, `brewWaterMagnesium`, `brewWaterPH`, `brewWaterNotes`, `brewWaterSodium`, `brewEfficiency`, `brewPPG`, `brewStatus`, `brewTapDate`, `brewMashGravity`, `brewPreBoilAmt`, `brewBrewerID`, `brewTargetOG`, `brewTargetFG`, `brewMashProfile`, `brewWaterProfile`, `brewYeastProfile`, `brewEquipProfile`, `brewBoilTime`, `brewFeatured`, `brewWaterRatio`, `brewArchive`) VALUES
(1, 'Sample Log #3', 'Belgian Blond Ale', '03_BB', 'Bottles', '2009-08-01', '5', 'All Grain', '$32.40', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Belgian Plisen Malt', '10.50', 'German Light Munich Malt', '0.50', 'German Wheat Malt Light', '0.50', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Sucrose (Table Sugar)', '2.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Golding', '0.65', '7.0', '90', 'Golding', '0.75', '7.0', '30', 'Saaz', '0.50', '5.8', '1', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Boil', 'Boil', 'Boil', NULL, NULL, NULL, NULL, NULL, NULL, 'Bittering', 'Both', 'Aroma', NULL, NULL, NULL, NULL, NULL, NULL, 'Pellets', 'Pellets', 'Pellets', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1000 ml', 'sample.jpg', '1.068', '1.005', '1.020', '5', '1.010', '10', NULL, NULL, '7', '72', '7', '70', NULL, NULL, NULL, NULL, '45', '61', '29.4', 'Rager', '03.8', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Secondary', '2009-09-27', '1.055', '6', 'admin', '1.068', '1.008', 19, 8, 54, 1, 90, 'Y', '1.33', 'No'),
(2, 'Sample Log #1', 'American Brown Ale', '01_BB', 'Keg', '2009-06-01', '5', 'All Grain', '$31.10', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'British Maris Otter Pale Malt', '11.00', 'German Light Munich Malt', '0.66', 'Crystal Malt 60L', '0.66', 'British Chocolate Malt', '0.50', 'British Roasted Barley', '0.12', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Brown Sugar (Dark)', '0.50', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Whirlfloc', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '15', NULL, NULL, NULL, '1 tablet', NULL, NULL, NULL, 'Magnum', '1.00', '13.6', '60', 'Challenger', '0.25', '6.7', '60', 'Mount Hood', '1.00', '4.2', '0', 'Kent Golding', '0.50', '4.5', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Boil', 'Boil', 'Boil', 'Dry Hop', NULL, NULL, NULL, NULL, NULL, 'Bittering', 'Bittering', 'Aroma', 'Aroma', NULL, NULL, NULL, NULL, NULL, 'Pellets', 'Pellets', 'Pellets', 'Pellets', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1000 ml', NULL, '1.068', '1.010', '1.015', '4', '1.012', '7', NULL, NULL, '7', '68', '21', '68', NULL, NULL, NULL, NULL, '21', '61', '55.4', 'Daniels', '025.9', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'On Tap', '2009-09-01', '1.049', '6.0', 'nonpriv', '1.066', '1.010', 15, 9, 124, 6, 90, 'N', '1.25', 'No'),
(3, 'Sample Log #2', 'Blonde Ale', '02_BB', 'Bottles', '2009-07-01', '10', 'All Grain', '$27.29', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'American Pale Malt (2-Row)', '18.00', 'German Light Munich Malt', '4.00', 'Crystal Malt 40L', '0.25', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Fermcap', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '60', NULL, NULL, NULL, '1/2 tsp.', NULL, NULL, NULL, 'Magnum', '1.00', '13.0', '60', 'Amarillo', '1.00', '8.2', '3', 'Amarillo', '1.00', '8.2', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Boil', 'Boil', 'Dry Hop', NULL, NULL, NULL, NULL, NULL, NULL, 'Bittering', 'Aroma', 'Aroma', NULL, NULL, NULL, NULL, NULL, NULL, 'Pellets', 'Pellets', 'Pellets', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2000 ml', 'sample.jpg', '1.060', '1.010', '1.020', '7', '1.015', '14', NULL, NULL, '7', '66', '14', '66', '21', '66', '35', '34', '28', '50', '25.6', 'Rager', '06.2', '<p>The latest iteration. Added dry hop addition.</p>', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Bottled', '2009-09-01', '1.041', '12', 'admin', '1.058', '1.010', 14, 8, 69, 1, 90, 'N', '1.50', 'No');

-- --------------------------------------------------------

--
-- Table structure for table `brewingcss`
--

CREATE TABLE IF NOT EXISTS `brewingcss` (
  `id` tinyint(4) NOT NULL auto_increment,
  `theme` varchar(250) NOT NULL default '0',
  `themeName` varchar(250) default NULL,
  `themeColor1` varchar(250) default NULL,
  `themeColor2` varchar(250) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM;

--
-- Dumping data for table `brewingcss`
--

INSERT INTO `brewingcss` (`id`, `theme`, `themeName`, `themeColor1`, `themeColor2`) VALUES
(1, '1.css', 'Blue', '#d3e3f3', '#E7F3F9'),
(2, '2.css', 'Gray', '#e0e0e0', '#efefef'),
(3, '3.css', 'Orange', '#ffecbc', '#fff6dc'),
(4, '4.css', 'Green', '#dae0d1', '#e4ebe0'),
(5, '5.css', 'Red', '#F5ECE5', '#FCFAF8'),
(6, '6.css', 'StylizedGreen', '#EBEFEB', '#dce4dd'),
(7, '7.css', 'StylizedBlue', '#E0E9F5', '#CDDDEF'),
(8, '8.css', 'StylizedRed', '#e6e6e6', '#f2f2f2'),
(9, 'brilliant.css', 'Brilliant', '#E4DBC3', '#D4C6A0'),
(10, 'folly.css', 'Folly', '#fee39a', '#FEF1CD'),
(11, 'midas.css', 'Midas', '#E5D4BD', '#baa076'),
(12, 'mobile.css', 'Mobile', '#eeeeee', '#dadada'),
(13, 'haze.css', 'Haze', '#EFE5D1', '#e8dabe'),
(14, 'SB12.css', 'SB12', '#dae2ec', '#c7d3e3');

-- --------------------------------------------------------

--
-- Table structure for table `equip_profiles`
--

CREATE TABLE IF NOT EXISTS `equip_profiles` (
  `id` int(8) NOT NULL auto_increment,
  `equipProfileName` varchar(255) default NULL,
  `equipBatchSize` varchar(10) default NULL,
  `equipBoilVolume` varchar(10) default NULL,
  `equipEvapRate` varchar(10) default NULL,
  `equipLoss` varchar(10) default NULL,
  `equipNotes` text,
  `equipMashTunVolume` varchar(10) default NULL,
  `equipMashTunWeight` varchar(10) default NULL,
  `equipMashTunMaterial` varchar(255) default NULL,
  `equipMashTunSpecificHeat` varchar(10) default NULL,
  `equipMashTunDeadspace` varchar(10) default NULL,
  `equipHopUtil` varchar(10) default NULL,
  `equipTypicalEfficiency` varchar(10) default NULL,
  `equipTopUp` varchar(10) default NULL,
  `equipTopUpKettle` varchar(10) default NULL,
  `equipBrewerID` varchar(255) default NULL,
  `equipTypicalWaterRatio` varchar(10) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM;

--
-- Dumping data for table `equip_profiles`
--

INSERT INTO `equip_profiles` (`id`, `equipProfileName`, `equipBatchSize`, `equipBoilVolume`, `equipEvapRate`, `equipLoss`, `equipNotes`, `equipMashTunVolume`, `equipMashTunWeight`, `equipMashTunMaterial`, `equipMashTunSpecificHeat`, `equipMashTunDeadspace`, `equipHopUtil`, `equipTypicalEfficiency`, `equipTopUp`, `equipTopUpKettle`, `equipBrewerID`, `equipTypicalWaterRatio`) VALUES
(1, 'Converted Keg, 10 Gallon/38 Liter Cooler Mash Tun', '10.00', '12.00', '9.00', '1.00', '<p>Converted 15.5 gallon/59 liter keg boil kettle for full boil with a 10 gallon/38 liter cooler as a mash/lauter tun.</p>', '10.00', '9.00', 'Plastic', '0.30', '0.80', '100', '72', '0', '0', 'brewblogger', '1.33'),
(2, '2 Gallon/7.5 Liter Kettle', '5.00', '1.50', '9.00', '0.00', NULL, '2.00', '2.50', 'Stainless Steel', '0.12', '0.25', '100', '72', '3.75', '0.00', 'brewblogger', '1.33'),
(3, '3 Gallon/11 Liter Kettle', '5.00', '2.50', '9.00', '0.00', NULL, '3.00', '3.00', 'Stainless Steel', '0.12', '0.25', '100', '72', '3.00', '0.00', 'brewblogger', '1.33'),
(4, '4 Gallon/15 Liter Kettle', '5.00', '3.25', '9.00', '0.00', NULL, '4.00', '4.00', 'Stainless Steel', '0.12', '0.25', '100', '72', '2.25', '0.00', 'brewblogger', '1.33'),
(5, '5 Gallon/19 Liter Kettle', '5.00', '4.00', '9.00', '0.25', NULL, '5.00', '5.00', 'Stainless Steel', '0.12', '0.25', '100', '72', '1.75', '0.00', 'brewblogger', '1.33'),
(6, '7 Gallon/26.5 Liter Kettle and 5 Gallon/19 Liter Cooler Mash Tun', '5.00', '6.00', '9.00', '0.25', NULL, '5.00', '4.00', 'Plastic', '0.30', '0.25', '100', '72', '0.00', '0.00', 'brewblogger', '1.25'),
(7, '8 Gallon/28 Liter Kettle and 10 Gallon/38 Liter Cooler Mash Tun', '5.00', '6.50', '11.00', '0.50', NULL, '10.00', '9.00', 'Plastic', '0.30', '0.25', '100', '72', '0.00', '0.00', 'brewblogger', '1.33'),
(8, '12.5 Gallon/48 Liter Kettle and 10 Gallon/38 Liter Cooler Mash Tun', '10.00', '12.13', '10.00', '0.50', NULL, '10.00', '9.00', 'Plastic', '0.30', '0.25', '100', '72', '0.00', '0.00', 'brewblogger', '1.33'),
(9, '15 Gallon/57 Liter Brew Pot (15) and 10 Gallon/38 Liter Cooler Mash Tun', '10.00', '12.55', '9.00', '1.00', NULL, '10.00', '9.00', 'Plastic', '0.30', '0.80', '100', '72', '0.00', '0.00', 'brewblogger', '1.33');

-- --------------------------------------------------------

--
-- Table structure for table `extract`
--

CREATE TABLE IF NOT EXISTS `extract` (
  `id` int(8) NOT NULL auto_increment,
  `extractName` varchar(250) default NULL,
  `extractLovibond` varchar(10) default NULL,
  `extractInfo` text,
  `extractCategory` char(1) default NULL,
  `extractYield` varchar(250) default NULL,
  `extractOrigin` varchar(250) default NULL,
  `extractSupplier` varchar(250) default NULL,
  `extractType` varchar(250) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM;

--
-- Dumping data for table `extract`
--

INSERT INTO `extract` (`id`, `extractName`, `extractLovibond`, `extractInfo`, `extractCategory`, `extractYield`, `extractOrigin`, `extractSupplier`, `extractType`) VALUES
(1, 'DME - Extra Light', '3', NULL, '1', '17', NULL, NULL, 'Dry Extract'),
(2, 'DME - Light', '3.5', NULL, '1', '18', NULL, NULL, 'Dry Extract'),
(3, 'DME - Amber', '10', NULL, '1', '19', NULL, NULL, 'Dry Extract'),
(4, 'DME - Dark', '30', NULL, '1', '20', NULL, NULL, 'Dry Extract'),
(5, 'LME - Extra Light', '1', NULL, '1', '21', NULL, NULL, 'Extract'),
(6, 'LME - Light', '3.5', NULL, '1', '22', NULL, NULL, 'Extract'),
(7, 'LME - Amber', '10', NULL, '1', '23', NULL, NULL, 'Extract'),
(8, 'LME - Dark', '30', NULL, '1', '24', NULL, NULL, 'Extract'),
(9, 'LME - Munich', '10', NULL, '1', '23', NULL, NULL, 'Extract'),
(10, 'LME - Pilsner', '6', NULL, '1', '21', NULL, NULL, 'Extract'),
(11, 'LME - Wheat', '6', NULL, '1', '22', NULL, NULL, 'Extract');

-- --------------------------------------------------------

--
-- Table structure for table `hops`
--

CREATE TABLE IF NOT EXISTS `hops` (
  `id` int(8) NOT NULL auto_increment,
  `hopsName` varchar(250) default NULL,
  `hopsGrown` varchar(250) default NULL,
  `hopsInfo` text,
  `hopsUse` varchar(250) default NULL,
  `hopsExample` varchar(250) default NULL,
  `hopsAAULow` tinyint(2) default NULL,
  `hopsAAUHigh` tinyint(2) default NULL,
  `hopsSub` varchar(250) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM;

--
-- Dumping data for table `hops`
--

INSERT INTO `hops` (`id`, `hopsName`, `hopsGrown`, `hopsInfo`, `hopsUse`, `hopsExample`, `hopsAAULow`, `hopsAAUHigh`, `hopsSub`) VALUES
(1, 'Bullion', 'United Kingdom, United States', 'Poor aroma, sharp bittering and black currant flavor and aroma when used in the boil.', 'Bittering, finishing.', 'IPA, ESB, Stout', 8, 11, 'Brewer''s Gold, Pacific Gem'),
(2, 'Cascade', 'United States', 'Strong spicy, floral, citrus (especially grapefruit) aroma.', 'Bittering, aroma, finishing, dry hopping.', 'Sierra Nevada Pale Ale, Anchor Liberty Ale, Old Foghorn', 4, 8, 'Centennial'),
(3, 'Centennial', 'United States', 'Spicy, floral, citrus aroma, clean bittering hop.', 'Bittering, aroma, dry hopping.', 'Ale; Sierra Nevada Celebration Ale, Sierra Nevada Bigfoot Ale', 9, 11, 'Cascade'),
(4, 'Challenger', 'United Kingdom', 'Spicy aroma, fruity flavor.', 'Aroma, bittering. Blends well with other hops.', 'English-style Ale, Porter, Stout, ESB', 6, 8, 'Perle, Northern Brewer'),
(5, 'Chinook', 'United States', 'Heavy spicy aroma, strong versatile bittering hop.', 'Bittering.', 'Pale Ale, Stout, Porter, IPA; Sierra Nevada Celebration Ale, Sierra Nevada Stout', 12, 14, 'Galena, Eroica, Nugget, Bullion'),
(6, 'Cluster', 'United States, Australia', 'Poor, sharp aroma, sharp bittering hop.', 'Bittering.', 'Ale (aroma), Lager (bittering); Winterhook Christmas Ale', 5, 8, 'Galena'),
(7, 'Crystal', 'United States', 'Mild, pleasant, slightly spicy.', 'Aroma, finishing, flavoring.', 'Lager, Pilsner, ESB', 2, 5, 'Hallertauer Mittelfrueh, Hallertauer Hersbrucker, Mount Hood, Liberty'),
(8, 'Kent Golding', 'United Kingdom', 'Spicy, floral, earthy, rounded, very mild aroma; spicy flavor.', 'Bittering, aroma, finishing, dry hopping for', 'Samuel Smith''s Pale Ale, Fuller''s ESB; British ales', 4, 7, 'Goldings, Target'),
(9, 'Eroica', 'United States', 'Clean bittering hop.', 'Bittering.', 'Wheat, Pale Ale, Porter; Ballard Bitter, Blackhook Porter, Anderson Valley Boont Amber', 12, 14, 'Northern Brewer, Galena'),
(10, 'Fuggle', 'United Kingdom, United States', 'Mild, soft, grassy, floral aroma.', 'Aroma, finishing, dry hopping.', 'English-style Ale, American Ale, ESB, Lager; Samuel Smith''s Pale Ale, Old Peculier, Thomas Hardy''s Ale; English ales', 3, 5, 'East Kent Goldings, Willamette'),
(11, 'Galena', 'United States', 'Strong, clean bittering hop.', 'Bittering.', 'Ale, Porter, Stout, ESB; Catamount Porter, Devil''s Mountain Railroad Ale', 12, 14, 'Northern Brewer, Eroica, Cluster'),
(13, 'Hallertauer Hersbrucker', 'Germany', 'Pleasant, spicy, mild, noble, earthy aroma.', 'Aroma, finishing.', 'Lager, Pilsner, Bock, Wheat; Wheathook Wheaten Ale; German style lagers', 2, 5, 'Hallertauer Mittelfrueh, Mt. Hood, Liberty, Crystal, NZ Hallertau Aroma'),
(14, 'Hallertauer Mittlefruh', 'Germany', 'Pleasant, spicy, mild herbal aroma.  Noble hop.', 'Aroma, finishing.', 'Lager, Bock, Wheat; Sam Adams Boston Lager, Sam Adams Boston Lightship; German style lagers', 3, 5, 'Hallertauer Hersbrucker, Mt. Hood, Liberty, Crystal, NZ Hallertau Aroma'),
(15, 'Liberty', 'United States', 'Fine, very mild aroma.', 'Aroma, finishing.', 'Lager, Pilsner, Bock, Wheat; Pete''s Wicked Lager', 2, 5, 'Hallertauer Mittelfrueh, Hallertauer Hersbrucker, Mt. Hood, Crystal'),
(16, 'Lublin', 'Poland', 'Reported to be a substitute for noble varieties.', 'Aroma, finishing.', NULL, 2, 4, 'Saaz, Hallertauer Mittelfrueh, Hallertauer Hersbrucker, Tettnang, Mount Hood, Liberty, Crystal.'),
(17, 'Mount Hood', 'United States', 'Mild, clean aroma.', 'Aroma, finishing.', 'Lager, Pilsner, Bock, Wheat; Anderson Valley High Rollers Wheat Beer, Portland Ale', 3, 8, 'Hallertauer Mittelfrueh, Hallertauer Hersbrucker, Liberty, Tettnang'),
(18, 'Northdown', 'Ireland', 'Good flavor and aroma, blends well with other United Kingdom types.', 'Bittering, aroma, finishing.', 'Ale; Guinness', 7, 9, 'Target, Northern Brewer'),
(19, 'Northern Brewer', 'United Kingdom, United States, Germany', 'Fine, fragrant aroma, dry, clean bittering hop.', 'Bittering, aroma, finishing.', 'ESB, Bitter, Pale Ale, Porter, California Common; Old Peculier, Anchor Liberty, Anchor Steam', 7, 10, 'Hallertauer Mittelfrueh, Hallertauer Hersbrucker'),
(20, 'Nugget', 'United States', 'Heavy, spicy, herbal aroma, strong bittering hop.', 'Bittering, aroma.', 'ESB, Lager, Ale; Sierra Nevada Porter, Sierra Nevada Bigfoot Ale, Anderson Valley ESB', 12, 14, 'Chinook'),
(21, 'New Zealand Hallertau Aroma', 'New Zealand', 'Said to be a replica of German Hallertauer Mittelfrueh.', 'Fine aroma hopping.', 'Coors, Coors Light; lager', 6, 8, 'Hallertauer Mittelfrueh, Hallertauer Hersbrucker, Tettnang, Crystal'),
(23, 'Perle', 'Germany, United States', 'Pleasant aroma, slightly spicy, almost minty bittering hop.', 'Bittering.', 'Lager, Pale Ale, Porter; Sierra Nevada Pale Ale, Summerfest, and Pale Bock', 7, 9, 'Hallertauer Mittelfrueh, NZ Hallertau Aroma'),
(24, 'Pride of Ringwood', 'Australia', 'Citric aroma, clean bittering hop.', 'Bittering.', 'Lager; Foster''s Lager, Victoria Bitter, Coopers Sparkling Ale', 9, 11, NULL),
(25, 'Progress', 'United Kingdom', 'Similar to Fuggles, slightly sweeter.', 'Bittering.', 'English-style Ale', 5, 7, 'Fuggles'),
(26, 'Saaz', 'Czechoslovakia, United States', 'Delicate, mild, floral aroma.  Czech varietey is considered a noble hop.', 'Aroma, finishing.', 'Plisner, Lager, Wheat; Pilsener Urquell; Bohemian style lagers', 2, 2, 'Tettnang'),
(27, 'Southern Cross', 'New Zealand', '', 'Strong bittering and fine aroma qualities.', 'Lager', 11, 12, NULL),
(28, 'Spalt', 'Germany, United States', 'Mild, pleasant, slightly spicy.', 'Aroma, finishing, flavoring, bittering.', 'Lager, Dusseldorf Alt', 3, 6, 'Saaz, Tettnang'),
(29, 'Sticklebract', 'New Zealand', 'Said to be comparable to European Northern Brewer.', 'Bittering, aroma.', NULL, 11, 13, 'Northern Brewer'),
(30, 'Strisselspalt', 'France', 'Medium intensity, pleasant, similar to Hersbrucker.', 'Aroma, finishing.', 'Pilsner, Lager, Wheat', 3, 5, 'Hersbrucker, German Spalt'),
(31, 'Styrian Golding', 'Yugoslavia, United States', 'Similar to Fuggles.', 'Bittering, finishing, dry hopping.', 'All English-style Ale, ESB, Bitter, Lager; Ind Coope''s Burton Ale, Timothy Taylor''s Landlord; English style ale', 4, 7, 'Fuggles, Willamette'),
(33, 'Target', 'United Kingdom', 'Accounts for 40% of United Kingdom hop production.', 'Bittering, aroma.', 'Ale, Lager; Young''s Special London Ale', 10, 12, 'Northdown, Progress'),
(34, 'Tettnanger', 'Germany, United States', 'Fine, spicy aroma.', 'Aroma, finishing.', 'Lager, Ale; Gulpener Pilsener, Sam Adams Octoberfest, Anderson Valley ESB', 3, 6, 'Saaz, Spalt'),
(35, 'Ultra', 'United States', 'Fine aroma hop.', 'Aroma, finishing.', 'Lager, Pilsner, Wheat, Ale (finish hop)', 3, 6, 'Hallertauer Mittelfrueh'),
(36, 'Williamette', 'United States', 'Mild, spicy, grassy, floral aroma.', 'Aroma, finishing, dry hopping.', 'English-style Ale, Porter, Stout; Sierra Nevada Porter, Ballard Bitter, Anderson Valley Boont Amber', 4, 7, 'Fuggle'),
(37, 'Amarillo', 'United States', 'Floral, citrus aroma.', 'Flavor, aroma.', 'Bighorn Big Red IPA', 8, 11, 'Cascade, Centennial, Chinook, Ahtanum.'),
(38, 'Admiral', 'United Kingdom', 'A good replacement for both high alpha and dual-purpose hops when used as a kettle hop.', 'Bittering.', 'Ale', 13, 16, NULL),
(39, 'Brewers Gold', 'United Kingdom, Germany', 'Blackcurrant, fruity, spicy aroma.', 'Bittering, aroma.', 'Ale, Pilsner, Lambic', 8, 10, 'Comet, Chinook, Eroica, Galena, Bullion'),
(40, 'Golding', 'United States, Canada', 'Version of Kent Goldings grown in the United States.', 'Aroma.', 'English-style Ale, ESB, Pale Ale', 4, 6, 'Kent Goldings'),
(41, 'Comet', 'United States', 'Especially bitter.', 'Bittering.', NULL, 9, 11, 'Galena'),
(42, 'Magnum', 'Germany', 'Clean bittering hop.  Bred at the Hop Research Institute in Hull, Germany.', 'Bittering.', 'Lager, Pilsner; Stout', 12, 14, 'Columbus, Nugget'),
(43, 'Select', 'Germany', 'Bred from Hallertauer Mittlefruh and Spalt as a disease resistant Spalt type.', 'Flavor, aroma.', 'German style lager and ale.', 4, 6, 'Saaz, Tettnang, Spalt, Hersbrucker'),
(44, 'Columbus', 'United States', 'Pungent aroma.', 'Bittering, dry hopping.', 'IPA, Pale Ale, Stout', 14, 16, 'Nugget, Chinook, Wye Target, Northern Brewer, Centennial'),
(45, 'Millenium', 'United States', 'Mild, herbal aroma.', 'Bittering.', NULL, 14, 15, 'Nugget, Columbus'),
(46, 'Ahtanum', 'United States', 'Floral, citrus, sharp, and piney.', 'Aroma, bittering.', 'Lager, American Ale', 5, 6, 'Cascade, Amarillo'),
(47, 'Glacier', 'United States', 'Balanced bitterness and pleasant aroma.  New variety.', 'Bittering, aroma, finishing.', 'Pale Ale, ESB, Bitter, English-Style Pale Ale, Porter, Stout', 5, 6, 'Willamette, US Fuggle, US Tettnang, Styrian Golding'),
(48, 'Horizon', NULL, 'Spicy, floral aroma.', 'Bittering, aroma.', 'All Ales, Lager.', 11, 13, 'Magnum'),
(49, 'Newport', 'United States', 'Mild aroma, high bittering alpha hop.', 'Bittering', 'Ale, Stout, Barley Wine', 13, 17, 'Galena, Nugget, Fuggle, Magnum, Brewer?s Gold'),
(50, 'Santiam', 'United States', 'Slightly spicy and floral aroma.  Noble hop characteristics.', 'Aroma, bittering.', 'Lager, Pilsner, Belgian Tripel, Kolsch, Bock, Munich Helles, American Ale', 5, 7, 'Tettnang, Spalt, Spalter'),
(51, 'Simcoe', 'United States', 'Pine-like aroma.  Mainly a bittering hop with good aroma characteristics', 'Bittering, aroma', 'American Ale', 12, 14, NULL),
(52, 'Sterling', 'United States', 'Herbal and spicy aroma with a hint of floral and citrus.', 'Aroma, bittering.', 'Pilsner, Lager, Belgian-Style Ale', 6, 9, 'Saaz'),
(53, 'Vanguard', 'United States', 'Similar to Hallertau (U.S.).  Aroma similar to continental European types.', 'Bittering, aroma.', 'Lager, Pilsner, Bock, Kolsch, Wheat, Munich Helles, Belgian-Style Ale', 5, 6, 'Hallertau, Hersbrucker, Mt Hood, Liberty'),
(54, 'Warrior', 'United States', 'Mild aroma, high alpha bittering hop.', 'Bittering.', 'Pale Ale, IPA, Stout', 15, 17, 'Nugget, Columbus'),
(55, 'Tradition', 'Germany', 'Fine, subtle aroma similar to Hallertau.', 'Aroma, bittering', 'Lager, Pilsner, Bock, Wheat, Weizen', 5, 7, 'Liberty, Hallertau'),
(56, 'First Gold', 'United Kingdom', 'A dwarf hop, predicted by many in the British industry for future success.', 'Aroma, bittering.', 'English style ale.', 6, 8, 'UK Kent Golding, Crystal'),
(57, 'Pacific Gem', 'New Zealand', 'Woody, berry aroma.  Frequenlty grown organic.', 'Bittering.', 'All ale styles', 14, 16, NULL),
(58, 'Zeus', 'United States', 'Pungent, flowery aroma; "chunky" bitterness.', 'Bittering', 'Ale', 13, 17, 'Columbus'),
(59, 'Yeoman', 'United Kingdom', 'Pleasant bitterness.', 'Bittering.', 'English style ale and lager.', 6, 8, 'Northdown'),
(61, 'Green Bullet', 'New Zealand', 'Citrus and floral aroma.', 'Bittering.', 'Lager; ale.', 8, 11, NULL),
(63, 'Aquila', 'United States', 'Not widely used.', 'Aroma.', NULL, 5, 7, NULL),
(64, 'Bramling Cross', 'United Kingdom, Canada', 'Toasty, buttery, slighly resiny aroma with some woody notes.  Quite mild, fruity currant aroma.', 'Bittering, finishing.', 'ESB, Bitter, Pale Ale', 6, 8, 'Progress, Kent Golding'),
(65, 'Herald', 'United Kingdom', 'High alpha-acid dwarf hop.', 'Bittering, aroma.', NULL, 11, 13, NULL),
(66, 'Huller Bitterer', 'Germany', NULL, 'Bittering', NULL, 7, 10, NULL),
(67, 'Marynka', 'Poland', 'Contains both high aroma values and high content of bitter substances.', NULL, NULL, 9, 12, NULL),
(68, 'Nelson Sauvin', 'New Zealand', 'Imparts grape-like flavor.', 'Bittering.', NULL, 12, 14, NULL),
(69, 'Omega', 'United Kingdom', 'Increasingly rare.', 'All beer types.', 'Bittering', 9, 11, NULL),
(70, 'Orion', 'Germany', NULL, 'Bittering, aroma.', NULL, NULL, NULL, NULL),
(71, 'Phoenix', 'United Kingdom', 'Similar to Challenger.', 'Bittering, aroma.', 'All beer types.', 12, 15, 'Northdown, Kent Golding, Challenger'),
(72, 'Pioneer', 'United Kindom', 'Clean bitterness; mild "English" aroma.  Dwarf variety.', 'Bittering.', 'Ale, ESB', 8, 10, NULL),
(73, 'Record', 'Germany', NULL, NULL, NULL, NULL, NULL, NULL),
(74, 'Talisman', 'United States', 'Derived from Cluster.', NULL, NULL, 8, 10, NULL),
(76, 'Wye Target', NULL, 'Northern Brewer and Golding heritage.', 'Bittering', 'English style ale.', 9, 12, NULL),
(77, 'Yakima Magnum', 'United States', '', 'Bittering.', 'American strong ale.', 11, 12, NULL),
(78, 'Hallertauer Gold', 'Germany', 'Known for its aromatic properties similar to Hallertauer.', 'Bittering, aroma.', 'Ale, Lager, Pilsner, Bock, Wheat', 6, 6, 'Crystal, Mount Hood'),
(79, 'Northwest Golding', 'United Kingdom', 'Strong aroma.', 'Bittering, aroma.', 'Ale, Porter, Stout, ESB', 4, 5, NULL),
(80, 'Olympic', 'United States', 'Mild to medium, citrusy aroma, spicy.', 'Bittering.', 'Pale Ale', 11, 13, 'Chinook'),
(81, 'Satus', 'United States', 'Medium but pleasant hoppiness, citrusy.', 'Bittering.', 'Ale, Porter, ESB', 10, 14, 'Nugget, Pride of Ringwood, Chinook'),
(82, 'Spalt Select', 'Germany, United States', 'Very fine Spalter-type aroma.  U.S. variety has "wild American" tones.', 'Bittering, aroma.', 'Lager', 4, 6, 'Saaz, Tettnanger, German Spalt'),
(83, 'Tomahwak', 'United States', 'Bittering hop.', 'Bittering.', 'Ale', 15, 17, 'Columbus'),
(84, 'WGV (Whitbread Golding Variety)', 'United Kingdom', 'Quite pleasant and hoppy, moderately intense.  Traditional English hop with a sweet and fruity aroma.', 'Bittering, aroma.', 'Ale', 5, 7, 'Kent Golding, Progress'),
(85, 'Yakima Cluster', 'United States', 'Pleasant, aromatic hop.', 'Bittering, aroma.', 'Lager, Pale Ale', 6, 8, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `malt`
--

CREATE TABLE IF NOT EXISTS `malt` (
  `id` int(8) NOT NULL auto_increment,
  `maltName` varchar(250) default NULL,
  `maltLovibond` varchar(10) default NULL,
  `maltInfo` text,
  `maltCategory` char(1) default NULL,
  `maltYield` varchar(250) default NULL,
  `maltOrigin` varchar(255) default NULL,
  `maltSupplier` varchar(255) default NULL,
  `maltType` varchar(250) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM;

--
-- Dumping data for table `malt`
--

INSERT INTO `malt` (`id`, `maltName`, `maltLovibond`, `maltInfo`, `maltCategory`, `maltYield`, `maltOrigin`, `maltSupplier`, `maltType`) VALUES
(1, 'Crystal Malt 10L', '10', 'Sweet, mild caramel flavor and a golden color. Use in light lagers and light ales.', '2', '33', NULL, NULL, 'Grain'),
(2, 'Crystal Malt 20L', '20', 'Sweet, mild caramel flavor and a golden color. Use in light lagers and light ales.', '2', '33', NULL, NULL, 'Grain'),
(3, 'Crystal Malt 30L', '30', 'Sweet, mild caramel flavor and a golden color. Use in light lagers and light ales.', '2', '34', NULL, NULL, 'Grain'),
(4, 'Crystal Malt 40L', '40', 'Sweet, mild caramel flavor and a golden color. Use in light lagers and light ales.', '2', '34', NULL, NULL, 'Grain'),
(5, 'Crystal Malt 60L', '60', 'Sweet, mild caramel flavor and a golden color. Use in amber and brown ales.', '2', '35', NULL, NULL, 'Grain'),
(6, 'Crystal Malt 80L', '80', 'Sweet, mild caramel flavor and a golden color. For porters and stouts', '2', '36', NULL, NULL, 'Grain'),
(7, 'Crystal Malt 90L', '90', 'Pronounced caramel flavor and a red color. For stouts, porters and black beers.', '2', '36', NULL, NULL, 'Grain'),
(8, 'Crystal Malt 120L', '120', 'Pronounced caramel flavor and a red color. For stouts, porters and black beers.', '2', '36', NULL, NULL, 'Grain'),
(9, 'American Black Patent', '127', 'Provides color and sharp flavor. Use in stouts and porters.', '2', '41', NULL, NULL, 'Grain'),
(10, 'American Roasted Barley', '127', 'Sweet, grainy, coffee flavor and a red to deep brown color.', '2', '40', NULL, NULL, 'Grain'),
(11, 'American Black Barley', '127', '<p>Provides dryness.</p>', '2', '40', NULL, NULL, 'Grain'),
(12, 'American Chocolate Malt', '127', 'Use in all types to adjust color and add nutty, toasted flavor. Chocolate flavor.', '2', '38', NULL, NULL, 'Grain'),
(13, 'American Dextrin (Cara-Pils) Malt', '1', 'Balances body and flavor without adding color, aids in head retention. For any beer.', '2', '32', NULL, NULL, 'Grain'),
(14, 'American Pale Malt (2-Row)', '1', 'Smooth, less grainy, moderate malt flavor. Basic malt for all beer styles.', '2', '28', NULL, NULL, 'Grain'),
(15, 'American Munich Malt', '10', 'Sweet, toasted flavor and aroma. For Oktoberfests and malty styles.', '2', '30', NULL, NULL, 'Grain'),
(16, 'American Special Roast', '50', 'Provides a deep golden to brown color for ales. Use in all darker ales.', '2', '31', NULL, NULL, 'Grain'),
(17, 'American Vienna Malt', '4', 'Increases malty flavor, provides balance. Use in Vienna, Marzen and Oktoberfest.', '2', '29', NULL, NULL, 'Grain'),
(19, 'American Victory Malt', '25', 'Provides a deep golden to brown color. Use in nut brown ales, IPAs and Scottish ales.', '2', '58', NULL, NULL, 'Grain'),
(20, 'American Pale Malt (6-Row)', '1', 'Moderate malt flavor. Basic malt for all beer styles.', '1', '27', NULL, NULL, 'Grain'),
(21, 'American Wheat Malt', '2', 'Light flavor and creamy head. For American weizenbier, weissbier and dunkelweiss.', '1', '42', NULL, NULL, 'Grain'),
(22, 'American White Wheat Malt', '2', 'Imparts a malty flavor. For American wheat beers, wheat bock and doppel bock.', '1', '51', NULL, NULL, 'Grain'),
(23, 'Belgian Aromatic Malt', '20-26', 'Imparts a big malt aroma. Use in brown ales, Belgian dubbels and tripels.', '2', '78', NULL, NULL, 'Grain'),
(24, 'Belgian Biscuit Malt', '23-25', 'Warm baked biscuit flavor and aroma. Increases body. Use in Belgian beers.', '2', '28', NULL, NULL, 'Grain'),
(26, 'Belgian Caravienne Malt', '21-22', 'Light crystal malt. Used in lighter Abbey or Trappist style ales.', '2', '55', NULL, NULL, 'Grain'),
(27, 'Belgian Pale Ale Malt', '2.7-3.8', 'Use as a base malt for any Belgian style beer with full body.', '1', '26', NULL, NULL, 'Grain'),
(28, 'Belgian Plisen Malt', '1.5', 'Light color, malty flavor. For pilsners, dubbels, tripels, whites and specialty ales.', '1', '44', NULL, NULL, 'Grain'),
(29, 'Belgian Special B Malt', '130-220', 'Extreme caramel aroma and flavor. For dark Abbey beers and other dark beers.', '2', '37', NULL, NULL, 'Grain'),
(30, 'British Amber Malt', '35', 'Roasted malt used in British milds, old ales, brown ales, nut brown ales.', '2', '54', NULL, NULL, 'Grain'),
(31, 'British Brown Malt', '65', 'Imparts a dry, biscuit flavor. Use in porters, brown, nut brown and Belgian ales.', '2', '31', NULL, NULL, 'Grain'),
(32, 'British Maris Otter Pale Malt', '3', 'Premium base malt for any beer. Good for pale ales. ', '1', '26', NULL, NULL, 'Grain'),
(33, 'British Pale Ale Malt', '2.2', 'Moderate malt flavor. Used to produce traditional English and Scottish style ales. ', '1', '26', NULL, NULL, 'Grain'),
(34, 'British Crystal Malt', '55-60', 'Sweet caramel flavor, adds mouthfeel and head retention. For pale or amber ales. ', '2', '35', NULL, NULL, 'Grain'),
(35, 'British Dark Crystal Malt', '145-188', 'Sweet caramel flavor, mouthfeel. For porters, stouts, old ales and any dark ale.', '2', '36', NULL, NULL, 'Grain'),
(36, 'British Mild Ale Malt', '2.3-2.7', 'Dry, nutty malty flavor. Promotes body. Use in English mild ales.', '1', '50', NULL, NULL, 'Grain'),
(37, 'British Dextrin (Cara-Pils) Malt', '10-14', 'Adds body; aids head retention. For porters, stouts and heavier bodied beers.', '2', '32', NULL, NULL, 'Grain'),
(38, 'British Chocolate Malt', '395-475', 'Nutty, toasted flavor, brown color. Use as a specialty grain in brown ales, porters, stouts and bocks.', '2', '38', NULL, NULL, 'Grain'),
(39, 'British Black Patent Malt', '500-600', 'Dry, burnt, chalky character. Use in porters, stouts, brown ales and dark lagers.', '2', '41', NULL, NULL, 'Grain'),
(40, 'British Peat Smoked Malt', '2.8', 'Imparts a robust smoky flavor and aroma. For Scottish ales and wee heavies.', '2', '49', NULL, NULL, 'Grain'),
(41, 'British Roasted Barley', '500', 'Dry, roasted flavor, amber color. For stouts, porters and Scottish ales.', '2', '40', NULL, NULL, 'Grain'),
(42, 'British Toasted Pale Malt', '25', 'Imparts nutty flavor and aroma. Use in IPAs and Scottish ales.', '2', '51', NULL, NULL, 'Grain'),
(43, 'British Wheat Malt', '2', 'Light flavor, creamy head. For wheat beers, stouts, doppelbocks and alt beers. ', '1', '42', NULL, NULL, 'Grain'),
(44, 'British Torrified Wheat', '1-1.5', 'Puffed wheat created by high heat. Use in pale ales, bitters and milds.', '2', '71', NULL, NULL, 'Grain'),
(45, 'German Acidulated (Sauer) Malt', '1.7-2.8', 'High lactic acid. For lambics, sour mash beers, Irish stout, pilsners and wheats. ', '1', '79', NULL, NULL, 'Grain'),
(46, 'German Carafa I', '300-340', 'Gives deep aroma and color to dark beers, bocks, stout, alt and schwarzbier. ', '2', '64', NULL, NULL, 'Grain'),
(47, 'German Carafa II', '375-450', 'Adds aroma, color and body.', '2', '65', NULL, NULL, 'Grain'),
(48, 'German Carafa III', '490-560', 'Adds aroma, color and body.', '2', '66', NULL, NULL, 'Grain'),
(49, 'German Chocolate Wheat Malt', '375-450', 'Intensifies aroma; improves color. For dark ales, alt, dark wheat, stout and porter.', '2', '63', NULL, NULL, 'Grain'),
(50, 'German Chocolate Rye Malt', '190-300', 'Enhances aroma of dark ales and improves color. For dunkel rye wheat and ale.', '2', '62', NULL, NULL, 'Grain'),
(51, 'German CaraHell (Light Crystal) Malt', '8-12', 'For light colored beer for body; hefeweizen, pale ale, golden ale, Oktoberfest.', '2', '33', NULL, NULL, 'Grain'),
(52, 'German CaraMunich Malt I', '30-38', 'Provides body. For Oktoberfest, bock, porter, stout, red, amber and brown ales. Results include increased fullness, heightened aroma and fuller flavor. Use 1 - 5% for light or pale beers.', '2', '60', NULL, NULL, 'Grain'),
(53, 'German CaraMunich Malt II', '42-50', 'Provides body. For Oktoberfest, bock, porter, stout, red, amber and brown ales. Results in increased fullness, heightened aroma, fuller flavor and deep color. Use 5 -10% for darker beers. ', '2', '60', NULL, NULL, 'Grain'),
(54, 'German CaraMunich Malt III', '53-60', 'Provides body. For Oktoberfest, bock, porter, stout, red, amber and brown ales. Dark crystal. Results in deep saturated color and a fuller flavor.', '2', '60', NULL, NULL, 'Grain'),
(55, 'German Light Munich Malt', '5-6', 'For a malty, nutty flavor. Lagers, Oktoberfests and bock beer. ', '1', '30', NULL, NULL, 'Grain'),
(56, 'German Dark Munich Malt', '8-10', 'Enhances body and aroma. Stout, schwarzbier, brown ale, dark and amber ales.', '2', '30', NULL, NULL, 'Grain'),
(57, 'German Melanoidin Malt', '23-31', 'For amber lagers and ales, dark lagers and ales, Scottish &amp; red ales. Imparts a reddish hue.', '2', '53', NULL, NULL, 'Grain'),
(58, 'German Rauch Smoked Malt', '2-4', 'For rauchbier, kellerbier, smoked porters, Scottish ales and barleywines.', '2', '52', NULL, NULL, 'Grain'),
(59, 'German Rye Malt', '2.8-4.3', 'Dry character. Can use as a base malt. For seasonal beers, roggenbier and ales. ', '1', '1', NULL, NULL, 'Grain'),
(60, 'German Wheat Malt Light', '1.5-2', 'Typical top fermented aroma; for wheat beers.', '1', '47', NULL, NULL, 'Grain'),
(61, 'German Wheat Malt Dark', '6-8', 'Typical top fermented aroma; for wheat beers.', '1', '47', NULL, NULL, 'Grain'),
(62, 'German Caramel Wheat Malt', '38-53', 'For dark ales, hefeweizen, dunkelweizen, wheat bocks and double bocks.', '2', '59', NULL, NULL, 'Grain'),
(63, 'British Carastan Malt', '30', 'A British malt similar to American or Belgian crystal malts.', '2', '34', NULL, NULL, 'Grain'),
(64, 'Honey Malt', '25', 'Malt sweetness and honey like flavor and aroma.', '2', '57', NULL, NULL, 'Grain'),
(65, 'Scottish Golden Promise', '2.4', 'Scottish pale ale malt; base malt for all Scottish beers.', '1', '26', NULL, NULL, 'Grain'),
(66, 'Flaked Barley', '1.5', 'Helps head retention, imparts creamy smoothness. For porters and stouts.', '3', '4', NULL, NULL, 'Grain'),
(67, 'Flaked Maize', '1', 'Lightens body and color. For light American pilsners and ales.', '3', '3', NULL, NULL, 'Grain'),
(68, 'Flaked Oats', '1', 'Adds body and creamy head. For stouts and oat ales.', '3', '2', NULL, NULL, 'Grain'),
(69, 'Flaked Rye', '2', 'Imparts a dry, crisp character. Use in rye beers.', '3', '1', NULL, NULL, 'Grain'),
(70, 'Flaked Wheat', '2', 'Imparts a wheat flavor and hazy color. For wheat beers and Belgian white beers.', '3', '80', NULL, NULL, 'Grain'),
(71, 'Grits', '1-1.5', 'Imparts a corn/grain taste. Use in American lagers.', '3', '68', NULL, NULL, 'Grain'),
(72, 'German Vienna Malt', '3', 'Increases malty flavor, provides balance. Use in Vienna, Marzen and Oktoberfest.', '2', '29', NULL, NULL, 'Grain'),
(73, 'Scottish Peated Malt', '3', 'Imparts a smoky flavor.', '2', '49', NULL, NULL, 'Grain'),
(74, 'Oats (Steel Cut)', '10', 'Imparts oatmeal flavor for stouts.', '3', '2', NULL, NULL, 'Grain'),
(75, 'Flaked Rice', '1', 'Imparts a light, crisp finish.', '3', '6', NULL, NULL, 'Grain'),
(76, 'Rice Hulls', '1', 'Used as a filtering bed after mashing.', '3', '81', NULL, NULL, 'Grain'),
(77, 'German Carafa I De-Husked Malt', '400', 'De-husked for a less bitter taste. Great for use in Dark beers, Stouts, Altbier, and Bockbier. The unique de-husked barley adds aroma, color and body, with a milder smoother flavor that can be achieved with whole grains.', '2', '64', NULL, NULL, 'Grain'),
(78, 'German Carafa II De-Husked Malt', '500-600', 'De-husked for a less bitter taste. Great for use in Dark beers, Stouts, Altbier, and Bockbier. The unique de-husked barley adds aroma, color and body, with a milder smoother flavor that can be achieved with whole grains.', '2', '65', NULL, NULL, 'Grain'),
(79, 'German Carafa III De-Husked Malt', '650-750', 'De-husked for a less bitter taste. Great for use in Dark beers, Stouts, Altbier, and Bockbier. The unique de-husked barley adds aroma, color and body, with a milder smoother flavor that can be achieved with whole grains.', '2', '66', NULL, NULL, 'Grain'),
(81, 'German Wheat Chocolate Malt', '500', 'A roasted wheat malt used Altbier or Dark Wheat Beer (Ales). It results in an intensified aroma and improved color and a mild roasted flavor.', '2', '63', NULL, NULL, 'Grain'),
(82, 'Belgian Munich Malt', '3', 'Used to increase malt aroma and body with slightly more color. ', '2', '30', NULL, NULL, 'Grain'),
(83, 'German Pilsen Malt (2-Row)', '1.5', 'Light color, malty flavor. For pilsners, lagers.', '1', '43', NULL, NULL, 'Grain'),
(84, 'American Pilsen Malt', '1-2', 'Light color, malty flavor. For pilsners, lagers.', '1', '43', NULL, NULL, 'Grain'),
(85, 'American Rye Malt', '3.7', NULL, '2', '1', NULL, NULL, 'Grain'),
(86, 'British Pale Chocolate', '200', 'Used in darker beers such as porters and stouts to add color and richness. It is used in preference to chocolate malt when less color from the grains is desired and a grain with milder flavors is needed.', '3', '39', 'United Kingdom', 'Thomas Fawcett and Sons', 'Grain');

-- --------------------------------------------------------

--
-- Table structure for table `mash_profiles`
--

CREATE TABLE IF NOT EXISTS `mash_profiles` (
  `id` int(8) NOT NULL auto_increment,
  `mashProfileName` varchar(255) default NULL,
  `mashGrainTemp` varchar(255) default NULL,
  `mashTunTemp` varchar(255) default NULL,
  `mashSpargeTemp` varchar(255) default NULL,
  `mashPH` varchar(255) default NULL,
  `mashEquipAdj` varchar(255) default NULL,
  `mashNotes` text,
  `mashBrewerID` varchar(255) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM;

--
-- Dumping data for table `mash_profiles`
--

INSERT INTO `mash_profiles` (`id`, `mashProfileName`, `mashGrainTemp`, `mashTunTemp`, `mashSpargeTemp`, `mashPH`, `mashEquipAdj`, `mashNotes`, `mashBrewerID`) VALUES
(1, 'Double Decoction', '72', '72', '168', '5.4', NULL, '<p>Draw some of the mash, rest, and boil. Add back to main mash.</p>', 'brewblogger'),
(2, 'Single Decoction', '72', '72', '168', '5.4', NULL, '<p>Draw a part of the mash, let it rest for at least 10 minutes, and boil.</p>', 'brewblogger'),
(3, 'Triple Decoction', '72', '72', '168', '5.4', NULL, '<p>Authentic German methodology.</p>', 'brewblogger'),
(4, 'Triple Decoction (Noonan)', '72', '72', '168', '5.4', NULL, '<p>As described in Noonan&quot;s <span style="text-decoration: underline;">New Brewing Lager Beer</span>.</p>', 'brewblogger'),
(5, 'Double Infusion Mash, Full Bodied Beer', '72', '72', '168', '5.4', NULL, '<p>For beers requiring a protein rest utilizing undermodified grains or adjuncts.</p>', 'brewblogger'),
(6, 'Double Infusion Mash, Light Bodied Beer', '72', '72', '168', '5.4', NULL, '<p>For beers requiring a protein rest utilizing undermodified grains or adjuncts</p>', 'brewblogger'),
(7, 'Double Infusion Mash, Medium Bodied Beer', '72', '72', '168', '5.4', NULL, '<p>For beers requiring a protein rest utilizing undermodified grains or adjuncts.</p>', 'brewblogger'),
(8, 'Cereal Mash and Single Infusion Mash', '72', '72', '168', '5.4', NULL, '<p>Boil cereal adjuncts to add to infusion mash.</p>', 'brewblogger'),
(9, 'Single Infusion Mash, Full Bodied Beer', '72', '72', '168', '5.4', NULL, '<p>Mash profile for most well-modified malts.</p>', 'brewblogger'),
(11, 'Single Infusion Mash, Full Bodied Beer, No Mash Out', '72', '72', '168', '5.4', NULL, '<p>Mash profile for most well-modified malts.</p>', 'brewblogger'),
(12, 'Single Infusion Mash, Light Bodied Beer', '72', '72', '168', '5.4', NULL, '<p>Mash profile for most well-modified malts.</p>', 'brewblogger'),
(14, 'Single Infusion Mash, Light Bodied Beer, No Mash Out', '72', '72', '168', '5.4', NULL, '<p>Mash profile for most well-modified malts.</p>', 'brewblogger'),
(15, 'Single Infusion Mash, Medium Bodied Beer', '72', '72', '168', '5.4', NULL, '<p>Mash profile for most well-modified malts.</p>', 'brewblogger'),
(17, 'Single Infusion Mash, Medium Bodied Beer, No Mash Out', '72', '72', '168', '5.4', NULL, '<p>Mash profile for most well-modified malts.</p>', 'brewblogger'),
(18, 'Single Step Temperature Mash, Full Bodied Beer', '72', '72', '168', '5.4', NULL, '<p>Mash with a direct heat source to maintain temperature.</p>', 'brewblogger'),
(19, 'Single Step Temperature Mash, Light Bodied Beer', '72', '72', '168', '5.4', NULL, '<p>Mash with a direct heat source to maintain temperature.</p>', 'brewblogger'),
(20, 'Single Step Temperature Mash, Medium Bodied Beer', '72', '72', '168', '5.4', NULL, '<p>Mash with a direct heat source to maintain temperature.</p>', 'brewblogger'),
(21, 'Two Step Temperature Mash, Full Bodied Beer', '72', '72', '168', '5.4', NULL, '<p>Mash with a direct heat source to maintain temperature.</p>', 'brewblogger'),
(22, 'Two Step Temperature Mash, Light Bodied Beer', '72', '72', '168', '5.4', NULL, '<p>Mash with a direct heat source to maintain temperature.</p>', 'brewblogger'),
(23, 'Two Step Temperature Mash, Medium Bodied Beer', '72', '72', '168', '5.4', NULL, '<p>Mash with a direct heat source to maintain temperature.</p>', 'brewblogger');

-- --------------------------------------------------------

--
-- Table structure for table `mash_steps`
--

CREATE TABLE IF NOT EXISTS `mash_steps` (
  `id` int(8) NOT NULL auto_increment,
  `stepMashProfileID` int(8) default NULL,
  `stepName` varchar(255) default NULL,
  `stepNumber` int(8) default NULL,
  `stepType` varchar(255) default NULL,
  `stepTime` varchar(255) default NULL,
  `stepTemp` varchar(255) default NULL,
  `stepRampTime` varchar(255) default NULL,
  `stepEndTemp` varchar(255) default NULL,
  `stepDescription` text,
  `stepInfuseAmt` varchar(255) default NULL,
  `stepDecoctionAmt` varchar(255) default NULL,
  `stepInfusionTemp` varchar(255) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=58 ;

--
-- Dumping data for table `mash_steps`
--

INSERT INTO `mash_steps` (`id`, `stepMashProfileID`, `stepName`, `stepNumber`, `stepType`, `stepTime`, `stepTemp`, `stepRampTime`, `stepEndTemp`, `stepDescription`, `stepInfuseAmt`, `stepDecoctionAmt`, `stepInfusionTemp`) VALUES
(1, 1, 'Protein Rest', 1, 'Infusion', '35', '122', NULL, NULL, '<p>Add water at 126&deg; F / 52&deg; C</p>', NULL, NULL, NULL),
(2, 1, 'Saccharification', 2, 'Decoction', '20', '147', NULL, NULL, '<p>Decoct 30% of mash, rest for at least 10 minutes, and boil</p>', NULL, NULL, NULL),
(3, 1, 'Saccharification', 3, 'Decoction', '20', '158', NULL, NULL, '<p>Decoct 15% of mash, rest for at least 10 minutes, and boil</p>', NULL, NULL, NULL),
(4, 1, 'Mash Out', 4, 'Infusion', '10', '168', NULL, NULL, '<p>Heat to 168&deg; F / 75&deg; C for at least 10 minutes</p>', NULL, NULL, NULL),
(5, 2, 'Protein Rest', 1, 'Infusion', '35', '122', NULL, NULL, '<p>Add water at 126 F</p>', NULL, NULL, NULL),
(6, 2, 'Saccharification', 2, 'Decoction', '45', '155', NULL, NULL, '<p>Decoct 44% of mash, rest for at least 10 minutes, and boil</p>', NULL, NULL, NULL),
(7, 2, 'Mash Out', 3, 'Infusion', '10', '168', NULL, NULL, '<p>Heat to 168&deg; F / 75&deg; C for at least 10 minutes</p>', NULL, NULL, NULL),
(8, 3, 'Acid Rest', 1, 'Infusion', '45', '95', NULL, NULL, '<p>Add water at 97&deg; F / 36&deg; C</p>', NULL, NULL, NULL),
(9, 3, 'Protein Rest', 2, 'Decoction', '60', '122', NULL, NULL, '<p>Decoct 25% of mash, rest for at least 10 minutes, and boil</p>', NULL, NULL, NULL),
(10, 3, 'Saccharification', 3, 'Decoction', '15', '148', NULL, NULL, '<p>Decoct 30% of mash, rest for at least 10 minutes, and boil</p>', NULL, NULL, NULL),
(11, 3, 'Saccharification', 4, 'Decoction', '15', '158', NULL, NULL, '<p>Decoct 30% of mash, rest for at least 10 minutes, and boil</p>', NULL, NULL, NULL),
(12, 3, 'Mash Out', 5, 'Infusion', '10', '168', NULL, NULL, '<p>Heat to 168&deg; F / 75&deg; C for at least 10 minutes</p>', NULL, NULL, NULL),
(13, 4, 'Dough-In', 1, 'Infusion', '15', '70', NULL, NULL, '<p>Add 60% of mash water at 70&deg; F / 22&deg; C</p>', NULL, NULL, NULL),
(14, 4, 'Acid Rest', 2, 'Decoction', '20', '105', NULL, NULL, '<p>Add 40% of mash water at 165&deg; F / 74&deg; C</p>', NULL, NULL, NULL),
(15, 4, 'Protein Rest', 3, 'Decoction', '10', '122', NULL, NULL, '<p>Decoct 20% of mash, rest for at least 10 minutes, and boil</p>', NULL, NULL, NULL),
(16, 4, 'Dextrinization Rest', 4, 'Decoction', '20', '155', NULL, NULL, '<p>Decoct 40% of mash, rest for at least 10 minutes, and boil</p>', NULL, NULL, NULL),
(17, 4, 'Mash Out', 5, 'Infusion', '5', '170', NULL, NULL, '<p>Decoct 25% of mash, rest for at least 10 minutes, and boil</p>', NULL, NULL, NULL),
(18, 5, 'Protein Rest', 1, 'Infusion', '30', '122', NULL, NULL, '<p>Add 40% of mash water at 132&deg; F / 55&deg; C</p>', NULL, NULL, NULL),
(19, 5, 'Saccrification', 2, 'Infusion', '30', '158', NULL, NULL, '<p>Add 35% of mash water at 207&deg; F / 97&deg; C</p>', NULL, NULL, NULL),
(20, 5, 'Mash Out', 3, 'Infusion', '10', '168', NULL, NULL, '<p>Add 25% of mash water at 199&deg; F / 92&deg; C</p>', NULL, NULL, NULL),
(21, 6, 'Protein Rest', 1, 'Infusion', '30', '122', NULL, NULL, '<p>Add 40% of mash water at 132&deg; F / 55&deg; C</p>', NULL, NULL, NULL),
(22, 6, 'Saccrification', 2, 'Infusion', '30', '150', NULL, NULL, '<p>Add 35% of mash water at 188&deg; F / 87&deg; C</p>', NULL, NULL, NULL),
(23, 6, 'Mash Out', 3, 'Infusion', '10', '168', NULL, NULL, '<p>Add 25% of mash water at 210&deg; F / 99&deg; C</p>', NULL, NULL, NULL),
(24, 7, 'Protein Rest', 1, 'Infusion', '30', '122', NULL, NULL, '<p>Add 40% of mash water at 132&deg; F / 55&deg; C</p>', NULL, NULL, NULL),
(25, 7, 'Saccrification', 2, 'Infusion', '30', '154', NULL, NULL, '<p>Add 35% of mash water at 197&deg; F / 92&deg; C</p>', NULL, NULL, NULL),
(26, 7, 'Mash Out', 3, 'Infusion', '10', '168', NULL, NULL, '<p>Add 25% of mash water at 205&deg; F / 96&deg; C</p>', NULL, NULL, NULL),
(27, 8, 'Protein Rest', 1, 'Infusion', '30', '104', NULL, NULL, '<p>Add 30% of mash water at 111&deg; F / 44&deg; C</p>', NULL, NULL, NULL),
(28, 8, 'Protein Rest', 2, 'Infusion', '45', '122', NULL, NULL, '<p>Add 10% of mash water at 181&deg; F / 83&deg; C</p>', NULL, NULL, NULL),
(29, 8, 'Saccharification', 3, 'Infusion', '60', '150', NULL, NULL, '<p>Add 25% of mash water at 200&deg; F / 93&deg; C</p>', NULL, NULL, NULL),
(30, 8, 'Mash Out', 4, 'Infusion', '10', '168', NULL, NULL, '<p>Add 35% of mash water at 208&deg; F / 98&deg; C</p>', NULL, NULL, NULL),
(31, 9, 'Mash In', 1, 'Infusion', '45', '158', NULL, NULL, '<p>Add 70% of mash water at 171&deg; F / 77&deg; C</p>', NULL, NULL, NULL),
(32, 9, 'Mash Out', 2, 'Infusion', '10', '168', NULL, NULL, '<p>Add 30% of mash water at 197&deg; F / 92&deg; C</p>', NULL, NULL, NULL),
(34, 11, 'Mash In', 1, 'Infusion', '45', '158', NULL, NULL, '<p>Add 100% of mash water at 171&deg; F / 77&deg; C</p>', NULL, NULL, NULL),
(35, 12, 'Mash In', 1, 'Infusion', '75', '150', NULL, NULL, '<p>Add 75% of mash water at 162&deg; F / 72&deg; C</p>', NULL, NULL, NULL),
(36, 12, 'Mash Out', 2, 'Infusion', '10', '168', NULL, NULL, '<p>Add 25% of mash water at 200&deg; F / 93&deg; C</p>', NULL, NULL, NULL),
(38, 14, 'Mash In', 1, 'Infusion', '75', '150', NULL, NULL, '<p>Add 100% of mash water at 162&deg; F / 72&deg; C</p>', NULL, NULL, NULL),
(39, 15, 'Mash In', 1, 'Infusion', '60', '154', NULL, NULL, '<p>Add 70% of mash water at 166&deg; F / 74&deg; C</p>', NULL, NULL, NULL),
(40, 15, 'Mash Out', 2, 'Infusion', '10', '168', NULL, NULL, '<p>Add 30% of mash water at 197&deg; F / 92&deg; C</p>', NULL, NULL, NULL),
(42, 17, 'Mash In', 1, 'Infusion', '60', '154', NULL, NULL, '<p>Add 100% of mash water at 166&deg; F / 74&deg; C</p>', NULL, NULL, NULL),
(43, 18, 'Saccharification', 1, 'Infusion', '40', '158', NULL, NULL, '<p>Add 100% of mash water at 170&deg; F / 77&deg; C</p>', NULL, NULL, NULL),
(44, 18, 'Mash Out', 2, 'Temperature', '10', '168', NULL, NULL, '<p>Heat to 168&deg; F / 75&deg; C for at least 10 minutes</p>', NULL, NULL, NULL),
(45, 19, 'Saccharification', 1, 'Infusion', '75', '150', NULL, NULL, '<p>Add 100% of mash water at 162&deg; F / 72&deg; C</p>', NULL, NULL, NULL),
(46, 19, 'Mash Out', 2, 'Temperature', '10', '168', NULL, NULL, '<p>Heat to 168&deg; F / 75&deg; C for at least 10 minutes</p>', NULL, NULL, NULL),
(47, 20, 'Saccharification', 1, 'Infusion', '60', '154', NULL, NULL, '<p>Add 100% of mash water at 166&deg; F / 74&deg; C</p>', NULL, NULL, NULL),
(48, 20, 'Mash Out', 2, 'Temperature', '10', '168', NULL, NULL, '<p>Heat to 168&deg; F / 75&deg; C for at least 10 minutes</p>', NULL, NULL, NULL),
(49, 21, 'Protein Rest', 1, 'Infusion', '30', '122', NULL, NULL, '<p>Add 100% of mash water at 128&deg; F / 53&deg; C</p>', NULL, NULL, NULL),
(50, 21, 'Saccharification', 2, 'Temperature', '30', '158', NULL, NULL, '<p>Heat to 158&deg; F / 70&deg; C over 15 minutes</p>', NULL, NULL, NULL),
(51, 21, 'Mash Out', 3, 'Temperature', '10', '168', NULL, NULL, '<p>Heat to 168&deg; F / 75&deg; C for at least 10 minutes</p>', NULL, NULL, NULL),
(52, 22, 'Protein Rest', 1, 'Infusion', '30', '122', NULL, NULL, '<p>Add 100% of mash water at 129&deg; F / 54&deg; C</p>', NULL, NULL, NULL),
(53, 22, 'Saccharification', 2, 'Temperature', '75', '150', NULL, NULL, '<p>Heat to 150&deg; F / 65.5&deg;C  over 15 minutes</p>', NULL, NULL, NULL),
(54, 22, 'Mash Out', 3, 'Temperature', '10', '168', NULL, NULL, '<p>Heat to 168&deg; F / 75&deg; C for at least 10 minutes</p>', NULL, NULL, NULL),
(55, 23, 'Protein Rest', 1, NULL, '30', '122', NULL, NULL, 'Add 100% of mash water at 129&deg; F / 54&deg; C', NULL, NULL, NULL),
(56, 23, 'Saccharification', 2, NULL, '45', '154', NULL, NULL, 'Heat to 154&deg; F / 68&deg; over 15 minutes', NULL, NULL, NULL),
(57, 23, 'Mash Out', 3, NULL, '10', '168', NULL, NULL, 'Heat to 168&deg; F / 75&deg; C for at least 10 minutes', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `misc`
--

CREATE TABLE IF NOT EXISTS `misc` (
  `id` int(8) NOT NULL auto_increment,
  `miscName` varchar(255) default NULL,
  `miscType` varchar(255) default NULL,
  `miscUse` varchar(255) default NULL,
  `miscNotes` varchar(255) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM;

--
-- Dumping data for table `misc`
--

INSERT INTO `misc` (`id`, `miscName`, `miscType`, `miscUse`, `miscNotes`) VALUES
(1, 'Amylase Enzyme', 'Other', 'Primary', '<p>Enhances fermentation and lowers final gravity.</p>'),
(2, 'Extract - Apricot', 'Flavor', 'Bottling', '<p>Apricot flavoring to add after fermentation is complete.</p>'),
(3, 'Baking Soda', 'Water Agent', 'Mash', '<p>Use to adjust brewing water mineral content.</p>'),
(4, 'Bitter Orange Peel', 'Spice', 'Boil', '<p>Made from curaco orange peel, used primarily in Belgian Wits and white beers.</p>'),
(5, 'Extract - Blackberry', 'Flavor', 'Bottling', '<p>Blackberry flavoring to add after fermentation is complete.</p>'),
(6, 'Burton Water Salts', 'Water Agent', 'Mash', '<p>A mixture of gypsum, potassium chloride, and epsom salt.  Used to harden water.</p>'),
(7, 'Calcium Chloride', 'Water Agent', 'Mash', 'Use to adjust brewing water mineral content. Adjusts pH of mash.'),
(8, 'Chalk', 'Water Agent', 'Mash', '<p>Use to adjust brewing water mineral content.</p>'),
(9, 'Extract - Cherry', 'Flavor', 'Bottling', '<p>Cherry flavoring to add after fermentation is complete.</p>'),
(10, 'Cinnamon Stick', 'Spice', 'Boil', '<p>Add one stick five minutes from the end of the boil. Can also be used in secondary with lesser flavor impact.</p>'),
(11, 'Clearfine', 'Spice', 'Secondary', '<p>Blend of animal collagen and polysaccarides that helps rapidly precipitate yeast and tannins.</p>'),
(12, 'Coriander Seed', 'Spice', 'Boil', '<p>Used in Belgian Wit, Whites, and Holiday ales. Adds a &ldquo;bright&rdquo; flavor profile that enhances citrus notes.</p>'),
(13, 'Extract - Cranberry', 'Flavor', 'Bottling', '<p>Cranberry flavoring to add after fermentation is complete.</p>'),
(14, 'Epsom Salt (MgSO4)', 'Water Agent', 'Mash', '<p>Use to adjust brewing water mineral content.</p>'),
(15, 'Sweet Gale', 'Spice', 'Boil', '<p>Very strong and fragrant. Use sparingly.</p>'),
(16, 'Gelatin', 'Spice', 'Secondary', '<p>Aids in settling yeast.</p>'),
(17, 'Ginger Root', 'Herb', 'Boil', '<p>Adds ginger flavor.</p>'),
(18, 'Gypsum (Calcium Sulfate)', 'Water Agent', 'Mash', '<p>Reduces PH of water.  Used to harden water.</p>'),
(19, 'Heading Liquid', 'Other', 'Bottling', 'Aids head formation and head retention.  Add before bottling.'),
(20, 'Irish Moss', 'Spice', 'Boil', '<p>Reduces protein chill haze and improves beer clarity. An ingredient in Whirlfloc.</p>'),
(21, 'Isinglass', 'Spice', 'Secondary', '<p>Aids in settling proteins, tannins, and yeast.</p>'),
(22, 'Lactic Acid', 'Water Agent', 'Mash', '<p>Used to lower the pH of the mash without altering the water profile.</p>'),
(23, 'Oak Chips', 'Flavor', 'Secondary', '<p>Used to simulate oak flavor.</p>'),
(24, 'BioFoam', 'Spice', 'Bottling', '<p>Improves foam and head retention of beer by augmenting the natural foam components in beer.</p>'),
(38, 'Mugwort', 'Herb', 'Secondary', '<p>Sage-like aroma.</p>'),
(25, '5.2 Stabilizer', 'Water Agent', 'Mash', '<p>Five Star Chemical"s mix of buffers used to adjust mash PH to 5.2.</p>'),
(26, 'Papain', 'Spice', 'Secondary', '<p>Helps reduce protein chill haze.  Add to secondary.</p>'),
(27, 'Polyclar', 'Spice', 'Secondary', '<p>Reduces chill haze.  Add to secondary.</p>'),
(28, 'Extract - Raspberry', 'Flavor', 'Bottling', '<p>Raspberry flavoring to add after fermentation is complete.</p>'),
(29, 'Salt', 'Water Agent', 'Mash', 'Use to adjust brewing water sodium levels.'),
(30, 'Sassafras', 'Spice', 'Boil', '<p>Bark of the sassafras tree root.  Adds root beer flavor.</p>'),
(31, 'Seeds of Paradise', 'Spice', 'Boil', '<p>Pepper and citrus qualities.</p>'),
(32, 'Extract - Spruce', 'Flavor', 'Bottling', '<p>Adds flavor and scent of spruce pine.</p>'),
(33, 'Spruce Tips', 'Herb', 'Bottling', '<p>Adds flavor and scent of spruce pine.</p>'),
(34, 'Star Anise', 'Spice', 'Boil', '<p>Adds black licorice flavor.</p>'),
(35, 'Sweet Orange Peel', 'Spice', 'Boil', '<p>Adds a sweet orange flavor and aroma.</p>'),
(36, 'Whirlfloc', 'Spice', 'Boil', '<p>A blend of Irish Moss and purified Kappa Carrageenan that aids in clearing of haze causing materials. Add to boil.</p>'),
(37, 'Yeast Nutrient', 'Other', 'Primary', '<p>Add before pitching yeast.</p>'),
(39, 'Cardamom', 'Spice', 'Boil', '<p>Imparts a pleasant, spicy cola-like flavor. Blends well with coriander and sweet or bitter orange peel.</p>'),
(40, 'Heather Tips', 'Herb', 'Boil', '<p>Imparts a pleasant aroma and smooth bitterness to beer. Add to boil.</p>'),
(41, 'Juniper Berries', 'Herb', 'Boil', '<p>Flavor is very compatible with rye beer and blends well with the citrus notes of ginger and orange peel as well as licorice root and coriander.</p>'),
(42, 'Licorice Root', 'Flavor', 'Boil', '<p>Adds a pleasing flavor to porters, stouts and dark ales. Also, sweetens and improves head retention. Blends well with juniper berries and mugwort.</p>'),
(43, 'Rose Hips', 'Herb', 'Secondary', '<p>Imparts a fragrant aroma and taste.</p>'),
(44, 'Vanilla Bean', 'Flavor', 'Boil', '<p>Add to the boil as a flavoring agent. Add to secondary for aroma.</p>'),
(45, 'Super Moss', 'Fining', 'Boil', '<p>Super Moss a purified form Irish Moss that mixes quickly in cold water and is more effective in removing coagulated protein matter from the boil than plain dried Irish Moss.</p>'),
(46, 'Silica Gel', 'Fining', 'Bottling', '<p>Silica gel will remove 90 to 95% of the chill haze in beer. Composed of silica (an insoluble mineral) and sterile water.</p>'),
(47, 'Extract - Apple', 'Flavor', 'Bottling', '<p>Apple flavoring to add after fermentation is complete.</p>'),
(48, 'Extract - Blueberry', 'Flavor', 'Bottling', '<p>Blueberry flavoring to add after fermentation is complete.</p>'),
(49, 'Extract - Watermellon', 'Flavor', 'Bottling', '<p>Watermellon flavoring to add after fermentation is complete.</p>'),
(50, 'Extract - Strawberry', 'Flavor', 'Bottling', '<p>Strawberry flavoring to add after fermentation is complete.</p>'),
(51, 'Extract - Peach', 'Flavor', 'Bottling', '<p>Peach flavoring to add after fermentation is complete.</p>'),
(52, 'Extract - Grape', 'Flavor', 'Bottling', '<p>Raspberry flavoring to add after fermentation is complete.</p>'),
(53, 'Extract - Banana', 'Flavor', 'Bottling', '<p>Banana flavoring to add after fermentation is complete.</p>'),
(54, 'Fermcap', 'Other', 'Boil', '<p>Food grade ingredient, dimethylpolysiloxane, reduces surface tension of the wort. Reduces foaming in boil and in fermentation. Settles out with yeast. Add 1/4 to 1/2 tsp. per 5 gallons.</p>');

-- --------------------------------------------------------

--
-- Table structure for table `news`
--

CREATE TABLE IF NOT EXISTS `news` (
  `id` int(8) NOT NULL auto_increment,
  `newsHeadline` varchar(250) default NULL,
  `newsText` text,
  `newsDate` date default NULL,
  `newsPrivate` char(1) default NULL,
  `newsPoster` varchar(250) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM;

--
-- Dumping data for table `news`
--

INSERT INTO `news` (`id`, `newsHeadline`, `newsText`, `newsDate`, `newsPrivate`, `newsPoster`) VALUES
(1, 'Test', '<p>This is a public news post. Ain&rsquo;t it exciting?</p>', '2008-08-07', 'Y', 'admin'),
(2, 'Testing Private', '<p>This is a private post that only authorized users can see.</p>', '2008-08-06', 'N', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `preferences`
--

CREATE TABLE IF NOT EXISTS `preferences` (
  `id` tinyint(4) NOT NULL auto_increment,
  `measFluid1` varchar(100) default NULL,
  `measFluid2` varchar(100) default NULL,
  `measWeight1` varchar(100) default NULL,
  `measWeight2` varchar(100) default NULL,
  `measWaterGrainRatio` varchar(255) default NULL,
  `measTemp` varchar(100) default NULL,
  `measColor` varchar(100) default NULL,
  `measBitter` varchar(100) default NULL,
  `measAbbrev` char(1) default NULL,
  `allowReviews` char(1) default NULL,
  `allowPrintLog` char(1) default NULL,
  `allowPrintRecipe` char(1) default NULL,
  `allowPrintXML` char(1) default NULL,
  `allowSpecifics` char(1) default NULL,
  `allowGeneral` char(1) default NULL,
  `allowComments` char(1) default NULL,
  `allowRecipe` char(1) default NULL,
  `allowMash` char(1) default NULL,
  `allowWater` char(1) default NULL,
  `allowProcedure` char(1) default NULL,
  `allowSpecialProcedure` char(1) default NULL,
  `allowFermentation` char(1) default NULL,
  `allowLabel` char(1) default NULL,
  `allowRelated` char(1) default NULL,
  `allowList` char(1) default NULL,
  `allowStatus` char(1) default NULL,
  `allowUpcoming` char(1) default NULL,
  `allowAwards` char(1) default NULL,
  `allowCalendar` char(1) default NULL,
  `allowNews` char(1) default NULL,
  `allowProfile` char(1) default NULL,
  `theme` varchar(250) default NULL,
  `mode` char(1) default NULL,
  `home` varchar(250) default NULL,
  `menuHome` varchar(255) default NULL,
  `menuBrewBlogs` varchar(255) default NULL,
  `menuRecipes` varchar(255) default NULL,
  `menuAwards` varchar(255) default NULL,
  `menuAbout` varchar(255) default NULL,
  `menuReference` varchar(255) default NULL,
  `menuCalculators` varchar(255) default NULL,
  `menuCalendar` varchar(255) default NULL,
  `menuLogin` varchar(255) default NULL,
  `menuLogout` varchar(255) default NULL,
  `menuMembers` varchar(255) default NULL,
  `mashDisplayMethod` char(1) default NULL,
  `waterDisplayMethod` char(1) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM;

--
-- Dumping data for table `preferences`
--

INSERT INTO `preferences` (`id`, `measFluid1`, `measFluid2`, `measWeight1`, `measWeight2`, `measWaterGrainRatio`, `measTemp`, `measColor`, `measBitter`, `measAbbrev`, `allowReviews`, `allowPrintLog`, `allowPrintRecipe`, `allowPrintXML`, `allowSpecifics`, `allowGeneral`, `allowComments`, `allowRecipe`, `allowMash`, `allowWater`, `allowProcedure`, `allowSpecialProcedure`, `allowFermentation`, `allowLabel`, `allowRelated`, `allowList`, `allowStatus`, `allowUpcoming`, `allowAwards`, `allowCalendar`, `allowNews`, `allowProfile`, `theme`, `mode`, `home`, `menuHome`, `menuBrewBlogs`, `menuRecipes`, `menuAwards`, `menuAbout`, `menuReference`, `menuCalculators`, `menuCalendar`, `menuLogin`, `menuLogout`, `menuMembers`, `mashDisplayMethod`, `waterDisplayMethod`) VALUES
(1, 'ounces', 'gallons', 'ounces', 'pounds', 'qt/lb', 'F', 'SRM', 'IBU', 'o', 'Y', 'Y', 'Y', 'Y', 'Y', 'Y', 'Y', 'Y', 'Y', 'Y', 'Y', 'Y', 'Y', 'Y', 'Y', 'Y', 'Y', 'Y', 'Y', 'Y', 'Y', 'Y', 'midas.css', '1', 'brewBlogCurrent', 'Home', 'BrewBlogs', 'Recipes', 'Awards-Competitions', 'About', 'Reference', 'Calculators', 'Calendar', 'Login', 'Log Out', 'Members', '1', '1');-- --------------------------------------------------------

--
-- Table structure for table `recipes`
--

CREATE TABLE IF NOT EXISTS `recipes` (
  `id` int(8) NOT NULL auto_increment,
  `brewName` varchar(250) default NULL,
  `brewStyle` varchar(250) default NULL,
  `brewSource` varchar(200) default NULL,
  `brewYield` varchar(10) default NULL,
  `brewMethod` varchar(200) default NULL,
  `brewLink1` varchar(250) default NULL,
  `brewLink1Name` varchar(250) default NULL,
  `brewLink2` varchar(250) default NULL,
  `brewLink2Name` varchar(250) default NULL,
  `brewNotes` text,
  `brewExtract1` varchar(100) default NULL,
  `brewExtract1Weight` varchar(10) default NULL,
  `brewExtract2` varchar(100) default NULL,
  `brewExtract2Weight` varchar(10) default NULL,
  `brewExtract3` varchar(100) default NULL,
  `brewExtract3Weight` varchar(4) default NULL,
  `brewExtract4` varchar(100) default NULL,
  `brewExtract4Weight` varchar(10) default NULL,
  `brewExtract5` varchar(100) default NULL,
  `brewExtract5Weight` varchar(10) default NULL,
  `brewGrain1` varchar(100) default NULL,
  `brewGrain1Weight` varchar(10) default NULL,
  `brewGrain2` varchar(100) default NULL,
  `brewGrain2Weight` varchar(10) default NULL,
  `brewGrain3` varchar(100) default NULL,
  `brewGrain3Weight` varchar(10) default NULL,
  `brewGrain4` varchar(100) default NULL,
  `brewGrain4Weight` varchar(10) default NULL,
  `brewGrain5` varchar(100) default NULL,
  `brewGrain5Weight` varchar(4) default NULL,
  `brewGrain6` varchar(100) default NULL,
  `brewGrain6Weight` varchar(10) default NULL,
  `brewGrain7` varchar(100) default NULL,
  `brewGrain7Weight` varchar(10) default NULL,
  `brewGrain8` varchar(100) default NULL,
  `brewGrain8Weight` varchar(10) default NULL,
  `brewGrain9` varchar(100) default NULL,
  `brewGrain9Weight` varchar(10) default NULL,
  `brewAddition1` varchar(100) default NULL,
  `brewAddition1Amt` varchar(20) default NULL,
  `brewAddition2` varchar(100) default NULL,
  `brewAddition2Amt` varchar(20) default NULL,
  `brewAddition3` varchar(100) default NULL,
  `brewAddition3Amt` varchar(20) default NULL,
  `brewAddition4` varchar(100) default NULL,
  `brewAddition4Amt` varchar(20) default NULL,
  `brewAddition5` varchar(100) default NULL,
  `brewAddition5Amt` varchar(20) default NULL,
  `brewAddition6` varchar(100) default NULL,
  `brewAddition6Amt` varchar(20) default NULL,
  `brewAddition7` varchar(100) default NULL,
  `brewAddition7Amt` varchar(20) default NULL,
  `brewAddition8` varchar(100) default NULL,
  `brewAddition8Amt` varchar(20) default NULL,
  `brewAddition9` varchar(100) default NULL,
  `brewAddition9Amt` varchar(20) default NULL,
  `brewMisc1Name` varchar(250) default NULL,
  `brewMisc2Name` varchar(250) default NULL,
  `brewMisc3Name` varchar(250) default NULL,
  `brewMisc4Name` varchar(250) default NULL,
  `brewMisc1Type` varchar(25) default NULL,
  `brewMisc2Type` varchar(25) default NULL,
  `brewMisc3Type` varchar(25) default NULL,
  `brewMisc4Type` varchar(25) default NULL,
  `brewMisc1Use` varchar(25) default NULL,
  `brewMisc2Use` varchar(25) default NULL,
  `brewMisc3Use` varchar(25) default NULL,
  `brewMisc4Use` varchar(25) default NULL,
  `brewMisc1Time` varchar(25) default NULL,
  `brewMisc2Time` varchar(25) default NULL,
  `brewMisc3Time` varchar(25) default NULL,
  `brewMisc4Time` varchar(25) default NULL,
  `brewMisc1Amount` varchar(25) default NULL,
  `brewMisc2Amount` varchar(25) default NULL,
  `brewMisc3Amount` varchar(25) default NULL,
  `brewMisc4Amount` varchar(25) default NULL,
  `brewHops1` varchar(100) default NULL,
  `brewHops1Weight` varchar(10) default NULL,
  `brewHops1IBU` varchar(10) default NULL,
  `brewHops1Time` varchar(25) default NULL,
  `brewHops2` varchar(100) default NULL,
  `brewHops2Weight` varchar(10) default NULL,
  `brewHops2IBU` varchar(10) default NULL,
  `brewHops2Time` varchar(25) default NULL,
  `brewHops3` varchar(100) default NULL,
  `brewHops3Weight` varchar(10) default NULL,
  `brewHops3IBU` varchar(10) default NULL,
  `brewHops3Time` varchar(25) default NULL,
  `brewHops4` varchar(100) default NULL,
  `brewHops4Weight` varchar(10) default NULL,
  `brewHops4IBU` varchar(10) default NULL,
  `brewHops4Time` varchar(25) default NULL,
  `brewHops5` varchar(100) default NULL,
  `brewHops5Weight` varchar(10) default NULL,
  `brewHops5IBU` varchar(10) default NULL,
  `brewHops5Time` varchar(25) default NULL,
  `brewHops6` varchar(100) default NULL,
  `brewHops6Weight` varchar(10) default NULL,
  `brewHops6IBU` varchar(10) default NULL,
  `brewHops6Time` varchar(25) default NULL,
  `brewHops7` varchar(100) default NULL,
  `brewHops7Weight` varchar(10) default NULL,
  `brewHops7IBU` varchar(10) default NULL,
  `brewHops7Time` varchar(25) default NULL,
  `brewHops8` varchar(100) default NULL,
  `brewHops8Weight` varchar(10) default NULL,
  `brewHops8IBU` varchar(10) default NULL,
  `brewHops8Time` varchar(25) default NULL,
  `brewHops9` varchar(100) default NULL,
  `brewHops9Weight` varchar(10) default NULL,
  `brewHops9IBU` varchar(10) default NULL,
  `brewHops9Time` varchar(25) default NULL,
  `brewHops1Use` varchar(25) default NULL,
  `brewHops2Use` varchar(25) default NULL,
  `brewHops3Use` varchar(25) default NULL,
  `brewHops4Use` varchar(25) default NULL,
  `brewHops5Use` varchar(25) default NULL,
  `brewHops6Use` varchar(25) default NULL,
  `brewHops7Use` varchar(25) default NULL,
  `brewHops8Use` varchar(25) default NULL,
  `brewHops9Use` varchar(25) default NULL,
  `brewHops1Type` varchar(25) default NULL,
  `brewHops2Type` varchar(25) default NULL,
  `brewHops3Type` varchar(25) default NULL,
  `brewHops4Type` varchar(25) default NULL,
  `brewHops5Type` varchar(25) default NULL,
  `brewHops6Type` varchar(25) default NULL,
  `brewHops7Type` varchar(25) default NULL,
  `brewHops8Type` varchar(25) default NULL,
  `brewHops9Type` varchar(25) default NULL,
  `brewHops1Form` varchar(25) default NULL,
  `brewHops2Form` varchar(25) default NULL,
  `brewHops3Form` varchar(25) default NULL,
  `brewHops4Form` varchar(25) default NULL,
  `brewHops5Form` varchar(25) default NULL,
  `brewHops6Form` varchar(25) default NULL,
  `brewHops7Form` varchar(25) default NULL,
  `brewHops8Form` varchar(25) default NULL,
  `brewHops9Form` varchar(25) default NULL,
  `brewYeast` varchar(250) default NULL,
  `brewYeastMan` varchar(250) default NULL,
  `brewYeastForm` varchar(25) default NULL,
  `brewYeastType` varchar(25) default NULL,
  `brewYeastAmount` varchar(25) default NULL,
  `brewLabelImage` varchar(250) default NULL,
  `brewOG` varchar(10) default NULL,
  `brewFG` varchar(10) default NULL,
  `brewProcedure` text,
  `brewPrimary` varchar(10) default NULL,
  `brewPrimaryTemp` varchar(10) default NULL,
  `brewSecondary` varchar(10) default NULL,
  `brewSecondaryTemp` varchar(10) default NULL,
  `brewTertiary` varchar(10) default NULL,
  `brewTertiaryTemp` varchar(10) default NULL,
  `brewLager` varchar(10) default NULL,
  `brewLagerTemp` varchar(10) default NULL,
  `brewAge` varchar(10) default NULL,
  `brewAgeTemp` varchar(10) default NULL,
  `brewBitterness` varchar(10) default NULL,
  `brewIBUFormula` varchar(250) default NULL,
  `brewLovibond` varchar(10) default NULL,
  `brewBrewerID` varchar(250) default NULL,
  `brewBoilTime` int(4) default NULL,
  `brewFeatured` char(1) default NULL,
  `brewMashProfile` int(5) default NULL,
  `brewWaterProfile` int(5) default NULL,
  `brewYeastProfile` int(5) default NULL,
  `brewArchive` varchar(8) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM;

--
-- Dumping data for table `recipes`
--

INSERT INTO `recipes` (`id`, `brewName`, `brewStyle`, `brewSource`, `brewYield`, `brewMethod`, `brewLink1`, `brewLink1Name`, `brewLink2`, `brewLink2Name`, `brewNotes`, `brewExtract1`, `brewExtract1Weight`, `brewExtract2`, `brewExtract2Weight`, `brewExtract3`, `brewExtract3Weight`, `brewExtract4`, `brewExtract4Weight`, `brewExtract5`, `brewExtract5Weight`, `brewGrain1`, `brewGrain1Weight`, `brewGrain2`, `brewGrain2Weight`, `brewGrain3`, `brewGrain3Weight`, `brewGrain4`, `brewGrain4Weight`, `brewGrain5`, `brewGrain5Weight`, `brewGrain6`, `brewGrain6Weight`, `brewGrain7`, `brewGrain7Weight`, `brewGrain8`, `brewGrain8Weight`, `brewGrain9`, `brewGrain9Weight`, `brewAddition1`, `brewAddition1Amt`, `brewAddition2`, `brewAddition2Amt`, `brewAddition3`, `brewAddition3Amt`, `brewAddition4`, `brewAddition4Amt`, `brewAddition5`, `brewAddition5Amt`, `brewAddition6`, `brewAddition6Amt`, `brewAddition7`, `brewAddition7Amt`, `brewAddition8`, `brewAddition8Amt`, `brewAddition9`, `brewAddition9Amt`, `brewMisc1Name`, `brewMisc2Name`, `brewMisc3Name`, `brewMisc4Name`, `brewMisc1Type`, `brewMisc2Type`, `brewMisc3Type`, `brewMisc4Type`, `brewMisc1Use`, `brewMisc2Use`, `brewMisc3Use`, `brewMisc4Use`, `brewMisc1Time`, `brewMisc2Time`, `brewMisc3Time`, `brewMisc4Time`, `brewMisc1Amount`, `brewMisc2Amount`, `brewMisc3Amount`, `brewMisc4Amount`, `brewHops1`, `brewHops1Weight`, `brewHops1IBU`, `brewHops1Time`, `brewHops2`, `brewHops2Weight`, `brewHops2IBU`, `brewHops2Time`, `brewHops3`, `brewHops3Weight`, `brewHops3IBU`, `brewHops3Time`, `brewHops4`, `brewHops4Weight`, `brewHops4IBU`, `brewHops4Time`, `brewHops5`, `brewHops5Weight`, `brewHops5IBU`, `brewHops5Time`, `brewHops6`, `brewHops6Weight`, `brewHops6IBU`, `brewHops6Time`, `brewHops7`, `brewHops7Weight`, `brewHops7IBU`, `brewHops7Time`, `brewHops8`, `brewHops8Weight`, `brewHops8IBU`, `brewHops8Time`, `brewHops9`, `brewHops9Weight`, `brewHops9IBU`, `brewHops9Time`, `brewHops1Use`, `brewHops2Use`, `brewHops3Use`, `brewHops4Use`, `brewHops5Use`, `brewHops6Use`, `brewHops7Use`, `brewHops8Use`, `brewHops9Use`, `brewHops1Type`, `brewHops2Type`, `brewHops3Type`, `brewHops4Type`, `brewHops5Type`, `brewHops6Type`, `brewHops7Type`, `brewHops8Type`, `brewHops9Type`, `brewHops1Form`, `brewHops2Form`, `brewHops3Form`, `brewHops4Form`, `brewHops5Form`, `brewHops6Form`, `brewHops7Form`, `brewHops8Form`, `brewHops9Form`, `brewYeast`, `brewYeastMan`, `brewYeastForm`, `brewYeastType`, `brewYeastAmount`, `brewLabelImage`, `brewOG`, `brewFG`, `brewProcedure`, `brewPrimary`, `brewPrimaryTemp`, `brewSecondary`, `brewSecondaryTemp`, `brewTertiary`, `brewTertiaryTemp`, `brewLager`, `brewLagerTemp`, `brewAge`, `brewAgeTemp`, `brewBitterness`, `brewIBUFormula`, `brewLovibond`, `brewBrewerID`, `brewBoilTime`, `brewFeatured`, `brewMashProfile`, `brewWaterProfile`, `brewYeastProfile`, `brewArchive`) VALUES
(1, 'Orange Krush', 'Witbier', 'BrewBlogger.net', '5.25', 'Partial Mash', NULL, NULL, NULL, NULL, '<p>Intended to be spicy and "orangy."</p>', 'LME - Extra Light', '3.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'German Wheat Malt Light', '3.00', 'Flaked Oats', '1.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Gypsum', 'Orange Zest (Peel)', 'Corriander (Crushed)', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '60', '20', '20', NULL, '1 tsp.', '2.0 ounces', '2.0 ounces', NULL, 'Admiral', '0.50', '5.50', '60', 'Cascade', '0.25', '5.50', '15', 'Cascade', '0.25', '5.50', '1', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Boil', 'Boil', 'Boil', NULL, NULL, NULL, NULL, NULL, NULL, 'Bittering', 'Both', 'Aroma', NULL, NULL, NULL, NULL, NULL, NULL, 'Pellets', 'Pellets', 'Pellets', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1500 ml', NULL, '1.036', '1.009', '<ul>\r\n<li>Mash grains in&nbsp;2.0 gallons of 152&deg; water for 60 minutes</li>\r\n<li>Sparge with&nbsp;2.0 gallons of 168&deg; water for 15 minutes</li>\r\n<li>Collect wort in kettle, bring to a boil</li>\r\n<li>Add extract and bring to a boil again</li>\r\n<li>Add hops according to schedule</li>\r\n<li>Cool wort in a sink filled with cold water and ice, swirl every 3 minutes</li>\r\n<li>Add wort to primary, fill to 5.25 gallons with water</li>\r\n<li>Pitch yeast when wort reaches 75&deg; or lower</li>\r\n</ul>', '10', '65', '10', '65', NULL, NULL, NULL, NULL, '28', '60', '15.9', 'Daniels', '01.6190476', 'nonpriv', NULL, 'N', NULL, NULL, 65, NULL),
(2, 'Steamer', 'California Common Beer', 'BrewBlogger.net', '5.0', 'Extract', NULL, NULL, NULL, NULL, NULL, 'DME - Extra Light', '6.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'German Light Munich Malt', '1.00', 'British Carastan Malt', '1.00', 'Crystal Malt 80L', '0.50', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Northern Brewer', '0.75', '8.2', '60', 'Northern Brewer', '0.75', '8.2', '15', 'Northern Brewer', '0.50', '8.2', '3', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Sanfrancisco Lager', 'White Labs', 'Liquid', NULL, NULL, NULL, '1.050', '1.013', NULL, '10', '62', '14', '62', NULL, NULL, '14', '40', NULL, NULL, '3.7', 'Daniels', '12.276', 'nonpriv', NULL, 'N', NULL, NULL, NULL, 'No'),
(3, '60-Minute Ticker', 'American IPA', 'BrewBlogger.net', '5', 'All Grain', NULL, NULL, NULL, NULL, '<p>All-grain version of the 60-Minute IPA recipe in the book <em>Extreme Brewing</em>.</p>\r\n<p>The target IBU level is approx. 60 and this recipe will achieve that.  However, to achieve truly authenitc results, a blend of the first 3 hops listed should be added continuously over the course of the 60 minute boil. Hence the name.</p>\r\n<p>Sub White Labs British Ale (WLP005) if you cant find the Wyeast Ringwood Ale.</p>', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'American Pale Malt (2-Row)', '11.24', 'Belgian Biscuit Malt', '0.24', 'Crystal Malt 120L', '0.13', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Nugget', '0.6', '13', '60', 'Simcoe', '0.6', '13', '45', 'Amarillo', '0.5', '8.4', '30', 'Amarillo', '0.5', '8.4', '0', 'Amarillo', '1', '8.4', '0', 'Simcoe', '1.4', '13', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Boil', 'Boil', 'Boil', 'Aroma', 'Dry Hop', 'Dry Hop', NULL, NULL, NULL, 'Both', 'Both', 'Both', 'Aroma', 'Aroma', 'Aroma', NULL, NULL, NULL, 'Pellets', 'Pellets', 'Pellets', 'Pellets', 'Pellets', 'Pellets', NULL, NULL, NULL, 'Ringwood Ale (1187)', NULL, 'Liquid', NULL, NULL, NULL, '1.063', '1.010', NULL, '7', '68', '14', '55', '0', '32', NULL, NULL, '21', '55', '66.3', 'Daniels', '8.3', 'admin', NULL, 'Y', NULL, NULL, NULL, NULL),
(4, 'Lupulus Imperialus Premiumus', 'Premium American Lager', 'BrewBlogger.net', '5', 'All Grain', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'American Pilsen Malt', '10.00', 'American Dextrin (Cara-Pils) Malt', '2.00', 'Crystal Malt 120L', '0.125', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '5.2 Stabilizer', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '60', NULL, NULL, NULL, '1 tbsp.', NULL, NULL, NULL, 'Zeus', '1.00', '13.0', '60', 'Amarillo', '0.25', '8.2', '20', 'Amarillo', '0.75', '8.2', '0', 'Amarillo', '1.00', '8.2', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Boil', 'Boil', 'Aroma', 'Dry Hop', NULL, NULL, NULL, NULL, NULL, 'Bittering', 'Aroma', 'Aroma', 'Aroma', NULL, NULL, NULL, NULL, NULL, 'Pellets', 'Pellets', 'Pellets', 'Pellets', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1000 ml', NULL, '1.063', '1.016', NULL, '7', '50', '2', '60', NULL, NULL, '42', '32', NULL, NULL, '52.5', 'Rager', '06.6', 'admin', NULL, 'Y', NULL, NULL, 37, 'No'),
(5, 'The Power of the Darkside', 'Munich Dunkel', 'BrewBlogger.net', '5', 'All Grain', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'American Pilsen Malt', '3.00', 'German Dark Munich Malt', '7.00', 'British Pale Chocolate', '0.125', 'German Carafa III De-Husked Malt', '0.125', 'German Melanoidin Malt', '0.75', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Magnum', '0.50', '13.0', '60', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Boil', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Bittering', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Pellets', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2500 ml', NULL, '1.057', '1.014', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '28.4', 'Daniels', '16.06', 'nonpriv', NULL, 'N', NULL, NULL, 56, 'No');

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE IF NOT EXISTS `reviews` (
  `id` int(8) NOT NULL auto_increment,
  `brewID` tinyint(5) default '0',
  `brewScoreDate` date default '0000-00-00',
  `brewAromaScore` tinyint(5) default NULL,
  `brewAromaInfo` text,
  `brewAppearanceScore` tinyint(4) default NULL,
  `brewAppearanceInfo` text,
  `brewFlavorScore` tinyint(2) default NULL,
  `brewFlavorInfo` text,
  `brewMouthfeelScore` tinyint(2) default NULL,
  `brewMouthfeelInfo` text,
  `brewOverallScore` tinyint(2) default NULL,
  `brewOverallInfo` text,
  `brewScoredBy` varchar(250) default NULL,
  `brewBrewerID` varchar(255) default NULL,
  `brewScorerLevel` varchar(255) default 'friend',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM;


-- --------------------------------------------------------

--
-- Table structure for table `styles`
--

CREATE TABLE IF NOT EXISTS `styles` (
  `id` tinyint(4) NOT NULL auto_increment,
  `brewStyleNum` char(3) character set latin1 default NULL,
  `brewStyle` varchar(250) character set latin1 default NULL,
  `brewStyleOG` varchar(20) character set latin1 default NULL,
  `brewStyleOGMax` varchar(25) character set latin1 default NULL,
  `brewStyleFG` varchar(20) character set latin1 default NULL,
  `brewStyleFGMax` varchar(25) character set latin1 default NULL,
  `brewStyleABV` varchar(250) character set latin1 default NULL,
  `brewStyleABVMax` varchar(25) character set latin1 default NULL,
  `brewStyleIBU` varchar(250) character set latin1 default NULL,
  `brewStyleIBUMax` varchar(25) character set latin1 default NULL,
  `brewStyleSRM` varchar(250) character set latin1 default NULL,
  `brewStyleSRMMax` varchar(25) character set latin1 default NULL,
  `brewStyleType` varchar(25) character set latin1 default NULL,
  `brewStyleInfo` text character set latin1,
  `brewStyleLink` varchar(200) character set latin1 default NULL,
  `brewStyleGroup` char(2) character set latin1 default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM;

--
-- Dumping data for table `styles`
--

INSERT INTO `styles` (`id`, `brewStyleNum`, `brewStyle`, `brewStyleOG`, `brewStyleOGMax`, `brewStyleFG`, `brewStyleFGMax`, `brewStyleABV`, `brewStyleABVMax`, `brewStyleIBU`, `brewStyleIBUMax`, `brewStyleSRM`, `brewStyleSRMMax`, `brewStyleType`, `brewStyleInfo`, `brewStyleLink`, `brewStyleGroup`) VALUES
(1, 'A', 'Lite American Lager', '1.028', '1.040', '0.998', '1.008', '3.2', '4.2', '08', '12', '02', '03', 'Lager', 'A lower gravity and lower calorie beer than standard international lagers. Strong flavors are a fault. Designed to appeal to the broadest range of the general public as possible.<p>Commercial Examples: Bitburger Light, Sam Adams Light, Heineken Premium Light, Miller Lite, Bud Light, Coors Light, Baltika #1 Light, Old Milwaukee Light, Amstel Light. </p>', 'http://www.bjcp.org/2008styles/style01.php#1a', '01'),
(2, 'B', 'Standard American Lager', '1.040', '1.050', '1.004', '1.010', '4.2', '5.3', '08', '15', '02', '04', 'Lager', 'Strong flavors are a fault. An international style including the standard mass-market lager from most countries.<p>Commercial Examples: Pabst Blue Ribbon, Miller High Life, Budweiser, Baltika #3 Classic, Kirin Lager, Grain Belt Premium Lager, Molson Golden, Labatt Blue, Coors Original, Foster&rsquo;s Lager.</p>', 'http://www.bjcp.org/2008styles/style01.php#1b', '01'),
(3, 'C', 'Premium American Lager', '1.046', '1.056', '1.008', '1.012', '4.6', '6.0', '15', '25', '02', '06', 'Lager', 'Premium beers tend to have fewer adjuncts than standard/lite lagers, and can be all-malt. Strong flavors are a fault, but premium lagers have more flavor than standard/lite lagers. A broad style of international mass-market lagers ranging from up-scale American lagers to the typical ''import'' or ''green bottle'' international beers found in America.<p>Commercial Examples: Full Sail Session Premium Lager, Miller Genuine Draft, Corona Extra, Michelob, Coors Extra Gold, Birra Moretti, Heineken, Beck&rsquo;s, Stella Artois, Red Stripe, Singha.</p>', 'http://www.bjcp.org/2008styles/style01.php#1c', '01'),
(4, 'D', 'Munich Helles', '1.045', '1.051', '1.008', '1.012', '4.7', '5.4', '16', '22', '03', '05', 'Lager', 'Unlike Pilsner but like its cousin, Munich Dunkel, Helles is a malt-accentuated beer that is not overly sweet, but rather focuses on malt flavor with underlying hop bitterness in a supporting role.<p>Commercial Examples: Weihenstephaner Original, Hacker-Pschorr M&uuml;nchner Gold, B&uuml;rgerbr&auml;u Wolznacher Hell Naturtr&uuml;b, Mahr&rsquo;s Hell, Paulaner Premium Lager, Spaten Premium Lager, Stoudt&rsquo;s Gold Lager.</p>', 'http://www.bjcp.org/2008styles/style01.php#1d', '01'),
(5, 'E', 'Dortmunder Export', '1.048', '1.056', '1.010', '1.015', '4.8', '6.0', '23', '30', '04', '06', 'Lager', 'Brewed to a slightly higher starting gravity than other light lagers, providing a firm malty body and underlying maltiness to complement the sulfate-accentuated hop bitterness.  The term ''Export'' is a beer strength category under German beer tax law, and is not strictly synonymous with the ''Dortmunder'' style.  Beer from other cities or regions can be brewed to Export strength, and labeled as such. </p><p>Commercial Examples: DAB Export, Dortmunder Union Export, Dortmunder Kronen, Ayinger Jahrhundert, Great Lakes Dortmunder Gold, Barrel House Duveneck&rsquo;s Dortmunder, Bell&rsquo;s Lager, Dominion Lager, Gordon Biersch Golden Export, Flensburger Gold.</p>', 'http://www.bjcp.org/2008styles/style01.php#1e', '01'),
(6, 'A', 'German Pilsner (Pils)', '1.044', '1.050', '1.008', '1.013', '4.4', '5.2', '25', '45', '02', '05', 'Lager', 'Drier and crisper than a Bohemian Pilsener with a bitterness that tends to linger more in the aftertaste due to higher attenuation and higher-sulfate water. Lighter in body and color, and with higher carbonation than a Bohemian Pilsener. Modern examples of German pilsners tend to become paler in color, drier in finish, and more bitter as you move from South to North in Germany.<p>Commercial Examples: Victory Prima Pils, Bitburger, Warsteiner, Trumer Pils, Old Dominion Tupper&rsquo;s Hop Pocket Pils, K&ouml;nig Pilsener, Jever Pils, Left Hand Polestar Pilsner, Holsten Pils, Spaten Pils, Brooklyn Pilsner.  </p>', 'http://www.bjcp.org/2008styles/style02.php#1a', '02'),
(7, 'B', 'Bohemian Pilsener', '1.044', '1.056', '1.013', '1.017', '4.2', '5.4', '35', '45', '03.5', '06', 'Lager', 'Uses Moravian malted barley and a decoction mash for rich, malt character. Saaz hops and low sulfate, low carbonate water provide a distinctively soft, rounded hop profile. Traditional yeast sometimes can provide a background diacetyl note. Dextrins provide additional body, and diacetyl enhances the perception of a fuller palate.</p> <p>Commercial Examples: Pilsner Urquell, Kru?ovice Imperial 12&deg;, Budweiser Budvar (Czechvar in the US), Czech Rebel, Staropramen, Gambrinus Pilsner, Zlaty Bazant Golden Pheasant, Dock Street Bohemian Pilsner.</p> ', 'http://www.bjcp.org/2008styles/style02.php#1b', '02'),
(8, 'C', 'Classic American Pilsner', '1.044', '1.060', '1.010', '1.015', '4.5', '6.0', '25', '40', '03', '06', 'Lager', 'A substantial Pilsner that can stand up to the classic European Pilsners, but exhibiting the native American grains and hops available to German brewers who initially brewed it in the USA. Refreshing, but with the underlying malt and hops that stand out when compared to other modern American light lagers. Maize lends a distinctive grainy sweetness. Rice contributes a crisper, more neutral character. A version of Pilsner brewed in the USA by immigrant German brewers who brought the process and yeast with them when they settled in America.  They worked with the ingredients that were native to America to create a unique version of the original Pilsner.  This style died out after Prohibition but was resurrected as a home-brewed style by advocates of the hobby<p>Commercial Examples: Occasional brewpub and microbrewery specials. </p>', 'http://www.bjcp.org/2008styles/style02.php#1c', '02'),
(9, 'A', 'Vienna Lager', '1.046', '1.052', '1.010', '1.014', '4.5', '5.7', '18', '30', '10', '16', 'Lager', 'Characterized by soft, elegant maltiness that dries out in the finish to avoid becoming sweet.<p>Commercial Examples: Great Lakes Eliot Ness, Boulevard Bob''s 47 Munich-Style Lager, Negra Modelo, Old Dominion Aviator Amber Lager, Gordon Biersch Vienna Lager, Capital Wisconsin Amber, Olde Saratoga Lager, Penn Pilsner.</p> ', 'http://www.bjcp.org/2008styles/style03.php#1a', '03'),
(10, 'B', 'Oktoberfest/Marzen', '1.050', '1.057', '1.012', '1.016', '4.8', '5.7', '20', '28', '07', '14', 'Lager', 'Smooth, clean, and rather rich, with a depth of malt character. This is one of the classic malty styles, with a maltiness that is often described as soft, complex, and elegant but never cloying.<p>Commercial Examples: Paulaner Oktoberfest, Ayinger Oktoberfest-M&auml;rzen, Hacker-Pschorr Original Oktoberfest, Hofbr&auml;u Oktoberfest, Victory Festbier, Great Lakes Oktoberfest, Spaten Oktoberfest, Capital Oktoberfest, Gordon Biersch M&auml;rzen, Goose Island Oktoberfest, Samuel Adams Oktoberfest.</p> ', 'http://www.bjcp.org/2008styles/style03.php#1b', '03'),
(11, 'A', 'Dark American Lager', '1.044', '1.056', '1.008', '1.012', '4.2', '6.0', '08', '20', '14', '22', 'Lager', 'A somewhat sweeter version of standard/premium lager with a little more body and flavor.<p>Commercial Examples: Dixie Blackened Voodoo, Shiner Bock, San Miguel Dark, Baltika #4, Beck''s Dark, Saint Pauli Girl Dark, Warsteiner Dunkel, Heineken Dark Lager, Crystal Diplomat Dark Beer.</p> ', 'http://www.bjcp.org/2008styles/style04.php#1a', '04'),
(12, 'B', 'Munich Dunkel', '1.048', '1.056', '1.010', '1.016', '4.5', '5.6', '18', '28', '14', '28', 'Lager', 'Characterized by depth and complexity of Munich malt and the accompanying melanoidins. Rich Munich flavors, but not as intense as a bock or as roasted as a schwarzbier. <p>Commercial Examples: Ayinger Altbairisch Dunkel, Hacker-Pschorr Alt Munich Dark, Paulaner Alt M&uuml;nchner Dunkel, Weltenburger Kloster Barock-Dunkel, Ettaler Kloster Dunkel, Hofbr&auml;u Dunkel, Penn Dark Lager, K&ouml;nig Ludwig Dunkel, Capital Munich Dark, Harpoon Munich-type Dark Beer, Gordon Biersch Dunkels, Dinkel Acker Dark.  In Bavaria, Ettaler Dunkel, L&ouml;wenbr&auml;u Dunkel, Hartmann Dunkel, Kneitinger Dunkel, Augustiner Dunkel.</p>', 'http://www.bjcp.org/2008styles/style04.php#1b', '04'),
(13, 'C', 'Schwarzbier', '1.046', '1.052', '1.010', '1.016', '4.4', '5.4', '22', '32', '17', '30', 'Lager', 'A dark German lager that balances roasted yet smooth malt flavors with moderate hop bitterness.<p>Commercial Examples: K&ouml;stritzer Schwarzbier, Kulmbacher M&ouml;nchshof Premium Schwarzbier, Samuel Adams Black Lager, Kru?ovice Cerne, Original Badebier, Einbecker Schwarzbier, Gordon Biersch Schwarzbier, Weeping Radish Black Radish Dark Lager, Sprecher Black Bavarian.</p>', 'http://www.bjcp.org/2008styles/style04.php#1c', '04'),
(14, 'A', 'Maibock/Helles Bock', '1.064', '1.072', '1.011', '1.018', '6.3', '7.4', '23', '35', '06', '11', 'Lager', 'A relatively pale, strong, malty lager beer. Designed to walk a fine line between blandness and too much color. Hop character is generally more apparent than in other bocks.<p>Commercial Examples: Ayinger Maibock, Mahr&rsquo;s Bock, Hacker-Pschorr Hubertus Bock, Capital Maibock, Einbecker Mai-Urbock, Hofbr&auml;u Maibock, Victory St. Boisterous, Gordon Biersch Blonde Bock, Smuttynose Maibock.</p>', 'http://www.bjcp.org/2008styles/style05.php#1a', '05'),
(15, 'B', 'Traditional Bock', '1.064', '1.072', '1.013', '1.019', '6.3', '7.2', '20', '27', '14', '22', 'Lager', 'A dark, strong, malty lager beer.<p>Commercial Examples: Einbecker Ur-Bock Dunkel, Pennsylvania Brewing St. Nick Bock, Aass Bock, Great Lakes Rockefeller Bock, Stegmaier Brewhouse Bock.</p>', 'http://www.bjcp.org/2008styles/style05.php#1b', '05'),
(16, 'C', 'Doppelbock', '1.072', '1.096', '1.016', '1.024', '7.0', '10.0', '16', '25', '06', '25', 'Lager', 'A very strong and rich lager. A bigger version of either a traditional bock or a helles bock.<p>Commercial Examples: Paulaner Salvator, Ayinger Celebrator, Weihenstephaner Korbinian, Andechser Doppelbock Dunkel, Spaten Optimator, Tucher Bajuvator, Weltenburger Kloster Asam-Bock, Capital Autumnal Fire, EKU 28, Eggenberg Urbock 23&ordm;, Bell&rsquo;s Consecrator, Moretti La Rossa, Samuel Adams Double Bock.</p>', 'http://www.bjcp.org/2008styles/style05.php#1c', '05'),
(17, 'D', 'Eisbock', '1.078', '1.120', '1.020', '1.035', '9.0', '14.0', '25', '35', '18', '30', 'Lager', 'An extremely strong, full and malty dark lager.<p>Commercial Examples:  Kulmbacher Reichelbr&auml;u Eisbock, Eggenberg Urbock Dunkel Eisbock, Niagara Eisbock, Capital Eisphyre, Southampton Eisbock.</p>', 'http://www.bjcp.org/2008styles/style05.php#1d', '05'),
(18, 'A', 'Cream Ale', '1.042', '1.055', '1.006', '1.012', '4.2', '5.6', '15', '20', '02.5', '05', 'Mixed', 'A clean, well-attenuated, flavorful American lawnmower beer.<p>Commercial Examples: Genesee Cream Ale, Little Kings Cream Ale (Hudepohl), Anderson Valley Summer Solstice Cerveza Crema, Sleeman Cream Ale, New Glarus Spotted Cow, Wisconsin Brewing Whitetail Cream Ale.</p>', 'http://www.bjcp.org/2008styles/style06.php#1a', '06'),
(19, 'B', 'Blonde Ale', '1.038', '1.054', '1.008', '1.013', '4.2', '5.5', '15', '28', '03', '06', 'Mixed', 'Easy-drinking, approachable, malt-oriented American craft beer.<p>Commercial Examples: Pelican Kiwanda Cream Ale, Russian River Aud Blonde, Rogue Oregon Golden Ale, Widmer Blonde Ale, Fuller&rsquo;s Summer Ale, Hollywood Blonde, Redhook Blonde.</p>', 'http://www.bjcp.org/2008styles/style06.php#1b', '06'),
(20, 'C', 'Kolsch', '1.044', '1.050', '1.007', '1.011', '4.4', '5.2', '20', '30', '03.5', '05', 'Mixed', 'A clean, crisp, delicately balanced beer usually with very subtle fruit flavors and aromas. Subdued maltiness throughout leads to a pleasantly refreshing tang in the finish. To the untrained taster easily mistaken for a light lager, a somewhat subtle pilsner, or perhaps a blonde ale.<p>Commercial Examples: Available in Cologne only: PJ Fr&uuml;h, Hellers, Malzm&uuml;hle, Paeffgen, Sion, Peters, Dom; import versions available in parts of North America: Reissdorf, Gaffel; Non-German versions: Eisenbahn Dourada, Goose Island Summertime, Alaska Summer Ale, Harpoon Summer Beer, New Holland Lucid, Saint Arnold Fancy Lawnmower, Capitol City Capitol K&ouml;lsch, Shiner K&ouml;lsch.</p>', 'http://www.bjcp.org/2008styles/style06.php#1c', '06'),
(21, 'D', 'American Wheat or Rye Beer', '1.040', '1.055', '1.008', '1.013', '4.0', '5.5', '15', '30', '03', '06', 'Mixed', 'Refreshing wheat or rye beers that can display more hop character and less yeast character than their German cousins.<p>Commercial Examples: Bell&rsquo;s Oberon, Harpoon UFO Hefeweizen, Three Floyds Gumballhead, Pyramid Hefe-Weizen, Widmer Hefeweizen, Sierra Nevada Unfiltered Wheat Beer, Anchor Summer Beer, Redhook Sunrye, Real Ale Full Moon Pale Rye.</p>', 'http://www.bjcp.org/2008styles/style06.php#1d', '06'),
(22, 'A', 'Northern German Altbier', '1.046', '1.054', '1.010', '1.015', '4.5', '5.2', '25', '40', '13', '19', 'Ale', 'A very clean and relatively bitter beer, balanced by some malt character.  Generally darker, sometimes more caramelly, and usually sweeter and less bitter than D&uuml;sseldorf Altbier.<p>Commercial Examples: DAB Traditional, Hannen Alt, Schwelmer Alt, Grolsch Amber, Alaskan Amber, Long Trail Ale, Otter Creek Copper Ale, Schmaltz&rsquo; Alt. </p>', 'http://www.bjcp.org/2008styles/style07.php#1a', '07'),
(23, 'B', 'California Common Beer', '1.048', '1.054', '1.011', '1.014', '4.5', '5.5', '30', '45', '10', '14', 'Ale', 'A lightly fruity beer with firm, grainy maltiness, interesting toasty and caramel flavors, and showcasing the signature Northern Brewer varietal hop character. <p>Commercial Examples: Anchor Steam, Southampton Steem Beer, Flying Dog Old Scratch Amber Lager. </p>', 'http://www.bjcp.org/2008styles/style07.php#1b', '07'),
(24, 'C', 'Dusseldorf Altbier', '1.046', '1.054', '1.010', '1.015', '4.5', '5.2', '35', '50', '11', '17', 'Ale', 'A well balanced, bitter yet malty, clean, smooth, well-attenuated copper-colored German ale.<p>Commercial Examples: Altstadt brewpubs: Zum Uerige, Im F&uuml;chschen, Schumacher, Zum Schl&uuml;ssel; other examples: Diebels Alt, Schl&ouml;sser Alt, Frankenheim Alt.</p>', 'http://www.bjcp.org/2008styles/style07.php#1c', '07'),
(25, 'A', 'Standard/Ordinary Bitter', '1.032', '1.040', '1.007', '1.011', '3.2', '3.8', '25', '35', '04', '14', 'Ale', 'Low gravity, low alcohol levels and low carbonation make this an easy-drinking beer. Some examples can be more malt balanced, but this should not override the overall bitter impression. Drinkability is a critical component of the style; emphasis is still on the bittering hop addition as opposed to the aggressive middle and late hopping seen in American ales.<p>Commercial Examples: Fuller''s Chiswick Bitter, Adnams Bitter, Young''s Bitter, Greene King IPA, Oakham Jeffrey Hudson Bitter (JHB), Brain''s Bitter, Tetley''s Original Bitter, Brakspear Bitter, Boddington''s Pub Draught.</p>', 'http://www.bjcp.org/2008styles/style08.php#1a', '08'),
(26, 'B', 'Special/Best/Premium Bitter', '1.040', '1.048', '1.008', '1.012', '3.8', '4.6', '25', '40', '05', '16', 'Ale', 'A flavorful, yet refreshing, session beer. Some examples can be more malt balanced, but this should not override the overall bitter impression. Drinkability is a critical component of the style; emphasis is still on the bittering hop addition as opposed to the aggressive middle and late hopping seen in American ales.<p>Commercial Examples: Fuller''s London Pride, Coniston Bluebird Bitter, Timothy Taylor Landlord, Adnams SSB, Young&rsquo;s Special, Shepherd Neame Masterbrew Bitter, Greene King Ruddles County Bitter, RCH Pitchfork Rebellious Bitter, Brains SA, Black Sheep Best Bitter, Goose Island Honkers Ale, Rogue Younger&rsquo;s Special Bitter.</p>', 'http://www.bjcp.org/2008styles/style08.php#1b', '08'),
(27, 'C', 'Extra Special/Strong Bitter (English Pale Ale)', '1.048', '1.060', '1.010', '1.016', '4.6', '6.2', '30', '50', '06', '18', 'Ale', 'An average-strength to moderately-strong English ale. The balance may be fairly even between malt and hops to somewhat bitter. Drinkability is a critical component of the style; emphasis is still on the bittering hop addition as opposed to the aggressive middle and late hopping seen in American ales. A rather broad style that allows for considerable interpretation by the brewer.<p>Commercial Examples: Fullers ESB, Adnams Broadside, Shepherd Neame Bishop''s Finger, Young&rsquo;s Ram Rod, Samuel Smith&rsquo;s Old Brewery Pale Ale, Bass Ale, Whitbread Pale Ale, Shepherd Neame Spitfire, Marston&rsquo;s Pedigree, Black Sheep Ale, Vintage Henley, Mordue Workie Ticket, Morland Old Speckled Hen, Greene King Abbot Ale, Bateman''s  XXXB, Gale&rsquo;s Hordean Special Bitter (HSB), Ushers 1824 Particular Ale, Hopback Summer Lightning, Great Lakes Moondog Ale, Shipyard Old Thumper, Alaskan ESB, Geary&rsquo;s Pale Ale, Cooperstown Old Slugger, Anderson Valley Boont ESB, Avery 14&rsquo;er ESB, Redhook ESB. </p>', 'http://www.bjcp.org/2008styles/style08.php#1c', '08'),
(28, 'A', 'Scottish Light 60/-', '1.030', '1.035', '1.010', '1.013', '2.5', '3.2', '10', '20', '09', '17', 'Ale', 'Cleanly malty with a drying finish, perhaps a few esters, and on occasion a faint bit of peaty earthiness (smoke). Most beers finish fairly dry considering their relatively sweet palate, and as such have a different balance than strong Scotch ales.<p>Commercial Examples: Belhaven 60/-, McEwan&rsquo;s 60/-, Maclay 60/- Light (all are cask-only products not exported to the US).</p>', 'http://www.bjcp.org/2008styles/style09.php#1a', '09'),
(29, 'B', 'Scottish Heavy 70/-', '1.035', '1.040', '1.010', '1.015', '3.2', '3.9', '10', '25', '09', '17', 'Ale', 'Cleanly malty with a drying finish, perhaps a few esters, and on occasion a faint bit of peaty earthiness (smoke). Most beers finish fairly dry considering their relatively sweet palate, and as such have a different balance than strong Scotch ales.<p>Commercial Examples: Caledonian 70/- (Caledonian Amber Ale in the US), Belhaven 70/-, Orkney Raven Ale, Maclay 70/-, Tennents Special, Broughton Greenmantle Ale.</p>', 'http://www.bjcp.org/2008styles/style09.php#1b', '09'),
(30, 'C', 'Scottish Export 80/-', '1.040', '1.054', '1.010', '1.016', '3.9', '5.0', '15', '30', '09', '17', 'Ale', 'Cleanly malty with a drying finish, perhaps a few esters, and on occasion a faint bit of peaty earthiness (smoke). Most beers finish fairly dry considering their relatively sweet palate, and as such have a different balance than strong Scotch ales.<p>Commercial Examples: Orkney Dark Island, Caledonian 80/- Export Ale, Belhaven 80/- (Belhaven Scottish Ale in the US), Southampton 80 Shilling, Broughton Exciseman&rsquo;s 80/-, Belhaven St. Andrews Ale, McEwan''s Export (IPA), Inveralmond Lia Fail, Broughton Merlin&rsquo;s Ale, Arran Dark</p>', 'http://www.bjcp.org/2008styles/style09.php#1c', '09'),
(31, 'D', 'Irish Red Ale', '1.044', '1.060', '1.010', '1.014', '4.0', '6.0', '17', '28', '09', '18', 'Ale', 'An easy-drinking pint. Malt-focused with an initial sweetness and a roasted dryness in the finish.<p>Commercial Examples: Three Floyds Brian Boru Old Irish Ale, Great Lakes Conway&rsquo;s Irish Ale (a bit strong at 6.5%), Kilkenny Irish Beer, O&rsquo;Hara&rsquo;s Irish Red Ale, Smithwick&rsquo;s Irish Ale, Beamish Red Ale, Caffrey&rsquo;s Irish Ale, Goose Island Kilgubbin Red Ale, Murphy&rsquo;s Irish Red (lager), Boulevard Irish Ale, Harpoon Hibernian Ale.</p>', 'http://www.bjcp.org/2008styles/style09.php#1d', '09'),
(32, 'E', 'Strong Scotch Ale', '1.070', '1.130', '1.018', '1.056', '6.5', '10.0', '17', '35', '14', '25', 'Ale', 'Rich, malty and usually sweet, which can be suggestive of a dessert. Complex secondary malt flavors prevent a one-dimensional impression. Strength and maltiness can vary.<p>Commercial Examples: Traquair House Ale, Belhaven Wee Heavy, McEwan''s Scotch Ale, Founders Dirty Bastard, MacAndrew''s Scotch Ale, AleSmith Wee Heavy, Orkney Skull Splitter, Inveralmond Black Friar, Broughton Old Jock, Gordon Highland Scotch Ale, Dragonmead Under the Kilt.</p>', 'http://www.bjcp.org/2008styles/style09.php#1e', '09'),
(33, 'A', 'American Pale Ale', '1.045', '1.060', '1.010', '1.015', '4.5', '6.0', '30', '45', '05', '14', 'Ale', 'Refreshing and hoppy, yet with sufficient supporting malt.<p>Commercial Examples: Sierra Nevada Pale Ale, Stone Pale Ale, Great Lakes Burning River Pale Ale, Bear Republic XP Pale Ale, Anderson Valley Poleeko Gold Pale Ale, Deschutes Mirror Pond, Full Sail Pale Ale, Three Floyds X-Tra Pale Ale, Firestone Pale Ale, Left Hand Brewing Jackman&rsquo;s Pale Ale. </p>', 'http://www.bjcp.org/2008styles/style10.php#1a', '10'),
(34, 'B', 'American Amber Ale', '1.045', '1.060', '1.010', '1.015', '4.5', '6.2', '25', '40', '10', '17', 'Ale', 'Like an American pale ale with more body, more caramel richness, and a balance more towards malt than hops (although hop rates can be significant).<p>Commercial Examples: North Coast Red Seal Ale, Tr&ouml;egs HopBack Amber Ale, Deschutes Cinder Cone Red, Pyramid Broken Rake, St. Rogue Red Ale, Anderson Valley Boont Amber Ale, Lagunitas Censored Ale, Avery Redpoint Ale, McNeill&rsquo;s Firehouse Amber Ale, Mendocino Red Tail Ale, Bell''s Amber.</p>', 'http://www.bjcp.org/2008styles/style10.php#1b', '10'),
(35, 'C', 'American Brown Ale', '1.045', '1.060', '1.010', '1.016', '4.3', '6.2', '20', '40', '18', '35', 'Ale', 'Can be considered a bigger, maltier, hoppier interpretation of Northern English brown ale or a hoppier, less malty Brown Porter, often including the citrus-accented hop presence that is characteristic of American hop varieties.<p>Commercial Examples: Bell&rsquo;s Best Brown, Smuttynose Old Brown Dog Ale, Big Sky Moose Drool Brown Ale, North Coast Acme Brown, Brooklyn Brown Ale, Lost Coast Downtown Brown, Left Hand Deep Cover Brown Ale.</p>', 'http://www.bjcp.org/2008styles/style10.php#1c', '10'),
(36, 'A', 'Mild', '1.030', '1.038', '1.008', '1.013', '2.8', '4.5', '10', '25', '12', '25', 'Ale', 'A light-flavored, malt-accented beer that is readily suited to drinking in quantity. Refreshing, yet flavorful. Some versions may seem like lower gravity brown porters.<p>Commercial Examples: Moorhouse Black Cat, Gale&rsquo;s Festival Mild, Theakston Traditional Mild, Highgate Mild, Sainsbury Mild, Brain&rsquo;s Dark, Banks''s Mild, Coach House Gunpowder Strong Mild, Woodforde&rsquo;s Mardler&rsquo;s Mild, Greene King XX Mild, Motor City Brewing Ghettoblaster.</p>', 'http://www.bjcp.org/2008styles/style11.php#1a', '11'),
(37, 'B', 'Southern English Brown Ale', '1.033', '1.042', '1.011', '1.014', '2.8', '4.2', '12', '20', '19', '35', 'Ale', 'A luscious, malt-oriented brown ale, with a caramel, dark fruit complexity of malt flavor. May seem somewhat like a smaller version of a sweet stout or a sweet version of a dark mild.<p>Commercial Examples: Mann''s Brown Ale (bottled, but not available in the US), Harvey&rsquo;s Nut Brown Ale, Woodeforde&rsquo;s Norfolk Nog.</p>', 'http://www.bjcp.org/2008styles/style11.php#1b', '11'),
(38, 'C', 'Northern English Brown Ale', '1.040', '1.052', '1.008', '1.013', '4.2', '5.4', '20', '30', '12', '22', 'Ale', 'English mild ale or pale ale malt base with caramel malts. May also have small amounts darker malts (e.g., chocolate) to provide color and the nutty character. English hop varieties are most authentic. Moderate carbonate water.<p>Commercial Examples: Newcastle Brown Ale, Samuel Smith&rsquo;s Nut Brown Ale, Riggwelter Yorkshire Ale, Wychwood Hobgoblin, Tr&ouml;egs Rugged Trail Ale, Alesmith Nautical Nut Brown Ale, Avery Ellie&rsquo;s Brown Ale, Goose Island Nut Brown Ale, Samuel Adams Brown Ale.</p>', 'http://www.bjcp.org/2008styles/style11.php#1c', '11'),
(39, 'A', 'Brown Porter', '1.040', '1.052', '1.008', '1.014', '4.0', '5.4', '18', '35', '20', '30', 'Ale', 'A fairly substantial English dark ale with restrained roasty characteristics.<p>Commercial Examples: Fuller''s London Porter, Samuel Smith Taddy Porter, Burton Bridge Burton Porter, RCH Old Slug Porter, Nethergate Old Growler Porter, Hambleton Nightmare Porter, Harvey&rsquo;s Tom Paine Original Old Porter, Salopian Entire Butt English Porter, St. Peters Old-Style Porter, Shepherd Neame Original Porter, Flag Porter, Wasatch Polygamy Porter.</p>', 'http://www.bjcp.org/2008styles/style12.php#1a', '12'),
(40, 'B', 'Robust Porter', '1.048', '1.065', '1.012', '1.016', '4.8', '6.5', '25', '50', '22', '35', 'Ale', 'A substantial, malty dark ale with a complex and flavorful roasty character.<p>Commercial Examples: Great Lakes Edmund Fitzgerald Porter, Meantime London Porter, Anchor Porter, Smuttynose Robust Porter, Sierra Nevada Porter, Deschutes Black Butte Porter,  Boulevard Bully! Porter, Rogue Mocha Porter, Avery New World Porter, Bell&rsquo;s Porter, Great Divide Saint Bridget&rsquo;s Porter.</p>', 'http://www.bjcp.org/2008styles/style12.php#1b', '12'),
(41, 'C', 'Baltic Porter', '1.060', '1.090', '1.016', '1.024', '5.5', '9.5', '20', '40', '17', '30', 'Ale', 'A Baltic Porter often has the malt flavors reminiscent of an English brown porter and the restrained roast of a schwarzbier, but with a higher OG and alcohol content than either. Very complex, with multi-layered flavors.<p>Commercial Examples: Sinebrychoff Porter (Finland), Okocim Porter (Poland), Zywiec Porter (Poland), Baltika #6 Porter (Russia), Carnegie Stark Porter (Sweden), Aldaris Porteris (Latvia), Utenos Porter (Lithuania), Stepan Razin Porter (Russia), N&oslash;gne &oslash; porter (Norway), Neuzeller Kloster-Br&auml;u Neuzeller Porter (Germany), Southampton Imperial Baltic Porter.</p>', 'http://www.bjcp.org/2008styles/style12.php#1c', '12'),
(42, 'A', 'Dry Stout', '1.036', '1.050', '1.007', '1.011', '4.0', '5.0', '30', '45', '25', '40', 'Ale', 'A very dark, roasty, bitter, creamy ale.<p>Commercial Examples: Guinness Draught Stout (also canned), Murphy''s Stout, Beamish Stout, O&rsquo;Hara&rsquo;s Celtic Stout, Russian River O.V.L. Stout, Three Floyd&rsquo;s Black Sun Stout, Dorothy Goodbody&rsquo;s Wholesome Stout, Orkney Dragonhead Stout, Old Dominion Stout, Goose Island Dublin Stout, Brooklyn Dry Stout.</p>', 'http://www.bjcp.org/2008styles/style13.php#1a', '13'),
(43, 'B', 'Sweet Stout', '1.044', '1.060', '1.012', '1.024', '4.0', '6.0', '20', '40', '30', '40', 'Ale', 'A very dark, sweet, full-bodied, slightly roasty ale. Often tastes like sweetened espresso.<p>Commercial Examples: Mackeson''s XXX Stout, Watney''s Cream Stout, Farson&rsquo;s Lacto Stout, St. Peter&rsquo;s Cream Stout, Marston&rsquo;s Oyster Stout, Sheaf Stout, Hitachino Nest Sweet Stout (Lacto), Samuel Adams Cream Stout, Left Hand Milk Stout, Widmer Snowplow Milk Stout.</p>', 'http://www.bjcp.org/2008styles/style13.php#1b', '13'),
(44, 'C', 'Oatmeal Stout', '1.048', '1.065', '1.010', '1.018', '4.2', '5.9', '25', '40', '22', '40', 'Ale', 'A very dark, full-bodied, roasty, malty ale with a complementary oatmeal flavor.<p>Commercial Examples: Samuel Smith Oatmeal Stout, Young''s Oatmeal Stout, McAuslan Oatmeal Stout, Maclay&rsquo;s Oat Malt Stout, Broughton Kinmount Willie Oatmeal Stout, Anderson Valley Barney Flats Oatmeal Stout, Tr&ouml;egs Oatmeal Stout, New Holland The Poet, Goose Island Oatmeal Stout, Wolaver&rsquo;s Oatmeal Stout.</p>', 'http://www.bjcp.org/2008styles/style13.php#1c', '13'),
(45, 'D', 'Foreign Extra Stout', '1.056', '1.075', '1.010', '1.018', '5.5', '8.0', '30', '70', '30', '40', 'Ale', 'A very dark, moderately strong, roasty ale. Tropical varieties can be quite sweet, while export versions can be drier and fairly robust.<p>Commercial Examples: Tropical-Type: Lion Stout (Sri Lanka), Dragon Stout (Jamaica), ABC Stout (Singapore), Royal Extra &ldquo;The Lion Stout&rdquo; (Trinidad), Jamaica Stout (Jamaica), Export-Type: Freeminer Deep Shaft Stout, Guinness Foreign Extra Stout (bottled, not sold in the US), Ridgeway of Oxfordshire Foreign Extra Stout, Coopers Best Extra Stout, Elysian Dragonstooth Stout.</p>', 'http://www.bjcp.org/2008styles/style13.php#1d', '13'),
(46, 'E', 'American Stout', '1.050', '1.075', '1.010', '1.022', '5.0', '7.0', '35', '75', '30', '40', 'Ale', 'A hoppy, bitter, strongly roasted Foreign-style Stout (of the export variety).<p>Commercial Examples: Rogue Shakespeare Stout, Deschutes Obsidian Stout, Sierra Nevada Stout, North Coast Old No. 38, Bar Harbor Cadillac Mountain Stout, Avery Out of Bounds Stout, Lost Coast 8 Ball Stout, Mad River Steelhead Extra Stout.</p>', 'http://www.bjcp.org/2008styles/style13.php#1e', '13'),
(47, 'F', 'Imperial Stout', '1.075', '1.115', '1.018', '1.030', '8.0', '12.0', '50', '90', '30', '40', 'Ale', 'An intensely flavored, big, dark ale. Roasty, fruity, and bittersweet, with a noticeable alcohol presence. Dark fruit flavors meld with roasty, burnt, or almost tar-like sensations. Like a black barleywine with every dimension of flavor coming into play.<p>Commercial Examples: Three Floyd&rsquo;s Dark Lord, Bell&rsquo;s Expedition Stout, North Coast Old Rasputin Imperial Stout, Stone Imperial Stout, Samuel Smith Imperial Stout, Scotch Irish Tsarina Katarina Imperial Stout, Thirsty Dog Siberian Night, Deschutes The Abyss, Great Divide Yeti, Southampton Russian Imperial Stout, Rogue Imperial Stout, Bear Republic Big Bear Black Stout, Great Lakes Blackout Stout, Avery The Czar, Founders Imperial Stout, Victory Storm King, Brooklyn Black Chocolate Stout. </p>', 'http://www.bjcp.org/2008styles/style13.php#1f', '13'),
(48, 'A', 'English IPA', '1.050', '1.075', '1.010', '1.018', '5.0', '7.5', '40', '60', '08', '14', 'Ale', 'A hoppy, moderately strong pale ale that features characteristics consistent with the use of English malt, hops and yeast. Has less hop character and a more pronounced malt flavor than American versions.<p>Commercial Examples: Meantime India Pale Ale, Freeminer Trafalgar IPA, Fuller''s IPA, Ridgeway Bad Elf, Summit India Pale Ale, Samuel Smith''s India Ale, Hampshire Pride of Romsey IPA, Burton Bridge Empire IPA,Middle Ages ImPailed Ale, Goose Island IPA, Brooklyn East India Pale Ale.</p>', 'http://www.bjcp.org/2008styles/style14.php#1a', '14'),
(49, 'B', 'American IPA', '1.056', '1.075', '1.010', '1.018', '5.5', '7.5', '40', '70', '06', '15', 'Ale', 'A decidedly hoppy and bitter, moderately strong American pale ale.<p>Commercial Examples: Bell&rsquo;s Two-Hearted Ale, AleSmith IPA, Russian River Blind Pig IPA, Stone IPA, Three Floyds Alpha King, Great Divide Titan IPA, Bear Republic Racer 5 IPA, Victory Hop Devil, Sierra Nevada Celebration Ale, Anderson Valley Hop Ottin&rsquo;,  Dogfish Head 60 Minute IPA, Founder&rsquo;s Centennial IPA, Anchor Liberty Ale, Harpoon IPA, Avery IPA.</p>', 'http://www.bjcp.org/2008styles/style14.php#1b', '14'),
(50, 'C', 'Imperial IPA', '1.075', '1.090', '1.010', '1.020', '7.5', '10.0', '60', '120', '08', '15', 'Ale', 'An intensely hoppy, very strong pale ale without the big maltiness and/or deeper malt flavors of an American barleywine.  Strongly hopped, but clean, lacking harshness, and a tribute to historical IPAs.  Drinkability is an important characteristic; this should not be a heavy, sipping beer.  It should also not have much residual sweetness or a heavy character grain profile.<p>Commercial Examples: Russian River Pliny the Elder, Three Floyd&rsquo;s Dreadnaught, Avery Majaraja, Bell&rsquo;s Hop Slam, Stone Ruination IPA, Great Divide Hercules Double IPA, Surly Furious, Rogue I2PA, Moylan&rsquo;s Hopsickle Imperial India Pale Ale, Stoudt&rsquo;s Double IPA, Dogfish Head 90-minute IPA, Victory Hop Wallop.</p>', 'http://www.bjcp.org/2008styles/style14.php#1c', '14'),
(51, 'A', 'Weizen/Weissbier', '1.044', '1.052', '1.010', '1.014', '4.3', '5.6', '08', '15', '02', '08', 'Ale', 'A pale, spicy, fruity, refreshing wheat-based ale.<p>Commercial Examples: Weihenstephaner Hefeweissbier, Schneider Weisse Weizenhell, Paulaner Hefe-Weizen, Hacker-Pschorr Weisse, Plank Bavarian Hefeweizen, Ayinger Br&auml;u Weisse, Ettaler Weissbier Hell, Franziskaner Hefe-Weisse, Andechser Weissbier Hefetr&uuml;b, Kapuziner Weissbier, Erdinger Weissbier, Penn Weizen, Barrelhouse Hocking Hills HefeWeizen, Eisenbahn Weizenbier.</p>', 'http://www.bjcp.org/2008styles/style15.php#1a', '15'),
(52, 'B', 'Dunkelweizen', '1.044', '1.056', '1.010', '1.014', '4.3', '5.6', '10', '18', '14', '23', 'Ale', 'A moderately dark, spicy, fruity, malty, refreshing wheat-based ale. Reflecting the best yeast and wheat character of a hefe-weizen blended with the malty richness of a Munich dunkel.<p>Commercial Examples: Weihenstephaner Hefeweissbier Dunkel, Ayinger Ur-Weisse, Franziskaner Dunkel Hefe-Weisse, Schneider Weisse (Original), Ettaler Weissbier Dunkel, Hacker-Pschorr Weisse Dark, Tucher Dunkles Hefe Weizen, Edelweiss Dunkel Weissbier, Erdinger Weissbier Dunkel, Kapuziner Weissbier Schwarz. </p>', 'http://www.bjcp.org/2008styles/style15.php#1b', '15'),
(53, 'C', 'Weizenbock', '1.064', '1.090', '1.015', '1.022', '6.5', '8.0', '15', '30', '12', '25', 'Ale', 'A strong, malty, fruity, wheat-based ale combining the best flavors of a dunkelweizen and the rich strength and body of a bock.<p>Commercial Examples: Schneider Aventinus, Schneider Aventinus Eisbock, Plank Bavarian Dunkler Weizenbock, Plank Bavarian Heller Weizenbock, AleSmith Weizenbock, Erdinger Pikantus, Mahr&rsquo;s Der Weisse Bock, Victory Moonglow Weizenbock, High Point Ramstein Winter Wheat, Capital Weizen Doppelbock, Eisenbahn Vigorosa.</p>', 'http://www.bjcp.org/2008styles/style15.php#1c', '15'),
(54, 'D', 'Roggenbier (German Rye Beer)', '1.046', '1.056', '1.010', '1.014', '4.5', '6.0', '10', '20', '14', '19', 'Ale', 'A dunkelweizen made with rye rather than wheat, but with a greater body and light finishing hops.<p>Commercial Examples: Paulaner Roggen, B&uuml;rgerbr&auml;u Wolznacher Roggenbier. </p>', 'http://www.bjcp.org/2008styles/style15.php#1d', '15'),
(55, 'A', 'Witbier', '1.044', '1.052', '1.008', '1.012', '4.5', '5.5', '10', '20', '02', '04', 'Ale', 'A refreshing, elegant, tasty, moderate-strength wheat-based ale.<p>Commercial Examples: Hoegaarden Wit, St. Bernardus Blanche, Celis White, Vuuve 5, Brugs Tarwebier (Blanche de Bruges), Wittekerke, Allagash White, Blanche de Bruxelles, Ommegang Witte, Avery White Rascal, Unibroue Blanche de Chambly, Sterkens White Ale, Bell&rsquo;s Winter White Ale, Victory Whirlwind Witbier, Hitachino Nest White Ale.</p>', 'http://www.bjcp.org/2008styles/style16.php#1a', '16'),
(56, 'B', 'Belgian Pale Ale', '1.048', '1.054', '1.010', '1.014', '4.8', '5.5', '20', '30', '08', '14', 'Ale', 'A fruity, moderately malty, somewhat spicy, easy-drinking, copper-colored ale. <p>Commercial Examples: De Koninck, Speciale Palm, Dobble Palm, Russian River Perdition, Ginder Ale, Op-Ale, St. Pieters Zinnebir, Brewer&rsquo;s Art House Pale Ale, Avery Karma, Eisenbahn Pale Ale, Ommegang Rare Vos.</p>', 'http://www.bjcp.org/2008styles/style16.php#1b', '16'),
(57, 'C', 'Saison', '1.048', '1.065', '1.002', '1.012', '5.0', '7.0', '20', '35', '05', '14', 'Ale', 'A medium to strong ale with a distinctive yellow-orange color, highly carbonated, well hopped, fruity and dry with a quenching acidity.<p>Commercial Examples: Saison Dupont Vieille Provision; Fant&ocirc;me Saison D&rsquo;Erez&eacute;e - Printemps; Saison de Pipaix; Saison Regal; Saison Voisin; Lefebvre Saison 1900; Ellezelloise Saison 2000; Saison Silly; Southampton Saison; New Belgium Saison; Pizza Port SPF 45; Lost Abbey Red Barn Ale; Ommegang Hennepin.</p>', 'http://www.bjcp.org/2008styles/style16.php#1c', '16'),
(58, 'D', 'Biere de Garde', '1.060', '1.080', '1.008', '1.016', '6.0', '8.5', '18', '28', '06', '19', 'Ale', 'A fairly strong, malt-accentuated, lagered artisanal farmhouse beer.<p>Commercial Examples: Jenlain (amber), Jenlain Bi&egrave;re de Printemps (blond), St. Amand (brown), Ch&rsquo;Ti Brun (brown), Ch&rsquo;Ti Blond (blond), La Choulette (all 3 versions), La Choulette Bi&egrave;re des Sans Culottes (blond), Saint Sylvestre 3 Monts (blond), Biere Nouvelle (brown), Castelain (blond), Jade (amber), Brasseurs Bi&egrave;re de Garde (amber), Southampton Bi&egrave;re de Garde (amber), Lost Abbey Avante Garde (blond).</p>', 'http://www.bjcp.org/2008styles/style16.php#1d', '16'),
(59, 'E', 'Belgian Specialty Ale', '', '', '', '', '', '', '', '', '', '', 'Ale', 'Variable. This category encompasses a wide range of Belgian ales produced by truly artisanal brewers more concerned with creating unique products than in increasing sales.<p>Commercial Examples: Orval; De Dolle&rsquo;s Arabier, Oerbier, Boskeun and Stille Nacht; La Chouffe, McChouffe, Chouffe Bok and N&rsquo;ice Chouffe; Ellezelloise Hercule Stout and Quintine Amber; Unibroue Ephemere, Maudite, Don de Dieu, etc.; Minty; Zatte Bie; Caracole Amber, Saxo and Nostradamus; Silenrieu Sara and Joseph; Fant&ocirc;me Black Ghost and Speciale No&euml;l; Dupont Moinette, Moinette Brune, and Avec Les Bons Voeux de la Brasserie Dupont; St. Fullien No&euml;l; Gouden Carolus No&euml;l; Affligem N&ouml;el; Guldenburg and Pere No&euml;l; De Ranke XX Bitter and Guldenberg; Poperings Hommelbier; Bush (Scaldis); Moinette Brune; Grottenbier; La Trappe Quadrupel; Weyerbacher QUAD; Bi&egrave;re de Miel; Verboden Vrucht; New Belgium 1554 Black Ale; Cantillon Iris; Russian River Temptation; Lost Abbey Cuvee de Tomme and Devotion, Lindemans Kriek and Framboise, and many more.</p>', 'http://www.bjcp.org/2008styles/style16.php#1e', '16'),
(60, 'A', 'Berliner Weisse', '1.028', '1.032', '1.003', '1.006', '2.8', '3.8', '03', '08', '02', '03', 'Ale', 'A very pale, sour, refreshing, low-alcohol wheat ale.<p>Commercial Examples: Schultheiss Berliner Weisse, Berliner Kindl Weisse, Nodding Head Berliner Weisse, Weihenstephan 1809 (unusual in its 5% ABV), Bahnhof Berliner Style Weisse, Southampton Berliner Weisse, Bethlehem Berliner Weisse, Three Floyds Deesko.</p>', 'http://www.bjcp.org/2008styles/style17.php#1a', '17'),
(61, 'B', 'Flanders Red Ale', '1.048', '1.057', '1.002', '1.012', '4.6', '6.5', '10', '25', '10', '16', 'Ale', 'A complex, sour, red wine-like Belgian-style ale.<p>Commercial Examples: Rodenbach Klassiek, Rodenbach Grand Cru, Bellegems Bruin, Duchesse de Bourgogne, New Belgium La Folie, Petrus Oud Bruin, Southampton Flanders Red Ale, Verhaege Vichtenaar, Monk&rsquo;s Cafe Flanders Red Ale, New Glarus Enigma, Panil Barriqu&eacute;e, Mestreechs Aajt.</p>', 'http://www.bjcp.org/2008styles/style17.php#1b', '17'),
(62, 'C', 'Flanders Brown Ale/Oud Bruin', '1.040', '1.074', '1.008', '1.012', '4.0', '8.0', '20', '25', '15', '22', 'Ale', 'A malty, fruity, aged, somewhat sour Belgian-style brown ale.<p>Commercial Examples: Liefman&rsquo;s Goudenband, Liefman&rsquo;s Odnar, Liefman&rsquo;s Oud Bruin, Ichtegem Old Brown, Riva Vondel. </p>', 'http://www.bjcp.org/2008styles/style17.php#1c', '17'),
(63, 'D', 'Straight (Unblended) Lambic', '1.040', '1.054', '1.001', '1.010', '5.0', '6.5', '00', '10', '03', '07', 'Ale', 'Complex, sour/acidic, pale, wheat-based ale fermented by a variety of Belgian microbiota.<p>Commercial Example: Cantillon Grand Cru Bruocsella.</p>', 'http://www.bjcp.org/2008styles/style17.php#1d', '17'),
(64, 'E', 'Gueuze', '1.040', '1.060', '1.000', '1.006', '5.0', '8.0', '00', '10', '03', '07', 'Ale', 'Complex, pleasantly sour/acidic, balanced, pale, wheat-based ale fermented by a variety of Belgian microbiota.<p>Commercial Examples: Boon Oude Gueuze, Boon Oude Gueuze Mariage Parfait, De Cam Gueuze, De Cam/Drei Fonteinen Millennium Gueuze, Drie Fonteinen Oud Gueuze, Cantillon Gueuze, Hanssens Oude Gueuze, Lindemans Gueuze Cuv&eacute;e Ren&eacute;, Girardin Gueuze (Black Label), Mort Subite (Unfiltered) Gueuze, Oud Beersel Oude Gueuze.</p>', 'http://www.bjcp.org/2008styles/style17.php#1e', '17'),
(65, 'F', 'Fruit Lambic', '1.040', '1.060', '1.000', '1.010', '5.0', '7.0', '00', '10', '03', '07', 'Ale', 'Complex, fruity, pleasantly sour/acidic, balanced, pale, wheat-based ale fermented by a variety of Belgian microbiota. A lambic with fruit, not just a fruit beer.<p>Commercial Examples: Boon Framboise Marriage Parfait, Boon Kriek Mariage Parfait, Boon Oude Kriek, Cantillon Fou&rsquo; Foune (apricot), Cantillon Kriek, Cantillon Lou Pepe Kriek, Cantillon Lou Pepe Framboise, Cantillon Rose de Gambrinus, Cantillon St. Lamvinus (merlot grape), Cantillon Vigneronne (Muscat grape), De Cam Oude Kriek, Drie Fonteinen Kriek, Girardin Kriek, Hanssens Oude Kriek, Oud Beersel Kriek, Mort Subite Kriek.</p>', 'http://www.bjcp.org/2008styles/style17.php#1f', '17'),
(66, 'A', 'Belgian Blond Ale', '1.062', '1.075', '1.008', '1.018', '6.0', '7.5', '15', '30', '04', '07', 'Ale', 'A moderate-strength golden ale that has a subtle Belgian complexity, slightly sweet flavor, and dry finish. History: Relatively recent development to further appeal to European Pils drinkers, becoming more popular as it is widely marketed and distributed.<p>Commercial Examples: Leffe Blond, Affligem Blond, La Trappe (Koningshoeven) Blond, Grimbergen Blond, Val-Dieu Blond, Straffe Hendrik Blonde, Brugse Zot, Pater Lieven Blond Abbey Ale, Troubadour Blond Ale.</p>', 'http://www.bjcp.org/2008styles/style18.php#1a', '18'),
(67, 'B', 'Belgian Dubbel', '1.062', '1.075', '1.008', '1.018', '6.0', '7.6', '15', '25', '10', '17', 'Ale', 'A deep reddish, moderately strong, malty, complex Belgian ale.<p>Commercial Examples: Westmalle Dubbel, St. Bernardus Pater 6, La Trappe Dubbel, Corsendonk Abbey Brown Ale, Grimbergen Double, Affligem Dubbel, Chimay Premiere (Red), Pater Lieven Bruin, Duinen Dubbel, St. Feuillien Brune, New Belgium Abbey Belgian Style Ale, Stoudts Abbey Double Ale, Russian River Benediction, Flying Fish Dubbel, Lost Abbey Lost and Found Abbey Ale, Allagash Double.</p>', 'http://www.bjcp.org/2008styles/style18.php#1b', '18'),
(68, 'C', 'Belgian Tripel', '1.075', '1.085', '1.008', '1.014', '7.5', '9.5', '20', '40', '04.5', '07', 'Ale', 'Strongly resembles a Strong Golden Ale but slightly darker and somewhat fuller-bodied. Usually has a more rounded malt flavor but should not be sweet.<p>Commercial Examples: Westmalle Tripel, La Rulles Tripel, St. Bernardus Tripel, Chimay Cinq Cents (White), Watou Tripel, Val-Dieu Triple, Affligem Tripel, Grimbergen Tripel, La Trappe Tripel, Witkap Pater Tripel, Corsendonk Abbey Pale Ale, St. Feuillien Tripel, Bink Tripel, Tripel Karmeliet, New Belgium Trippel, Unibroue La Fin du Monde, Dragonmead Final Absolution, Allagash Tripel Reserve, Victory Golden Monkey.</p>', 'http://www.bjcp.org/2008styles/style18.php#1c', '18'),
(69, 'D', 'Belgian Golden Strong Ale', '1.070', '1.095', '1.005', '1.016', '7.5', '10.5', '22', '35', '03', '06', 'Ale', 'A golden, complex, effervescent, strong Belgian-style ale.<p>Commercial Examples: Duvel, Russian River Damnation, Hapkin, Lucifer, Brigand, Judas, Delirium Tremens, Dulle Teve, Piraat, Great Divide Hades, Avery Salvation, North Coast Pranqster, Unibroue Eau Benite, AleSmith Horny Devil.</p>', 'http://www.bjcp.org/2008styles/style18.php#1d', '18'),
(70, 'E', 'Belgian Dark Strong Ale', '1.075', '1.110', '1.010', '1.024', '8.0', '11.0', '20', '35', '12', '22', 'Ale', 'A dark, very rich, complex, very strong Belgian ale. Complex, rich, smooth and dangerous.<p>Commercial Examples: Westvleteren 12 (yellow cap), Rochefort 10 (blue cap), St. Bernardus Abt 12, Gouden Carolus Grand Cru of the Emperor, Achel Extra Brune, Rochefort 8 (green cap), Southampton Abbot 12, Chimay Grande Reserve (Blue), Brasserie des Rocs Grand Cru, Gulden Draak, Kasteelbier Bi&egrave;re du Chateau Donker, Lost Abbey Judgment Day, Russian River Salvation.</p>', 'http://www.bjcp.org/2008styles/style18.php#1e', '18'),
(71, 'A', 'Old Ale', '1.060', '1.090', '1.015', '1.022', '6.0', '9.0', '30', '60', '10', '22', 'Ale', 'An ale of significant alcoholic strength, bigger than strong bitters and brown porters, though usually not as strong or rich as barleywine. Usually tilted toward a sweeter, maltier balance. &ldquo;It should be a warming beer of the type that is best drunk in half pints by a warm fire on a cold winter&rsquo;s night&rdquo; &ndash; Michael Jackson.<p>Commercial Examples: Gale&rsquo;s Prize Old Ale, Burton Bridge Olde Expensive, Marston Owd Roger, Greene King Olde Suffolk Ale , J.W. Lees Moonraker, Harviestoun Old Engine Oil, Fuller&rsquo;s Vintage Ale, Harvey&rsquo;s Elizabethan Ale, Theakston Old Peculier (peculiar at OG 1.057), Young''s Winter Warmer, Sarah Hughes Dark Ruby Mild, Samuel Smith&rsquo;s Winter Welcome, Fuller&rsquo;s 1845, Fuller&rsquo;s Old Winter Ale, Great Divide Hibernation Ale, Founders Curmudgeon, Cooperstown Pride of Milford Special Ale, Coniston Old Man Ale, Avery Old Jubilation.</p>', 'http://www.bjcp.org/2008styles/style19.php#1a', '19'),
(72, 'B', 'English Barleywine', '1.080', '1.120', '1.018', '1.030', '8.0', '12.0', '35', '70', '08', '22', 'Ale', 'The richest and strongest of the English Ales. A showcase of malty richness and complex, intense flavors. The character of these ales can change significantly over time; both young and old versions should be appreciated for what they are. The malt profile can vary widely; not all examples will have all possible flavors or aromas.<p>Commercial Examples: Thomas Hardy&rsquo;s Ale, Burton Bridge Thomas Sykes Old Ale, J.W. Lee&rsquo;s Vintage Harvest Ale, Robinson&rsquo;s Old Tom, Fuller&rsquo;s Golden Pride, AleSmith Old Numbskull, Young&rsquo;s Old Nick (unusual in its 7.2% ABV), Whitbread Gold Label, Old Dominion Millenium, North Coast Old Stock Ale (when aged), Weyerbacher Blithering Idiot.</p>', 'http://www.bjcp.org/2008styles/style19.php#1b', '19'),
(73, 'C', 'American Barleywine', '1.080', '1.120', '1.016', '1.030', '8.0', '12.0', '50', '120', '10', '19', 'Ale', 'A well-hopped American interpretation of the richest and strongest of the English ales. The hop character should be evident throughout, but does not have to be unbalanced. The alcohol strength and hop bitterness often combine to leave a very long finish. <p>Commercial Examples: Sierra Nevada Bigfoot, Great Divide Old Ruffian, Victory Old Horizontal, Rogue Old Crustacean, Avery Hog Heaven Barleywine, Bell&rsquo;s Third Coast Old Ale, Anchor Old Foghorn, Three Floyds Behemoth, Stone Old Guardian, Bridgeport Old Knucklehead, Hair of the Dog Doggie Claws, Lagunitas Olde GnarleyWine, Smuttynose Barleywine, Flying Dog Horn Dog.</p>', 'http://www.bjcp.org/2008styles/style19.php#1c', '19'),
(74, 'A', 'Fruit Beer', '', '', '', '', '', '', '', '', '', '', 'Ale', 'A harmonious marriage of fruit and beer. The key attributes of the underlying style will be different with the addition of fruit; do not expect the base beer to taste the same as the unadulterated version. Judge the beer based on the pleasantness and balance of the resulting combination.<p>Commercial Examples: New Glarus Belgian Red and Raspberry Tart, Bell&rsquo;s Cherry Stout, Dogfish Head Aprihop, Great Divide Wild Raspberry Ale, Founders R&uuml;b&aelig;us, Ebulum Elderberry Black Ale, Stiegl Radler, Weyerbacher Raspberry Imperial Stout, Abita Purple Haze, Melbourne Apricot Beer and Strawberry Beer, Saxer Lemon Lager, Magic Hat #9, Grozet Gooseberry and Wheat Ale,  Pyramid Apricot Ale, Dogfish Head Fort.</p>', 'http://www.bjcp.org/2008styles/style20.php#1a', '20'),
(75, 'A', 'Spice, Herb, or Vegetable Beer', '', '', '', '', '', '', '', '', '', '', 'Ale', 'A harmonious marriage of spices, herbs and/or vegetables and beer. The key attributes of the underlying style will be different with the addition of spices, herbs and/or vegetables; do not expect the base beer to taste the same as the unadulterated version. Judge the beer based on the pleasantness and balance of the resulting combination.<p>Commercial Examples: Alesmith Speedway Stout, Founders Breakfast Stout, Traquair Jacobite Ale, Rogue Chipotle Ale, Young&rsquo;s Double Chocolate Stout, Bell&rsquo;s Java Stout, Fraoch Heather Ale, Southampton Pumpkin Ale, Rogue Hazelnut Nectar, Hitachino Nest Real Ginger Ale, Breckenridge Vanilla Porter, Left Hand JuJu Ginger Beer, Dogfish Head Punkin Ale, Dogfish Head Midas Touch, Redhook Double Black Stout, Buffalo Bill''s Pumpkin Ale,  BluCreek Herbal Ale, Christian Moerlein Honey Almond,  Rogue Chocolate Stout, Birrificio Baladin Nora, Cave Creek Chili Beer.</p>', 'http://www.bjcp.org/2008styles/style21.php#1a', '21'),
(76, 'B', 'Christmas/Winter Specialty Spiced Beer', '', '', '', '', '', '', '', '', '', '', 'Ale', 'A stronger, darker, spiced beer that often has a rich body and warming finish suggesting a good accompaniment for the cold winter season.<p>Commercial Examples: Anchor Our Special Ale, Harpoon Winter Warmer, Weyerbacher Winter Ale, Nils Oscar Jul&ouml;l, Goose Island Christmas Ale, North Coast Wintertime Ale, Great Lakes Christmas Ale, Lakefront Holiday Spice Lager Beer, Samuel Adams Winter Lager, Troegs The Mad Elf, Jamtlands Jul&ouml;l.</p>', 'http://www.bjcp.org/2008styles/style21.php#1b', '21'),
(77, 'A', 'Classic Rauchbier', '1.050', '1.057', '1.012', '1.016', '4.8', '6.0', '20', '30', '12', '22', 'Ale', 'M&auml;rzen/Oktoberfest-style beer with a sweet, smoky aroma and flavor and a somewhat darker color.<p>Commercial Examples: Schlenkerla Rauchbier M&auml;rzen, Kaiserdom Rauchbier, Eisenbahn Rauchbier, Victory Scarlet Fire Rauchbier, Spezial Rauchbier M&auml;rzen, Saranac Rauchbier.</p>', 'http://www.bjcp.org/2008styles/style22.php#1a', '22');
INSERT INTO `styles` (`id`, `brewStyleNum`, `brewStyle`, `brewStyleOG`, `brewStyleOGMax`, `brewStyleFG`, `brewStyleFGMax`, `brewStyleABV`, `brewStyleABVMax`, `brewStyleIBU`, `brewStyleIBUMax`, `brewStyleSRM`, `brewStyleSRMMax`, `brewStyleType`, `brewStyleInfo`, `brewStyleLink`, `brewStyleGroup`) VALUES
(78, 'B', 'Other Smoked Beer', '', '', '', '', '', '', '', '', '', '', 'Ale', 'This is any beer that is exhibiting smoke as a principle flavor and aroma characteristic other than the Bamberg-style Rauchbier (i.e. beechwood-smoked M&auml;rzen). Balance in the use of smoke, hops and malt character is exhibited by the better examples.<p>Commercial Examples: Alaskan Smoked Porter, O&rsquo;Fallons Smoked Porter, Spezial Lagerbier, Weissbier and Bockbier, Stone Smoked Porter, Schlenkerla Weizen Rauchbier and Ur-Bock Rauchbier, Rogue Smoke, Oskar Blues Old Chub, Left Hand Smoke Jumper, Dark Horse Fore Smoked Stout, Magic Hat Jinx. </p>', 'http://www.bjcp.org/2008styles/style22.php#1b', '22'),
(79, 'C', 'Wood-Aged Beer', '', '', '', '', '', '', '', '', '', '', 'Ale', 'A harmonious blend of the base beer style with characteristics from aging in contact with wood (including any alcoholic products previously in contact with the wood).  The best examples will be smooth, flavorful, well-balanced and well-aged. <em>Beers made using either limited wood aging or products that only provide a subtle background character may be entered in the base beer style categories as long as the wood character isn&rsquo;t prominently featured.</em><p>Commercial Examples: The Lost Abbey Angel&rsquo;s Share Ale, J.W. Lees Harvest Ale in Port, Sherry, Lagavulin Whisky or Calvados Casks, Bush Prestige, Petrus Aged Pale, Firestone Walker Double Barrel Ale, Dominion Oak Barrel Stout, New Holland Dragons Milk, Great Divide Oak Aged Yeti Imperial Stout, Goose Island Bourbon County Stout, Le Coq Imperial Extra Double Stout, Harviestoun Old Engine Oil Special Reserve, many microbreweries have specialty beers served only on premises often directly from the cask.</p>', 'http://www.bjcp.org/2008styles/style22.php#1c', '22'),
(80, 'A', 'Specialty Beer', '', '', '', '', '', '', '', '', '', '', 'Ale', 'A harmonious marriage of ingredients, processes and beer. The key attributes of the underlying style (if declared) will be atypical due to the addition of special ingredients or techniques; do not expect the base beer to taste the same as the unadulterated version. Judge the beer based on the pleasantness and harmony of the resulting combination. The overall uniqueness of the process, ingredients used, and creativity should be considered. The overall rating of the beer depends heavily on the inherently subjective assessment of distinctiveness and drinkability.<p>Commercial Examples: Bell&rsquo;s Rye Stout, Bell&rsquo;s Eccentric Ale, Samuel Adams Triple Bock and Utopias, Hair of the Dog Adam, Great Alba Scots Pine, Tommyknocker Maple Nut Brown Ale, Great Divide Bee Sting Honey Ale, Stoudt&rsquo;s Honey Double Mai Bock, Rogue Dad&rsquo;s Little Helper, Rogue Honey Cream Ale, Dogfish Head India Brown Ale, Zum Uerige Sticke and Doppel Sticke Altbier, Yards Brewing Company General Washington Tavern Porter, Rauchenfels Steinbier, Odells 90 Shilling Ale, Bear Republic Red Rocket Ale, Stone Arrogant Bastard.</p>', 'http://www.bjcp.org/2008styles/style23.php#1a', '23'),
(81, 'A', 'Dry Mead', '', '', '', '', '', '', 'N/A', 'N/A', 'N/A', 'N/A', 'Mead', 'Similar in balance, body, finish and flavor intensity to a dry white wine, with a pleasant mixture of subtle honey character, soft fruity esters, and clean alcohol. Complexity, harmony, and balance of sensory elements are most desirable, with no inconsistencies in color, aroma, flavor or aftertaste. The proper balance of sweetness, acidity, alcohol and honey character is the essential final measure of any mead.<p>Commercial Examples: White Winter Dry Mead, Sky River Dry Mead, Intermiel Bouquet Printanier.</p>', 'http://www.bjcp.org/2008styles/style24.php#1a', '24'),
(82, 'B', 'Semi-Sweet Mead', '', '', '', '', '', '', 'N/A', 'N/A', 'N/A', 'N/A', 'Mead', 'Similar in balance, body, finish and flavor intensity to a semisweet (or medium-dry) white wine, with a pleasant mixture of honey character, light sweetness, soft fruity esters, and clean alcohol. Complexity, harmony, and balance of sensory elements are most desirable, with no inconsistencies in color, aroma, flavor or aftertaste. The proper balance of sweetness, acidity, alcohol and honey character is the essential final measure of any mead.<p>Commercial Examples: Lurgashall English Mead, Redstone Traditional Mountain Honey Wine, Sky River Semi-Sweet Mead, Intermiel Verge d&rsquo;Or and M&eacute;lilot. </p>', 'http://www.bjcp.org/2008styles/style24.php#1b', '24'),
(83, 'C', 'Sweet Mead', '', '', '', '', '', '', 'N/A', 'N/A', 'N/A', 'N/A', 'Mead', 'Similar in balance, body, finish and flavor intensity to a well-made dessert wine (such as Sauternes), with a pleasant mixture of honey character, residual sweetness, soft fruity esters, and clean alcohol. Complexity, harmony, and balance of sensory elements are most desirable, with no inconsistencies in color, aroma, flavor or aftertaste. The proper balance of sweetness, acidity, alcohol and honey character is the essential final measure of any mead.<p>Commercial Examples: Lurgashall Christmas Mead, Chaucer&rsquo;s Mead, Rabbit&rsquo;s Foot Sweet Wildflower Honey Mead, Intermiel Beno&icirc;te.</p>', 'http://www.bjcp.org/2008styles/style24.php#1c', '24'),
(84, 'A', 'Cyser', '', '', '', '', '', '', 'N/A', 'N/A', 'N/A', 'N/A', 'Mead', 'In well-made examples of the style, the fruit is both distinctive and well-incorporated into the honey-sweet-acid-tannin-alcohol balance of the mead. Some of the best strong examples have the taste and aroma of an aged Calvados (apple brandy from northern France), while subtle, dry versions can taste similar to many fine white wines.<p>Commercial Examples: White Winter Cyser, Rabbit&rsquo;s Foot Apple Cyser, Long Island Meadery Apple Cyser.</p>', 'http://www.bjcp.org/2008styles/style25.php#1a', '25'),
(85, 'B', 'Pyment', '', '', '', '', '', '', 'N/A', 'N/A', 'N/A', 'N/A', 'Mead', 'In well-made examples of the style, the grape is both distinctively vinous and well-incorporated into the honey-sweet-acid-tannin-alcohol balance of the mead. White and red versions can be quite different, and the overall impression should be characteristic of the type of grapes used and suggestive of a similar variety wine.<p>Commercial Examples: Redstone Pinot Noir and White Pyment Mountain Honey Wines.</p>', 'http://www.bjcp.org/2008styles/style25.php#1b', '25'),
(86, 'C', 'Other Fruit Melomel', '', '', '', '', '', '', 'N/A', 'N/A', 'N/A', 'N/A', 'Mead', 'In well-made examples of the style, the fruit is both distinctive and well-incorporated into the honey-sweet-acid-tannin-alcohol balance of the mead. Different types of fruit can result in widely different characteristics; allow for a variation in the final product.<p>Commercial Examples: White Winter Blueberry, Raspberry and Strawberry Melomels, Redstone Black Raspberry and Sunshine Nectars, Bees Brothers Raspberry Mead, Intermiel Honey Wine and Raspberries, Honey Wine and Blueberries, and Honey Wine and Blackcurrants, Long Island Meadery Blueberry Mead, Mountain Meadows Cranberry and Cherry Meads.</p>', 'http://www.bjcp.org/2008styles/style25.php#1c', '25'),
(87, 'A', 'Metheglin', '', '', '', '', '', '', 'N/A', 'N/A', 'N/A', 'N/A', 'Mead', 'Often, a blend of spices may give a character greater than the sum of its parts. The better examples of this style use spices/herbs subtly and when more than one are used, they are carefully selected so that they blend harmoniously. See standard description for entrance requirements. Entrants MUST specify carbonation level, strength, and sweetness. Entrants MAY specify honey varieties. Entrants MUST specify the types of spices used.<p>Commercial Examples: Bonair Chili Mead, Redstone Juniper Mountain Honey Wine, Redstone Vanilla Beans and Cinnamon Sticks Mountain Honey Wine, Long Island Meadery Vanilla Mead, iQhilika Africa Birds Eye Chili Mead, Mountain Meadows Spice Nectar.</p>', 'http://www.bjcp.org/2008styles/style26.php#1a', '26'),
(88, 'B', 'Braggot', '', '', '', '', '', '', 'N/A', 'N/A', 'N/A', 'N/A', 'Mead', 'A harmonious blend of mead and beer, with the distinctive characteristics of both. A wide range of results are possible, depending on the base style of beer, variety of honey and overall sweetness and strength. Beer flavors tend to somewhat mask typical honey flavors found in other meads.<p>Commercial Examples: Rabbit&rsquo;s Foot Diabhal and Bi&egrave;re de Miele, Magic Hat Braggot, Brother Adams Braggot Barleywine Ale, White Winter Traditional Brackett.</p>', 'http://www.bjcp.org/2008styles/style26.php#1b', '26'),
(89, 'C', 'Open Category Mead', '', '', '', '', '', '', 'N/A', 'N/A', 'N/A', 'N/A', 'Mead', 'See standard description for entrance requirements. Entrants MUST specify carbonation level, strength, and sweetness. Entrants MAY specify honey varieties. Entrants MUST specify the special nature of the mead, whether it is a combination of existing styles, an experimental mead, a historical mead, or some other creation. Any special ingredients that impart an identifiable character MAY be declared.<p>Commercial Examples: Jadwiga, Hanssens/Lurgashall Mead the Gueuze, Rabbit&rsquo;s Foot Private Reserve Pear Mead, White Winter Cherry Bracket, Saba Tej, Mountain Meadows Trickster&rsquo;s Treat Agave Mead, Intermiel Ros&eacute;e.</p>', 'http://www.bjcp.org/2008styles/style26.php#1c', '26'),
(90, 'A', 'Common Cider', '1.045', '1.065', '1.000', '1.020', '5', '8', 'N/A', 'N/A', 'N/A', 'N/A', 'Cider', 'Variable, but should be a medium, refreshing drink. Sweet ciders must not be cloying. Dry ciders must not be too austere. An ideal cider serves well as a &quot;session&quot; drink, and suitably accompanies a wide variety of food.<p>Commercial Examples: [US] Red Barn Cider Jonagold Semi-Dry and Sweetie Pie (WA), AEppelTreow Barn Swallow Draft Cider (WI), Wandering Aengus Heirloom Blend Cider (OR), Uncle John&rsquo;s Fruit House Winery Apple Hard Cider (MI), Bellwether Spyglass (NY), West County Pippin (MA), White Winter Hard Apple Cider (WI), Harpoon Cider (MA)</p>', 'http://www.bjcp.org/2008styles/style27.php#1a', '27'),
(91, 'B', 'English Cider', '1.050', '1.075', '0.995', '1.010', '6', '9', 'N/A', 'N/A', 'N/A', 'N/A', 'Cider', 'Generally dry, full-bodied, austere.<p>Commercial Examples: [US] Westcott Bay Traditional Very Dry, Traditional Dry and Traditional Medium Sweet (WA), Farnum Hill Extra-Dry, Dry, and Farmhouse (NH), Wandering Aengus Dry Cider (OR), Red Barn Cider Burro Loco (WA), Bellwether Heritage (NY); [UK] Oliver&rsquo;s Herefordshire Dry Cider, various from Hecks, Dunkerton, Burrow Hill, Gwatkin Yarlington Mill, Aspall Dry Cider</p>', 'http://www.bjcp.org/2008styles/style27.php#1b', '27'),
(92, 'C', 'French Cider', '1.050', '1.065', '1.010', '1.020', '3', '6', 'N/A', 'N/A', 'N/A', 'N/A', 'Cider', 'Medium to sweet, full-bodied, rich.<p>Commercial Examples: [US] West County Reine de Pomme (MA), Rhyne Cider (CA); [France] Eric Bordelet (various), Etienne Dupont, Etienne Dupont Organic, Bellot.</p>', 'http://www.bjcp.org/2008styles/style27.php#1c', '27'),
(93, 'D', 'Common Perry', '1.050', '1.060', '1.000', '1.020', '5', '7', 'N/A', 'N/A', 'N/A', 'N/A', 'Cider', 'Mild. Medium to medium-sweet. Still to lightly sparkling. Only very slight acetification is acceptable. Mousiness, ropy/oily characters are serious faults.<p>[US] White Winter Hard Pear Cider (WI), AEppelTreow Perry (WI), Blossomwood Laughing Pig Perry (CO), Uncle John&rsquo;s Fruit House Winery Perry (MI).</p>', 'http://www.bjcp.org/2008styles/style27.php#1d', '27'),
(94, 'E', 'Traditional Perry', '1.050', '1.070', '1.000', '1.020', '5', '9', 'N/A', 'N/A', 'N/A', 'N/A', 'Cider', 'Tannic. Medium to medium-sweet. Still to lightly sparkling. Only very slight acetification is acceptable. Mousiness, ropy/oily characters are serious faults.<p>Commercial Examples:  [France] Bordelet Poire Authentique and Poire Granit, Christian Drouin Poire, [UK] Gwatkin Blakeney Red Perry, Oliver&rsquo;s Blakeney Red Perry and Herefordshire Dry Perry.</p>', 'http://www.bjcp.org/2008styles/style27.php#1e', '27'),
(95, 'A', 'New England Cider', '1.060', '1.100', '0.995', '1.010', '7', '13', 'N/A', 'N/A', 'N/A', 'N/A', 'Cider', 'Adjuncts may include white and brown sugars, molasses, small amounts of honey, and raisins. Adjuncts are intended to raise OG well above that which would be achieved by apples alone. This style is sometimes barrel-aged, in which case there will be oak character as with a barrel-aged wine. If the barrel was formerly used to age spirits, some flavor notes from the spirit (e.g., whisky or rum) may also be present, but must be subtle. Entrants MUST specify if the cider was barrel-fermented or aged. Entrants MUST specify carbonation level (still, petillant, or sparkling). Entrants MUST specify sweetness (dry, medium, or sweet). ', 'http://www.bjcp.org/2008styles/style28.php#1a', '28'),
(96, 'B', 'Fruit Cider', '1.045', '1.070', '0.995', '1.010', '5', '9', 'N/A', 'N/A', 'N/A', 'N/A', 'Cider', 'Like a dry wine with complex flavors. The apple character must marry with the added fruit so that neither dominates the other.<p>Commercial Examples: [US] West County Blueberry-Apple Wine (MA), AEppelTreow Red Poll Cran-Apple Draft Cider (WI), Bellwether Cherry Street (NY), Uncle John&rsquo;s Fruit Farm Winery Apple Cherry Hard Cider (MI).</p>', 'http://www.bjcp.org/2008styles/style28.php#1b', '28'),
(97, 'C', 'Applewine', '1.070', '1.100', '0.995', '1.010', '9', '12', 'N/A', 'N/A', 'N/A', 'N/A', 'Cider', 'Like a dry white wine, balanced, and with low astringency and bitterness.<p>Commercial Examples: [US] AEppelTreow Summer&rsquo;s End (WI), Wandering Aengus Pommeau (OR), Uncle John&rsquo;s Fruit House Winery Fruit House Apple (MI), Irvine''s Vintage Ciders (WA).</p>', 'http://www.bjcp.org/2008styles/style28.php#1c', '28'),
(98, 'D', 'Other Specialty Cider or Perry', '1.045', '1.100', '0.995', '1.020', '5', '12', 'N/A', 'N/A', 'N/A', 'N/A', 'Cider', 'Entrants MUST specify all major ingredients and adjuncts. Entrants MUST specify carbonation level (still, petillant, or sparkling). Entrants MUST specify sweetness (dry or medium).<p>Commercial Examples: [US] Red Barn Cider Fire Barrel (WA), AEppelTreow Pear Wine and Sparrow Spiced Cider (WI).</p>', 'http://www.bjcp.org/2008styles/style28.php#1d', '28');

-- --------------------------------------------------------

--
-- Table structure for table `sugar_type`
--

CREATE TABLE IF NOT EXISTS `sugar_type` (
  `id` int(5) NOT NULL auto_increment,
  `sugarName` varchar(255) default NULL,
  `sugarPPG` varchar(255) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM;

--
-- Dumping data for table `sugar_type`
--

INSERT INTO `sugar_type` (`id`, `sugarName`, `sugarPPG`) VALUES
(1, 'Malted Rye', '29'),
(2, 'Flaked Oats', '32'),
(3, 'Flaked Corn', '39'),
(4, 'Flaked Barley', '32'),
(5, 'Flaked Wheat', '36'),
(6, 'Flaked Rice', '38'),
(7, 'Malto-Dextrin Powder', '40'),
(8, 'Honey - Light', '46'),
(9, 'Honey - Dark', '46'),
(10, 'Sugar - Corn', '46'),
(11, 'Sugar - Cane', '46'),
(12, 'Sugar - Brown', '46'),
(13, 'Syrup - Corn', '46'),
(14, 'Syrup - Cane', '46'),
(15, 'Syrup - Molasses', '46'),
(16, 'Syrup - Maple', '46'),
(17, 'Malt Extract - Dry - Extra Light', '44'),
(18, 'Malt Extract - Dry - Light', '44'),
(19, 'Malt Extract - Dry - Amber', '44'),
(20, 'Malt Extract - Dry - Dark', '44'),
(21, 'Malt Extract - Liquid - Extra Light', '37'),
(22, 'Malt Extract - Liquid - Light', '37'),
(23, 'Malt Extract - Liquid - Amber', '37'),
(24, 'Malt Extract - Liquid - Dark', '37'),
(25, 'Malted Barley - 2 Row Lager', '37'),
(26, 'Malted Barley - 2 Row Pale Ale', '38'),
(27, 'Malted Barley - 6 Row', '35'),
(28, 'Malted Barley - Biscuit', '35'),
(29, 'Malted Barley - Vienna', '35'),
(30, 'Malted Barley - Munich', '35'),
(31, 'Malted Barley - Brown', '32'),
(32, 'Malted Barley - Dextrin', '32'),
(33, 'Malted Barley - Light Crystal (10-25 L)', '35'),
(34, 'Malted Barley - Pale Crystal (25-40 L)', '34'),
(35, 'Malted Barley - Medium Crystal (60-75 L)', '34'),
(36, 'Malted Barley - Dark Crystal (80-150 L)', '33'),
(37, 'Malted Barley - Special B', '31'),
(38, 'Malted Barley - Chocolate', '28'),
(39, 'Malted Barley - Pale Chocolate', '31'),
(40, 'Malted Barley - Roast Barley', '25'),
(41, 'Malted Barley - Black', '25'),
(42, 'Malted Wheat', '37'),
(43, 'Malted Barley - Pilsner 2 Row', '36'),
(44, 'Malted Barley - Belgian Pilsner 2 Row', '36'),
(45, 'Malted Barley - German Pilsner 2 Row', '37'),
(46, 'Malted Wheat - Belgian', '37'),
(47, 'Malted Wheat - German', '39'),
(48, 'Malted Wheat - White', '39'),
(49, 'Malted Barley - Peated', '34'),
(50, 'Malted Barley - Mild', '37'),
(51, 'Malted Barley - Toasted', '29'),
(52, 'Malted Barley - Smoked', '37'),
(53, 'Malted Barley - Melanoidin', '37'),
(54, 'Malted Barley - Amber', '35'),
(55, 'Malted Barley - CaraVienna', '34'),
(56, 'Malted Barley - CaraRed', '35'),
(57, 'Malted Barley - Honey', '37'),
(58, 'Malted Barley - Victory', '34'),
(59, 'Malted Wheat - Caramel', '35'),
(60, 'Malted Barley - CaraMunich', '33'),
(61, 'Malted Barley - CaraAroma', '35'),
(62, 'Malted Rye - Chocolate', '31'),
(63, 'Malted Wheat - Chocolate', '33'),
(64, 'Malted Barley - Wyerman Carafa I', '32'),
(65, 'Malted Barley - Wyerman Carafa II', '32'),
(66, 'Malted Barley - Wyerman Carafa III', '32'),
(67, 'Malted Oats', '37'),
(68, 'Corn Grits', '37'),
(69, 'Unmalted Barley', '28'),
(70, 'Sugar - Candi (Light)', '36'),
(71, 'Torrified Wheat', '36'),
(72, 'Sugar - Candi (Amber)', '36'),
(73, 'Sugar - Candi (Dark)', '36'),
(74, 'Sugar - Dememera', '46'),
(75, 'Sugar - Invert', '46'),
(76, 'Sugar - Turbinado', '46'),
(77, 'Syrup - Golden', '46'),
(78, 'Malted Barley - Aromatic', '34'),
(79, 'Malted Barley - Acidulated (Sauer) Malt', '38'),
(80, 'Flaked Rye', '32'),
(81, 'Rice Hulls', '38');

-- --------------------------------------------------------

--
-- Table structure for table `upcoming`
--

CREATE TABLE IF NOT EXISTS `upcoming` (
  `id` int(8) NOT NULL auto_increment,
  `upcoming` varchar(250) default NULL,
  `upcomingDate` date default '0000-00-00',
  `upcomingRecipeID` varchar(10) default NULL,
  `brewBrewerID` varchar(250) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM;

--
-- Dumping data for table `upcoming`
--

INSERT INTO `upcoming` (`id`, `upcoming`, `upcomingDate`, `upcomingRecipeID`, `brewBrewerID`) VALUES
(1, '60 Minute Ticker', '2009-10-14', '8', 'admin'),
(2, 'Orange Krush', '2009-09-14', '3', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(8) NOT NULL auto_increment,
  `user_name` varchar(20) NOT NULL default '',
  `password` varchar(250) NOT NULL default '',
  `realFirstName` varchar(250) default NULL,
  `realLastName` varchar(250) default NULL,
  `userLevel` char(1) default NULL,
  `userProfile` text,
  `userPicURL` varchar(250) default NULL,
  `userFavStyles` text,
  `userFavCommercial` varchar(250) default NULL,
  `userFavQuote` text,
  `userDesignations` text,
  `userOccupation` varchar(250) default NULL,
  `userHobbies` text,
  `userBirthdate` varchar(250) default NULL,
  `userHometown` varchar(250) default NULL,
  `userBrewingSince` year(4) default NULL,
  `userWebsiteName` varchar(250) default NULL,
  `userWebsiteURL` varchar(250) default NULL,
  `userInfoPrivate` char(1) default NULL,
  `userPosition` varchar(250) default NULL,
  `userPastPosition` varchar(250) default NULL,
  `userAddress` varchar(250) default NULL,
  `userCity` varchar(250) default NULL,
  `userState` varchar(250) default NULL,
  `userZip` varchar(15) default NULL,
  `userPhoneH` varchar(15) default NULL,
  `userPhoneW` varchar(15) default NULL,
  `userEmail` varchar(250) default NULL,
  `defaultBoilTime` int(4) default NULL,
  `defaultEquipProfile` int(8) default NULL,
  `defaultMashProfile` int(8) default NULL,
  `defaultWaterProfile` int(8) default NULL,
  `defaultBitternessFormula` varchar(255) default NULL,
  `defaultMethod` varchar(255) default NULL,
  `defaultBatchSize` int(8) default NULL,
  `defaultWaterRatio` varchar(8) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `user_name`, `password`, `realFirstName`, `realLastName`, `userLevel`, `userProfile`, `userPicURL`, `userFavStyles`, `userFavCommercial`, `userFavQuote`, `userDesignations`, `userOccupation`, `userHobbies`, `userBirthdate`, `userHometown`, `userBrewingSince`, `userWebsiteName`, `userWebsiteURL`, `userInfoPrivate`, `userPosition`, `userPastPosition`, `userAddress`, `userCity`, `userState`, `userZip`, `userPhoneH`, `userPhoneW`, `userEmail`, `defaultBoilTime`, `defaultEquipProfile`, `defaultMashProfile`, `defaultWaterProfile`, `defaultBitternessFormula`, `defaultMethod`, `defaultBatchSize`, `defaultWaterRatio`) VALUES
(1, 'admin', 'ee11cbb19052e40b07aac0ca060c23ee', 'Joe', 'Brewer', '1', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1996, NULL, NULL, NULL, NULL, NULL, '1234 Main', 'Anytown', 'CO', '80111', '555-555-5555', '555-555-1234', 'you@email.com', 90, 8, 2, 5, 'Rager', 'All Grain', 10, NULL),
(2, 'nonpriv', 'ee11cbb19052e40b07aac0ca060c23ee', 'Billy', 'Brewer', '2', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 60, 8, 1, 2, 'Daniels', 'Extract', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `water_profiles`
--

CREATE TABLE IF NOT EXISTS `water_profiles` (
  `id` int(8) NOT NULL auto_increment,
  `waterName` varchar(255) default NULL,
  `waterAmount` varchar(255) default NULL,
  `waterCalcium` varchar(255) default NULL,
  `waterBicarbonate` varchar(255) default NULL,
  `waterSulfate` varchar(255) default NULL,
  `waterChloride` varchar(255) default NULL,
  `waterSodium` varchar(255) default NULL,
  `waterMagnesium` varchar(255) default NULL,
  `waterPH` varchar(255) default NULL,
  `waterNotes` text,
  `waterBrewerID` varchar(255) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM;

--
-- Dumping data for table `water_profiles`
--

INSERT INTO `water_profiles` (`id`, `waterName`, `waterAmount`, `waterCalcium`, `waterBicarbonate`, `waterSulfate`, `waterChloride`, `waterSodium`, `waterMagnesium`, `waterPH`, `waterNotes`, `waterBrewerID`) VALUES
(1, 'Pilsen, Czech Republic', NULL, '7.0', '2.0', '5.0', '5.0', '15.0', '5.0', '8.0', '<p>Very soft water.</p>', 'brewblogger'),
(2, 'Burton Upon Trent, United Kingdom', NULL, '295.0', '300.0', '725.0', '25.0', '55.0', '45.0', '8.0', '<p>Exceptionally hard water that brings out hop flavor.</p>', 'brewblogger'),
(3, 'Munich, Germany', NULL, '75.0', '200.0', '10.0', '2.0', '10.0', '20.0', '8.0', NULL, 'brewblogger'),
(4, 'Vienna, Austria', NULL, '200.0', '120.0', '125.0', '12.0', '8.0', '60.0', '8.0', NULL, 'brewblogger'),
(5, 'Dortmund, Germany', NULL, '250.0', '550.0', '280.0', '100.0', '70.0', '25.0', '8.0', '<p>Hard water accentuates hop flavor and maltiness.</p>', 'brewblogger'),
(6, 'Distilled Water', NULL, '0.0', '0.0', '0.0', '0.0', '0.0', '0.0', '7.0', '<p>Add minerals to create a distinct, custom water profile.</p>', 'brewblogger'),
(7, 'Dublin, Ireland', NULL, '115.0', '200.0', '55.0', '19.0', '12.0', '4.0', '8.0', '<p>Notable for making dry stouts.</p>', 'brewblogger'),
(8, 'Denver, Colorado', NULL, '31.5', '104', '50.8', '23.5', '21.4', '8.5', '7.8', NULL, 'brewblogger'),
(9, 'London, England', NULL, '52', '156', '77', '60', '99', '16', '8.0', '<p>Carbonate plus high levels of sodium and chloride encourage balanced, smooth dark beers such as porter and mild.</p>', 'brewblogger');

-- --------------------------------------------------------

--
-- Table structure for table `yeast_profiles`
--

CREATE TABLE IF NOT EXISTS `yeast_profiles` (
  `id` int(5) NOT NULL auto_increment,
  `yeastName` varchar(255) default NULL,
  `yeastFloc` varchar(255) default NULL,
  `yeastAtten` varchar(255) default NULL,
  `yeastTolerance` varchar(255) default NULL,
  `yeastType` varchar(255) default NULL,
  `yeastForm` varchar(255) default NULL,
  `yeastAmount` varchar(255) default NULL,
  `yeastLab` varchar(255) default NULL,
  `yeastProdID` varchar(255) default NULL,
  `yeastMinTemp` varchar(255) default NULL,
  `yeastMaxTemp` varchar(255) default NULL,
  `yeastNotes` varchar(255) default NULL,
  `yeastBestFor` varchar(255) default NULL,
  `yeastMaxReuse` varchar(255) default NULL,
  `yeastBrewerID` varchar(255) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM;

--
-- Dumping data for table `yeast_profiles`
--

INSERT INTO `yeast_profiles` (`id`, `yeastName`, `yeastFloc`, `yeastAtten`, `yeastTolerance`, `yeastType`, `yeastForm`, `yeastAmount`, `yeastLab`, `yeastProdID`, `yeastMinTemp`, `yeastMaxTemp`, `yeastNotes`, `yeastBestFor`, `yeastMaxReuse`, `yeastBrewerID`) VALUES
(1, 'American Megabrewery', 'Medium', '73', 'Medium', 'Lager', 'Liquid', '10', 'Brewtek', 'CL-0620', '48', '58', '<p>Smooth yeast with a slight fruity flavor.  Lagers into a smooth, clean tasting beer.  Use for light, clean lager styles with unobtrusive yeast character.</p>', 'Light, Clean American style lagers.', '5', 'brewblogger'),
(2, 'American Microbrewery Ale #1', 'Medium', '75', 'Medium', 'Ale', 'Liquid', '10', 'Brewtek', 'CL-0010', '56', '72', '<p>Smooth, clean, strong fermenting ale yeast that works well at cold temperature.  Clean malt flavor is ideal for cream ales.</p>', 'American Ales, Cream Ales', '5', 'brewblogger'),
(3, 'American Microbrewery Ale #2', 'Medium', '75', 'High', 'Ale', 'Liquid', '10', 'Brewtek', 'CL-0020', '56', '72', '<p>Produces distinct diacytl.  Use for low gravity beers where malt character is needed or stronger beers for a robust character.</p>', 'American ales', '5', 'brewblogger'),
(4, 'American Microbrewery Lager', 'Medium', '73', 'Medium', 'Lager', 'Liquid', '10', 'Brewtek', 'CL-0630', '48', '58', '<p>Clean, full flavored, malty finish. For most lager styles.</p>', 'All lager styles', '5', 'brewblogger'),
(5, 'American White Ale', 'Low', '73', 'Medium', 'Wheat', 'Liquid', '10', 'Brewtek', 'CL-0980', '55', '68', '<p>Smooth wheat yeast with a round, clean, malt flavor.  Low flocculation leaves cloudy Hefe-Weizen finish.  Smooth flavor makes a great unfiltered wheat beer.</p>', 'Hefe-Weizen, American Wheat', '5', 'brewblogger'),
(6, 'Belgian Ale #1', 'Medium', '75', 'High', 'Ale', 'Liquid', '10', 'Brewtek', 'CL-0300', '62', '72', '<p>Produces Belgian ale flavor - estery with clove notes.</p>', 'Belgian Ales, High gravity ales.', '5', 'brewblogger'),
(7, 'Belgian Ale #2', 'Low', '75', 'Medium', 'Ale', 'Liquid', '10', 'Brewtek', 'CL-0320', '62', '72', '<p>Attenuates well and produces malty profile.  Slow to flocculate.</p>', 'Flanders style Belgian Ales, Belgian Brown, Fruit beers', '5', 'brewblogger'),
(8, 'Belgian Ale #3', 'Medium', '75', 'High', 'Ale', 'Liquid', '10', 'Brewtek', 'CL-0340', '62', '72', 'Slightly more refined than CL-300.  Produces the classic Trappist ale character with esters of spice and fruit. Mildly phenolic.  Strong fermenting yeast.', 'Belgian ales, Trappist Ales', '5', 'brewblogger'),
(9, 'Belgian Wheat', 'Medium', '73', 'Medium', 'Wheat', 'Liquid', '10', 'Brewtek', 'CL-0900', '55', '68', 'Top fermenting yeast with a soft bread-like character.  Leaves a sweet, mildly estery finish.  Delicious Belgian character to any beer.  Great in Wit style with coriander and bitter orange peel.', 'Belgian Pils, Belgian Wit', '5', 'brewblogger'),
(10, 'Brettanomyces Lambicus', 'Medium', '73', 'Medium', 'Ale', 'Liquid', '10', 'Brewtek', 'CL-5200', '48', '68', 'Wild yeast strain. Contributes horsey, old leather flavor.  Slow growing yeast that takes weeks to ferment and months to develop fully.', 'Belgian Lambic beers', '5', 'brewblogger'),
(11, 'British Draft Ale', 'Medium', '75', 'Medium', 'Ale', 'Liquid', '10', 'Brewtek', 'CL-0160', '62', '72', 'Slight diactyl.  Emphasizes malt character for full bodied beers.', 'Porters and Bitters.', '5', 'brewblogger'),
(12, 'British Microbrewery Ale', 'Medium', '75', 'Medium', 'Ale', 'Liquid', '10', 'Brewtek', 'CL-0110', '62', '72', 'Oakey/fruity ester profile. Leaves some residual malt flavor.', 'English Bitters and Milds', '5', 'brewblogger'),
(13, 'British Pale Ale #1', 'Medium', '75', 'Medium', 'Ale', 'Liquid', '10', 'Brewtek', 'CL-0120', '62', '72', 'Citrusy aspects accentuate mineral and hops.', 'British Pale Ales and Bitters.', '5', 'brewblogger'),
(14, 'British Pale Ale #2', 'Medium', '75', 'High', 'Ale', 'Liquid', '10', 'Brewtek', 'CL-0130', '62', '72', 'Full bodied ale yeast with mild esters. Accentuates caramel and malt flavors.', 'British Pale Ale, other British Ales', '5', 'brewblogger'),
(15, 'British Real Ale', 'Medium', '70', 'Medium', 'Ale', 'Liquid', '10', 'Brewtek', 'CL-0150', '62', '72', 'Woody flavor and musty ester profile of real ale.  Leaves mild residual sweetness in the finish.', 'Bitters and other English Ales', '5', 'brewblogger'),
(16, 'California Esteem', 'Medium', '73', 'Meidum', 'Lager', 'Liquid', '10', 'Brewtek', 'CL-0690', '48', '65', 'Use for California Common Beers.  Slight esters. Well attenuated.', 'California Common Beer, American or Robust porters', '5', 'brewblogger'),
(17, 'Canadian Ale', 'Medium', '75', 'Medium', 'Ale', 'Liquid', '10', 'Brewtek', 'CL-0260', '62', '72', 'Clean, well attenuated yeast. Fruity and complex finish.', 'Light Canadian Ales, Bitish Bitter, Pale Ale, Porters', '5', 'brewblogger'),
(18, 'Classic British Ale', 'Medium', '75', 'Medium', 'Ale', 'Liquid', '10', 'Brewtek', 'CL-0170', '62', '72', 'Complex ale with British tones and fruit like esters.  Works well in high gravity ales such as scottish heavy as well.', 'Bitters, Porters, Scottish Heavy Ales.', '5', 'brewblogger'),
(19, 'East European Lager', 'Medium', '73', 'Medium', 'Lager', 'Liquid', '10', 'Brewtek', 'CL-0680', '48', '58', 'Smooth, rich, creamy character.  Emphasizes big malt flavor and clean finish.  Full but smooth malt character.', 'Marzens, Oktoberfest', '5', 'brewblogger'),
(20, 'German Weiss', 'Medium', '73', 'Medium', 'Wheat', 'Liquid', '10', 'Brewtek', 'CL-0930', '55', '68', 'Milder than German Wheat #1, this strain still produces the desired clove and phenol character, but to a lesser degree.  Full, earthy character.', 'Weiss, Weizen, other Southern German Wheat styles', '5', 'brewblogger'),
(21, 'German Wheat', 'Medium', '75', 'Medium', 'Wheat', 'Liquid', '10', 'Brewtek', 'CL-0920', '55', '68', 'Top fermenting Weizenbier yeast.  Intensely spicy, clovey and phenolic.  High attenuation.', 'Weizen, Weizenbocks', '5', 'brewblogger'),
(22, 'Irish Dry Stout', 'Medium', '75', 'Medium', 'Ale', 'Liquid', '10', 'Brewtek', 'CL-0240', '62', '72', 'Top fermenting yeast which leaves a recognizable slightly woody character to Dry Stouts.  Vinous almost lactic character that blends well with roast malts.  High attenuation.', 'Dry Stouts', '5', 'brewblogger'),
(23, 'Kolsch', 'Medium', '75', 'Medium', 'Ale', 'Liquid', '10', 'Brewtek', 'CL-0400', '62', '72', 'Produces mild sulfer flavor which smooths with time to a clean attenuated flavor.  Mineral and malt characters come through well.  Clean, lightly yeasty flavor and aroma in the finish.', 'German Kolsch', '5', 'brewblogger'),
(24, 'Northern German Lager', 'Medium', '73', 'Medium', 'Lager', 'Liquid', '10', 'Brewtek', 'CL-0660', '48', '58', 'Clean, crisp, traditional lager character.  Strong fermenting and forgiving yeast.  Excellent general purpose lager yeast.', 'German pilsners, Mexican and Canadian Lagers', '5', 'brewblogger'),
(25, 'Noth-Eastern Micro Ale', 'Medium', '75', 'Medium', 'Ale', 'Liquid', '10', 'Brewtek', 'CL-0060', '56', '72', 'Malty, bready, yet clean malt character.  Leaves hops flavor and aroma intact.  Versitile yeast for many American styles.', 'American Ales, Reds, Ambers', '5', 'brewblogger'),
(26, 'Old Bavarian Lager', 'Medium', '73', 'Medium', 'Lager', 'Liquid', '10', 'Brewtek', 'CL-0650', '48', '58', 'Well rounded, malty with a subtle ester complex and citrus flavors.  Distinct, flavorful yeast is great for Southern German lager styles.', 'German lagers, Bock, Dunkel, Helles', '5', 'brewblogger'),
(27, 'Old German Ale', 'Medium', '75', 'Medium', 'Ale', 'Liquid', '10', 'Brewtek', 'CL-0400', '62', '72', 'Traditional Alt Bier flavor.  Strong fermenter with a smooth, attenuated, mild flavor.  Slightly dry, clean, quenching finish.', 'Altbier, German ales, some Wheat beers.', '5', 'brewblogger'),
(28, 'Original Pilsner', 'Medium', '73', 'Medium', 'Lager', 'Liquid', '10', 'Brewtek', 'CL-0600', '48', '58', 'Full bodied lager yeast with sweet, underattenuated finish.  Subdued diacetyl character.  Big malty palatte.  Classic Pilsner finish and style.', 'Classic Czech Pilsners', '5', 'brewblogger'),
(29, 'Pediococcus Damnosus', 'Medium', '73', 'Medium', 'Ale', 'Liquid', '10', 'Brewtek', 'CL-5600', '48', '68', 'Slow growing bacteria used in secondary to create lactic acid flavor in Belgian lambics.  Produces large amounts of lactic acid and diacytl.  Prefers anaerobic conditions.', 'Belgian Lambic beers', '5', 'brewblogger'),
(30, 'Saison', 'Medium', '75', 'Medium', 'Ale', 'Liquid', '10', 'Brewtek', 'CL-0380', '62', '72', 'Pleasant yeast blend.  Leaves a smooth full character to the malt with mild, but pleasant esters and some apple pie spices.', 'French or Belgian Ales and Grand Cru styles.', '5', 'brewblogger'),
(31, 'Cooper Ale', 'Medium', '75', NULL, 'Ale', 'Dry', '15', 'Coopers', NULL, '62', '72', 'General purpose dry ale yeast with a very good reputation.  Produces significant fruity flavors.  No phenolics.  Clean, fruity finish.', 'Most ales.', '5', 'brewblogger'),
(32, 'Safale English Ale', 'Medium', '73', 'Medium', 'Ale', 'Dry', '11.5', 'Fermentis', 'S-04', '64', '70', 'A well known English ale strain noted for its fast fermentation and rapid settling. Used in the production of a wide range of ales including English ale styles.', 'Great general purpose ale yeast.', '5', 'brewblogger'),
(33, 'Safale German Ale', 'Medium', '73', 'Medium', 'Ale', 'Dry', '11.5', 'Fermentis', 'K-97', '65', '70', 'Low sedimentation yeast, sometimes used in open fermentation. Good for wheat beers, weizens and light ales.', 'High attenuation ales, wheat beers and weizens.', '5', 'brewblogger'),
(34, 'Safbrew Ale', 'Medium', '73', 'Medium', 'Ale', 'Dry', '11.5', 'Fermentis', 'S-33', '65', '72', 'General purpose ale yeast, widely used.  Very consistent, clean finish. High attenuation and good flavor profile.', 'Most ales.', '5', 'brewblogger'),
(35, 'Safbrew Specialty Ale', 'Medium', '73', 'High', 'Ale', 'Dry', '11.5', 'Fermentis', 'T-58', '60', '72', 'Estery, somewhat spicy ale yeast. Often used for bottle and cask conditioning.', 'Complex ales. Especiall Belgians.', '5', 'brewblogger'),
(36, 'Saflager German Lager', 'High', '72', 'Medium', 'Lager', 'Dry', '11.5', 'Fermentis', 'S-189', '48', '56', 'Popular lager yeast strain.  Produces wide range of continental lagers and pilsners.  Clean finish.', 'Wide range of lagers and pilsners.', '5', 'brewblogger'),
(37, 'Saflager West European Lager', 'High', '73', 'Medium', 'Lager', 'Dry', '11.5', 'Fermentis', 'S-23', '46', '50', 'German lager yeast strain.  Performs well at low temperature. High flocculation and attenuation for a clean German finish.', 'German style lagers and pilsners.', '5', 'brewblogger'),
(38, 'London', 'Medium', '72', NULL, 'Ale', 'Dry', NULL, 'Danstar', NULL, '64', '70', 'Produces a clean, well balanced ale.  Medium attenuation preserves some beer complexity.', 'Well balanced British style ales.', '5', 'brewblogger'),
(39, 'Manchester', 'Medium', '72', NULL, 'Ale', 'Dry', NULL, 'Danstar', NULL, '64', '70', 'Old English style ale yeast that produces a complex, woody, full bodied ale at warm temperature.  Medium attenuation.  Good dry yeast for many English styles.', 'Complex, full bodied Porters, Stouts, Ales.', '5', 'brewblogger'),
(40, 'Nottingham', 'High', '75', NULL, 'Ale', 'Dry', NULL, 'Danstar', NULL, '57', '70', 'Dry strain is highly flocculant and has high attenuation.  Produces relatively few fruity esters for a dry yeast. Can be fermented at low temperature to produce lager-style beers.', 'Good neutral ale yeast.', '5', 'brewblogger'),
(41, 'Doric Ale', 'Medium', '75', NULL, 'Ale', 'Dry', NULL, 'Doric', NULL, '62', '72', 'Good reputation.  Reliable clean finish for a dry yeast.', 'Ales', '5', 'brewblogger'),
(42, 'Edme Ale Yeast', 'Medium', '75', NULL, 'Ale', 'Dry', NULL, 'Edme', NULL, '62', '72', 'Quick starting dry yeast with a good reputation. Produces some fruity ester. Highly attentive, so it will likely produce a slightly dry taste.', 'Ales requiring high attenuation.', '5', 'brewblogger'),
(43, 'Special Ale', 'Medium', '75', NULL, 'Ale', 'Dry', NULL, 'Glenbrew', NULL, '62', '72', 'Highly attentive, clean finish dry yeast.', 'All-malt beers.', '5', 'brewblogger'),
(44, 'Nottingham Yeast', 'Very High', '75', NULL, 'Ale', 'Dry', NULL, 'Lallemand', NULL, '62', '72', 'High flocculation - settles quickly.  Very good reputation as a fast starter and quick fermenter.  Clean and only slightly fruity.  Some nutty flavor in bottled version.  Relatively high attenuation.', 'Ales', '5', 'brewblogger'),
(45, 'Windsor Yeast', 'Very High', '75', NULL, 'Ale', 'Dry', NULL, 'Lallemand', NULL, '62', '72', 'Clean, well balanced finish.  Yeast produces an estery ale with a slightly fresh yeast flavor.  Not as quick as the Nottingham.  Some bannana aroma.', 'Ales', '5', 'brewblogger'),
(46, 'Lalvin', 'Medium', '75', NULL, 'Wine', 'Dry', NULL, 'Lallemand - Lalvin', 'K1V-1116', '59', '86', 'Used for white grape varieties.  Rapid starter with constant and complete fermentation. Capable of surviving difficult conditions such as low nutrient or high SO2 levels.  Has low volatile action.', 'Souvingnon Blanc, Chenin Blanc and Seyval.  ', NULL, 'brewblogger'),
(47, 'Lalvin', 'High', '75', NULL, 'Wine', 'Dry', NULL, 'Lallemand - Lalvin', '71B-1122', '59', '86', 'Rapid starter with constant and complete fermentation. Ability to metabolize high amounts (20-40%) of malic acid. Partial metabolism of malic acid helps soften the wine.  May produce significant esters, making it a good choice for concentrates. ', 'Young wines such as nouveau, blush and sugar white.', NULL, 'brewblogger'),
(48, 'Lalvin', 'High', '75', NULL, 'Wine', 'Dry', NULL, 'Lallemand - Lalvin', 'D-47', '50', '86', 'Recommended for white variety wines such as Chardonnay and Rose as well as Mead.  Low foaming, quick fermenting, forming a compact lees at the end of fermentation.  Use yeast nutrients if making mead.  Saccharomyces Cerevisiae.', 'White wines such as Chardonnay and Rose.  Also good for mead.', NULL, 'brewblogger'),
(49, 'Lalvin', 'High', '75', NULL, 'Wine', 'Dry', NULL, 'Lallemand - Lalvin', 'EC-1118', '45', '95', 'Low production of foam, volatile acid and H2S.  Ferments over a wide temperature range. High alcohol tolerance, compact lees and good flocculation.  Relatively neutral flavor and aroma.', 'All types of wine and also cider.', NULL, 'brewblogger'),
(50, 'Lalvin Bourgovin', 'Medium', '75', NULL, 'Wine', 'Dry', NULL, 'Lallemand - Lalvin', 'RC 212', '59', '86', 'RC212 recommended for red variety wines and high gravity beers.  Alcohol tolerance in the 12-14% range.  Low foaming and moderate speed fermenting.  Saccharomyces Cerevisiae.', 'Red wines.', NULL, 'brewblogger'),
(51, 'Munton Fison Ale', 'Medium', '75', NULL, 'Ale', 'Dry', NULL, 'Munton-Fison', NULL, '62', '72', 'Quick starting dry yeast.  Produces some fuity esters.  High attenuation produces clean finish.', 'High attenuation yeast good for most ales.', '5', 'brewblogger'),
(52, 'Pasteur Champagne', 'Medium', '75', NULL, 'Champagne', 'Dry', NULL, 'Red Star', NULL, '65', '73', 'High attenuation dry yeast. Good reputation.  Good for Meads and other high gravity ales.', 'Meads, Barleywines, Imperial Stouts and high gravity ales.', '5', 'brewblogger'),
(53, 'Red Star Ale', 'Medium', '77', NULL, 'Ale', 'Dry', NULL, 'Red Star', NULL, '62', '72', 'Good general purpose dry yeast. Change to a different strain in recent years has improved overall quality.', 'High attenuation ales with a dry clean taste.', '5', 'brewblogger'),
(54, 'Abbey Ale', 'Medium', '75', NULL, 'Ale', 'Liquid', NULL, 'White Labs', 'WLP530', '66', '72', 'Used in two of six remaining Trappist breweries.  Distinctive plum and fruitiness.  Good for high gravity beers.', 'Belgian Trappist Ale, Spiced Ale, Trippel, Dubbel, Grand Cru', '5', 'brewblogger'),
(55, 'American Hefeweizen Ale', 'Low', '72', NULL, 'Wheat', 'Liquid', NULL, 'White Labs', 'WLP320', '65', '69', 'Produces a much smaller amount of clove and banana flavor than the German Hefeweizen White Labs yeast.  Some sulfur, and creates desired cloudy look.', 'Oregon style American Hefeweizen', '5', 'brewblogger'),
(56, 'American Lager', 'Medium', '77', NULL, 'Lager', 'Liquid', NULL, 'White Labs', 'WLP840', '50', '55', 'Dry and clean with very slight apple fruitiness.  Minimal sulfur and diacetyl.', 'All American Style Lagers -- both light and dark.', '5', 'brewblogger'),
(57, 'Australian Ale Yeast', 'High', '72', NULL, 'Ale', 'Liquid', NULL, 'White Labs', 'WLP009', '65', '70', 'White Labs entry for Australian Ales.  Produces a clean, malty finish with pleasant ester character.  Bready character.  Can ferment clean at high temperatures.', 'Australian Ales, English Ales', '5', 'brewblogger'),
(58, 'Bastogne Belgian Ale', 'Medium', '77', NULL, 'Ale', 'Liquid', NULL, 'White Labs', 'WLP510', '66', '72', 'High gravity Trappist ale yeast.  Creates a dry beer with a slightly acidic finish.  Cleaner finish and slightly less spicy than WLP500 or WLP530.  ', 'High gravity beers, Belgian ales, Dubbels, Trippels.', '5', 'brewblogger'),
(59, 'Bavarian Weizen Yeast', 'Low', '75', NULL, 'Wheat', 'Liquid', NULL, 'White Labs', 'WLP351', '66', '70', 'Former yeast lab W51 strain.  Produces a classic German style wheat beer with moderately high, spicy, phenolic overtones reminiscent of cloves.', 'Bavarian Weizen and wheat beers.', '5', 'brewblogger'),
(60, 'Bedford British Ale', 'High', '76', NULL, 'Ale', 'Liquid', NULL, 'White Labs', 'WLP006', '65', '70', 'High attenuation. Ferments dry with high flocculation. Distinctive ester profile.  Good for most English ale styles.', 'English style ales - bitter, pale, porter and brown ale', '5', 'brewblogger'),
(61, 'Belgian Ale', 'Medium', '75', NULL, 'Ale', 'Liquid', NULL, 'White Labs', 'WLP550', '68', '78', 'Phenolic and spicy flavors.  Complex profile, with less fruitiness than White&apos;s Trappist Ale strain.', 'Belgian Ales, Saisons, Belgian Reds, Belgian Browns, White beers', '5', 'brewblogger'),
(62, 'Belgian Golden Ale', 'Low', '77', NULL, 'Ale', 'Liquid', NULL, 'White Labs', 'WLP570', '68', '75', 'Combination of fruitiness and phenolic characters dominate the profile.  Some sulfur which will dissipate following fermentation.', 'Belgian Ales, Dubbel, Grand Cru, Belgian Holiday Ale', '5', 'brewblogger'),
(63, 'Belgian Saison I Ale', 'Medium', '70', NULL, 'Ale', 'Liquid', NULL, 'White Labs', 'WLP565', '68', '75', 'Saison yeast from Wallonia.  Earthy, spicy and peppery notes.  Slightly sweet.', 'Saison Ale, Belgian Ale, Dubbel, Trippel', '5', 'brewblogger'),
(64, 'Belgian Style Ale Yeast Blend', 'Medium', '77', NULL, 'Ale', 'Liquid', NULL, 'White Labs', 'WLP575', '68', '75', 'Blend of two Trappist ale yeasts and one Belgian ale yeast.  Creates a versatile blend to be used for Trappist and other Belgian style ales.', 'Trappist and other Belgian ales.', '5', 'brewblogger'),
(65, 'Belgian Wit Ale', 'Low', '76', NULL, 'Wheat', 'Liquid', NULL, 'White Labs', 'WLP400', '67', '74', 'Phenolic and tart.  The original yeast used to produce Wit in Belgium.', 'Belgian Wit', '5', 'brewblogger'),
(66, 'Belgian Wit II', 'Medium', '72', NULL, 'Ale', 'Liquid', NULL, 'White Labs', 'WLP410', '67', '74', 'Less phenolic than WLP400 (Belgian Wit Ale) but more spicy.  Leaves a little more sweetness and flocculation is higher than WLP400.', 'Belgian Wit, Spiced Ale, Wheat Ales and Specialty Beers', '5', 'brewblogger'),
(67, 'British Ale', 'High', '70', NULL, 'Ale', 'Liquid', NULL, 'White Labs', 'WLP005', '67', '74', 'This yeast has higher attenuation than the White Labs English Ale yeast strains.  Produces a malty flavored beer.', 'Excellent for all English style ales including bitters, pale ale, porters and brown ale.', '5', 'brewblogger'),
(68, 'Burton Ale', 'Medium', '72', NULL, 'Ale', 'Liquid', NULL, 'White Labs', 'WLP023', '68', '73', 'Burton-on-trent yeast produces a complex character.  Flavors include apple, pear, and clover honey.', 'All English styles including Pale Ale, IPA, Porter, Stout and Bitters.', '5', 'brewblogger'),
(69, 'California Ale', 'High', '76', NULL, 'Ale', 'Liquid', NULL, 'White Labs', 'WLP001', '68', '73', 'Very clean flavor, balance and stability.  Accentuates hop flavor\r\nVersitile - can be used to make any style ale.', 'American Style Ales, Ambers, Pale Ales, Brown Ale, Strong Ale', '5', 'brewblogger'),
(70, 'California Ale V', 'High', '72', NULL, 'Ale', 'Liquid', NULL, 'White Labs', 'WLP051', '66', '70', 'Similar to White Labs California Ale Yeast, but slightly lower attenuation leaves a fuller bodied beer.', 'American style Pales, Ambers, Browns, IPAs, American Strong Ale', '5', 'brewblogger'),
(71, 'Champagne Yeast', 'Low', '75', NULL, 'Champagne', 'Liquid', NULL, 'White Labs', 'WLP715', '70', '75', 'Can tolerate alcohol up to 17%.  For Barley Wine or Meads.', 'Wine, Mead and Cider', '5', 'brewblogger'),
(72, 'Cry Havoc', 'Medium', '68', NULL, 'Lager', 'Liquid', NULL, 'White Labs', 'WLP862', '68', '74', 'Licensed by White Labs from Charlie Papazian, author of "The Complete Joy of Home Brewing".  This yeast was used to brew many of his original recipes.  Diverse strain can ferment at ale and lager temps.', 'All American Style Lagers -- both light and dark.', '5', 'brewblogger'),
(73, 'Czech Budejovice Lager', 'Medium', '77', NULL, 'Lager', 'Liquid', NULL, 'White Labs', 'WLP802', '50', '55', 'Dry and crisp with low diacetyl production.  From Southern Czech Republic.', 'Bohemian Style Pilsner', '5', 'brewblogger'),
(74, 'Dry English Ale', 'High', '75', NULL, 'Ale', 'Liquid', NULL, 'White Labs', 'WLP007', '65', '70', 'Clean, Highly flocculant, and highly attentive yeast.  Similar to White labs English Ale yeast, but more attentive.  Suitable for high gravity ales.', 'Pale Ales, Amber, ESB, Brown Ales, Strong Ales', '5', 'brewblogger'),
(75, 'Dusseldorf Alt Yeast', 'Medium', '68', NULL, 'Ale', 'Liquid', NULL, 'White Labs', 'WLP036', '65', '69', 'Traditional Alt yeast from Dusseldorf, Germany.  Produces clean, slightly sweet alt beers.  Does not accentuate hop flavor like WLP029 does.', 'Alt biers, Dusseldorf Alts, German Ales', '5', 'brewblogger'),
(76, 'East Coast Ale', 'Low', '72', NULL, 'Ale', 'Liquid', NULL, 'White Labs', 'WLP008', '68', '73', 'White labs "Brewer Patriot" strain can be used to reproduce many of the American versions of classic beer styles.  Very clean with low esters. ', 'American Ales, Golden ales, Blonde Ale, Pale Ale and German Alt styles', '5', 'brewblogger'),
(77, 'Edinburgh Ale', 'Medium', '72', NULL, 'Ale', 'Liquid', NULL, 'White Labs', 'WLP028', '65', '70', 'Malty strong ale yeast.  Reproduces complex, malty, flavorful schottish ales.  Hop character comes through well.', 'Strong Scottish style ales,  ESB, Irish Reds', '5', 'brewblogger'),
(78, 'English Ale', 'Very High', '66', NULL, 'Ale', 'Liquid', NULL, 'White Labs', 'WLP002', '65', '68', 'Classic ESB strain best for English style milds, bitters, porters and English style stouts.  Leaves a clear beer with some residual sweetness.', 'English Pale Ale, ESB, India Pale Ale, Brown Ale, Porter, Sweet Stouts and Strong Ales', '5', 'brewblogger'),
(79, 'English Cider Yeast', 'Medium', '80', NULL, 'Wine', 'Liquid', NULL, 'White Labs', 'WLP775', '68', '75', 'Classic Cider yeast.  Ferments dry, but retains apple flavor.  Some sulfer produced during fermentation will fade with age.', 'Cider, Wine and High Gravity Beer', '5', 'brewblogger'),
(80, 'Essex Ale Yeast', 'Medium', '73', NULL, 'Ale', 'Liquid', NULL, 'White Labs', 'WLP022', '66', '70', 'Flavorful British yeast with a drier finish than many ale yeasts.  Bready and fruity in character.  Well suited for top cropping (collecting).  Does not flocculate as much as WLP005 or WLP002.', 'British milds, pale ales, bitters, stouts.', '5', 'brewblogger'),
(81, 'European Ale', 'Medium', '67', NULL, 'Ale', 'Liquid', NULL, 'White Labs', 'WLP011', '65', '70', 'Malty, Northern European ale yeast.  Low ester production, low sulfer, gives a clean profile.  Low attenuation contributes to malty taste.', 'Alt, Kolsch, malty English Ales, Fruit beers', '5', 'brewblogger'),
(82, 'German Ale II', 'Medium', '76', NULL, 'Ale', 'Liquid', NULL, 'White Labs', 'WLP003', '65', '70', 'Strong sulfer component will reduce with aging.  Clean flavor, but with more ester production than regular German Ale Yeast.', 'Kolsch, Alt and German Pale Ales', '5', 'brewblogger'),
(83, 'German Ale/Kolsch', 'Medium', '75', NULL, 'Ale', 'Liquid', NULL, 'White Labs', 'WLP029', '65', '69', 'Great for light beers.  Accentuates hop flavors.  Slight sulfer flavor will fade with age and leave a clean, lager like ale.', 'Kolsch, Altbiers, Pale Ales, Blonde and Honey Ales', '5', 'brewblogger'),
(84, 'German Bock Lager', 'Medium', '73', NULL, 'Lager', 'Liquid', NULL, 'White Labs', 'WLP833', '48', '55', 'Produces beer that has balanced malt and hop character.  From Southern Bavaria.', 'Bocks, Doppelbocks, Oktoberfest, Vienna, Helles, some American Pilsners', '5', 'brewblogger'),
(85, 'German Lager', 'Medium', '76', NULL, 'Lager', 'Liquid', NULL, 'White Labs', 'WLP830', '50', '55', 'Very malty and clean.  One of the world&apos; most popular lager yeasts.', 'German Marzen, Pilsner, Lagers, Oktoberfest beers.', '5', 'brewblogger'),
(86, 'Hefeweizen Ale', 'Low', '74', NULL, 'Wheat', 'Liquid', NULL, 'White Labs', 'WLP300', '68', '72', 'Produces the banana and clove nose traditionally associated with German Wheat beers.  Also produces desired cloudy look.', 'German style wheat beers.  Weiss, Weizen, Hefeweizen', '5', 'brewblogger'),
(87, 'Hefeweizen IV Ale', 'Low', '76', NULL, 'Wheat', 'Liquid', NULL, 'White Labs', 'WLP380', '66', '70', 'Large clove and phenolic aroma, but with minimal banana flavor.  Citrus and apricot notes.  Crisp and drinkable, with some sulfur production.', 'German style Hefeweizen', '5', 'brewblogger'),
(88, 'Irish Ale', 'Medium', '71', NULL, 'Ale', 'Liquid', NULL, 'White Labs', 'WLP004', '65', '68', 'Excellent for Irish Stouts.  Produces slight hint of diacetyl balanced by a light fruitiness and a slightly dry crispness.', 'Irish Ales, Stouts, Porters, Browns, Reds and Pale Ale', '5', 'brewblogger'),
(89, 'Klassic Ale Yeast', 'Medium', '70', NULL, 'Ale', 'Liquid', NULL, 'White Labs', 'WLP033', '66', '70', 'Traditional English Ale style yeast.  Produces ester character, and allows hop flavor through.  Leaves a slightly sweet malt character in ales.', 'Bitters, milds, porters stouts and scottish ale styles.', '5', 'brewblogger'),
(90, 'London Ale', 'Medium', '71', NULL, 'Ale', 'Liquid', NULL, 'White Labs', 'WLP013', '66', '71', 'Dry, malty ale yeast.  Produces a complex, oak flavored ester character.  Hop bitterness comes through well.', 'Classic British Pale Ales, Bitters and Stouts', '5', 'brewblogger'),
(91, 'Mexican Lager', 'Medium', '74', NULL, 'Lager', 'Liquid', NULL, 'White Labs', 'WLP940', '50', '55', 'From Mexico City - produces a clean lager beer with a crisp finish.  Good for mexican style beers.', 'Mexican style light and dark lagers.', '5', 'brewblogger'),
(92, 'Nottingham Ale Yeast', 'Medium', '77', NULL, 'Ale', 'Liquid', NULL, 'White Labs', 'WLP039', '66', '70', 'British style of ale yeast with a very dry finish and high attenuation.  Medium to low fruit and fusel alcohol production.  Good top fermenting yeast for cropping. ', 'British ales, pale ales, ambers, porters and stouts.', '5', 'brewblogger'),
(93, 'Octoberfest/Marzen Lager', 'Medium', '69', NULL, 'Lager', 'Liquid', NULL, 'White Labs', 'WLP820', '52', '58', 'Produces a malty, bock style beer.  Does not finish as dry or as fast as White&apos; German Lager yeast.  Longer lagering or starter recommended.', 'Marzen, Oktoberfest, European Lagers, Bocks, Munich Helles', '5', 'brewblogger'),
(94, 'Old Bavarian Lager', 'Medium', '69', NULL, 'Lager', 'Liquid', NULL, 'White Labs', 'WLP920', '50', '55', 'Southern Germany/Bavarian lager yeast.  Finishes malty with a slight ester profile.', 'Oktoberfest, Marzen, Bock and Dark Lagers.', '5', 'brewblogger'),
(95, 'Pacific Ale', 'High', '67', NULL, 'Ale', 'Liquid', NULL, 'White Labs', 'WLP041', '65', '68', 'Popular yeast from the Pacific Northwest.  Leaves a clear and malty profile.  More fruity than WLP002.  Suitable for many English and American styles.', 'English & American ales including milds, bitters, IPA, porters and English stouts.', '5', 'brewblogger'),
(96, 'Pilsner Lager', 'High', '74', NULL, 'Lager', 'Liquid', NULL, 'White Labs', 'WLP800', '50', '55', 'Classic pilsner strain from Czech Republic.  Dry with a malty finish.', 'European Pilsners, Bohemian Pilsner', '5', 'brewblogger'),
(97, 'Premium Bitter Ale', 'Medium', '72', NULL, 'Ale', 'Liquid', NULL, 'White Labs', 'WLP026', '67', '70', 'From Staffordshire England.  Mild, but complex estery flavor.  High attenuation - ferments strong and dry.  Suitable for high gravity beers.', 'All English ales including bitters, milds, ESB, Porter, Stout and Barley Wine', '5', 'brewblogger'),
(98, 'San Francisco Lager', 'High', '67', NULL, 'Lager', 'Liquid', NULL, 'White Labs', 'WLP810', '58', '65', 'Produces "California Common" style beer.', 'California and Premium Lagers, all American Lagers', '5', 'brewblogger'),
(99, 'Southern German Lager', 'High', '72', NULL, 'Lager', 'Liquid', NULL, 'White Labs', 'WLP838', '50', '55', 'Malty finish and balanced aroma.  Strong fermenter, slight sulfur and low diacetyl.', 'German Pilsner, Helles, Oktoberfest, Marzen, Bocks', '5', 'brewblogger'),
(100, 'Southwold Ale', 'Medium', '71', NULL, 'Ale', 'Liquid', NULL, 'White Labs', 'WLP025', '66', '69', 'From Suffolk county.  Products complex fruity and citrus flavors.  Slight sulfer production, but this will fade with ageing.', 'British bitters and pale ales.', '5', 'brewblogger'),
(101, 'Steinberg-Geisenheim Wine', 'Low', '80', NULL, 'Wine', 'Liquid', NULL, 'White Labs', 'WLP727', '50', '90', 'German origin wine yeast.  High fruit/ester production.  Moderate fermentation characteristics and cold tolerant.', 'Riesling wines.', '5', 'brewblogger'),
(102, 'Super High Gravity Ale', 'Low', '80', NULL, 'Ale', 'Liquid', NULL, 'White Labs', 'WLP099', '69', '74', 'Ferments up to 25% alcohol content.  Flavor may vary greatly depending on beer alcohol.  English like esters at low gravity, but will become more wine-like as alcohol exceeds 16% ABV.  Refer to White Labs web page for tips on fermenting high gravity ales.', 'Very high gravity beers and barley wine up to 25% alcohol.', '5', 'brewblogger'),
(103, 'Sweet Mead/Wine', 'Low', '75', NULL, 'Wine', 'Liquid', NULL, 'White Labs', 'WLP720', '70', '75', 'Lower attenuation than White Labs Champagne Yeast.  Leaves some residual sweetness as well as fruity flavor.  Alcohol concentration up to 15%.', 'Sweet Mead, Wine and Cider', '5', 'brewblogger'),
(104, 'Sweet Mead/Wine', 'Low', '75', NULL, 'Wine', 'Liquid', NULL, 'White Labs', 'WLP727', '70', '75', 'Lower attenuation than White Labs Champagne Yeast.  Leaves some residual sweetness as well as fruity flavor.  Alcohol concentration up to 15%.', 'Sweet Mead, Wine and Cider', '5', 'brewblogger'),
(105, 'Trappist Ale', 'Medium', '75', NULL, 'Ale', 'Liquid', NULL, 'White Labs', 'WLP500', '65', '72', 'Distinctive fruitiness and plum characteristics.  Excellent for high gravity beers.', 'Trappist Ale, Dubbel, Trippel, Belgian Ales', '5', 'brewblogger'),
(106, 'Zurich Lager', 'Medium', '75', NULL, 'Lager', 'Liquid', NULL, 'White Labs', 'WLP885', '50', '55', 'Swiss style lager yeast.  Sulfer and diacytl production is minimal.  May be used for high gravity lagers with proper care.', 'Swiss style lager, and high gravity lagers (over 11% ABV)', '5', 'brewblogger'),
(107, 'American Ale', 'Medium', '75', NULL, 'Ale', 'Liquid', NULL, 'Wyeast', '1056', '60', '72', 'Soft, smooth, clean finish.  Very well balanced.  Very versitile -- works well with many ale styles.', 'American Pale Ale, Scottish Ale, Porters, Sweet Stout, Barley Wine, Alt', '5', 'brewblogger'),
(108, 'American Ale II', 'High', '74', NULL, 'Ale', 'Liquid', NULL, 'Wyeast', '1272', '60', '72', 'Clean, tart, nutty flavor.  More fruity than Wyeast American Ale yeast.', 'All American Ales, Brown Ales, Barley Wine', '5', 'brewblogger'),
(109, 'American Lager', 'Medium', '75', NULL, 'Lager', 'Liquid', NULL, 'Wyeast', '2035', '48', '58', 'Bold, with a complex aroma.  Good flavor depth characteristics for a wide variety of lager beers.', 'American Lagers and Pilsners', '5', 'brewblogger'),
(110, 'American Wheat Ale', 'Low', '76', NULL, 'Ale', 'Liquid', NULL, 'Wyeast', '1010', '58', '74', 'Dry, Crisp, tart beer in the American Hefeweizen style.  Low flocculation aids in producing desired chill haze.', 'American Wheat, Berlin Weiss, Hefeweizen', '5', 'brewblogger'),
(111, 'Bavarian Lager', 'Medium', '75', NULL, 'Lager', 'Liquid', NULL, 'Wyeast', '2206', '46', '58', 'Use by many German breweries.  Produces a full-bodied, rich, malty beer.', 'German Bocks, Vienna, Oktoberfest, Hells, Marzens, Dunkel', '5', 'brewblogger'),
(112, 'Bavarian Wheat', 'Low', '73', NULL, 'Wheat', 'Liquid', NULL, 'Wyeast', '3638', '64', '75', 'Hefeweizen yeast with complex flavor and aroma.  Bubble gum, banana flavors with apple/plub ester profile.  Malty flavor.', 'Bavarian Weizen, Hefeweizen', '5', 'brewblogger'),
(113, 'Bavarian Wheat Yeast', 'Medium', '75', NULL, 'Wheat', 'Liquid', NULL, 'Wyeast', '3056', '64', '74', 'Blend of top-fermenting ale and wheat yeasts providing a mild ester and phenolic profile.', 'Bavarian style wheat beers.', '5', 'brewblogger'),
(114, 'Belgian Abbey II', 'Medium', '75', NULL, 'Ale', 'Liquid', NULL, 'Wyeast', '1762', '65', '75', 'Dry flavor with slight fruitiness. High alcohol tolerance.', 'Belgian Ales, Trappist Ales, Abbey Ales, Grand Cru', '5', 'brewblogger'),
(115, 'Belgian Ale', 'Medium', '74', NULL, 'Ale', 'Liquid', NULL, 'Wyeast', '1214', '58', '68', 'Trappist style ale yeast.  Complex estery flavor.', 'Belgian Ales, Abbey Ales, Trappist Ales', '5', 'brewblogger'),
(116, 'Belgian Ardennes', 'High', '74', NULL, 'Wheat', 'Liquid', NULL, 'Wyeast', '3522', '65', '85', 'Phenolics develop at increased temperature.  Mild fruitiness and complex spicy flavor.', 'Belgian Ale', '5', 'brewblogger'),
(117, 'Belgian Lambic Blend', 'Low', '70', NULL, 'Ale', 'Liquid', NULL, 'Wyeast', '3278', '63', '75', 'Lambic culture of Saccharomyces Cerevisiar and a mixture of yeasts and bacterias.  Blend of organisms helps create lactic flavor of Belgian Lambics.', 'Belgian Lambic', '5', 'brewblogger'),
(118, 'Belgian Saison', 'Low', '78', NULL, 'Ale', 'Liquid', NULL, 'Wyeast', '3724', '70', '95', 'Classic farmhouse ale yeast.  Spicy, complex aromatics including bubble gum.  Tart and dry on the palate with mild fruitiness.  Finishes crisp and mildly acidic.  Ferment at warm temperature.  May have vigorous fermentation start.', 'Belgian Saison beer', '5', 'brewblogger'),
(119, 'Belgian Strong Ale', 'Low', '75', NULL, 'Ale', 'Liquid', NULL, 'Wyeast', '1388', '65', '75', 'Dry, tart, fruity flavor.  High alcohol tolerance.', 'Belgian Ales, Scottish Strong Ale,Trappist Ales, Dubbels, Trippels', '5', 'brewblogger'),
(120, 'Belgian Wheat Yeast', 'Medium', '75', NULL, 'Wheat', 'Liquid', NULL, 'Wyeast', '3942', '64', '74', 'Estery lor phenol yeast.  Plum and apple aroma with a dry finish.', 'Belgian Wheat, Bavarian Weizen', '5', 'brewblogger'),
(121, 'Belgian Witbier', 'Medium', '74', NULL, 'Wheat', 'Liquid', NULL, 'Wyeast', '3944', '62', '75', 'Tart, slightly phenolic character.  For Wits and Grand Cru.  Tolerates high gravity beers well.', 'Belgian Wit, Grand Cru', '5', 'brewblogger'),
(122, 'Bohemian Lager', 'Medium', '71', NULL, 'Lager', 'Liquid', NULL, 'Wyeast', '2124', '48', '58', 'Ferments clean and malty, with rich malty flavor for full gravity pilsners.', 'Bohemian Pilsners, Pilsners, German Helles, Bocks', '5', 'brewblogger'),
(123, 'Brettanomyces Bruxellensis', 'Medium', '67', NULL, 'Ale', 'Liquid', NULL, 'Wyeast', '3112', '60', '75', 'Wild yeast strain isolated from Brussels region of Belgium.  Adds classic sweaty horse hair flavor as well as sourness and cherry-pie like flavor.  Generally used in conjunction with S. Cerevisiae after the primary fermentation has begun.  Requires 3-6 mo', 'Belgian Lambic, Gueze Lambic, and Sour Browns', '5', 'brewblogger'),
(124, 'British Ale', 'Medium', '74', NULL, 'Ale', 'Liquid', NULL, 'Wyeast', '1098', '64', '72', 'Fruity, tart, dry crisp finish.  Very well balanced.', 'All British Ales, Pales, Bitters, English Strong Ale', '5', 'brewblogger'),
(125, 'British Ale II', 'High', '74', NULL, 'Ale', 'Liquid', NULL, 'Wyeast', '1335', '63', '75', 'Malty, clean, crisp finish.  Dry flavor.', 'British and Canadian Ales, English Bitters', '5', 'brewblogger'),
(126, 'British Cask Ale', 'Medium', '75', NULL, 'Ale', 'Liquid', NULL, 'Wyeast', '1026', '63', '72', 'A great choice for any cask conditioned British Ale.  \r\nProduces nice malt profile with a hint of fruit. Finishes dry and slightly tart. ', 'British Ales', '5', 'brewblogger'),
(127, 'Budvar Lager', 'High', '73', NULL, 'Lager', 'Liquid', NULL, 'Wyeast', '2000', '46', '56', 'Classic pilsner lager yeast.  Malty nose and subtle fruit.  Rich malt profile, but dry crisp finish.  Hop character accentuated by dry finish.', 'Bohemian Pilsner, Classic Pilsners, Dortmunder and Light Lagers', '5', 'brewblogger'),
(128, 'California Lager', 'High', '69', NULL, 'Lager', 'Liquid', NULL, 'Wyeast', '2112', '58', '68', 'Suited for 19th century California style beers.  Lagers at high temperature and produces malty, clear beers.', 'California common beers, Steam Beer', '5', 'brewblogger'),
(129, 'Czech Pilsner Lager', 'Medium', '75', NULL, 'Lager', 'Liquid', NULL, 'Wyeast', '2278', '48', '56', 'Classic Pilsner strain.  Creates a dry but malty finish.  Perfect for Pilsners and bocks.  Some sulfur produced, but will fade with time.', 'Bohemian and American Pilsner, Bocks, Oktoberfest, Marzen', '5', 'brewblogger'),
(130, 'Danish Lager', 'Medium', '75', NULL, 'Lager', 'Liquid', NULL, 'Wyeast', '2042', '46', '56', 'Rich, Dortmund style, with a crisp, dry finish.  Soft profile accentuates hop flavor.', 'Dortmund/Export Lagers', '5', 'brewblogger'),
(131, 'European Ale', 'High', '69', NULL, 'Ale', 'Liquid', NULL, 'Wyeast', '1338', '62', '72', 'Very malty flavor characteristic of Bavarian/Munich Ales.  Complex character.', 'European Ales, German Ales, Alts, Pale Ale, Brown Ale, Kolsch', '5', 'brewblogger'),
(132, 'European Lager II', 'Low', '75', NULL, 'Lager', 'Liquid', NULL, 'Wyeast', '2247', '46', '56', 'Clean, dry flavor profile for aggressively hopped pilsners.  Dry finish, mild aroma, slight sulfur production.', 'Bohemian Pilsner, American Pilsner, Helles, Dunkel', '5', 'brewblogger'),
(133, 'Forbidden Fruit', 'Low', '75', NULL, 'Wheat', 'Liquid', NULL, 'Wyeast', '3463', '63', '76', 'Phenolic profile with subdued fruitiness.  Available seasonally.', 'Belgian Wit, Grand Cru', '5', 'brewblogger'),
(134, 'GF All American Ale', 'High', '74', NULL, 'Ale', 'Liquid', NULL, 'Wyeast', '1272', '60', '72', 'Popular all purpose American ale style now in a Gluten Free strain.  Produces beers that are nutty, clean with a slight tart finish.  Ferment warmer to accentuate hops and add fruitiness or ferment cold for clean light citrus character.', 'American Amber, Brown, IPA, Pale ales and stouts.  Blondes and fruit beers.', '5', 'brewblogger'),
(135, 'German Ale', 'Low', '75', NULL, 'Ale', 'Liquid', NULL, 'Wyeast', '1007', '55', '66', 'Crisp, dry finish with a mild flavor.', 'German Ales, Alts, Kolsch, Dry Stout', '5', 'brewblogger'),
(136, 'German Wheat', 'High', '73', NULL, 'Wheat', 'Liquid', NULL, 'Wyeast', '3333', '63', '75', 'Subtle flavor profile.  Sharp, fruity, crisp, sherry like flavor.', 'Bavarian Weizen', '5', 'brewblogger'),
(137, 'Irish Ale', 'Medium', '73', NULL, 'Ale', 'Liquid', NULL, 'Wyeast', '1084', '62', '72', 'Dry diacetyl, fruity flavor characteristic of stouts.  Full bodied, dry, clean flavor.', 'Irish Dry Stouts, Porter, Scottish Ale, Brown Ale, Imperial Stout, Barley Wine', '5', 'brewblogger'),
(138, 'Kolsch Yeast', 'Low', '75', NULL, 'Ale', 'Liquid', NULL, 'Wyeast', '2565', '56', '64', 'Very malty flavor with mix of lager and ale character.  Crisp, clean finish.', 'Kolsch, European Ales', '5', 'brewblogger'),
(139, 'Lactobacillus Delbrueckii', 'Medium', '67', NULL, 'Ale', 'Liquid', NULL, 'Wyeast', '4335', '60', '95', 'Lactic acid bacteria isolated from Belgium.  Produces mild acidity and sourness found in many types of Belgian beers.  Always used in conjunction with S. Cerevisiae and wild yeasts.', 'Belgian gueze, lambic, sour brown ales, and Berliner Weisse.', '5', 'brewblogger'),
(140, 'London Ale', 'Medium', '75', NULL, 'Ale', 'Liquid', NULL, 'Wyeast', '1028', '60', '72', 'Dry finish, bold, rich flavor, some fruit profile and a crisp finish.', 'English Ales, Bitters, IPAs, Brown Ale', '5', 'brewblogger'),
(141, 'London Ale III', 'High', '73', NULL, 'Ale', 'Liquid', NULL, 'Wyeast', '1318', '64', '74', 'Light, fruity flavor.  Balanced flavor with hint of sweetness.', 'British Ales, Bitters', '5', 'brewblogger'),
(142, 'London ESB Ale', 'High', '69', NULL, 'Ale', 'Liquid', NULL, 'Wyeast', '1968', '64', '72', 'Malty, balanced flavor.  Fruity, rich finish.  Excellent for cask conditioned ales and bitters.', 'English Bitters, IPA, Brown Ales, Mild Ales', '5', 'brewblogger'),
(143, 'Munich Lager', 'Medium', '75', NULL, 'Lager', 'Liquid', NULL, 'Wyeast', '2308', '48', '56', 'Unique Pilsner strain.  Very smooth, well-rounded and full bodied.  Benefits from a diacetyl rest.', 'Pilsners, Light Lagers, Dortmond/Export, Marzen/Oktoberfest, Dunkel', '5', 'brewblogger'),
(144, 'North American Lager', 'High', '73', NULL, 'Lager', 'Liquid', NULL, 'Wyeast', '2272', '48', '56', 'American and Canadian lager yeast. Malty finish makes it suitable for Marzens/Oktoberfest as well.', 'American Pilsner, California Common, Canadian Lager, Oktoberfest, Marzen', '5', 'brewblogger'),
(145, 'Northwest Ale', 'High', '69', NULL, 'Ale', 'Liquid', NULL, 'Wyeast', '1332', '65', '75', 'Classic Northwest US ale yeast.  Slight fruit flavor, malty ale with good body and balance.', 'Oregon Ales, All American Ale styles', '5', 'brewblogger'),
(146, 'Pediococcus Cerevisiae', 'Medium', '67', NULL, 'Ale', 'Liquid', NULL, 'Wyeast', '4733', '60', '95', 'Lactic acid bacteria isolated from Belgium.  Creates a high level of lactic acidity over a long time.  Often used with other yeasts, and it may take several months for flavor to fully develop.', 'Gueze and other Belgian styles.', '5', 'brewblogger'),
(147, 'Pilsen Lager', 'Medium', '73', NULL, 'Lager', 'Liquid', NULL, 'Wyeast', '2007', '48', '56', 'Classic American pilsner strain.  Smooth with a malty flavor.  Dry and crisp fermentation.', 'American Pilsner, Bohemian Pilsner, Light Lagers', '5', 'brewblogger'),
(148, 'Ringwood Ale', 'High', '70', NULL, 'Ale', 'Liquid', NULL, 'Wyeast', '1187', '64', '74', 'European ale yeast.  Highly flocculant with complex, clear, but malty profile.  Slightly fruity ester.', 'Ringwood Ale, Brown Ales', '5', 'brewblogger'),
(149, 'Roselare Belgian Blend', 'Medium', '70', NULL, 'Ale', 'Liquid', NULL, 'Wyeast', '3763', '55', '80', 'Culture of Saccharomyces, Brettonomyces and Lactic Acid Bacteria.  Complex aromas and flavors.  May be used for primary fermentation.  Primarily for sour brown and red Belgian styles.', 'Belgian sour brown and red beers.', '5', 'brewblogger'),
(150, 'Scottish Ale', 'High', '71', NULL, 'Ale', 'Liquid', NULL, 'Wyeast', '1728', '55', '75', 'High alcohol tolerance.', 'Scottish Ale, Scottish Strong Ales, Sweet Stout, Imperial Stout, Barley Wine', '5', 'brewblogger'),
(151, 'Thames Valley Ale', 'Medium', '74', NULL, 'Ale', 'Liquid', NULL, 'Wyeast', '1275', '62', '72', 'Clean, complex flavor.  Low in fruit, low in esters, rich in flavor.  Hops come through well.', 'British Bitters, ESB, India Pale Ale, English Strong Ale', '5', 'brewblogger'),
(152, 'Trappist High Gravity', 'Medium', '77', NULL, 'Wheat', 'Liquid', NULL, 'Wyeast', '3787', '64', '78', 'Robust top cropping yeast.  Phenolic character and alcohol tolerance up to 12%.  Rich ester profile and malty flavor.', 'Belgian Wit, Trappist Ale, High gravity ales', '5', 'brewblogger'),
(153, 'Urquell Lager', 'Medium', '74', NULL, 'Lager', 'Liquid', NULL, 'Wyeast', '2001', '48', '58', 'Pilsner Urquell yeast with mild fruit/floral aroma.  Very dry and clean on palate with full mouth feel.  Subtle malt character.  Clean and neutral finish.', 'Bohemian Pilsner', '5', 'brewblogger'),
(154, 'Weihenstephan Weizen', 'Low', '75', NULL, 'Wheat', 'Liquid', NULL, 'Wyeast', '3068', '64', '75', 'Unique Bavarian wheat yeast that produces the spicy weizen clove and banana flavor.  Best when fermented at around 68 deg F.', 'Bavarian Weizen', '5', 'brewblogger'),
(155, 'Whitbread Ale', 'High', '70', NULL, 'Ale', 'Liquid', NULL, 'Wyeast', '1099', '64', '75', 'Slightly more fruity and malty than Wyeast&apos; British Ale.  Clear and highly flocculant.', 'Whitbread Ale, British Ales, Pales, Bitters', '5', 'brewblogger'),
(156, 'Wyeast Ale Blend', 'Medium', '73', NULL, 'Ale', 'Liquid', NULL, 'Wyeast', '1087', '64', '72', 'Blend of ale strains designed to provide quick starts, good flavor, balance and flocculation.  Balanced finish suitable for most American and British ale styles.', 'American and British Ale Styles.', '5', 'brewblogger'),
(157, 'Wyeast Lager Blend', 'Medium', '73', NULL, 'Lager', 'Liquid', NULL, 'Wyeast', '2178', '48', '58', 'Blend of lager strains to produce a complex but clean lager flavor profile.  Suitable for many common lager styles.', 'Classic Pilsners, Lagers, Bocks.', '5', 'brewblogger'),
(158, 'Lager', 'High', NULL, NULL, 'Lager', 'Dry', '12', 'Brewferm', NULL, '50', '59', 'A sturdy lager yeast, delivering a consistent neutral fermentation with little or no Sulphur components or other undesirable by-products.', 'Lagers', '5', 'brewblogger'),
(159, 'Blanche', 'Low', NULL, NULL, 'Ale', 'Dry', '12', 'Brewferm', NULL, '64', '75', 'Top-fermenting brewers yeast, Saccharmyces cerevisiae, selected for its formation of typical wheat beer aromas. Very suitable for production of witbier, wheatbeers, etc.', 'Wheats, witbiers.', '5', 'brewblogger'),
(160, 'Top', 'Medium', NULL, NULL, 'Ale', 'Dry', '12', 'Brewferm', NULL, '64', '77', 'Universal top-fermenting beer yeast. ', NULL, '5', 'brewblogger'),
(161, 'Canadian/Belgian', 'Medium', '75-79', 'High', 'Ale', 'Liquid', '125', 'Wyeast', '3864', '65', '80', '<p>This strain has a classic profile producing mild phenolics which increase with higher fermentation temperatures. It has a low ester profile with a dry, slightly tart finish. This strain is alcohol tolerant while producing complex &amp; well balanced be', 'Belgian Ales, High gravity ales.', '5',  'brewblogger'),
(162, 'Trappist Blend', 'Medium', '75-80', 'High', 'Ale', 'Liquid', '125', 'Wyeast', '3789', '68', '85', '<p>A unique blend of Belgian Saccharomyces and Brettanomyces for emulating Trappist style beer from the Florenville region in Belgium. Phenolics, mild fruitiness and complex spicy notes develop with increased fermentation temperatures. Subdued but classic', 'Belgian Specialty Ale, Belgian Pale Ale, Flanders Red, Oud Bruin', '5', 'brewblogger'),
(163, 'Brettanomyces Claussenii', 'Medium', '80', 'High', 'Ale', 'Liquid', '125', 'Wyeast', '5151', '60', '75', '<p>Isolated from English stock ale, this wild yeast produces a mild Brett character with overtones of tropical fruit and pineapple. It ferments best in worts with a reduced pH after primary fermentation has begun. May form a pellicle in bottles or casks. ', 'Lambics, Geuze, Fruit Lambic, Flanders Red Ale', '5', 'brewblogger'),
(164, 'Imperial Blend', 'Low', '75-80', 'High', 'Ale', 'Liquid', '125', 'Wyeast', '9093', '68', '75', '<p>This unique blend of strains is designed to ferment higher gravity worts used in producing any style of Imperial beer. The results will be a rich, malty, full bodied beer with notes of citrus &amp; fruity esters. Even with a high starting gravity your ', 'American Barleywine, Imperial IPA, Imperial Red, Imperial Brown, Imperial Porter, Russian Imperial Stout', '5', 'brewblogger'),
(165, 'Old Ale Blend', 'Medium', '75-80', 'High', 'Ale', 'Liquid', '125', 'Wyeast', '9097', '68', '75', '<p>To bring you a bit of English brewing heritage we developed the &ldquo;Old Ale&rdquo; blend, including an attenuative ale strain and a Brettanomyces strain, which will ferment well in dark worts and produce beers with nice fruitiness. Complex estery ch', 'English Barleywine, English Strong Ale, Old Ale ', '5', 'brewblogger'),
(166, 'West Yorkshire Ale', 'High', '67-71', 'Medium', 'Ale', 'Liquid', '125', 'Wyeast', '1469', '64', '72', '<p>This strain produces ales with a full chewy malt flavor and character, but finishes dry, producing famously balanced beers. Expect moderate nutty and stone-fruit esters. Best used for the production of cask-conditioned bitters, ESB and mild ales. Relia', 'English Ales', '5', 'brewblogger'),
(167, 'English Special Bitter', 'High', '72-78', 'Medium', 'Ale', 'Liquid', '125', 'Wyeast', '1768', '64', '72', '<p>A great yeast for malt predominate ales. Produces light fruit and ethanol aromas along with soft, nutty flavors. Exhibits a mild malt profile with a neutral finish. Bright beers are easily achieved without any filtration. It is similar to our 1968 Lond', 'English Ales', '5', 'brewblogger'),
(168, 'French Saison', 'Low', '77-83', 'High', 'Ale', 'Liquid', '125', 'Wyeast', '3711', '65', '77', '<p>Produces saison or farmhouse style biers that are highly aromatic with clean, citrus-esters, peppery and spicy with no earthiness and low phenols. This strain enhances the use of spices and aroma hops, and is extremely attenuative but leaves an unexpec', 'Belgian and French Ales', '5', 'brewblogger'),
(169, 'Bier de Garde', 'Low', '74-79', 'High', 'Ale', 'Liquid', '125', 'Wyeast', '3725', '70', '95', '<p>Low to moderate ester production with subtle spiciness. Malty and full on the palate with initial sweetness. Finishes dry and slightly tart. Ferments well with no sluggishness.</p>\r\n<p>&nbsp;</p>', 'Belgian and French Ales', '5', 'brewblogger'),
(170, 'Farmhouse Ale', 'Low', '74-79', 'High', 'Ale', 'Liquid', '125', 'Wyeast', '3726', '70', '95', '<p>This strain produces complex esters balanced with earthy/spicy notes. Slightly tart and dry with a peppery finish. A perfect strain for farmhouse ales and saisons.</p>', 'Belgian and French Ales', '5', 'brewblogger'),
(171, 'Safale', 'Medium', '75-79', 'Medium', 'Ale', 'Dry', '11', 'Fermentis', 'US-05', '59', '75', '<p>A ready-to-pitch dry American ale yeast. Safale US-05 produces well balanced beers with low diacetyl and a very clean, crisp end palate. Sedimentation: low to medium.</p>', 'American ales', '5', 'brewblogger'),
(172, 'Octoberfest Lager', 'Medium', '73-77', 'Medium', 'Lager', 'Liquid', '125', 'Wyeast', '2633', '48', '58', 'blend of lager strains designed to produce a rich, malty, complex and full bodied Octoberfest style beer. Attenuates well while still leaving plenty of malt character and mouthfeel. Low in sulfur production. ', 'Baltic Porter, Classic Rauchbier, Oktoberfest/Marzen, Vienna Lager', '5', 'brewblogger');


ALTER TABLE `brewing` CHANGE `brewBitterness` `brewBitterness` FLOAT NULL;
ALTER TABLE `brewing` CHANGE `brewLovibond` `brewLovibond` FLOAT NULL;
ALTER TABLE `recipes` CHANGE `brewBitterness` `brewBitterness` FLOAT NULL;
ALTER TABLE `recipes` CHANGE `brewLovibond` `brewLovibond` FLOAT NULL;

