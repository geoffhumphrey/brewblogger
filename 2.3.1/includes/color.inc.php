<?php
if ($page == "recipeList") {
$colorSRM = $row_recipeList['brewLovibond'];
$colorSRM_featured = $row_featured['brewLovibond']; 
} 
elseif (($page == "brewBlogCurrent") || ($page == "brewBlogDetail") || ($page == "brewBlogList") || ($page == "recipeDetail") || ($page == "logPrint")) {
if ($row_pref['measColor'] == "EBC") $colorSRM = colorconvert($row_log['brewLovibond'], "SRM"); else $colorSRM = $row_log['brewLovibond'];
if ($row_pref['measColor'] == "EBC") $colorSRM_featured = colorconvert($row_featured['brewLovibond'], "SRM"); else $colorSRM_featured = $row_featured['brewLovibond']; 
}
else if ($action == "calculate") $colorSRM = $SRM; 
else { $colorSRM = "1"; }

if ($colorSRM >= 01 && $colorSRM < 02) { $beercolor ="#f3f993"; }
elseif ($colorSRM >= 02 && $colorSRM < 03) { $beercolor ="#f5f75c"; }
elseif ($colorSRM >= 03 && $colorSRM < 04) { $beercolor ="#f6f513"; }
elseif ($colorSRM >= 04 && $colorSRM < 05) { $beercolor ="#eae615"; }
elseif ($colorSRM >= 05 && $colorSRM < 06) { $beercolor ="#e0d01b"; }
elseif ($colorSRM >= 06 && $colorSRM < 07) { $beercolor ="#d5bc26"; }
elseif ($colorSRM >= 07 && $colorSRM < 08) { $beercolor ="#cdaa37"; }
elseif ($colorSRM >= 08 && $colorSRM < 09) { $beercolor ="#c1963c"; }
elseif ($colorSRM >= 09 && $colorSRM < 10) { $beercolor ="#be8c3a"; }
elseif ($colorSRM >= 10 && $colorSRM < 11) { $beercolor ="#be823a"; }
elseif ($colorSRM >= 11 && $colorSRM < 12) { $beercolor ="#c17a37"; }
elseif ($colorSRM >= 12 && $colorSRM < 13) { $beercolor ="#bf7138"; }
elseif ($colorSRM >= 13 && $colorSRM < 14) { $beercolor ="#bc6733"; }
elseif ($colorSRM >= 14 && $colorSRM < 15) { $beercolor ="#b26033"; }
elseif ($colorSRM >= 15 && $colorSRM < 16) { $beercolor ="#a85839"; }
elseif ($colorSRM >= 16 && $colorSRM < 17) { $beercolor ="#985336"; }
elseif ($colorSRM >= 17 && $colorSRM < 18) { $beercolor ="#8d4c32"; }
elseif ($colorSRM >= 18 && $colorSRM < 19) { $beercolor ="#7c452d"; }
elseif ($colorSRM >= 19 && $colorSRM < 20) { $beercolor ="#6b3a1e"; }
elseif ($colorSRM >= 20 && $colorSRM < 21) { $beercolor ="#5d341a"; }
elseif ($colorSRM >= 21 && $colorSRM < 22) { $beercolor ="#4e2a0c"; }
elseif ($colorSRM >= 22 && $colorSRM < 23) { $beercolor ="#4a2727"; }
elseif ($colorSRM >= 23 && $colorSRM < 24) { $beercolor ="#361f1b"; }
elseif ($colorSRM >= 24 && $colorSRM < 25) { $beercolor ="#261716"; }
elseif ($colorSRM >= 25 && $colorSRM < 26) { $beercolor ="#231716"; }
elseif ($colorSRM >= 26 && $colorSRM < 27) { $beercolor ="#19100f"; }
elseif ($colorSRM >= 27 && $colorSRM < 28) { $beercolor ="#16100f"; }
elseif ($colorSRM >= 28 && $colorSRM < 29) { $beercolor ="#120d0c"; }
elseif ($colorSRM >= 29 && $colorSRM < 30) { $beercolor ="#100b0a"; }
elseif ($colorSRM >= 30 && $colorSRM < 31) { $beercolor ="#050b0a"; }
elseif ($colorSRM > 31) { $beercolor ="#000000"; }
else { $beercolor ="#ffffff"; }

