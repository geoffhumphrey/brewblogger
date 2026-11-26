<?php
/**
 * Key for errors:
 * 1 = Added successfully
 * 2 = Edited successfully
 * 3 = Deleted successfully
 * 4 = Error
 */


if ($msg == "1") { ?>
<div class="alert alert-success alert-dismissible hidden-print fade in" role="alert">
  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
  <p><span class="fa fa-lg fa-check-circle"></span> <strong>Record was added successfully.</strong></p>
</div>
<?php } 

if ($msg == "2") { ?>
<div class="alert alert-success alert-dismissible hidden-print fade in" role="alert">
  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
  <p><span class="fa fa-lg fa-check-circle"></span> <strong>Record was edited successfully.</strong></p>
</div>
<?php } 

if ($msg == "3") { ?>
<div class="alert alert-success alert-dismissible hidden-print fade in" role="alert">
  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
  <p><span class="fa fa-lg fa-check-circle"></span> <strong>Record was deleted successfully.</strong></p>
</div>
<?php } 

if ($msg == "4") { 

	$errors_display = "";
	if (!empty($_SESSION['error_output'])) {
	    foreach ($_SESSION['error_output'] as $key => $value) {
	        $errors_display .= "<li>".$value."</li>";
	    }
	}

?>
<div class="alert alert-danger alert-dismissible hidden-print fade in" role="alert">
	<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	<p><span class="fa fa-lg fa-exclamation-circle"></span> <strong>There was an error.</strong> Please try again.</p>
	<?php if (!empty($errors_display)) echo "<p>Error details:</p><ul>".$errors_display."</ul>"; ?>
</div>
<?php } ?>