<div class="include">
<form action="includes/logincheck.inc.php" method="POST" name="form1" id="form1">

<?php if ($section == "loginError") { ?>
<table class="dataTable">
	<tr>
		<td class="error">Sorry, there was a problem with your last login attempt. Please try again.</td>
	</tr>
</table>
<?php } if ($section == "loggedout") { ?>
<table class="dataTable">
	<tr>
		<td class="error">You have been logged out.</td>
	</tr>
</table>
<?php }	?>
<table class="dataTable">
	<tr>
    	<td class="dataLabelLeft">Username:</td>
    	<td class="data"><input name="loginUsername" type="text" class="submit" size="25"></td>
  	</tr>
  	<tr>
    	<td class="dataLabelLeft">Password:</td>
    	<td class="data"><input name="loginPassword" type="password" class="submit" size="25"></td>
  	</tr>
  	<tr>
    	<td class="dataLabel">&nbsp;</td>
    	<td class="data"><input type="image" src="<?php echo $imageSrc . $row_colorChoose['themeName']; ?>/button_login_<?php echo $row_colorChoose['themeName']; ?>.png" alt="Login" class="radiobutton" value="Login"></td>
  	</tr>
</table>
</form>
</div>