if ($colorSRM_featured >= 01 && $colorSRM_featured < 02) { $beercolor_featured ="#f3f993"; }
elseif ($colorSRM_featured >= 02 && $colorSRM_featured < 03) { $beercolor_featured ="#f5f75c"; }
elseif ($colorSRM_featured >= 03 && $colorSRM_featured < 04) { $beercolor_featured ="#f6f513"; }
elseif ($colorSRM_featured >= 04 && $colorSRM_featured < 05) { $beercolor_featured ="#eae615"; }
elseif ($colorSRM_featured >= 05 && $colorSRM_featured < 06) { $beercolor_featured ="#e0d01b"; }
elseif ($colorSRM_featured >= 06 && $colorSRM_featured < 07) { $beercolor_featured ="#d5bc26"; }
elseif ($colorSRM_featured >= 07 && $colorSRM_featured < 08) { $beercolor_featured ="#cdaa37"; }
elseif ($colorSRM_featured >= 08 && $colorSRM_featured < 09) { $beercolor_featured ="#c1963c"; }
elseif ($colorSRM_featured >= 09 && $colorSRM_featured < 10) { $beercolor_featured ="#be8c3a"; }
elseif ($colorSRM_featured >= 10 && $colorSRM_featured < 11) { $beercolor_featured ="#be823a"; }
elseif ($colorSRM_featured >= 11 && $colorSRM_featured < 12) { $beercolor_featured ="#c17a37"; }
elseif ($colorSRM_featured >= 12 && $colorSRM_featured < 13) { $beercolor_featured ="#bf7138"; }
elseif ($colorSRM_featured >= 13 && $colorSRM_featured < 14) { $beercolor_featured ="#bc6733"; }
elseif ($colorSRM_featured >= 14 && $colorSRM_featured < 15) { $beercolor_featured ="#b26033"; }
elseif ($colorSRM_featured >= 15 && $colorSRM_featured < 16) { $beercolor_featured ="#a85839"; }
elseif ($colorSRM_featured >= 16 && $colorSRM_featured < 17) { $beercolor_featured ="#985336"; }
elseif ($colorSRM_featured >= 17 && $colorSRM_featured < 18) { $beercolor_featured ="#8d4c32"; }
elseif ($colorSRM_featured >= 18 && $colorSRM_featured < 19) { $beercolor_featured ="#7c452d"; }
elseif ($colorSRM_featured >= 19 && $colorSRM_featured < 20) { $beercolor_featured ="#6b3a1e"; }
elseif ($colorSRM_featured >= 20 && $colorSRM_featured < 21) { $beercolor_featured ="#5d341a"; }
elseif ($colorSRM_featured >= 21 && $colorSRM_featured < 22) { $beercolor_featured ="#4e2a0c"; }
elseif ($colorSRM_featured >= 22 && $colorSRM_featured < 23) { $beercolor_featured ="#4a2727"; }
elseif ($colorSRM_featured >= 23 && $colorSRM_featured < 24) { $beercolor_featured ="#361f1b"; }
elseif ($colorSRM_featured >= 24 && $colorSRM_featured < 25) { $beercolor_featured ="#261716"; }
elseif ($colorSRM_featured >= 25 && $colorSRM_featured < 26) { $beercolor_featured ="#231716"; }
elseif ($colorSRM_featured >= 26 && $colorSRM_featured < 27) { $beercolor_featured ="#19100f"; }
elseif ($colorSRM_featured >= 27 && $colorSRM_featured < 28) { $beercolor_featured ="#16100f"; }
elseif ($colorSRM_featured >= 28 && $colorSRM_featured < 29) { $beercolor_featured ="#120d0c"; }
elseif ($colorSRM_featured >= 29 && $colorSRM_featured < 30) { $beercolor_featured ="#100b0a"; }
elseif ($colorSRM_featured >= 30 && $colorSRM_featured < 31) { $beercolor_featured ="#050b0a"; }
elseif ($colorSRM_featured > 31) { $beercolor_featured ="#000000"; }
else { $beercolor_featured ="#ffffff"; }

?>