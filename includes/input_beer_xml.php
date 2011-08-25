<?php
/* vim: set expandtab tabstop=4 shiftwidth=4 foldmethod=marker: */
//{{{ License
// +------------------------------------------------------------------------+
// | Input Beer XML - takes recipes objects from BeerXMLParser              |
// |                     and inserts recipes into database                  |
// | 							                                            |
// | NOTES - measurements in METRIC                 			            |
// +------------------------------------------------------------------------+
// | This program is free software; you can redistribute it and/or          |
// | modify it under the terms of the GNU General Public License            |
// | as published by the Free Software Foundation; either version 2         |
// | of the License, or (at your option) any later version.                 |
// |                                                                        |
// | This program is distributed in the hope that it will be useful,        |
// | but WITHOUT ANY WARRANTY; without even the implied warranty of         |
// | MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the          |
// | GNU General Public License for more details.                           |
// |                                                                        |
// | You should have received a copy of the GNU General Public License      |
// | along with this program; if not, write to the Free Software            |
// | Foundation, Inc., 59 Temple Place - Suite 330,                         |
// | Boston, MA  02111-1307, USA.                                           |
// +------------------------------------------------------------------------+
// | Author: Oskar Stephens <oskar.stephens@gmail.com>	                    |
// +------------------------------------------------------------------------+
//}}}

require ('../../paths.php');
require_once (CONFIG.'config.php'); 
include ('parse_beer_xml.inc.php');

//{{{ InputBeerXML
class InputBeerXML {
    public $recipes;
    public $insertedRecipes;
    public $brewer;
    //{{{InputBeerXML
    function InputBeerXML($filename) {
        $this->brewer = $GLOBALS['loginUsername'];
        $this->recipes = new BeerXMLParser($filename);
    }
    //}}}

    //{{{ insertRecipes
    function insertRecipes(){
        foreach($this->recipes->recipes as $recipe){
            $this->insertRecipe($recipe);
        }
        return $this->insertedRecipes;
    }
    //}}}

