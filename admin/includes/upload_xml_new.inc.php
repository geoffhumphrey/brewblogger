<?php

/**
 * July 2024
 * Moved parsing of BeerXML File to a single file.
 * 
 * TODO: Add checks for malt, hops, water, yeast to see if they exist
 * in their respective DB tables. If not, add. If so, update with 
 * latest data being imported as it's assumed to be the latest.
 * 
 */

if ($phpVersion >= "7") {

    //Mmaximum file size.
    $MAX_SIZE = 2000000;

    //Allowable file Mime Types.
    $FILE_MIMES = array('image/jpeg','image/jpg','image/gif','image/png','application/msword');

    //Allowable file ext. names.
    $FILE_EXTS  = array('.xml','.txt');

    function convertUnit($value,$type){

        if (is_numeric($value)) {

            switch($type) {
                case "hopWeight";
                    if ($_SESSION['measWeight1'] == "grams") return $value * 1000;
                    else return $value * 35.27396;
                case "temperature":
                    if ($_SESSION['measTemp'] == "F") return ($value * 1.8) + 32;
                    else return $value; 
                case "volume":
                    if ($_SESSION['measFluid2'] == "gallons") return $value * 0.26417;
                    else return $value;
                case "weight":
                    if ($_SESSION['measWeight2'] == "pounds") return $value * 2.20462; 
                    else return $value;
                default:
                break;
            }

        }
        
        else return $value;

    }

    /**
     * Read a numeric BeerXML value. Empty elements (parsed as empty arrays), missing or
     * non-numeric values return "" instead of crashing number_format()/round() on PHP 8.
     * A leading number is taken from values with units, e.g., "53.7 IBUs", "5.3 SRM", "5.8%".
     * $decimals NULL keeps up to 2 decimals without padding; no thousands separator is added.
     */
    function xml_number($value, $decimals = NULL, $type = "") {

        if ((is_array($value)) || (!preg_match('/^\s*(-?[0-9]*\.?[0-9]+)/', (string) $value, $matches))) return "";
        $value = (float) $matches[1];
        if ($type != "") $value = convertUnit($value, $type);
        if ($decimals === NULL) return (string) round($value, 2);
        return number_format($value, $decimals, ".", "");

    }

function xmlToArray($xml, $options = array()) {
    
    $defaults = array(
        'namespaceSeparator' => ':', // you may want this to be something other than a colon
        'attributePrefix' => '@',    // to distinguish between attributes and nodes with the same name
        'alwaysArray' => array(),    // array of xml tag names which should always become arrays
        'autoArray' => true,         // only create arrays for tags which appear more than once
        'textContent' => '$',        // key used for the text content of elements
        'autoText' => true,          // skip textContent key if node has no attributes or child nodes
        'keySearch' => false,        // optional search and replace on tag and attribute names
        'keyReplace' => false        // replace values for above search values (as passed to str_replace())
    );

    $options = array_merge($defaults, $options);
    $namespaces = $xml->getDocNamespaces();
    $namespaces[''] = null; //add base (empty) namespace
 
    // get attributes from all namespaces
    $attributesArray = array();
    foreach ($namespaces as $prefix => $namespace) {
        foreach ($xml->attributes($namespace) as $attributeName => $attribute) {
            //replace characters in attribute name
            if ($options['keySearch']) $attributeName = str_replace($options['keySearch'], $options['keyReplace'], $attributeName);
            $attributeKey = $options['attributePrefix'] . ($prefix ? $prefix . $options['namespaceSeparator'] : '') . $attributeName;
            $attributesArray[$attributeKey] = (string)$attribute;
        }
    }
 
    // get child nodes from all namespaces
    $tagsArray = array();
    foreach ($namespaces as $prefix => $namespace) {
        
        foreach ($xml->children($namespace) as $childXml) {
            
            //recurse into child nodes
            $childArray = xmlToArray($childXml, $options);
            $childTagName = key($childArray);
            $childProperties = current($childArray);
 
            //replace characters in tag name
            if ($options['keySearch']) $childTagName = str_replace($options['keySearch'], $options['keyReplace'], $childTagName);
            
            //add namespace prefix, if any
            if ($prefix) $childTagName = $prefix . $options['namespaceSeparator'] . $childTagName;
 
            if (!isset($tagsArray[$childTagName])) {
                //only entry with this key
                //test if tags of this type should always be arrays, no matter the element count
                $tagsArray[$childTagName] = in_array($childTagName, $options['alwaysArray']) || !$options['autoArray'] ? array($childProperties) : $childProperties;
            } 

            elseif (is_array($tagsArray[$childTagName]) && array_keys($tagsArray[$childTagName]) === range(0, count($tagsArray[$childTagName]) - 1)) {
                //key already exists and is integer indexed array
                $tagsArray[$childTagName][] = $childProperties;
            } 

            else {
                //key exists so convert to integer indexed array with previous value in position 0
                $tagsArray[$childTagName] = array($tagsArray[$childTagName], $childProperties);
            }
        }
    }
 
    // get text content of node
    $textContentArray = array();
    $plainText = trim((string)$xml);
    if ($plainText !== '') $textContentArray[$options['textContent']] = $plainText;
 
    // stick it all together
    $propertiesArray = !$options['autoText'] || $attributesArray || $tagsArray || ($plainText === '')
            ? array_merge($attributesArray, $tagsArray, $textContentArray) : $plainText;
 
    // return node as array
    return array(
        $xml->getName() => $propertiesArray
    );
}

// Scrub ASCII values from BF
$scrub_bf = array(
    "&#32;" => " ",
    "&#48;" => "0",
    "&#49;" => "1",
    "&#50;" => "2",
    "&#51;" => "3",
    "&#52;" => "4",
    "&#53;" => "5",
    "&#54;" => "6",
    "&#55;" => "7",
    "&#56;" => "8",
    "&#57;" => "9",
);

$imported = array();
$error_output = array();

if ((isset($_FILES['userfile'])) && ($_FILES['userfile'])) {
    
    $file_type = $_FILES['userfile']['type'];
    $file_name = $_FILES['userfile']['name'];
    $file_ext = strtolower(substr($file_name,strrpos($file_name,".")));
    $message = $_FILES['userfile']['tmp_name'];
  
    // File Size Check
    if ($_FILES['userfile']['size'] > $MAX_SIZE) 
    $message = "The file size is over 2MB.  Please adjust the size and try again.";

    // File Type/Extension Check
    elseif ((!in_array($file_type, $FILE_MIMES)) && (!in_array($file_ext, $FILE_EXTS))) $message = "Sorry, that file type is not allowed to be uploaded.  Acceptable file type extensions are: .xml, .txt";

    elseif (is_uploaded_file($_FILES['userfile']['tmp_name'])) {

        $xml = simplexml_load_file($_FILES['userfile']['tmp_name']);

        $recipes = xmlToArray($xml, array(
            'alwaysArray' => array('RECIPE','FERMENTABLE','HOP','MISC','YEAST','WATER','MASH','MASH_STEPS','MASH_STEP')
        ));

        foreach ($recipes['RECIPES'] as $key => $recipe) {

            foreach ($recipe as $key => $rec) {
                
                // Get top-level vars
                $brewName = clean_text($rec['NAME']);
                $brewBrewerID = $GLOBALS['loginUsername']; 
                $brewSource = clean_text($rec['BREWER']);
                $brewBatchSize = xml_number($rec['BATCH_SIZE'], 2, "volume");
                $brewInfo = clean_text($rec['NOTES']);
                $brewMethod = clean_text($rec['TYPE']);
                $brewOG = xml_number($rec['OG'], 3);
                $brewFG = xml_number($rec['FG'], 3);
                $brewBoilSize = xml_number($rec['BOIL_SIZE'], 2, "volume");
                $brewBoilTime = xml_number($rec['BOIL_TIME'], 0); 
                $brewEfficiency = xml_number($rec['EFFICIENCY'], 0); 
                $brewIBU = xml_number($rec['IBU'], 1);
                $brewColor = xml_number($rec['EST_COLOR'], 1);
                $brewABV = xml_number($rec['EST_ABV'], 1);
                $brewCarbonation = xml_number($rec['CARBONATION'], 1);

                // Define arrays for JSON encoding
                $brewStyle = array();
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
                $brewAge = array();

                // ------------ Style ------------

                if (isset($rec['STYLE'])) {

                    $vf = array();

                    if (isset($rec['STYLE']['NAME'])) {

                        $vf['NAME'] = clean_text($rec['STYLE']['NAME']);
                        $vf['CATEGORY'] = clean_text($rec['STYLE']['CATEGORY']);
                        $vf['VERSION'] = sterilize($rec['STYLE']['VERSION']);
                        $vf['CATEGORY_NUMBER'] = clean_text($rec['STYLE']['CATEGORY_NUMBER']);
                        $vf['STYLE_LETTER'] = clean_text($rec['STYLE']['STYLE_LETTER']);
                        $vf['STYLE_GUIDE'] = clean_text($rec['STYLE']['STYLE_GUIDE']);
                        $vf['TYPE'] = sterilize($rec['STYLE']['TYPE']);
                        $vf['OG_MIN'] = xml_number($rec['STYLE']['OG_MIN'], 3);
                        $vf['OG_MAX'] = xml_number($rec['STYLE']['OG_MAX'], 3);
                        $vf['FG_MIN'] = xml_number($rec['STYLE']['FG_MIN'], 3);
                        $vf['FG_MAX'] = xml_number($rec['STYLE']['FG_MAX'], 3);
                        $vf['IBU_MIN'] = sterilize($rec['STYLE']['IBU_MIN']);
                        $vf['IBU_MAX'] = sterilize($rec['STYLE']['IBU_MAX']);
                        $vf['COLOR_MIN'] = sterilize($rec['STYLE']['COLOR_MIN']);
                        $vf['COLOR_MAX'] = sterilize($rec['STYLE']['COLOR_MAX']);

                        $brewStyle = $vf;
                    }

                }

                if (!empty($brewStyle)) $brewStyle = json_encode($brewStyle);
                else $brewStyle = "";

                // ------------ Fermentables ------------
                
                $fermentables_count = 0;
                
                if (isset($rec['FERMENTABLES'])) {

                    $fermentables = $rec['FERMENTABLES'];

                    foreach ($fermentables['FERMENTABLE'] as $fermentable) {

                        $vf = array();

                        if (isset($fermentable['NAME'])) {

                            $vf['NAME'] = clean_text($fermentable['NAME']);
                            $vf['VERSION'] = sterilize($fermentable['VERSION']);
                            $vf['TYPE'] = sterilize($fermentable['TYPE']);
                            $vf['AMOUNT'] = xml_number($fermentable['AMOUNT'], 2, "weight");
                            $vf['YIELD'] = xml_number($fermentable['YIELD'], 1);
                            $vf['COLOR'] = xml_number($fermentable['COLOR'], 1);
                            if (isset($fermentable['ORIGIN'])) $vf['ORIGIN'] = clean_text($fermentable['ORIGIN']);
                            if (isset($fermentable['SUPPLIER'])) $vf['SUPPLIER'] = clean_text($fermentable['SUPPLIER']);
                            if (isset($fermentable['NOTES'])) $vf['NOTES'] = clean_text($fermentable['NOTES']);
                            if (isset($fermentable['COARSE_FINE_DIFF'])) $vf['COARSE_FINE_DIFF'] = xml_number($fermentable['COARSE_FINE_DIFF'], 1);
                            if (isset($fermentable['MOISTURE'])) $vf['MOISTURE'] = xml_number($fermentable['MOISTURE'], 1);
                            if (isset($fermentable['DIASTATIC_POWER'])) $vf['DIASTATIC_POWER'] = xml_number($fermentable['DIASTATIC_POWER'], 2);
                            if (isset($fermentable['PROTEIN'])) $vf['PROTEIN'] = xml_number($fermentable['PROTEIN'], 1);
                            if (isset($fermentable['MAX_IN_BATCH'])) $vf['MAX_IN_BATCH'] = xml_number($fermentable['MAX_IN_BATCH'], 1);
                            if (isset($fermentable['RECOMMEND_MASH'])) $vf['RECOMMEND_MASH'] = sterilize(strtoupper($fermentable['RECOMMEND_MASH']));
                            if (isset($fermentable['IBU_GAL_PER_LB'])) {
                                if (is_numeric($fermentable['IBU_GAL_PER_LB'])) $vf['IBU_GAL_PER_LB'] = xml_number($fermentable['IBU_GAL_PER_LB'], 2);
                            }
                            
                            // Brewfather only
                            if (isset($fermentable['NOT_FERMENTABLE'])) $vf['NOT_FERMENTABLE'] = sterilize(strtoupper($fermentable['NOT_FERMENTABLE']));
                            if (isset($fermentable['ADD_AFTER_BOIL'])) $vf['ADD_AFTER_BOIL'] = sterilize($fermentable['ADD_AFTER_BOIL']);

                            $brewFermentables["fermentable".$fermentables_count++] = $vf;

                        }

                    }

                }

                if (!empty($brewFermentables)) $brewFermentables = json_encode($brewFermentables);
                else $brewFermentables = "";

                // ------------ Hops ------------
                
                $hops_count = 0;

                if (isset($rec['HOPS'])) {

                    $hops = $rec['HOPS'];

                    foreach ($hops['HOP'] as $hop) {

                        $vf = array();

                        if (isset($hop['NAME'])) {

                            $vf['NAME'] = clean_text($hop['NAME']);
                            $vf['VERSION'] = sterilize($hop['VERSION']);
                            $vf['ALPHA'] = xml_number($hop['ALPHA'], 1);
                            $vf['AMOUNT'] = xml_number($hop['AMOUNT'], 2, "hopWeight");
                            $vf['USE'] = sterilize($hop['USE']);
                            $vf['TIME'] = xml_number($hop['TIME'], 0);
                            if (isset($hop['ORIGIN'])) $vf['ORIGIN'] = clean_text($hop['ORIGIN']);
                            if (isset($hop['TYPE'])) $vf['TYPE'] = sterilize($hop['TYPE']);
                            if (isset($hop['FORM'])) $vf['FORM'] = sterilize($hop['FORM']);
                            if (isset($hop['HOP_TEMP'])) $vf['HOP_TEMP'] = xml_number($hop['HOP_TEMP'], 0, "temperature");
                            if (isset($hop['TEMPERATURE'])) $vf['TEMPERATURE'] = xml_number($hop['TEMPERATURE'], 0, "temperature");
                            if (isset($hop['NOTES'])) $vf['NOTES'] = clean_text($hop['NOTES']);
                            if (isset($hop['BETA'])) $vf['BETA'] = xml_number($hop['BETA'], 1);
                            if (isset($hop['HSI'])) $vf['HSI'] = xml_number($hop['HSI'], 1);
                            if (isset($hop['SUBSTITUTES'])) $vf['SUBSTITUTES'] = clean_text($hop['SUBSTITUTES']);
                            if (isset($hop['HUMULENE'])) $vf['HUMULENE'] = xml_number($hop['HUMULENE'], 1);
                            if (isset($hop['CARYOPHYLLENE'])) $vf['CARYOPHYLLENE'] = xml_number($hop['CARYOPHYLLENE'], 1);
                            if (isset($hop['COHUMULONE'])) $vf['COHUMULONE'] = xml_number($hop['COHUMULONE'], 1);
                            if (isset($hop['MYRCENE'])) $vf['MYRCENE'] = xml_number($hop['MYRCENE'], 1);

                            $brewHops["hop".$hops_count++] = $vf;

                        }

                    }
                    
                }

                if (!empty($brewHops)) $brewHops = json_encode($brewHops);
                else $brewHops = "";

                // ------------ Miscs ------------

                $miscs_count = 0;
                
                if (isset($rec['MISCS'])) {

                    $miscs = $rec['MISCS'];

                    foreach ($miscs['MISC'] as $misc) {

                        $vf = array();

                        if (isset($misc['NAME'])) {

                            $vf['NAME'] = clean_text($misc['NAME']);
                            $vf['VERSION'] = sterilize($misc['VERSION']);

                            if ((isset($misc['AMOUNT_IS_WEIGHT'])) && (!empty($misc['AMOUNT_IS_WEIGHT'])) && (strtoupper($misc['AMOUNT_IS_WEIGHT']) == "TRUE")) $vf['AMOUNT'] = xml_number($misc['AMOUNT'], 6, "weight");                        
                            else $vf['AMOUNT'] = xml_number($misc['AMOUNT'], 6, "volume");
                            
                            $vf['TYPE'] = sterilize($misc['TYPE']);
                            $vf['USE'] = sterilize($misc['USE']);
                            $vf['TIME'] = sterilize($misc['TIME']);
                            if (isset($misc['USE_FOR'])) $vf['USE_FOR'] = clean_text($misc['USE_FOR']);
                            if (isset($misc['NOTES'])) $vf['NOTES'] = clean_text($misc['NOTES']);
                            if (isset($misc['AMOUNT_IS_WEIGHT'])) $vf['AMOUNT_IS_WEIGHT'] = strtoupper(sterilize($misc['AMOUNT_IS_WEIGHT']));
                            
                            // Optional Extension
                            if (isset($misc['DISPLAY_AMOUNT'])) $vf['DISPLAY_AMOUNT'] = clean_text($misc['DISPLAY_AMOUNT']);

                            $brewMiscs["misc".$miscs_count++] = $vf;

                        }
                        
                    }

                }

                if (!empty($brewMiscs)) $brewMiscs = json_encode($brewMiscs);
                else $brewMiscs = "";

                // ------------ Yeasts ------------

                $yeasts_count = 0;

                if (isset($rec['YEASTS'])) {

                    $yeasts = $rec['YEASTS'];

                    foreach ($yeasts['YEAST'] as $yeast) {

                        $vf = array();
                        
                        if (isset($yeast['NAME'])) {

                            if (isset($yeast['NAME'])) $vf['NAME'] = clean_text($yeast['NAME']);
                            if (isset($yeast['VERSION'])) $vf['VERSION'] = sterilize($yeast['VERSION']);
                            if (isset($yeast['TYPE'])) $vf['TYPE'] = sterilize($yeast['TYPE']);
                            if (isset($yeast['FORM'])) $vf['FORM'] = sterilize($yeast['FORM']);       
                            
                            if ((isset($yeast['AMOUNT_IS_WEIGHT'])) && (!empty($yeast['AMOUNT_IS_WEIGHT'])) && (strtoupper($yeast['AMOUNT_IS_WEIGHT']) == "TRUE")) $vf['AMOUNT'] = xml_number($yeast['AMOUNT'], 6, "weight");                        
                            else $vf['AMOUNT'] = xml_number($yeast['AMOUNT'], 6, "volume");

                            // Not required
                            if ((isset($yeast['LABORATORY'])) && (!empty($yeast['LABORATORY']))) $vf['LABORATORY'] = clean_text($yeast['LABORATORY']);
                            if ((isset($yeast['PRODUCT_ID'])) && (!empty($yeast['PRODUCT_ID']))) $vf['PRODUCT_ID'] = clean_text($yeast['PRODUCT_ID']);
                            if ((isset($yeast['MIN_TEMPERATURE'])) && (!empty($yeast['MIN_TEMPERATURE']))) convertUnit($vf['MIN_TEMPERATURE'] = sterilize($yeast['MIN_TEMPERATURE']),"temperature");
                            if ((isset($yeast['MAX_TEMPERATURE'])) && (!empty($yeast['MAX_TEMPERATURE']))) convertUnit($vf['MAX_TEMPERATURE'] = sterilize($yeast['MAX_TEMPERATURE']),"temperature");
                            if ((isset($yeast['FLOCCULATION'])) && (!empty($yeast['FLOCCULATION']))) $vf['FLOCCULATION'] = sterilize($yeast['FLOCCULATION']);
                            if ((isset($yeast['ATTENUATION'])) && (!empty($yeast['ATTENUATION']))) $vf['ATTENUATION'] = xml_number($yeast['ATTENUATION'], 1);
                            if ((isset($yeast['NOTES'])) && (!empty($yeast['NOTES']))) $vf['NOTES'] = clean_text($yeast['NOTES']);
                            if ((isset($yeast['BEST_FOR'])) && (!empty($yeast['BEST_FOR']))) $vf['BEST_FOR'] = clean_text($yeast['BEST_FOR']);
                            if ((isset($yeast['MAX_REUSE'])) && (!empty($yeast['MAX_REUSE']))) $vf['MAX_REUSE'] = sterilize($yeast['MAX_REUSE']);
                            if ((isset($yeast['TIMES_CULTURED'])) && (!empty($yeast['']))) $vf['TIMES_CULTURED'] = sterilize($yeast['TIMES_CULTURED']);
                            if ((isset($yeast['ADD_TO_SECONDARY'])) && (!empty($yeast['ADD_TO_SECONDARY']))) $vf['ADD_TO_SECONDARY'] = strtoupper(sterilize($yeast['ADD_TO_SECONDARY']));
                            if ((isset($yeast['AMOUNT_IS_WEIGHT'])) && (!empty($yeast['AMOUNT_IS_WEIGHT']))) $vf['AMOUNT_IS_WEIGHT'] = strtoupper(sterilize($yeast['AMOUNT_IS_WEIGHT']));

                            /*
                            // Extensions
                            if ((isset($yeast['CULTURE_DATE'])) && (!empty($yeast['CULTURE_DATE']))) $vf['CULTURE_DATE'] = sterilize($yeast['CULTURE_DATE']);
                            if ((isset($yeast['DISPLAY_AMOUNT'])) && (!empty($yeast['DISPLAY_AMOUNT']))) $vf['DISPLAY_AMOUNT'] = sterilize($yeast['DISPLAY_AMOUNT']);
                            if ((isset($yeast['DISPLAY_MIN_TEMP'])) && (!empty($yeast['DISPLAY_MIN_TEMP']))) $vf['DISPLAY_MIN_TEMP'] = xml_number($yeast['DISPLAY_MIN_TEMP'], NULL, "temperature");
                            if ((isset($yeast['DISPLAY_MAX_TEMP'])) && (!empty($yeast['DISPLAY_MAX_TEMP']))) $vf['DISPLAY_MAX_TEMP'] = xml_number($yeast['DISPLAY_MAX_TEMP'], NULL, "temperature");
                            if ((isset($yeast['INVENTORY'])) && (!empty($yeast['INVENTORY']))) $vf['INVENTORY'] = sterilize($yeast['INVENTORY']);
                            */
                            
                            $brewYeasts["yeast".$yeasts_count++] = $vf;

                        }

                    }

                }

                if (!empty($brewYeasts)) $brewYeasts = json_encode($brewYeasts);
                else $brewYeasts = "";

                // ------------ Mash ------------

                if (isset($rec['MASH'])) {

                    $mash_step_count = 0;

                    $vf = array();

                    foreach ($rec['MASH'] as $mash) {

                        if (isset($mash['NAME'])) {

                            $vf['NAME'] = clean_text($mash['NAME']);
                            $vf['VERSION'] = sterilize($mash['VERSION']);
                            $vf['GRAIN_TEMP'] = xml_number($mash['GRAIN_TEMP'], 0, "temperature");
                            if ((isset($mash['NOTES'])) && (!empty($mash['NOTES']))) $vf['NOTES'] = clean_text($mash['NOTES']);
                            if ((isset($mash['TUN_TEMP'])) && (!empty($mash['TUN_TEMP']))) $vf['TUN_TEMP'] = xml_number($mash['TUN_TEMP'], 0, "temperature"); 
                            if ((isset($mash['SPARGE_TEMP'])) && (!empty($mash['SPARGE_TEMP']))) $vf['SPARGE_TEMP'] = xml_number($mash['SPARGE_TEMP'], 0, "temperature");
                            if ((isset($mash['PH'])) && (!empty($mash['PH']))) $vf['PH'] = xml_number($mash['PH'], 2);
                            if ((isset($mash['TUN_WEIGHT'])) && (!empty($mash['TUN_WEIGHT']))) $vf['TUN_WEIGHT'] = xml_number($mash['TUN_WEIGHT'], 2, "weight");
                            if ((isset($mash['TUN_SPECIFIC_HEAT'])) && (!empty($mash['TUN_SPECIFIC_HEAT']))) $vf['TUN_SPECIFIC_HEAT'] = sterilize($mash['TUN_SPECIFIC_HEAT']);
                            if ((isset($mash['EQUIP_ADJUST'])) && (!empty($mash['EQUIP_ADJUST']))) $vf['EQUIP_ADJUST'] = sterilize($mash['EQUIP_ADJUST']);
                            
                            if ((isset($mash['MASH_STEPS'])) && (!empty($mash['MASH_STEPS']))) {

                                $mash_steps = array();
                                    
                                foreach ($mash['MASH_STEPS'] as $mash_step_arr) {

                                    foreach ($mash_step_arr as $key => $mash_step) {

                                        foreach ($mash_step as $ms_name) {
                                            
                                            $ms = array();

                                            if (isset($ms_name['NAME'])) {
                                                
                                                $ms['NAME'] = clean_text($ms_name['NAME']);
                                                if (isset($ms_name['VERSION'])) $ms['VERSION'] = sterilize($ms_name['VERSION']);
                                                if (isset($ms_name['TYPE'])) $ms['TYPE'] = sterilize($ms_name['TYPE']);
                                                if (isset($ms_name['STEP_TEMP'])) $ms['STEP_TEMP'] = xml_number($ms_name['STEP_TEMP'], NULL, "temperature");
                                                if (isset($ms_name['STEP_TIME'])) $ms['STEP_TIME'] = sterilize($ms_name['STEP_TIME']);
                                                if (isset($ms_name['RAMP_TIME'])) $ms['RAMP_TIME'] = sterilize($ms_name['RAMP_TIME']);
                                                if (isset($ms_name['END_TEMP'])) $ms['END_TEMP'] = xml_number($ms_name['END_TEMP'], NULL, "temperature");

                                                $mash_steps["mash_step".$mash_step_count++] = $ms;
                                            
                                            } // end if (isset($ms_name['NAME']))
                                        
                                        } // end foreach ($mash_step as $ms_name)

                                    } // end foreach ($mash_step_arr as $key => $mash_step)
                                    
                                } // end foreach ($mash['MASH_STEPS'] as $mash_step_arr)

                                $vf['MASH_STEPS'] = $mash_steps;

                            } // end if ((isset($mash['MASH_STEPS'])) && (!empty($mash['MASH_STEPS']))) 

                            $brewMash = $vf;
                        
                        } // end if (isset($mash['NAME']))

                    } // end foreach ($rec['MASH'] as $mash)             

                } // end if (isset($rec['MASH']))

                if (!empty($brewMash)) $brewMash = json_encode($brewMash);
                else $brewMash = "";

                // ------------ Equipment ------------
                
                if (isset($rec['EQUIPMENT'])) {

                    $vf = array();

                    if (isset($rec['EQUIPMENT']['NAME'])) {

                        $vf['NAME'] = clean_text($rec['EQUIPMENT']['NAME']);
                        $vf['VERSION'] = sterilize($rec['EQUIPMENT']['VERSION']);
                        $vf['BOIL_SIZE'] = xml_number($rec['EQUIPMENT']['BOIL_SIZE'], 2, "volume");
                        $vf['BATCH_SIZE'] = xml_number($rec['EQUIPMENT']['BATCH_SIZE'], 2, "volume");
                        
                        if ((isset($rec['EQUIPMENT']['TUN_VOLUME'])) && (!empty($rec['EQUIPMENT']['TUN_VOLUME']))) $vf['TUN_VOLUME'] = xml_number($rec['EQUIPMENT']['TUN_VOLUME'], 2, "volume");
                        if ((isset($rec['EQUIPMENT']['TUN_WEIGHT'])) && (!empty($rec['EQUIPMENT']['TUN_WEIGHT']))) $vf['TUN_WEIGHT'] = xml_number($rec['EQUIPMENT']['TUN_WEIGHT'], 2, "weight");
                        if ((isset($rec['EQUIPMENT']['TUN_SPECIFIC_HEAT'])) && (!empty($rec['EQUIPMENT']['TUN_SPECIFIC_HEAT']))) $vf['TUN_SPECIFIC_HEAT'] = sterilize($rec['EQUIPMENT']['TUN_SPECIFIC_HEAT']);
                        if ((isset($rec['EQUIPMENT']['TOP_UP_WATER'])) && (!empty($rec['EQUIPMENT']['TOP_UP_WATER']))) $vf['TOP_UP_WATER'] = xml_number($rec['EQUIPMENT']['TOP_UP_WATER'], 2, "volume");
                        if ((isset($rec['EQUIPMENT']['TRUB_CHILLER_LOSS'])) && (!empty($rec['EQUIPMENT']['TRUB_CHILLER_LOSS']))) $vf['TRUB_CHILLER_LOSS'] = xml_number($rec['EQUIPMENT']['TRUB_CHILLER_LOSS'], 2, "volume");
                        if ((isset($rec['EQUIPMENT']['EVAP_RATE'])) && (!empty($rec['EQUIPMENT']['EVAP_RATE']))) $vf['EVAP_RATE'] = xml_number($rec['EQUIPMENT']['EVAP_RATE'], 2);
                        if ((isset($rec['EQUIPMENT']['BOIL_TIME'])) && (!empty($rec['EQUIPMENT']['BOIL_TIME']))) $vf['BOIL_TIME'] = sterilize($rec['EQUIPMENT']['BOIL_TIME']);
                        if ((isset($rec['EQUIPMENT']['LAUTER_DEADSPACE'])) && (!empty($rec['EQUIPMENT']['LAUTER_DEADSPACE']))) $vf['LAUTER_DEADSPACE'] = xml_number($rec['EQUIPMENT']['LAUTER_DEADSPACE'], 2, "volume");
                        if ((isset($rec['EQUIPMENT']['TOP_UP_KETTLE'])) && (!empty($rec['EQUIPMENT']['TOP_UP_KETTLE']))) $vf['TOP_UP_KETTLE'] = xml_number($rec['EQUIPMENT']['TOP_UP_KETTLE'], 2, "volume");
                        if ((isset($rec['EQUIPMENT']['HOP_UTILIZATION'])) && (!empty($rec['EQUIPMENT']['HOP_UTILIZATION']))) $vf['HOP_UTILIZATION'] = sterilize($rec['EQUIPMENT']['HOP_UTILIZATION']);
                        if ((isset($rec['EQUIPMENT']['NOTES'])) && (!empty($rec['EQUIPMENT']['NOTES']))) $vf['NOTES'] = clean_text($rec['EQUIPMENT']['NOTES']);
                        
                        $brewEquipment = $vf;
                    
                    }

                }

                if (!empty($brewEquipment)) $brewEquipment = json_encode($brewEquipment);
                else $brewEquipment = "";

                // ------------ Water ------------

                $waters_count = 0;

                if (isset($rec['WATERS'])) {

                    $waters = $rec['WATERS'];

                    foreach ($waters['WATER'] as $water) {

                        $vf = array();

                        $vf['NAME'] = clean_text($water['NAME']);
                        $vf['VERSION'] = sterilize($water['VERSION']);
                        if ((isset($water['AMOUNT'])) && (!empty($water['AMOUNT']))) $vf['AMOUNT'] = xml_number($water['AMOUNT'], 2, "volume");
                        if ((isset($water['CALCIUM'])) && (!empty($water['CALCIUM']))) $vf['CALCIUM'] = xml_number($water['CALCIUM'], 2);
                        if ((isset($water['BICARBONATE'])) && (!empty($water['BICARBONATE']))) $vf['BICARBONATE'] = xml_number($water['BICARBONATE'], 2);
                        if ((isset($water['SULFATE'])) && (!empty($water['SULFATE']))) $vf['SULFATE'] = xml_number($water['SULFATE'], 2);
                        if ((isset($water['CHLORIDE'])) && (!empty($water['CHLORIDE']))) $vf['CHLORIDE'] = xml_number($water['CHLORIDE'], 2);
                        if ((isset($water['SODIUM'])) && (!empty($water['SODIUM']))) $vf['SODIUM'] = xml_number($water['SODIUM'], 2);
                        if ((isset($water['MAGNESIUM'])) && (!empty($water['MAGNESIUM']))) $vf['MAGNESIUM'] = xml_number($water['MAGNESIUM'], 2);
                        if ((isset($water['PH'])) && (!empty($water['PH']))) $vf['PH'] = xml_number($water['PH'], 2);
                        if ((isset($water['NOTES'])) && (!empty($water['NOTES']))) $vf['NOTES'] = clean_text($water['NOTES']);

                        $brewWater["water".$waters_count++] = $vf;

                    }

                }  
                
                if (!empty($brewWater)) $brewWater = json_encode($brewWater);
                else $brewWater = "";


                // ------------ Primary, Secondary, Tertiary, Age ------------

                if ((isset($rec['PRIMARY_AGE'])) && (!empty($rec['PRIMARY_AGE']))) {
                    $brewPrimary['PRIMARY_AGE'] = xml_number($rec['PRIMARY_AGE'], 0);
                    if ((isset($rec['PRIMARY_TEMP'])) && (!empty($rec['PRIMARY_TEMP']))) $brewPrimary['PRIMARY_TEMP'] = xml_number($rec['PRIMARY_TEMP'], 0, "temperature");
                }
                if (!empty($brewPrimary)) $brewPrimary = json_encode($brewPrimary);
                else $brewPrimary = "";

                if ((isset($rec['SECONDARY_AGE'])) && (!empty($rec['SECONDARY_AGE']))) {
                    $brewSecondary['SECONDARY_AGE'] = xml_number($rec['SECONDARY_AGE'], 0);
                    if ((isset($rec['SECONDARY_TEMP'])) && (!empty($rec['SECONDARY_TEMP']))) $brewSecondary['SECONDARY_TEMP'] = xml_number($rec['SECONDARY_TEMP'], 0, "temperature");
                }
                if (!empty($brewSecondary)) $brewSecondary = json_encode($brewSecondary);
                else $brewSecondary = "";

                if ((isset($rec['TERTIARY_AGE'])) && (!empty($rec['TERTIARY_AGE']))) {
                    $brewTertiary['TERTIARY_AGE'] = xml_number($rec['TERTIARY_AGE'], 0);
                    if ((isset($rec['TERTIARY_TEMP'])) && (!empty($rec['TERTIARY_TEMP']))) $brewTertiary['TERTIARY_TEMP'] = xml_number($rec['TERTIARY_TEMP'], 0, "temperature");
                }
                if (!empty($brewTertiary)) $brewTertiary = json_encode($brewTertiary);
                else $brewTertiary = "";

                if ((isset($rec['AGE'])) && (!empty($rec['AGE']))) {
                    $brewAge['AGE'] = xml_number($rec['AGE'], 0);
                    if ((isset($rec['AGE_TEMP'])) && (!empty($rec['AGE_TEMP']))) $brewAge['AGE_TEMP'] = xml_number($rec['AGE_TEMP'], 0, "temperature");
                }
                if (!empty($brewAge)) $brewAge = json_encode($brewAge);
                else $brewAge = "";

                // ------------ Add record to DB ------------
                $update_table = "brewblogs";
                $data = array(
                    'brewName' => blank_to_null($brewName),
                    'brewDate' => time(),
                    'brewInfo' => blank_to_null($brewInfo),
                    'brewMethod' => blank_to_null($brewMethod),
                    'brewStyle' => blank_to_null($brewStyle),
                    'brewBrewerID' => blank_to_null($brewBrewerID),
                    'brewBatchSize' => blank_to_null($brewBatchSize),
                    'brewBoilSize' => blank_to_null($brewBoilSize),
                    'brewBoilTime' => blank_to_null($brewBoilTime),
                    'brewEfficiency' => blank_to_null($brewEfficiency),
                    'brewOG' => blank_to_null($brewOG),
                    'brewFG' => blank_to_null($brewFG),
                    'brewABV' => blank_to_null($brewABV),
                    'brewIBU' => blank_to_null($brewIBU),
                    'brewColor' => blank_to_null($brewColor),
                    'brewCarbonation' => blank_to_null($brewCarbonation),
                    'brewHops' => blank_to_null($brewHops),
                    'brewFermentables' => blank_to_null($brewFermentables),
                    'brewMiscs' => blank_to_null($brewMiscs),
                    'brewYeasts' => blank_to_null($brewYeasts),
                    'brewMash' => blank_to_null($brewMash),
                    'brewEquipment' => blank_to_null($brewEquipment),
                    'brewWater' => blank_to_null($brewWater),
                    'brewPrimary' => blank_to_null($brewPrimary),
                    'brewSecondary' => blank_to_null($brewSecondary),
                    'brewTertiary' => blank_to_null($brewTertiary),
                    'brewAge' => blank_to_null($brewAge)
                );
                
                $result = $db_conn->insert($update_table, $data);
                
                if ($result) {
                    $query_brew_id = sprintf("SELECT id FROM `brewblogs` WHERE brewBrewerID='%s' ORDER BY id DESC LIMIT 1",$brewBrewerID);
                    $brew_id = mysqli_query($connection,$query_brew_id) or die (mysqli_error($connection));
                    $row_brew_id = mysqli_fetch_assoc($brew_id);
                    $id = $row_brew_id['id'];
                    $imported[$id] = $brewName;
                }

                else {
                    $error_output[] = $db_conn->getLastError();
                    $errors = TRUE;
                }

                

                /*
                
                ///////////////////////////////////////////////////////////////////
                // DISPLAY - Move to appropriate display code area.
                //////////////////////////////////////////////////////////////////

                // Style Display
                $brewStyle_display = json_decode($brewStyle, true);

                echo "<h3>".$brewName;
                if (!empty($brewStyle_display)) echo " <small><em>".$brewStyle_display['NAME']." (".$brewStyle_display['STYLE_GUIDE']." ".$brewStyle_display['CATEGORY_NUMBER'].$brewStyle_display['STYLE_LETTER'].")</em></small>";
                if (!empty($brewSource)) echo "<br><small>".$brewSource."</em></small>";                
                echo "</h3>";

                echo "<p>";
                if (!empty($brewInfo)) echo $brewInfo."<br>";
                
                if (!empty($brewBatchSize)) echo $brewBatchSize." ".$_SESSION['measFluid2']."<br>";   
                if (!empty($brewMethod)) echo $brewMethod."<br>";
                if (!empty($brewOG)) echo "OG: ".$brewOG."<br>";
                if (!empty($brewFG)) echo "FG: ".$brewFG."<br>";
                if (!empty($brewColor)) echo "Color: ".$brewColor." ".$_SESSION['measColor']."<br>";
                if (!empty($brewABV)) echo "ABV: ".$brewABV."%<br>";
                if (!empty($brewIBU)) echo "IBU: ".$brewIBU."<br>";
                if (!empty($brewBoilSize)) echo "Boil Size: ".$brewBoilSize." ".$_SESSION['measFluid2']."<br>";
                if (!empty($brewBoilTime)) echo "Boil Time: ".$brewBoilTime." minutes<br>";
                if (!empty($brewEfficiency)) echo "Efficiency: ".$brewEfficiency."%<br>";
                if (!empty($brewCarbonation)) echo "Carbonation: ".$brewCarbonation." Vols<br>";
                echo "</p>";

                // Fermentables display
                $brewFermentables_display = json_decode($brewFermentables, true);
                $fermentables_count = 1;

                if (!empty($brewFermentables_display)) {

                    echo "<h4>Fermentables</h4>";

                    foreach ($brewFermentables_display as $key => $fermentable) {

                        echo "<p>";
                        echo sterilize($fermentable['AMOUNT'])." ".$_SESSION['measWeight2']." ".sterilize($fermentable['NAME'])." (".sterilize($fermentable['SUPPLIER']).")<br>";

                        echo sterilize($fermentable['TYPE'])."<br>";
                        echo sterilize($fermentable['COLOR'])." SRM<br>";
                        echo "</p>";

                    }
                
                }

                // Hops dislpay
                $brewHops_display = json_decode($brewHops, true);
                $hops_count = 1;

                if (!empty($brewHops_display)) {

                    echo "<h4>Hops</h4>";

                    foreach ($brewHops_display as $key => $hop) {

                        $hop_temp = FALSE;
                        echo "<p>";
                        echo "<strong>Hop Addition ".$hops_count++.": ".strtr(sterilize($hop['NAME']), $html_string)."</strong><br>";
                        //echo sterilize($hop['VERSION'])."<br>";
                        echo sterilize($hop['ALPHA'])."<br>";
                        echo sterilize($hop['AMOUNT'])." ".$_SESSION['measWeight1']."<br>";
                        echo sterilize($hop['USE'])."<br>";
                        echo sterilize($hop['TIME'])."<br>";
                        if (isset($hop['FORM'])) echo sterilize($hop['FORM'])."<br>";
                        if ((isset($hop['TEMPERATURE'])) && (!empty($hop['TEMPERATURE']))) {
                            $hop_temp = TRUE;
                            echo sterilize($hop['TEMPERATURE'])."&deg; ".$_SESSION['measTemp']."<br>";
                        }
                        if (((isset($hop['HOP_TEMP'])) && (!empty($hop['HOP_TEMP']))) && (!$hop_temp)) echo sterilize($hop['HOP_TEMP'])."&deg; ".$_SESSION['measTemp']."<br>";
                        if (isset($hop['ORIGIN'])) echo clean_text($hop['ORIGIN'])."<br>";
                        if (isset($hop['TYPE'])) echo sterilize($hop['TYPE'])."<br>";

                        echo "</p>";
                        
                    }

                }

                // Miscs dislpay
                $brewMiscs_display = json_decode($brewMiscs, true);

                if (!empty($brewMiscs_display)) {

                    echo "<h4>Non-fermentable Miscellaneous Ingredients</h4>";

                    foreach ($brewMiscs_display as $key => $misc) {

                        echo "<p>";
                        if (isset($misc['DISPLAY_AMOUNT'])) echo sterilize($misc['DISPLAY_AMOUNT'])." ";
                        else echo sterilize($misc['AMOUNT'])." ";
                        echo sterilize($misc['NAME'])."<br>";
                        echo sterilize($misc['TYPE'])."<br>";
                        echo sterilize($misc['USE'])."<br>";
                        echo sterilize($misc['TIME'])." minutes<br>";
                        echo "</p>";

                    }
                
                }

                // Yeasts dislpay
                $brewYeasts_display = json_decode($brewYeasts, true);

                if (!empty($brewYeasts_display)) {

                    echo "<h4>Yeasts</h4>";

                    foreach ($brewYeasts_display as $key => $yeast) {

                        echo "<p>";
                        if (isset($yeast['DISPLAY_AMOUNT'])) echo sterilize($yeast['DISPLAY_AMOUNT'])." ";
                        else echo sterilize($yeast['AMOUNT'])." ";
                        echo sterilize($yeast['NAME'])."<br>";
                        if (isset($yeast['PRODUCT_ID'])) echo clean_text($yeast['PRODUCT_ID'])."<br>";
                        echo sterilize($yeast['TYPE'])."<br>";
                        echo sterilize($yeast['FORM'])."<br>";
                        
                        echo "</p>";

                    }
                
                }

                // Mash dislpay
                $brewMash_display = json_decode($brewMash, true);

                if (!empty($brewMash_display)) {

                    echo "<h4>Mash</h4>";
                    echo "<p>";
                    echo sterilize($brewMash_display['NAME'])."<br>";
                    echo sterilize($brewMash_display['GRAIN_TEMP'])."<br>";
                    if ((isset($brewMash_display['NOTES'])) && (!empty($brewMash_display['NOTES']))) echo sterilize($brewMash_display['NOTES'])."<br>";
                    if ((isset($brewMash_display['TUN_TEMP'])) && (!empty($brewMash_display['TUN_TEMP']))) echo sterilize($brewMash_display['TUN_TEMP'])."<br>"; 
                    if ((isset($brewMash_display['SPARGE_TEMP'])) && (!empty($brewMash_display['SPARGE_TEMP']))) echo sterilize($brewMash_display['SPARGE_TEMP'])."<br>";
                    if ((isset($brewMash_display['PH'])) && (!empty($brewMash_display['PH']))) echo sterilize($brewMash_display['PH'])."<br>";
                    if ((isset($brewMash_display['TUN_WEIGHT'])) && (!empty($brewMash_display['TUN_WEIGHT']))) echo sterilize($brewMash_display['TUN_WEIGHT'])."<br>";
                    if ((isset($brewMash_display['TUN_SPECIFIC_HEAT'])) && (!empty($brewMash_display['TUN_SPECIFIC_HEAT']))) echo sterilize($brewMash_display['TUN_SPECIFIC_HEAT'])."<br>";
                    if ((isset($brewMash_display['EQUIP_ADJUST'])) && (!empty($brewMash_display['EQUIP_ADJUST']))) echo sterilize($brewMash_display['EQUIP_ADJUST'])."<br>";
                    if ((isset($brewMash_display['MASH_STEPS'])) && (!empty($brewMash_display['MASH_STEPS']))) {

                        foreach ($brewMash_display['MASH_STEPS'] as $mash) {

                             echo "<strong>Step: ".sterilize($mash['NAME'])."</strong>";
                             echo "<ul>";
                             if (isset($mash['STEP_TEMP'])) echo "<li>".$mash['STEP_TEMP']."&deg; ".$_SESSION['measTemp']."</li>";
                             if (isset($mash['STEP_TIME'])) echo "<li>".$mash['STEP_TIME']." minutes</li>";
                             echo "</ul>";
                            
                        }

                    }
                
                    echo "</p>";
                }

                // Equipment display
                if (!empty($brewEquipment)) {
                    $brewEquipment_display = json_decode($brewEquipment, true);
                    echo "<h4>Equipment</h4>";
                    echo "<p>";
                    echo sterilize($brewEquipment_display['NAME'])."<br>";
                    echo sterilize($brewEquipment_display['BOIL_SIZE'])."<br>";
                    echo sterilize($brewEquipment_display['BATCH_SIZE'])."<br>";
                    echo "</p>";
                }

                $brew_fermentation_display = "";

                if (!empty($brewPrimary)) {
                    $brewPrimary_display = json_decode($brewPrimary, true);
                    $brew_fermentation_display .=  "<p>Primary: ";
                    $brew_fermentation_display .=  sterilize($brewPrimary_display['PRIMARY_AGE'])." days";
                    if (isset($brewPrimary_display['PRIMARY_TEMP'])) $brew_fermentation_display .=  " @ ".sterilize($brewPrimary_display['PRIMARY_TEMP'])."&deg; ".$_SESSION['measTemp']."<br>";
                    $brew_fermentation_display .=  "</p>";
                }

                if (!empty($brewSecondary)) {
                    $brewSecondary_display = json_decode($brewSecondary, true);
                    $brew_fermentation_display .=  "<p>Secondary: ";
                    $brew_fermentation_display .=  sterilize($brewSecondary_display['SECONDARY_AGE'])." days";
                    if (isset($brewSecondary_display['SECONDARY_TEMP'])) $brew_fermentation_display .=  " @ ".sterilize($brewSecondary_display['SECONDARY_TEMP'])."&deg; ".$_SESSION['measTemp']."<br>";
                    $brew_fermentation_display .=  "</p>";
                }

                if (!empty($brewTertiary)) {
                    $brewTertiary_display = json_decode($brewTertiary, true);
                    $brew_fermentation_display .=  "<p>Tertiary: ";
                    $brew_fermentation_display .=  sterilize($brewTertiary_display['TERTIARY_AGE'])." days";
                    if (isset($brewTertiary_display['TERTIARY_TEMP'])) $brew_fermentation_display .=  " @ ".sterilize($brewTertiary_display['TERTIARY_TEMP'])."&deg; ".$_SESSION['measTemp']."<br>";
                    $brew_fermentation_display .=  "</p>";
                }

                if (!empty($brewAge)) {
                    $brewAge_display = json_decode($brewAge, true);
                    $brew_fermentation_display .=  "<p>Age: ";
                    $brew_fermentation_display .=  sterilize($brewAge_display['AGE'])." days";
                    if (isset($brewAge_display['AGE_TEMP'])) $brew_fermentation_display .=  " @ ".sterilize($brewAge_display['AGE_TEMP'])."&deg; ".$_SESSION['measTemp']."<br>";
                    $brew_fermentation_display .=  "</p>";
                }

                if (!empty($brew_fermentation_display)) {
                    echo "<h4>Fermentation/Aging</h4>";
                    echo $brew_fermentation_display;
                }

                */
            
            }

            
        }
   
    } // end elseif (is_uploaded_file($_FILES['userfile']['tmp_name']))

}

else if ((isset($_FILES['userfile'])) && (!$_FILES['userfile'])) $message = "userfile check failed";
else $message = "Invalid file type. Must be an .xml or .txt file.";

?>

<form name="upload" id="upload" ENCTYPE="multipart/form-data" method="post">
    <div id="alert-container"></div>
    <input class="form-control texta" name="userfile" type="file" id="userfile">
    <input type="submit" class="btn btn-primary mt-3" value="Process BeerXML File" disabled>
</form>

<script>
    $(document).ready(function() {
        
        $('#userfile').on('change', function() {

            var fileName = $(this).val();
            var fileExtension = fileName.split('.').pop().toLowerCase();
            
            $('#alert-container').empty();
            
            if (fileExtension === 'xml' || fileExtension === 'txt') {
               
                $('input[type="submit"]').prop('disabled', false);
            
            } else {
                
                $('input[type="submit"]').prop('disabled', true);
                
                if (fileName) {
                    
                    var alertHtml = 
                                '<div class="alert alert-danger alert-dismissible" role="alert">' +
                                '<strong>Invalid file type!</strong> Please select a file with an .xml or .txt extension.' +
                                '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>' +
                                '</div>'
                    ;
                    
                    $('#alert-container').hide().html(alertHtml).fadeIn(300);
                
                }
            
            }

        });

    });
</script>

<?php 

    $imported_list = "";
    
    if (isset($_REQUEST['message'])) $imported_list .= "<p>".$_REQUEST['message']."</p>";  
    
    if ((isset($imported)) && (!empty($imported))) { 
        
        $imported_list .= "<h3>Imported File(s)</h3>";
        $imported_list .= "<ul class=\"list-unstyled\">";
        
        foreach ($imported as $key => $value) {
            
            $edit_href_1 = build_public_url("admin", "brewblogs", "edit", "brewblogs", "all", $key, $base_url);
            $edit_href_2 = build_public_url("admin", "brewblogs", "edit", "brewblogs", "essentials", $key, $base_url);
            
            $actions_links_edit_1 = "<a href=\"".$edit_href_1."\"><span class=\"fa fa-pencil\"></span> Edit ".$value." - All Info</a>";
            $actions_links_edit_2 = "<a href=\"".$edit_href_2."\"><span class=\"fa fa-edit\"></span> Edit ".$value." - Essential Info Only</a>";
            
            $imported_list .= "<li>".$actions_links_edit_1."</li>";
            $imported_list .= "<li>".$actions_links_edit_2."</li>";

        }

        $imported_list .= "</ul>";
    }

    echo $imported_list;

} 

else echo "<p>Your server's version of PHP does not support the BeerXML import feature. PHP version 7.x or higher is required &mdash; this server is running PHP version ".$phpVersion.".</p>";
?>