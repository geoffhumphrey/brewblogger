<?php

ob_start();
require('../paths.php');
require(CONFIG.'config.php');
$connection = $brewing;
session_start();

header('Expires: Sat, 26 Jul 1997 05:00:00 GMT');
header('Last-Modified: ' . gmdate( 'D, d M Y H:i:s' ) . ' GMT');
header('Cache-Control: no-store, no-cache, must-revalidate');
header('Cache-Control: post-check=0, pre-check=0', false);
header('Pragma: no-cache');

$logout_location = $base_url."index.php?page=login&section=logged-out";

$requested_logout = true;

if ($requested_logout) {
    session_restart();
}

// Now the session_id will be different every browser refresh
print(session_id());

function session_restart() {
    if (session_name()=='') {
        // Session not started yet
        session_start();
    }

    else {
    // Session was started, so destroy
    session_destroy();
    }
}

header("Location: $logout_location");

?>