    //{{{ insertRecipe
    function insertRecipe($recipe){
        $brewing = mysql_connect($GLOBALS['hostname_brewblog'], $GLOBALS['username_brewblog'], $GLOBALS['password_brewblog']) or trigger_error(mysql_error());
        $sqlQuery = "INSERT INTO recipes ";
        $fields = "(brewName";
        $values = " VALUES('" . $recipe->name . "'";
        $vf = array();
        $counter = array();

        //$vf["brewName"] = $recipe->name;
        $vf["brewStyle"] = $recipe->style->name;
        $vf["brewSource"] = "BeerXML Parser";
        $vf["brewYield"] = round(($recipe->batchSize * 0.26418), 3);
        $vf["brewNotes"] = $recipe->notes;
        $vf["brewMethod"] = $recipe->type; 
        $counter["grain"] = 0;
        $counter["extract"] = 0;
        $counter["adjunct"] = 0;
        foreach($recipe->fermentables->fermentables as $fermentable){
            switch($fermentable->type){
                case "Grain":
                    $counter["grain"]++;
                    if($counter["grain"] <= 9){
                        $vf["brewGrain" . $counter["grain"]] = $fermentable->name;
                        $vf["brewGrain" . $counter["grain"] . "Weight"] = round(($fermentable->amount * 2.20462262),3);
                    }
                    break;
                case "Extract":
                    $counter["extract"]++;
                    if($counter["extract"] <= 5){
                        $vf["brewExtract" . $counter["extract"]] = $fermentable->name;
                        $vf["brewExtract" . $counter["extract"] . "Weight"] = round(($fermentable->amount * 2.20462262),3);
                    }
                    break;
                case "Dry Extract":
                    $counter["extract"]++;
                    if($counter["extract"] <= 5){
                        $vf["brewExtract" . $counter["extract"]] = $fermentable->name;
                        $vf["brewExtract" . $counter["extract"] . "Weight"] = round(($fermentable->amount * 2.20462262),3);
                    }
                    break;
                case "Adjunct":
                    $counter["adjunct"]++;
                    if($counter["adjunct"] <= 9){
                        $vf["brewAddition" . $counter["adjunct"]] = $fermentable->name;
                        $vf["brewAddition" . $counter["adjunct"] . "Amt"] = round(($fermentable->amount * 2.20462262),3);
                    }
                    break;
                case "Sugar":
                    $counter["adjunct"]++;
                    if($counter["adjunct"] <= 9){
                        $vf["brewAddition" . $counter["adjunct"]] = $fermentable->name;
                        $vf["brewAddition" . $counter["adjunct"] . "Amt"] = round(($fermentable->amount * 2.20462262),3);
                    }
                    break;
                default:
                    break;
            }
        }

        $counter["misc"] = 0;
        foreach($recipe->miscs->miscs as $misc){
            $counter["misc"]++;
            if($counter["misc"] <= 4){
                $vf["brewMisc" . $counter["misc"] . "Name"] = $misc->name;
                $vf["brewMisc" . $counter["misc"] . "Type"] = $misc->type;
                $vf["brewMisc" . $counter["misc"] . "Use"] = $misc->useFor;
                $vf["brewMisc" . $counter["misc"] . "Time"] = $misc->time;
                $vf["brewMisc" . $counter["misc"] . "Amount"] = $misc->amount;
            }
        }

        $counter["hops"] = 0;
        foreach($recipe->hops->hops as $hop){
            $counter["hops"]++;
            if($counter["hops"] <= 9){
                $vf["brewHops" . $counter["hops"]] = $hop->name;
                $vf["brewHops" . $counter["hops"] . "Weight"] = round(($hop->amount *  35.2739619),3);
                $vf["brewHops" . $counter["hops"] . "IBU"] = $hop->alpha;
                $vf["brewHops" . $counter["hops"] . "Time"] = $hop->time;
                $vf["brewHops" . $counter["hops"] . "Use"] = $hop->use;
                $vf["brewHops" . $counter["hops"] . "Type"] = $hop->type;
                $vf["brewHops" . $counter["hops"] . "Form"] = $hop->form;
            }
        }

        $counter["yeast"] = 0;
        foreach($recipe->yeasts->yeasts as $yeast){
            $vf["brewYeast"] = $yeast->name;
            $vf["brewYeast" . "Man"] = $yeast->labratory;
            $vf["brewYeast" . "Form"] = $yeast->form;
            $vf["brewYeast" . "Type"] = $yeast->type;
            $vf["brewYeast" . "Amount"] = $yeast->amount;
        }

        $vf["brewOG"] = 1 . substr($recipe->estimatedOriginalGravity,1,4);
        $vf["brewFG"] = 1 . substr($recipe->estimatedFinalGravity,1,4);
        $vf["brewProcedure"] = $recipe->notes;
        $vf["brewPrimary"] = $recipe->primaryAge;
        $vf["brewPrimaryTemp"] = $recipe->primaryTemp * (9/5) + 32;
        $vf["brewSecondary"] = $recipe->secondaryAge;
        $vf["brewSecondaryTemp"] = $recipe->secondaryTemp * (9/5) + 32;
        $vf["brewTertiary"] = $recipe->tertiaryAge;
        $vf["brewTertiaryTemp"] = $recipe->secondaryTemp * (9/5) + 32;
        $vf["brewAge"] = $recipe->age;
        $vf["brewAgeTemp"] = $recipe->ageTemp * (9/5) + 32;
        $vf["brewBitterness"] = $recipe->ibu;
        $vf["brewLovibond"] = $recipe->estimatedColor;
        $vf["brewBrewerID"] = $this->brewer;


        foreach($vf as $field=>$value){
            $fields .= "," . $field;
            $values .= ",'" . $value . "'";
        }

        $fields .= ")";
        $values .= ")";
        $sqlQuery .= $fields . $values;
        //echo $sqlQuery . "<br />";
        mysql_select_db($GLOBALS['database_brewing'], $brewing) or die(mysql_error());
        $Result1 = mysql_query($sqlQuery, $brewing) or die(mysql_error());

        $this->insertedRecipes[mysql_insert_id()] = $recipe->name;
        }
    //}}}

    //{{{ insertBlogs
    function insertBlogs(){
        foreach($this->recipes->recipes as $recipe){
            $this->insertBlog($recipe);
        }
        return $this->insertedRecipes;
    }
    //}}}

