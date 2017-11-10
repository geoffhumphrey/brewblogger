<?php
// Default var values
$alert_text = "";
$alert_type = "alert-danger";
$alert_icon = "fa-exclamation-circle";

if ($page == "login") {
    if ($section == "login-error") $alert_text = "<strong>Sorry, there was a problem with your last login attempt.</strong> Please try again.";
    if ($section == "logged-out") $alert_text = "<strong>You have been successfully logged out.</strong> Log in again?";
}

?>


<?php if (!empty($alert_text)) { ?>
<div class="alert <?php echo $alert_type; ?> alert-dismissible" role="alert">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    <span class="fa <?php echo $alert_icon; ?>"></span> <?php echo $alert_text; ?>
</div>
<?php } ?>