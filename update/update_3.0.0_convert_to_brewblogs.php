<?php

/**
 * Update: April 18, 2026.
 *
 * Converts all data in the obsolete brewing DB table into the
 * brewblogs table (record ids are kept, so URLs still work).
 *
 * Runs automatically: update_3.0.0_data_checks.php (included from
 * index.php) creates the brewblogs table if needed and includes this
 * file - from inside a function, with $db_conn and $purifier set - when
 * brewblogs has never held any records. Results are returned in
 * $convert_report. The SQL below is for reference only.
 *
 * The files with the _new appendage draw their data from the 
 * brewblogs table, and any imprted data is added to this table 
 * as well (BeerXML import is currently the only way to add new 
 * brewblogs into the DB).
 * 
 * The brewing table will be fully deprecated.
 * 
 */

/*
CREATE TABLE `brewblogs` (
  `id` int(8) NOT NULL,
  `brewOriginalID` int(8) DEFAULT NULL,
  `brewName` varchar(250) DEFAULT NULL,
  `brewDate` varchar(255) DEFAULT NULL,
  `brewCost` varchar(10) DEFAULT NULL,
  `brewInfo` text DEFAULT NULL,
  `brewMethod` varchar(200) DEFAULT NULL,
  `brewStyle` mediumtext DEFAULT NULL,
  `brewBrewerID` varchar(250) DEFAULT NULL,
  `brewBatchSize` float DEFAULT NULL,
  `brewBatchNum` varchar(100) DEFAULT NULL,
  `brewBoilSize` float DEFAULT NULL,
  `brewBoilTime` tinyint(4) DEFAULT NULL,
  `brewEfficiency` tinyint(4) DEFAULT NULL,
  `brewOG` mediumtext DEFAULT NULL,
  `brewFG` mediumtext DEFAULT NULL,
  `brewABV` mediumtext DEFAULT NULL,
  `brewIBU` float DEFAULT NULL,
  `brewIBUFormula` varchar(250) DEFAULT NULL,
  `brewColor` float DEFAULT NULL,
  `brewColorFormula` varchar(255) DEFAULT NULL,
  `brewCarbonation` float DEFAULT NULL,
  `brewCondition` varchar(100) DEFAULT NULL,
  `brewHops` mediumtext DEFAULT NULL,
  `brewFermentables` mediumtext DEFAULT NULL,
  `brewMiscs` mediumtext DEFAULT NULL,
  `brewYeasts` mediumtext DEFAULT NULL,
  `brewMash` mediumtext DEFAULT NULL,
  `brewMashGravities` mediumtext DEFAULT NULL,
  `brewEquipment` mediumtext DEFAULT NULL,
  `brewWater` mediumtext DEFAULT NULL,
  `brewPrimary` text DEFAULT NULL,
  `brewSecondary` text DEFAULT NULL,
  `brewTertiary` text DEFAULT NULL,
  `brewLager` text DEFAULT NULL,
  `brewAge` text DEFAULT NULL,
  `brewFermGravities` mediumtext DEFAULT NULL,
  `brewComments` text DEFAULT NULL,
  `brewProcedure` text DEFAULT NULL,
  `brewSpecialProcedure` text DEFAULT NULL,
  `brewStatus` varchar(250) DEFAULT NULL,
  `brewTapDate` varchar(250) DEFAULT NULL,
  `brewLabelImage` varchar(250) DEFAULT NULL,
  `brewFeatured` tinyint(1) DEFAULT NULL,
  `brewArchive` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
*/

$convert_report = array("converted" => 0, "errors" => array());

