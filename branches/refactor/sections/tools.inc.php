<?php
$imageSrc = "images/";
$pageVars = array(
    'current_section' => $section,
    'sections' => array(
        'bitterness' => 'Bitterness Calculator',
        'efficiency' => 'Brewhouse Efficiency Calculator',
        'calories' => 'Calories, Alcohol, and Plato Calculator',
        'force_carb' => 'Force Carbonation Calculator',
        'plato' => 'Plato/Brix/SG Calculator',
        'sugar' => 'Priming Sugar Calculator',
        'strike' => 'Strike Water Temperature Calculator',
        'water' => 'Water Amounts Calculator',
        'hyd' => 'Hydrometer Correction Calculator',
    ),
);

ob_start();
if ($section == "calories") 		include (ADMIN_TOOLS.'gravity.php');
elseif ($section == "bitterness") 	include (ADMIN_TOOLS.'bitterness.php');
elseif ($section == "efficiency") 	include (ADMIN_TOOLS.'efficiency.php');
elseif ($section == "water") 		include (ADMIN_TOOLS.'water_amounts.php');
elseif ($section == "sugar") 		include (ADMIN_TOOLS.'priming.php');
elseif ($section == "force_carb") 	include (ADMIN_TOOLS.'force_carb.php');
elseif ($section == "plato") 		include (ADMIN_TOOLS.'sg.php');
elseif ($section == "strike") 		include (ADMIN_TOOLS.'strike.php');
elseif ($section == "hyd") 			include (ADMIN_TOOLS.'hydrometer.php');

$pageVars['content'] = ob_get_clean();
return $twig->render('tools.html.twig', $pageVars);
