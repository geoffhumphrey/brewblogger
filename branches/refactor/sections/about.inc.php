<?php
return $twig->render('about.html.twig', array(
    'pref' => $row_pref,
    'name' => $row_name
));