if ((isset($db_conn)) && (isset($purifier))) {

	// Misc Arrays
	$extract_type_keywords = array("DME","Dry","dry","dme");
	$sugar_keywords = array("sugar", "honey", "dextrose", "syrup", "molasses", "juice", "fruit", "blackberry", "raspberry", "marionberry", "blueberry", "cherry", "cranberry", "strawberry", "watermellon", "apple", "grape", "peach", "doughnut", "blackberries", "raspberries", "marionberries", "blueberries", "cherries", "cranberries", "strawberries", "apples", "grapes", "peaches", "doughnuts");
	$adjunct_keywords = array("maltodextrin", "barley", "corn", "oats", "rye", "wheat", "grits", "flaked");
	$water_agent_keywords = array("calcium chloride", "baking soda", "epsom salt", "lactic acid", "salts", "salt", "gypsum", "stabilizer", "chalk", "lime", "soda");

	// Get the brewlogs from the brewing table
	$db_conn->orderBy("id","asc");
	$brewing = $db_conn->get('brewing');

	if ($db_conn->count > 0) {

		foreach ($brewing as $brew) {

			$brewOriginalID = $brew['id'];
				
			$brewStyle = array();

			// Look up style, get all information
			$db_conn->where ("brewStyle", $brew['brewStyle']);
			$db_conn->orderBy("brewStyle","desc");
			$style = $db_conn->getOne ("reference_styles");

			if ($db_conn->count > 0) {
				$brewStyle = array(
					"NAME" => $style['brewStyle'],
					"VERSION" => "1",
					"CATEGORY" => $style['brewStyleCategory'],
					"CATEGORY_NUMBER" => $style['brewStyleGroup'],
					"STYLE_LETTER" => $style['brewStyleNum'],
					"STYLE_GUIDE" => str_replace("2"," 2",$style['brewStyleVersion']),
					"TYPE" => $style['brewStyleType'],
					"OG_MIN" => $style['brewStyleOG'],
					"OG_MAX" => $style['brewStyleOGMax'],
					"FG_MIN" => $style['brewStyleFG'],
					"FG_MAX" => $style['brewStyleFGMax'],
					"IBU_MIN" => $style['brewStyleIBU'],
					"IBU_MAX" => $style['brewStyleIBUMax'],
					"ABV_MIN" => $style['brewStyleABV'],
					"ABV_MAX" => $style['brewStyleABVMax'],
					"COLOR_FORMULA" => "SRM",
					"COLOR_MIN" => $style['brewStyleSRM'],
					"COLOR_MAX" => $style['brewStyleSRMMax'],
					"INFO" => $style['brewStyleInfo']
				);
			}

			else {
				$brewStyle['NAME'] = $brew['brewStyle'];
			}

			if (!empty($brewStyle)) $brewStyle = json_encode($brewStyle);

			// Look up username and instead use id
			$brewBrewerID = sterilize($brew['brewBrewerID']);
			
			$brewName = $purifier->purify(sterilize($brew['brewName']));
			
			$brewDate = strtotime(sterilize($brew['brewDate']));
			
			$brewCost = "";
			if ((isset($brew['brewCost'])) && (!empty($brew['brewCost']))) {
				$brewCost = ltrim($brew['brewCost'],"$");
				if (is_numeric($brewCost)) $brewCost = number_format($brewCost, 2);
			}
			if ((!empty($brewCost)) && (is_numeric($brewCost)) && ($brewCost > 0)) $brewCost = $brewCost;
			
			$brewInfo = $purifier->purify($brew['brewInfo']);
			
			$brewMethod = sterilize($brew['brewMethod']);
			
			$brewBatchSize = "";
			if (is_numeric($brew['brewYield'])) $brewBatchSize = sterilize(number_format($brew['brewYield'],2));
			
			$brewBatchNum = "";
			if (!empty($brew['brewBatchNum'])) $brewBatchNum = sterilize($brew['brewBatchNum']);
			
			$brewBoilSize = "";
			if (is_numeric($brew['brewPreBoilAmt'])) $brewBoilSize = sterilize(number_format($brew['brewPreBoilAmt'],2));
			
			$brewBoilTime = "";
			if (is_numeric($brew['brewBoilTime'])) $brewBoilTime = sterilize(number_format($brew['brewBoilTime'],0));
			
			$brewEfficiency = "";
			if (is_numeric($brew['brewEfficiency'])) $brewEfficiency = sterilize(number_format($brew['brewEfficiency'],2));
			
			$brewOG = "";
			if (is_numeric($brew['brewOG'])) $brewOG = sterilize(number_format($brew['brewOG'],2));
			
			$brewFG = "";
			if (is_numeric($brew['brewFG'])) $brewFG = sterilize(number_format($brew['brewFG'],2));
			
			$brewABV = "";
			if ((!empty($brew['brewOG'])) && (!empty($brew['brewFG']))) $brewABV = sterilize(number_format((($brew['brewOG'] - $brew['brewFG']) * 131.25), 1));
		
			$brewIBU = "";
			if (is_numeric($brew['brewBitterness'])) $brewIBU = sterilize(number_format($brew['brewBitterness'], 1));
			
			$brewIBUFormula = "";
			
			$brewColor = "";
			if (is_numeric($brew['brewLovibond'])) $brewColor = sterilize(number_format($brew['brewLovibond'], 1));
			
			$brewColorFormula = "";
			if (!empty($brew['brewColorFormula'])) $brewColorFormula = sterilize($brew['brewColorFormula']);

			$brewCarbonation = "";
			$brewCondition = sterilize($brew['brewCondition']);

			// Extract, sugars/aduncts, and grains are all fermentables
			$brewFermentables = array();
			$brewHops = array();
			$brewMiscs = array();
			$brewYeasts = array();
			$brewMash = array();
			$brewEquipment = array();
			$brewWater = array();
			$brewPrimary = array();
			$brewSecondary = array();
			$brewTertiary = array();
			$brewLager = array();
			if (!empty($brew['brewLager'])) {
				$brewLager['age'] = sterilize($brew['brewLager']);
				if (!empty($brew['brewLagerTemp'])) $brewLager['temperature'] = sterilize($brew['brewLagerTemp']);
			}

			$brewAge = array();
			if (!empty($brew['brewAge'])) {
				$brewAge['AGE'] = sterilize($brew['brewAge']);
				if (!empty($brew['brewAgeTemp'])) $brewAge['AGE_TEMP'] = sterilize($brew['brewAgeTemp']);
			}

			if (!empty($brewAge)) $brewAge = json_encode($brewAge);
			else $brewAge = "";

			$fermentables_count = 0;
			
			// Extracts
			for ($i = 1; $i <= MAX_EXT; $i++) {

			    $key_extract = "brewExtract".$i;
			    $key_extract_weight = "brewExtract".$i."Weight";

			    if ((isset($brew[$key_extract])) && (!empty($brew[$key_extract]))) {
	    	        
	    	        $extract_weight = "";
	    	        if ((isset($brew[$key_extract_weight])) && (is_numeric($brew[$key_extract_weight])) && ($brew[$key_extract_weight] > 0)) $extract_weight = number_format(filter_var($brew[$key_extract_weight], FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION|FILTER_FLAG_ALLOW_THOUSAND),2);

		    	    $db_conn->where ("extractName", $brew[$key_extract]);
		    	    $extract = $db_conn->getOne("extract");

		    	    $vf = array();
	    	    	$vf['NAME'] = sterilize($brew[$key_extract]);
	    	    	$vf['VERSION'] = "1";
	    	    	$vf['AMOUNT'] = $extract_weight;
	    	    	$vf['YIELD'] = "";
	    	    	$vf['COLOR'] = "";

	    	    	// Get Type
	    	    	$dry = 0;
	    	    	foreach ($extract_type_keywords as $value) {
	    	    		$value = strtolower($value);
	    	    		if (strpos(strtolower($brew[$key_extract]), $value) !== false) {
	    	    		    $dry++;
	    	    		}
	    	    	}
	    	    	
	    	    	if ($db_conn->count == 0) {
		    	    	
		    	    	if ($dry > 0) $vf['TYPE'] = "Dry Extract";
	    	    		else $vf['TYPE'] = "Extract";
	    	    	
	    	    	}

		    	    // If in extracts table, add additional information
		    	    else {

		    	    	if (!empty($extract['extractType'])) $vf['TYPE'] = sterilize($extract['extractType']);
		    	    	else {
		    	    		if ($dry > 0) $vf['TYPE'] = "Dry Extract";
		    	    		else $vf['TYPE'] = "Extract";
		    	    	}
		    	    	if (!empty($extract['extractYield'])) $vf['YIELD'] = number_format(sterilize($extract['extractYield']), 1);
	    	    		if (!empty($extract['extractLovibond'])) $vf['COLOR'] = number_format(sterilize($extract['extractLovibond']), 1);
	    	    		if (!empty($extract['extractOrigin'])) $vf['ORIGIN'] = sterilize($extract['extractOrigin']);
		    	    	if (!empty($extract['extractSupplier'])) $vf['SUPPLIER'] = sterilize($extract['extractSupplier']);
		    	    	if (!empty($extract['extractInfo'])) {
		    	    		$notes = strip_tags($extract['extractInfo']);
		    	    		$notes = preg_replace('/\v+/', '', $notes);
		    	    		$vf['NOTES'] = sterilize($notes);
		    	    	}
		    	    
		    	    }

		    	    $brewFermentables["fermentable".$fermentables_count++] = $vf;

			    }

			} // END Extracts

			// Grains/Malts
			for ($i = 1; $i <= MAX_GRAINS; $i++) {

			    $key_grain = "brewGrain".$i;
			    $key_grain_weight = "brewGrain".$i."Weight";

			    if ((isset($brew[$key_grain])) && (!empty($brew[$key_grain]))) {
	    	        
	    	        $grain_weight = "";
	    	        if ((isset($brew[$key_grain_weight])) && (is_numeric($brew[$key_grain_weight])) && ($brew[$key_grain_weight] > 0)) $grain_weight = number_format(filter_var($brew[$key_grain_weight], FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION|FILTER_FLAG_ALLOW_THOUSAND),2);

		    	    $db_conn->where ("maltName", $brew[$key_grain]);
		    	    $malt = $db_conn->getOne("malt");

		    	    $vf = array();
	    	    	$vf['NAME'] = sterilize($brew[$key_grain]);
	    	    	$vf['VERSION'] = "1";
	    	    	$vf['AMOUNT'] = $grain_weight;
	    	    	$vf['YIELD'] = "";
	    	    	$vf['COLOR'] = "";
	    	    	$vf['TYPE'] = "Grain";
	    	    	
		    	    if ($db_conn->count > 0)  {

		    	    	if (!empty($malt['maltType'])) $vf['TYPE'] = sterilize($malt['maltType']);
		    	    	if (!empty($malt['maltYield'])) $vf['YIELD'] = number_format(sterilize($malt['maltYield']), 1);
	    	    		if ((isset($malt['maltLovibond'])) && (!empty($malt['maltLovibond']))) {
	    	    			$color = sterilize(strtr($malt['maltLovibond'],"-",true));
	    	    			if (is_numeric($color)) $vf['COLOR'] = number_format($color, 1);
	    	    		}
	    	    		if (!empty($malt['maltOrigin'])) $vf['ORIGIN'] = sterilize($malt['maltOrigin']);
		    	    	if (!empty($malt['maltSupplier'])) $vf['SUPPLIER'] = sterilize($malt['maltSupplier']);
		    	    	if (!empty($malt['maltInfo'])) {
		    	    		$notes = strip_tags($malt['maltInfo']);
		    	    		$notes = preg_replace('/\v+/', '', $notes);
		    	    		$vf['NOTES'] = sterilize($notes);
		    	    	}

		    	    }

		    	    $brewFermentables["fermentable".$fermentables_count++] = $vf;

			    }

			} // END Malts

			// Adjuncts
			for ($i = 1; $i <= MAX_ADJ; $i++) {

			    $key_adjunct = "brewAddition".$i;
			    $key_adjunct_weight = "brewAddition".$i."Amt";

			    if ((isset($brew[$key_adjunct])) && (!empty($brew[$key_adjunct]))) {
	    	        
	    	        $adjunct_weight = "";
	    	        if ((isset($brew[$key_adjunct_weight])) && (is_numeric($brew[$key_adjunct_weight])) && ($brew[$key_adjunct_weight] > 0)) $adjunct_weight = number_format(filter_var($brew[$key_adjunct_weight], FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION|FILTER_FLAG_ALLOW_THOUSAND),2);

		    	    $db_conn->where ("adjunctName", $brew[$key_adjunct]);
		    	    $adjunct = $db_conn->getOne("adjuncts");

					$vf = array();
					$vf['NAME'] = sterilize($brew[$key_adjunct]);
					$vf['VERSION'] = "1";
					$vf['AMOUNT'] = $adjunct_weight;
					$vf['YIELD'] = "";
					$vf['COLOR'] = "";
					$vf['TYPE'] = "Sugar";
					
					$adj = 0;
					foreach ($adjunct_keywords as $value) {
						$value = strtolower($value);
						if (strpos(strtolower($brew[$key_adjunct]), $value) !== false) {
						    $adj++;
						}
					}

					if ($adj > 0) $vf['TYPE'] = "Adjunct";

		    	    if ($db_conn->count > 0) {

		    	    	$color = "";

		    	    	if (!empty($adjunct['adjunctType'])) $vf['TYPE'] = sterilize($adjunct['adjunctType']);
		    	    	if (!empty($adjunct['adjunctYield'])) $vf['YIELD'] = number_format(sterilize($adjunct['adjunctYield']), 1);
	    	    		if ((isset($adjunct['adjunctLovibond'])) && (!empty($adjunct['adjunctLovibond']))) {
	    	    			$color = sterilize(strtr($adjunct['adjunctLovibond'],"-",true));
	    	    			if (is_numeric($color)) $vf['COLOR'] = number_format($color, 1);
	    	    		}
	    	    		if (!empty($adjunct['adjunctOrigin'])) $vf['ORIGIN'] = sterilize($adjunct['adjunctOrigin']);
		    	    	if (!empty($adjunct['adjunctSupplier'])) $vf['SUPPLIER'] = sterilize($adjunct['adjunctSupplier']);
		    	    	if (!empty($adjunct['adjunctInfo'])) {
		    	    		$notes = strip_tags($adjunct['adjunctInfo']);
		    	    		$notes = preg_replace('/\v+/', '', $notes);
		    	    		$vf['NOTES'] = sterilize($notes);
		    	    	};

		    	    }

		    	    $brewFermentables["fermentable".$fermentables_count++] = $vf;
			    
			    }

			} // END Adjuncts

			if (!empty($brewFermentables)) $brewFermentables = json_encode($brewFermentables);
			else $brewFermentables = "";

			// Misc
			$miscs_count = 0;
			for ($i = 1; $i <= MAX_MISC; $i++) {

				// Name, Type, Use, Time, Amount

			    $key_misc = "brewMisc".$i."Name";
		        $key_misc_type = "brewMisc".$i."Type";
		        $key_misc_use = "brewMisc".$i."Use";
		        $key_misc_time = "brewMisc".$i."Time";
		        $key_misc_amt = "brewMisc".$i."Amount";

			    if ((isset($brew[$key_misc])) && (!empty($brew[$key_misc]))) {

		    	    $db_conn->where ("miscName", $brew[$key_misc]);
		    	    $misc = $db_conn->getOne("misc");

		    	    $vf = array();
		    	    $vf['NAME'] = sterilize($brew[$key_misc]);
		    	    $vf['VERSION'] = "1";
		    	    $vf['TYPE'] = "Other";
		    	    if (!empty($brew[$key_misc_type])) {

		    	    	$wa = 0;
		    	    	foreach ($water_agent_keywords as $value) {
		    	    		$value = strtolower($value);
		    	    		if (strpos(strtolower($brew[$key_misc]), $value) !== false) {
		    	    		    $wa++;
		    	    		}
		    	    	}

		    	    	if ($wa > 0) $vf['TYPE'] = "Water Agent";
		    	    	
		    	    	$vf['TYPE'] = sterilize($brew[$key_misc_type]);
		    	    
		    	    }

		    	    if (!empty($brew[$key_misc_amt])) $vf['AMOUNT'] = sterilize($brew[$key_misc_amt]);
		    	    else $vf['AMOUNT'] = "";
		    	    if (!empty($brew[$key_misc_use])) $vf['USE'] = sterilize($brew[$key_misc_use]);
		    	    else $vf['USE'] = "";
		    	    if (!empty($brew[$key_misc_time])) $vf['TIME'] = sterilize($brew[$key_misc_time]);
		    	    else $vf['TIME'] = "";
		    	    
		    	    if ($db_conn->count > 0) {

		    	    	if (($vf['TYPE'] = "Other") && (!empty($misc['miscType']))) $vf['TYPE'] = sterilize($misc['miscType']);
		    	    	if (!empty($misc['miscUse'])) $vf['USE'] = sterilize($misc['miscUse']);
		    	    	if (!empty($misc['miscInfo'])) {
		    	    		$notes = strip_tags($misc['miscInfo']);
		    	    		$notes = preg_replace('/\v+/', '', $notes);
		    	    		$vf['NOTES'] = sterilize($notes);
		    	    	}

		    	    }

		    	    $brewMiscs["misc".$miscs_count++] = $vf;

			    }

			} // END Misc

			if (!empty($brewMiscs)) $brewMiscs = json_encode($brewMiscs);
			else $brewMiscs = "";

			// Hops
			$hops_count = 0;
			for ($i = 1; $i <= MAX_HOPS; $i++) {

				// Name, Type, Use, Time, Amount

			    $key_hops = "brewHops".$i;
		        $key_hops_weight = "brewHops".$i."Weight";
		        $key_hops_ibu = "brewHops".$i."IBU";
		        $key_hops_time = "brewHops".$i."Time";
		        $key_hops_use = "brewHops".$i."Use";
		        $key_hops_type = "brewHops".$i."Type";
		        $key_hops_form = "brewHops".$i."Form";

			    if ((isset($brew[$key_hops])) && (!empty($brew[$key_hops]))) {

		    	    $db_conn->where ("hopsName", $brew[$key_hops]);
		    	    $hop = $db_conn->getOne("hops");

		    	    $hops_weight = "";
		    	    if ((isset($brew[$key_hops_weight])) && (is_numeric($brew[$key_hops_weight])) && ($brew[$key_hops_weight] > 0)) $hops_weight = number_format(filter_var($brew[$key_hops_weight], FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION|FILTER_FLAG_ALLOW_THOUSAND),2);

		    	    $vf = array();
		    	    
		    	    $vf['NAME'] = sterilize($brew[$key_hops]);
		    	    $vf['VERSION'] = "1";
		    	    if ((!empty($brew[$key_hops_ibu])) && (is_numeric($brew[$key_hops_ibu]))) $vf['ALPHA'] = number_format(sterilize($brew[$key_hops_ibu]), 1);
		    	    $vf['AMOUNT'] = sterilize($hops_weight);
		    	    if (!empty($brew[$key_hops_use])) $vf['USE'] = sterilize($brew[$key_hops_use]);
		    	    if (!empty($brew[$key_hops_time])) $vf['TIME'] = sterilize($brew[$key_hops_time]);
		    	    if (!empty($brew[$key_hops_form])) $vf['FORM'] = sterilize($brew[$key_hops_form]);

		    	    if ($db_conn->count > 0) {

		    	    	if (empty($brew[$key_hops_use])) $vf['USE'] = sterilize($hop['hopsUse']);
		    	    	if (!empty($hop['hopsGrown'])) $vf['ORIGIN'] =sterilize(strtr($hop['hopsGrown'],",",true));
		    	    	if (isset($hop['hopsSub'])) $vf['SUBSTITUTES'] = sterilize($hop['hopsSub']);
		    	    	if (!empty($hop['hopsInfo'])) {
		    	    		$notes = strip_tags($hop['hopsInfo']);
		    	    		$notes = preg_replace('/\v+/', '', $notes);
		    	    		$vf['NOTES'] = sterilize($notes);
		    	    	}

		    	    }

		    	    $brewHops["hop".$hops_count++] = $vf;

			    }

			} // END Hops

			if (!empty($brewHops)) $brewHops = json_encode($brewHops);
			else $brewHops = "";

			if ((isset($brew['brewYeast'])) && (!empty($brew['brewYeast']))) {

				$parts = explode("(",$brew['brewYeast']);
				$yeast_name = trim(sterilize($parts[0]));

				$like_var1 = "%".$yeast_name."%";
				$like_var2 = "%".$brew['brewYeastMan']."%";
				$db_conn->where ("yeastName", $like_var1, 'like');
				$db_conn->where ("yeastLab", $like_var2, 'like');
				$yeast = $db_conn->getOne("yeast_profiles");

				$vf = array();
				$vf['NAME'] = trim($yeast_name);
				$vf['VERSION'] = "1";
				if (!empty($brew['brewYeastType'])) $vf['TYPE'] = sterilize($brew['brewYeastType']);
				if (!empty($brew['brewYeastForm'])) $vf['FORM'] = sterilize($brew['brewYeastForm']); 
				if (!empty($brew['brewYeastAmount'])) $vf['AMOUNT'] = sterilize($brew['brewYeastAmount']);
				if (!empty($brew['brewYeastMan'])) $vf['LABORATORY'] = sterilize($brew['brewYeastMan']);

				if ($db_conn->count > 0) {

					if ((empty($brew['brewYeastType'])) && (!empty($yeast['yeastType']))) $vf['TYPE'] = sterilize($yeast['yeastType']);
					if ((empty($brew['brewYeastForm'])) && (!empty($yeast['yeastForm']))) $vf['FORM'] = sterilize($yeast['yeastForm']); 
					if ((empty($brew['brewYeastAmount'])) && (!empty($yeast['yeastAmount']))) $vf['AMOUNT'] = sterilize($yeast['yeastAmount']);
					if ((empty($brew['brewYeastMan'])) && (!empty($yeast['yeastLab']))) $vf['LABORATORY'] = sterilize($yeast['yeastLab']);
					if (!empty($yeast['yeastProdID'])) $vf['PRODUCT_ID'] = sterilize($yeast['yeastProdID']);
					if (!empty($yeast['yeastMinTemp'])) $vf['MIN_TEMPERATURE'] = sterilize($yeast['yeastMinTemp']);
					if (!empty($yeast['yeastMaxTemp'])) $vf['MAX_TEMPERATURE'] = sterilize($yeast['yeastMaxTemp']);
					if (!empty($yeast['yeastFloc'])) $vf['FLOCCULATION'] = sterilize($yeast['yeastFloc']);
					if (!empty($yeast['yeastAtten'])) $vf['ATTENUATION'] = number_format(sterilize($yeast['yeastAtten']), 0);
					
					if (!empty($yeast['yeastNotes'])) {
						$notes = strip_tags($yeast['yeastNotes']);
						$notes = preg_replace('/\v+/', '', $notes);
						$vf['NOTES'] = sterilize($notes);
					}
					
					if (!empty($yeast['yeastBestFor'])) $vf['BEST_FOR'] = sterilize($yeast['yeastBestFor']);
					if (!empty($yeast['yeastMaxReuse'])) $vf['MAX_REUSE'] = sterilize($yeast['yeastMaxReuse']);
					
				}

				$brewYeasts['yeast0'] = $vf;

			}

			elseif ((isset($brew['brewYeastProfile'])) && (!empty($brew['brewYeastProfile']))) {

				$db_conn->where ("id", $brew['brewYeastProfile']);
				$yeast = $db_conn->getOne("yeast_profiles");

				$vf = array();
				$vf['NAME'] = trim($yeast['yeastName']);
				$vf['VERSION'] = "1";
				if (!empty($yeast['yeastType'])) $vf['TYPE'] = sterilize($yeast['yeastType']);
				if (!empty($yeast['yeastForm'])) $vf['FORM'] = sterilize($yeast['yeastForm']); 
				if (!empty($brew['brewYeastAmount'])) $vf['AMOUNT'] = sterilize($brew['brewYeastAmount']);
				if (!empty($yeast['yeastMan'])) $vf['LABORATORY'] = sterilize($yeast['yeastMan']);
				if ((empty($yeast['yeastType'])) && (!empty($yeast['yeastType']))) $vf['TYPE'] = sterilize($yeast['yeastType']);
				if ((empty($yeast['yeastForm'])) && (!empty($yeast['yeastForm']))) $vf['FORM'] = sterilize($yeast['yeastForm']); 
				if ((empty($yeast['yeastAmount'])) && (!empty($yeast['yeastAmount']))) $vf['AMOUNT'] = sterilize($yeast['yeastAmount']);
				if ((empty($yeast['yeastMan'])) && (!empty($yeast['yeastLab']))) $vf['LABORATORY'] = sterilize($yeast['yeastLab']);
				if (!empty($yeast['yeastProdID'])) $vf['PRODUCT_ID'] = sterilize($yeast['yeastProdID']);
				if (!empty($yeast['yeastMinTemp'])) $vf['MIN_TEMPERATURE'] = sterilize($yeast['yeastMinTemp']);
				if (!empty($yeast['yeastMaxTemp'])) $vf['MAX_TEMPERATURE'] = sterilize($yeast['yeastMaxTemp']);
				if (!empty($yeast['yeastFloc'])) $vf['FLOCCULATION'] = sterilize($yeast['yeastFloc']);
				if (!empty($yeast['yeastAtten'])) {
					$parts = explode("-",$yeast['yeastAtten']);
					if (is_numeric($parts[0])) $vf['ATTENUATION'] = number_format(sterilize($parts[0]), 0);
				}
				
				if (!empty($yeast['yeastNotes'])) {
					$notes = strip_tags($yeast['yeastNotes']);
					$notes = preg_replace('/\v+/', '', $notes);
					$vf['NOTES'] = sterilize($notes);
				}
				
				if (!empty($yeast['yeastBestFor'])) $vf['BEST_FOR'] = sterilize($yeast['yeastBestFor']);
				if (!empty($yeast['yeastMaxReuse'])) $vf['MAX_REUSE'] = sterilize($yeast['yeastMaxReuse']);
					
				$brewYeasts['yeast0'] = $vf;

			}

			if (!empty($brewYeasts)) $brewYeasts = json_encode($brewYeasts);
			else $brewYeasts = "";

			if ((isset($brew['brewMashType'])) && (!empty($brew['brewMashType']))) {

				$vf = array();
				$ms = array();
				$mash_step_count = 0;
				$vf['NAME'] = sterilize($brew['brewMashType']);
	            $vf['VERSION'] = "1";
	            if (!empty($brew['brewMashGrainTemp'])) $vf['GRAIN_TEMP'] = number_format(sterilize($brew['brewMashGrainTemp']),0);
	            if (!empty($brew['brewMashTunTemp'])) $vf['TUN_TEMP'] = number_format(sterilize($brew['brewMashTunTemp']),0); 
	            if (!empty($brew['brewMashSpargeTemp'])) $vf['SPARGE_TEMP'] = number_format(sterilize($brew['brewMashSpargeTemp']),0);
	            if (!empty($brew['brewMashPH'])) $vf['PH'] = number_format(sterilize($brew['brewMashPH']),2);
	            
	            if (!empty($brew['brewMashStep1Name'])) {
	            	$msteps = array();
	            	$msteps['NAME'] = $brew['brewMashStep1Name'];
	            	$msteps['VERSION'] = "1";
	            	if (!empty($brew['brewMashStep1Desc'])) {
	            		$notes = strip_tags($brew['brewMashStep1Desc']);
	            		$notes = preg_replace('/\v+/', '', $notes);
	            		$msteps['NOTES'] = sterilize($notes);
	            	}
	            	if (!empty($brew['brewMashStep1Time'])) $msteps['STEP_TIME'] = sterilize($brew['brewMashStep1Time']);
	            	if (!empty($brew['brewMashStep1Temp'])) $msteps['STEP_TEMP'] = number_format(sterilize($brew['brewMashStep1Temp']),0);
	            	$ms["mash_step".$mash_step_count++] = $msteps;
	            }

	            if (!empty($brew['brewMashStep2Name'])) {
	            	$msteps = array();
	            	$msteps['NAME'] = $brew['brewMashStep2Name'];
	            	$msteps['VERSION'] = "1";
	            	if (!empty($brew['brewMashStep2Desc'])) {
	            		$notes = strip_tags($brew['brewMashStep2Desc']);
	            		$notes = preg_replace('/\v+/', '', $notes);
	            		$msteps['NOTES'] = sterilize($notes);
	            	}
	            	if (!empty($brew['brewMashStep2Time'])) $msteps['STEP_TIME'] = sterilize($brew['brewMashStep2Time']);
	            	if (!empty($brew['brewMashStep2Temp'])) $msteps['STEP_TEMP'] = number_format(sterilize($brew['brewMashStep2Temp']),0);
	            	$ms["mash_step".$mash_step_count++] = $msteps;
	            }

	            if (!empty($brew['brewMashStep3Name'])) {
	            	$msteps = array();
	            	$msteps['NAME'] = $brew['brewMashStep3Name'];
	            	$msteps['VERSION'] = "1";
	            	if (!empty($brew['brewMashStep3Desc'])) {
	            		$notes = strip_tags($brew['brewMashStep3Desc']);
	            		$notes = preg_replace('/\v+/', '', $notes);
	            		$msteps['NOTES'] = sterilize($notes);
	            	}
	            	if (!empty($brew['brewMashStep3Time'])) $msteps['STEP_TIME'] = sterilize($brew['brewMashStep3Time']);
	            	if (!empty($brew['brewMashStep3Temp'])) $msteps['STEP_TEMP'] = number_format(sterilize($brew['brewMashStep3Temp']),0);
	            	$ms["mash_step".$mash_step_count++] = $msteps;
	            }

	            if (!empty($brew['brewMashStep4Name'])) {
	            	$msteps = array();
	            	$msteps['NAME'] = $brew['brewMashStep4Name'];
	            	$msteps['VERSION'] = "1";
	            	if (!empty($brew['brewMashStep4Desc'])) {
	            		$notes = strip_tags($brew['brewMashStep4Desc']);
	            		$notes = preg_replace('/\v+/', '', $notes);
	            		$msteps['NOTES'] = sterilize($notes);
	            	}
	            	if (!empty($brew['brewMashStep4Time'])) $msteps['STEP_TIME'] = sterilize($brew['brewMashStep4Time']);
	            	if (!empty($brew['brewMashStep4Temp'])) $msteps['STEP_TEMP'] = number_format(sterilize($brew['brewMashStep4Temp']),0);
	            	$ms["mash_step".$mash_step_count++] = $msteps;
	            }

	            if (!empty($brew['brewMashStep5Name'])) {
	            	$msteps = array();
	            	$msteps['NAME'] = $brew['brewMashStep5Name'];
	            	$msteps['VERSION'] = "1";
	            	if (!empty($brew['brewMashStep5Desc'])) {
	            		$notes = strip_tags($brew['brewMashStep5Desc']);
	            		$notes = preg_replace('/\v+/', '', $notes);
	            		$msteps['NOTES'] = sterilize($notes);
	            	}
	            	if (!empty($brew['brewMashStep5Time'])) $msteps['STEP_TIME'] = sterilize($brew['brewMashStep5Time']);
	            	if (!empty($brew['brewMashStep5Temp'])) $msteps['STEP_TEMP'] = number_format(sterilize($brew['brewMashStep5Temp']),0);
	            	$ms["mash_step".$mash_step_count++] = $msteps;
	            }

	            if ($mash_step_count > 0) $vf['MASH_STEPS'] = $ms;

	            $brewMash = $vf;

			}

			elseif ((isset($brew['brewMashProfile'])) && (!empty($brew['brewMashProfile']))) {

				$db_conn->where ("id", $brew['brewMashProfile']);
				$mash = $db_conn->getOne("mash_profiles");

				if ($db_conn->count > 0) {

					$db_conn->where ("stepMashProfileID", $brew['brewMashProfile']);
					$mash_steps = $db_conn->get("mash_steps");

					$vf = array();
					$ms = array();
					$mash_step_count = 0;
					$vf['NAME'] = $mash['mashProfileName'];
					$vf['VERSION'] = "1";
					if (!empty($brew['brewMashGrainTemp'])) $vf['GRAIN_TEMP'] = number_format(sterilize($brew['brewMashGrainTemp']),0);
					if (!empty($brew['brewMashTunTemp'])) $vf['TUN_TEMP'] = number_format(sterilize($brew['brewMashTunTemp']),0); 
					if (!empty($brew['brewMashSpargeTemp'])) $vf['SPARGE_TEMP'] = number_format(sterilize($brew['brewMashSpargeTemp']),0);
					if (!empty($brew['brewMashPH'])) $vf['PH'] = number_format(sterilize($brew['brewMashPH']),2);
				
					foreach ($mash_steps as $step) {

						$msteps = array();
						$msteps['NAME'] = $step['stepName'];
						$msteps['VERSION'] = "1";
						if (!empty($step['stepType'])) $msteps['TYPE'] = sterilize($step['stepType']);
						if (!empty($step['stepInfuseAmt'])) $msteps['INFUSE_AMOUNT'] = number_format(sterilize($step['stepInfuseAmt']),2);
						if (!empty($step['stepTime'])) $msteps['STEP_TIME'] = sterilize($step['stepTime']);
						if (!empty($step['stepTemp'])) $msteps['STEP_TEMP'] = number_format(sterilize($step['stepTemp']),0);
						if (!empty($step['stepRampTime'])) $ms['RAMP_TIME'] = sterilize($step['stepRampTime']);
						if (!empty($step['stepEndTemp'])) $ms['END_TEMP'] = number_format(sterilize($step['stepEndTemp']),0);
						if (!empty($step['stepWaterGrainRatio'])) $ms['WATER_GRAIN_RATIO'] = sterilize($step['stepWaterGrainRatio']);
						if (!empty($step['stepInfusionTemp'])) $ms['INFUSE_TEMP'] = number_format(sterilize($step['stepInfusionTemp']),0);
						if (!empty($step['stepDecoctionAmt'])) $ms['DECOCTION_AMT'] = number_format(sterilize($step['stepDecoctionAmt']),2);
						if (!empty($step['stepDescription'])) {
							$notes = strip_tags($step['stepDescription']);
							$notes = preg_replace('/\v+/', '', $notes);
							$msteps['NOTES'] = sterilize($notes);
						}
						$ms["mash_step".$mash_step_count++] = $msteps;
					}
						
					if ($mash_step_count > 0) $vf['MASH_STEPS'] = $ms;

				}

				$brewMash = $vf;

			}

			if (!empty($brewMash)) $brewMash = json_encode($brewMash);
			else $brewMash = "";

			if ((isset($brew['brewWaterName'])) && (!empty($brew['brewWaterName']))) {

				$vf = array();
				$vf['NAME'] = sterilize($brew['brewWaterName']);
				$vf['VERSION'] = "1";
				if (!empty($brew['brewWaterAmount'])) $vf['AMOUNT'] = sterilize($brew['brewWaterAmount']);
				if (!empty($brew['brewWaterCalcium'])) $vf['CALCIUM'] = sterilize($brew['brewWaterCalcium']);
				if (!empty($brew['brewWaterBicarb'])) $vf['BICARBONATE'] = sterilize($brew['brewWaterBicarb']);
				if (!empty($brew['brewWaterSulfate'])) $vf['SULFATE'] = sterilize($brew['brewWaterSulfate']);
				if (!empty($brew['brewWaterChloride'])) $vf['CHLORIDE'] = sterilize($brew['brewWaterChloride']);
				if (!empty($brew['brewWaterSodium'])) $vf['SODIUM'] = sterilize($brew['brewWaterSodium']);
				if (!empty($brew['brewWaterMagnesium'])) $vf['MAGNESIUM'] = sterilize($brew['brewWaterMagnesium']);
				if (!empty($brew['brewWaterPH'])) $vf['PH'] = sterilize($brew['brewWaterPH']);
				if (!empty($brew['brewWaterNotes'])) {
					$notes = strip_tags($brew['brewWaterNotes']);
					$notes = preg_replace('/\v+/', '', $notes);
					$vf['NOTES'] = sterilize($notes);
				}

				$brewWater["water0"] = $vf;

			}

			elseif ((isset($brew['brewWaterProfile'])) && (!empty($brew['brewWaterProfile']))) {

				$db_conn->where ("id", $brew['brewWaterProfile']);
				$water = $db_conn->getOne("water_profiles");

				if ($db_conn->count > 0) {

					$vf = array();
					$vf['NAME'] = sterilize($water['waterName']);
					$vf['VERSION'] = "1";
					if (!empty($water['waterAmount'])) $vf['AMOUNT'] = sterilize($water['waterAmount']);
					if (!empty($water['waterCalcium'])) $vf['CALCIUM'] = sterilize($water['waterCalcium']);
					if (!empty($water['waterBicarbonate'])) $vf['BICARBONATE'] = sterilize($water['waterBicarbonate']);
					if (!empty($water['waterSulfate'])) $vf['SULFATE'] = sterilize($water['waterSulfate']);
					if (!empty($water['waterChloride'])) $vf['CHLORIDE'] = sterilize($water['waterChloride']);
					if (!empty($water['waterSodium'])) $vf['SODIUM'] = sterilize($water['waterSodium']);
					if (!empty($water['waterMagnesium'])) $vf['MAGNESIUM'] = sterilize($water['waterMagnesium']);
					if (!empty($water['waterPH'])) $vf['PH'] = sterilize($water['waterPH']);
					if (!empty($water['waterNotes'])) {
						$notes = strip_tags($water['waterNotes']);
						$notes = preg_replace('/\v+/', '', $notes);
						$vf['NOTES'] = sterilize($notes);
					}

					$brewWater["water0"] = $vf;

				}

			}

			if (!empty($brewWater)) $brewWater = json_encode($brewWater);
			else $brewWater = "";

			if ((isset($brew['brewEquipProfile'])) && (!empty($brew['brewEquipProfile']))) {

				$db_conn->where ("id", $brew['brewEquipProfile']);
				$equip = $db_conn->getOne("equip_profiles");

				if ($db_conn->count > 0) {

					$vf = array();
					$vf['NAME'] = sterilize($equip['equipProfileName']);
					$vf['VERSION'] = "1";
					$vf['BOIL_SIZE'] = sterilize($equip['equipBoilVolume']);
					$vf['BATCH_SIZE'] = sterilize($equip['equipBatchSize']);
					if (!empty($equip['equipMashTunVolume'])) $vf['TUN_VOLUME'] = sterilize($equip['equipMashTunVolume']);
					if (!empty($equip['equipMashTunWeight'])) $vf['TUN_WEIGHT'] = sterilize($equip['equipMashTunWeight']);
					if (!empty($equip['equipMashTunSpecificHeat'])) $vf['TUN_SPECIFIC_HEAT'] = sterilize($equip['equipMashTunSpecificHeat']);
					if (!empty($equip['equipMashTunDeadspace'])) $vf['LAUTER_DEADSPACE'] = sterilize($equip['equipMashTunDeadspace']);
					if (!empty($equip['equipEvapRate'])) $vf['EVAP_RATE'] = sterilize($equip['equipEvapRate']);
					if (!empty($equip['equipTopUpKettle'])) $vf['TOP_UP_WATER'] = sterilize($equip['equipTopUpKettle']);
					if (!empty($equip['equipLoss'])) $vf['TRUB_CHILLER_LOSS'] = sterilize($equip['equipLoss']);
					if (!empty($equip['equipHopUtil'])) $vf['HOP_UTILIZATION'] = sterilize($equip['equipHopUtil']);
					if (!empty($equip['equipNotes'])) {
						$notes = strip_tags($equip['equipNotes']);
						$notes = preg_replace('/\v+/', '', $notes);
						$vf['NOTES'] = sterilize($notes);
					}

					$brewEquipment = $vf;

				}

			}

			if (!empty($brewEquipment)) $brewEquipment = json_encode($brewEquipment);
			else $brewEquipment = "";

			$brewMashGravities = "";
			$brewFermGravities = array();

			if (!empty($brew['brewPrimary'])) {
				$brewPrimary['PRIMARY_AGE'] = sterilize($brew['brewPrimary']);
				$brewPrimary['PRIMARY_TEMP'] = sterilize($brew['brewPrimaryTemp']);
			}

			if (!empty($brewPrimary)) $brewPrimary = json_encode($brewPrimary);
			else $brewPrimary = "";

			if (!empty($brew['brewSecondary'])) {
				$brewSecondary['SECONDARY_AGE'] = sterilize($brew['brewSecondary']);
				$brewSecondary['SECONDARY_TEMP'] = sterilize($brew['brewSecondaryTemp']);
			}

			if (!empty($brewSecondary)) $brewSecondary = json_encode($brewSecondary);
			else $brewSecondary = "";

			if (!empty($brew['brewTertiary'])) {
				$brewTertiary['TERTIARY_AGE'] = sterilize($brew['brewTertiary']);
				$brewTertiary['TERTIARY_TEMP'] = sterilize($brew['brewTertiaryTemp']);
			}

			if (!empty($brewTertiary)) $brewTertiary = json_encode($brewTertiary);
			else $brewTertiary = "";
			
			if (!empty($brew['brewGravity1'])) {
				$brewFermGravities['fermgravity1'] = array('gravity' => sterilize($brew['brewGravity1']), 'days' => sterilize($brew['brewGravity1Days']));
			}

			if (!empty($brew['brewGravity2'])) {
				$brewFermGravities['fermgravity2'] = array('gravity' => sterilize($brew['brewGravity2']), 'days' => sterilize($brew['brewGravity2Days']));
			}

			if (!empty($brewFermGravities)) $brewFermGravities = json_encode($brewFermGravities);
			else $brewFermGravities = "";

			$brewComments = $purifier->purify($brew['brewComments']);
			$brewProcedure = $purifier->purify($brew['brewProcedure']);
			$brewSpecialProcedure = $purifier->purify($brew['brewSpecialProcedure']);
			$brewStatus = $purifier->purify($brew['brewStatus']);
			
			$brewTapDate = "";
			if ((isset($brew['brewTapDate'])) && (!empty($brew['brewTapDate']))) $brewTapDate = strtotime($brew['brewTapDate']);
			
			$brewLabelImage = sterilize($brew['brewLabelImage']);
			$brewFeatured = sterilize($brew['brewFeatured']);
			$brewArchive = sterilize($brew['brewArchive']);

			// Build insert query.
			$update_table = "brewblogs";
			$data = array(
				'id' =>blank_to_null($brewOriginalID),
				'brewOriginalID' =>blank_to_null($brewOriginalID),
			    'brewName' => blank_to_null($brewName),
			    'brewDate' => blank_to_null($brewDate),
			    'brewCost' => blank_to_null($brewCost),
			    'brewInfo' => blank_to_null($brewInfo),
			    'brewMethod' => blank_to_null($brewMethod),
			    'brewStyle' => blank_to_null($brewStyle),
			    'brewBrewerID' => blank_to_null($brewBrewerID),
			    'brewBatchSize' => blank_to_null($brewBatchSize),
			    'brewBatchNum' => blank_to_null($brewBatchNum),
			    'brewBoilSize' => blank_to_null($brewBoilSize),
			    'brewBoilTime' => blank_to_null($brewBoilTime),
			    'brewEfficiency' => blank_to_null($brewEfficiency),
			    'brewOG' => blank_to_null($brewOG),
			    'brewFG' => blank_to_null($brewFG),
			    'brewABV' => blank_to_null($brewABV),
			    'brewIBU' => blank_to_null($brewIBU),
			    'brewColor' => blank_to_null($brewColor),
			    'brewColorFormula' => blank_to_null($brewColorFormula),
			    'brewCarbonation' => blank_to_null($brewCarbonation),
			    'brewFermentables' => blank_to_null($brewFermentables),
			    'brewMiscs' => blank_to_null($brewMiscs),
			    'brewHops' => blank_to_null($brewHops),
			    'brewYeasts' => blank_to_null($brewYeasts),
			    'brewMash' => blank_to_null($brewMash),
			    'brewWater' => blank_to_null($brewWater),
			    'brewEquipment' => blank_to_null($brewEquipment),
			    'brewPrimary' => blank_to_null($brewPrimary),
			    'brewSecondary' => blank_to_null($brewSecondary),
			    'brewTertiary' => blank_to_null($brewTertiary),
			    'brewAge' => blank_to_null($brewAge),
			    'brewFermGravities' => blank_to_null($brewFermGravities),
			    'brewComments' => blank_to_null($brewComments),
			    'brewProcedure' => blank_to_null($brewProcedure),
			    'brewSpecialProcedure' => blank_to_null($brewSpecialProcedure),
			    'brewStatus' => blank_to_null($brewStatus),
			    'brewTapDate' => blank_to_null($brewTapDate),
			    'brewLabelImage' => blank_to_null($brewLabelImage),
			    'brewFeatured' => blank_to_null($brewFeatured),
			    'brewArchive' => blank_to_null($brewArchive)
			);

			//echo "<p><pre>";
			//print_r($data);
			//echo "</pre></p>";
		 	//$confirm_output .= "<li>".$brewName."</li>";
		
			$result = $db_conn->insert($update_table, $data);

			if ($result) $convert_report['converted']++;
			else $convert_report['errors'][] = "brewing id ".$brewOriginalID.": ".$db_conn->getLastError();

		} // end foreach ($brewing as $brew)

	} // end if ($db_conn->count > 0)

} // end if ((isset($db_conn)) && (isset($purifier)))

?>