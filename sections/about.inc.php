<div class="dataContainer">
<table class="dataTable">
 <tr>
	<td valign="top" class="dataLabelLeft"><?php if ($row_pref['mode'] == "2") echo "Club "; ?>Name:</td>
	<td valign="top" class="data"><?php if ($row_name['brewerPrefix'] !="") { echo $row_name['brewerPrefix']." "; } if ($row_name['brewerFirstName'] !="") { echo $row_name['brewerFirstName'];  }  if ($row_name['brewerMiddleName'] !="") { echo " ".$row_name['brewerMiddleName']; }  if ($row_name['brewerLastName'] !="") {  echo " ".$row_name['brewerLastName']; }  if ($row_name['brewerSuffix'] !="") { echo ", ".$row_name['brewerSuffix']; } ?></td>
 </tr>
 <?php 
 if ($row_pref['mode'] == "1") { 
   if ($row_name['brewerAge'] !="") { 
 ?>
 <tr>
	<td valign="top" class="dataLabelLeft">Age:</td>
	<td valign="top" class="data"><?php echo $row_name['brewerAge']; ?></td>
 </tr>
 <?php 
 } 
   }
 ?>
 <?php if ($row_name['brewerCity'] !="") { ?>
 <tr>
	<td valign="top" class="dataLabelLeft">Hometown:</td>
	<td valign="top" class="data"><?php echo $row_name['brewerCity']; if ($row_name['brewerState'] !="") { echo ", ".$row_name['brewerState'];  }  if ($row_name['brewerCountry'] !="") { echo " ".$row_name['brewerCountry'];  } ?></td>
 </tr>
 <?php } ?>
 <?php 
 if ($row_pref['mode'] == "1") { 
 	if ($row_name['brewerClubs'] != "" ) { 
 ?>
 <tr>
	<td valign="top" class="dataLabelLeft">Clubs:</td>
	<td valign="top" class="data"><?php echo $row_name['brewerClubs']; ?></td>
 </tr>
 <?php } ?>
 <?php if ($row_name['brewerFavStyles'] !="") { ?>
 <tr>
	<td valign="top" class="dataLabelLeft">Fav Styles:</td>
	<td valign="top" class="data"><?php echo $row_name['brewerFavStyles']; ?></td>
 </tr>
 <?php } ?>
 <?php if ($row_name['brewerPrefMethod'] != "") { ?>
 <tr>
	<td valign="top" class="dataLabelLeft">Method:</td>
	<td valign="top" class="data"><?php echo $row_name['brewerPrefMethod']; ?></td>
 </tr>
 <?php 
   } 
 }
 ?>
<?php if ($row_name['brewerAbout'] != "" ) { ?>
 <tr>
 	<td valign="top" class="dataLabelLeft">Info:</td>
 	<td valign="top" class="data"><?php echo $row_name['brewerAbout']; ?></td>
 </tr>
<?php }  ?>
<?php if ($row_name['brewerOther'] !="") { ?>
 <tr>
	<td valign="top" class="dataLabelLeft">Other Info:</td>
	<td valign="top" class="data"><?php echo $row_name['brewerOther']; ?></td> 
 </tr>
<?php } ?>
</table>
</div>