    //{{{ insertBlog
    function insertBlog($recipe){
        $brewing = mysql_connect($GLOBALS['hostname_brewblog'], $GLOBALS['username_brewblog'], $GLOBALS['password_brewblog']) or trigger_error(mysql_error());
        mysql_select_db($GLOBALS['database_brewing'], $brewing) or die(mysql_error());

        $sqlQuery = "INSERT INTO brewing ";
        $fields = "(brewName";
        $values = " VALUES('" . $recipe->name . "'";
        $vf = array();
        $counter = array();
        $batchNumber = " SELECT brewBatchNum FROM `brewing` ORDER BY brewBatchNum DESC LIMIT 1 ";

        $vf["brewStyle"] = $recipe->style->name;
        //$vf["brewSource"] = "BeerXML Parser";
        //$vf["brewBatchNum"] = ((int)mysql_query($batchNumber,$brewing))++;
        $vf["brewYield"] = round(($recipe->batchSize * 0.26418), 3);
        $vf["brewInfo"] = $recipe->notes;
        $vf["brewMethod"] = $recipe->type;
        $vf["brewDate"] = date("Y-m-d", strtotime($recipe->date));

        $counter["grain"] = 0;
        $totalGrainWeight = 0;
        $counter["extract"] = 0;
        $counter["adjunct"] = 0;
        foreach($recipe->fermentables->fermentables as $fermentable){
            switch($fermentable->type){
                case "Grain":
                    $counter["grain"]++;
                    if($counter["grain"] <= 9){
                        $vf["brewGrain" . $counter["grain"]] = $fermentable->name;
                        $vf["brewGrain" . $counter["grain"] . "Weight"] = round(($fermentable->amount * 2.20462262),3);
                    }
                    break;
                case "Extract":
                    $counter["extract"]++;
                    if($counter["extract"] <= 5){
                        $vf["brewExtract" . $counter["extract"]] = $fermentable->name;
                        $vf["brewExtract" . $counter["extract"] . "Weight"] = round(($fermentable->amount * 2.20462262),3);
                    }
                    break;
                case "Dry Extract":
                    $counter["extract"]++;
                    if($counter["extract"] <= 5){
                        $vf["brewExtract" . $counter["extract"]] = $fermentable->name;
                        $vf["brewExtract" . $counter["extract"] . "Weight"] = round(($fermentable->amount * 2.20462262),3);
                    }
                    break;
                case "Adjunct":
                    $counter["adjunct"]++;
                    if($counter["adjunct"] <= 9){
                        $vf["brewAddition" . $counter["adjunct"]] = $fermentable->name;
                        $vf["brewAddition" . $counter["adjunct"] . "Amt"] = round(($fermentable->amount * 2.20462262),3);
                    }
                    break;
                case "Sugar":
                    $counter["adjunct"]++;
                    if($counter["adjunct"] <= 9){
                        $vf["brewAddition" . $counter["adjunct"]] = $fermentable->name;
                        $vf["brewAddition" . $counter["adjunct"] . "Amt"] = round(($fermentable->amount * 2.20462262),3);
                    }
                    break;
                default:
                    break;
            }
        }

        $counter["misc"] = 0;
        foreach($recipe->miscs->miscs as $misc){
            $counter["misc"]++;
            if($counter["misc"] <= 4){
                $vf["brewMisc" . $counter["misc"] . "Name"] = $misc->name;
                $vf["brewMisc" . $counter["misc"] . "Type"] = $misc->type;
                $vf["brewMisc" . $counter["misc"] . "Use"] = $misc->useFor;
                $vf["brewMisc" . $counter["misc"] . "Time"] = $misc->time;
                $vf["brewMisc" . $counter["misc"] . "Amount"] = $misc->amount;
            }
        }

        $counter["hops"] = 0;
        foreach($recipe->hops->hops as $hop){
            $counter["hops"]++;
            if($counter["hops"] <= 9){
                $vf["brewHops" . $counter["hops"]] = $hop->name;
                $vf["brewHops" . $counter["hops"] . "Weight"] = round(($hop->amount *  35.2739619),3);
                $vf["brewHops" . $counter["hops"] . "IBU"] = $hop->alpha;
                $vf["brewHops" . $counter["hops"] . "Time"] = $hop->time;
                $vf["brewHops" . $counter["hops"] . "Use"] = $hop->use;
                $vf["brewHops" . $counter["hops"] . "Type"] = $hop->type;
                $vf["brewHops" . $counter["hops"] . "Form"] = $hop->form;
            }
        }

        $counter["yeast"] = 0;
        foreach($recipe->yeasts->yeasts as $yeast){
            $vf["brewYeast"] = $yeast->name;
            $vf["brewYeast" . "Man"] = $yeast->labratory;
            $vf["brewYeast" . "Form"] = $yeast->form;
            $vf["brewYeast" . "Type"] = $yeast->type;
            $vf["brewYeast" . "Amount"] = $yeast->amount;
        }

        $counter["mash"] = 0;
        //$vf["brewMashGrainWeight"] = $recipe->mash->
        $vf["brewMashGrainTemp"] = $recipe->mash->grainTemp * (9/5) + 32;
        $vf["brewMashTunTemp"] = $recipe->mash->tunTemp * (9/5) + 32;
        $vf["brewMashPH"] = $recipe->mash->ph;
        $vf["brewMashGrainWeight"] = $totalGrainWeight;
        $vf["brewMashType"] = "Infusion"; // this is hard coded because it is the most common and the beerXML spec does not mention it
        $vf["brewMashEquipAdjust"] = $recipe->mash->equipAdjust;  // FIELDS TO COMPLETE: spargeAmt
        $vf["brewMashSpargeTemp"] = $recipe->mash->spargeTemp * (9/5) + 32;
        $totalSpargeAmount = 0;
        foreach($recipe->mash->mashSteps as $mashStep){
            $counter["mash"]++;
            if($counter["mash"] <= 5){
                $vf["brewMashStep" . $counter["mash"] . "Name"] = $mashStep->name;
                $vf["brewMashStep" . $counter["mash"] . "Temp"] = $mashStep->stepTemp * (9/5) + 32;
                $vf["brewMashStep" . $counter["mash"] . "Time"] = $mashStep->stepTime;
                $vf["brewMashStep" . $counter["mash"] . "Desc"] = $mashStep->type;
                $totalSpargeAmount += $mashStep->infuseAmount;
            }
        }
        $vf["brewMashSpargAmt"] = round($totalSpargeAmount * 0.26418,3);

        foreach($recipe->waters->waters as $water){
            $vf["brewWaterName"] = $water->name;
            $vf["brewWaterAmount"] = $water->amount;
            $vf["brewWaterCalcium"] = $water->calcium;
            $vf["brewWaterBicarb"] = $water->bicarbonate;
            $vf["brewWaterSulfate"] = $water->sulfate;
            $vf["brewWaterChloride"] = $water->chloride;
            $vf["brewWaterMagnesium"] = $water->magnesium;
            $vf["brewWaterPH"] = $water->ph;
            $vf["brewWaterNotes"] = $water->notes;
            $vf["brewWaterSodium"] = $water->sodium;
        }

        $vf["brewOG"] = 1 . substr($recipe->estimatedOriginalGravity,1,4);
        $vf["brewFG"] = 1 . substr($recipe->estimatedFinalGravity,1,4);
        $vf["brewProcedure"] = $recipe->notes;
        $vf["brewPrimary"] = $recipe->primaryAge;
        $vf["brewPrimaryTemp"] = $recipe->primaryTemp * (9/5) + 32;
        $vf["brewSecondary"] = $recipe->secondaryAge;
        $vf["brewSecondaryTemp"] = $recipe->secondaryTemp * (9/5) + 32;
        $vf["brewTertiary"] = $recipe->tertiaryAge;
        //$vf["brewTertiaryTemp"] = $recipe->secondaryTemp * (9/5) + 32;
        $vf["brewAge"] = $recipe->age;
        $vf["brewAgeTemp"] = $recipe->ageTemp * (9/5) + 32;
        $vf["brewBitterness"] = $recipe->ibu;
        $vf["brewLovibond"] = $recipe->estimatedColor;
        $vf["brewEfficiency"] = $recipe->efficiency;
        $vf["brewPreBoilAmt"] = round($recipe->boilSize * 0.26418,3);
        $vf["brewBrewerID"] = $this->brewer;


        foreach($vf as $field=>$value){
            $fields .= "," . $field;
            $values .= ",'" . $value . "'";
        }

        $fields .= ")";
        $values .= ")";
        $sqlQuery .= $fields . $values;
        //echo $sqlQuery . "<br />";
        $Result1 = mysql_query($sqlQuery, $brewing) or die(mysql_error());

        $this->insertedRecipes[mysql_insert_id()] = $recipe->name;
    }

}
//}}}

//}}}

?>
