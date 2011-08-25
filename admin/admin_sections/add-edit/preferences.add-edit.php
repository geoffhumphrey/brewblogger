<div class="headerContentAdmin">Theme</div>
<table class="dataTable">
<tr>
	<td width="5%">
	<select  class="text_area" name="theme">
	  <?php do { ?>
   	    <option value="<?php echo $row_theme['theme']; ?>" <?php if ($action == "edit") { if (!(strcmp($row_theme['theme'], $row_pref['theme']))) {echo "SELECTED";} } ?>><?php echo $row_theme['themeName']; ?></option>
	  <?php } while ($row_theme = mysql_fetch_assoc($theme)); $rows = mysql_num_rows($theme); if ($rows > 0) { mysql_data_seek($theme, 0); $row_theme = mysql_fetch_assoc($grains); }	?>
	</select>
	</td>
    <td class="data"><span class="data_icon"><img src="<?php echo $imageSrc; ?>add.png" border="0" align="absbottom" alt="Add Themes?" title="Add Themes?"></span><span class="data"><a href="index.php?action=add&dbTable=brewingcss">Add Themes?</a></span></td>
</tr>
</table>

<div class="headerContentAdmin">Edition</div>
<table class="dataTable">
<tr>
      <td>
	<select class="text_area" name="mode">
       <option value="1" <?php if (!(strcmp($row_log['mode'], "1" ))) {echo "SELECTED";} ?>>Single User</option>
       <option value="2" <?php if (!(strcmp($row_log['mode'], "2" ))) {echo "SELECTED";} ?>>Club (Multi-User)</option>
      </select>
      </td>
</tr>
</table>

<div class="headerContentAdmin">Home Page</div>
<table class="dataTable">
<tr>
      <td width="5%">
	 <select class="text_area" name="home">
       <option value="about" <?php if (!(strcmp($row_log['home'], "about" ))) {echo "SELECTED";} ?>>About <?php if ($row_pref['mode'] == "2") echo "(Default)"; ?> </option>
       <option value="tools" <?php if (!(strcmp($row_log['home'], "tools" ))) {echo "SELECTED";} ?>><?php echo $row_pref['menuCalculators'];?></option>
       <option value="calendar" <?php if (!(strcmp($row_log['home'], "calendar" ))) {echo "SELECTED";} ?>>Calendar</option>
	   <option value="brewBlogList" <?php if (!(strcmp($row_log['home'], "brewBlogList" ))) {echo "SELECTED";} ?>><?php echo $row_pref['menuBrewBlogs']; ?></option>
	 <?php if ($row_pref['mode'] == "1") { ?><option value="brewBlogCurrent" <?php if (!(strcmp($row_log['home'], "brewBlogCurrent" ))) {echo "SELECTED";} ?>>Current <?php echo $row_pref['menuBrewBlogs']; ?> (Default)</option><?php } ?>
       <option value="login" <?php if (!(strcmp($row_log['home'], "login" ))) {echo "SELECTED";} ?>>Login</option>
	 <?php if ($row_pref['mode'] == "2") { ?><option value="members" <?php if (!(strcmp($row_log['home'], "members" ))) {echo "SELECTED";} ?>><?php echo $row_pref['menuMembers']; ?></option><?php } ?>
	 <option value="recipeList" <?php if (!(strcmp($row_log['home'], "recipeList" ))) {echo "SELECTED";} ?>><?php echo $row_pref['menuRecipes']; ?></option>
       <option value="reference" <?php if (!(strcmp($row_log['home'], "reference" ))) {echo "SELECTED";} ?>><?php echo $row_pref['menuReference']; ?></option>
      </select>
      </td>
      <td class="data">* Be sure to choose your edition and click "Edit" BEFORE choosing your home page.</td>
</tr>
</table>

<div class="headerContentAdmin">General</div>
<table>
<tr>
      <td class="dataLabelLeft">Fluid Measure (Small):</td>
      <td class="data" width="10%">
		<select class="text_area"  name="measFluid1">
       		<option value="ounces" <?php if (!(strcmp($row_log['measFluid1'], "ounces" ))) {echo "SELECTED";} ?>>ounces [I]</option>
       		<option value="milliliters" <?php if (!(strcmp($row_log['measFluid1'], "milliliters" ))) {echo "SELECTED";} ?>>milliliters [M]</option>
      	</select>      </td>
      <td class="data">Yeast, liquid additives, etc. </td>
</tr>
<tr>
      <td class="dataLabelLeft">Fluid Measure (Large):</td>
      <td class="data" >
	<select class="text_area"  name="measFluid2">
       <option value="gallons" <?php if (!(strcmp($row_log['measFluid2'], "gallons" ))) {echo "SELECTED";} ?>>gallons [I]</option>
       <option value="liters" <?php if (!(strcmp($row_log['measFluid2'], "liters" ))) {echo "SELECTED";} ?>>liters [M]</option>
      </select>      </td>
      <td class="data" >Boil volume, batch size, etc. </td>
</tr>
<tr>
      <td class="dataLabelLeft">Weight Measure (Small):</td>
      <td class="data" >
      <select class="text_area"  name="measWeight1">
       <option value="ounces" <?php if (!(strcmp($row_log['measWeight1'], "ounces" ))) {echo "SELECTED";} ?>>ounces [I]</option>
       <option value="grams" <?php if (!(strcmp($row_log['measWeight1'], "grams" ))) {echo "SELECTED";} ?>>grams [M]</option>
      </select>      </td>
      <td class="data" >Hops.</td>
</tr>
<tr>
      <td class="dataLabelLeft">Weight Measure (Large):</td>
      <td class="data" >
	<select class="text_area"  name="measWeight2">
	  <option value="pounds" <?php if (!(strcmp("pounds", $row_log['measWeight2']))) {echo "SELECTED";} ?>>pounds [I]</option>
        <option value="kilograms" <?php if (!(strcmp("kilograms", $row_log['measWeight2']))) {echo "SELECTED";} ?>>kilograms [M]</option>
        <!-- <option value="stone" <?php //if (!(strcmp("stone", $row_log['measWeight2']))) {echo "SELECTED";} ?>>stone</option> -->
      </select>      </td>
      <td class="data">Base malts, malt extracts, etc. </td>
</tr>
<tr>
  <td class="dataLabelLeft"><div class="right">**</div></td>
  <td colspan="2" class="data"> Note: for the BeerXML import function, mash profiles, etc. to work optimally, all of the above must be consistent to one standard of measurement (e.g., Metric [M] or Imperial [I])</td>
</tr>
<tr>
    <td class="dataLabelLeft">Mash Thickness:</td>
    <td class="data" >
	<select class="text_area"  name="measWaterGrainRatio">
	  <option value="qt/lb" <?php if (!(strcmp("qt/lb", $row_log['measWaterGrainRatio']))) {echo "SELECTED";} ?>>qt/lb</option>
      <option value="li/kg" <?php if (!(strcmp("li/kg", $row_log['measWaterGrainRatio']))) {echo "SELECTED";} ?>>li/kg</option>
    </select>      
    </td>
    <td class="data">Strike water added to the mash per pound or kilogram of grain.</td>
</tr>
<tr>
      <td class="dataLabelLeft">Temperature Scale:</td>
      <td class="data" >
	<select class="text_area"  name="measTemp">
        <option value="F" <?php if (!(strcmp("F", $row_log['measTemp']))) {echo "SELECTED";} ?>>Fahrenheit</option>
        <option value="C" <?php if (!(strcmp("C", $row_log['measTemp']))) {echo "SELECTED";} ?>>Celsius</option>
      </select>      </td>
      <td class="data">Mash profiles, etc. </td>
</tr>
<tr>
      <td class="dataLabelLeft">Beer Color Scale:</td>
      <td class="data" >
	<select class="text_area"  name="measColor">
       <option value="SRM" <?php if (!(strcmp("SRM", $row_log['measColor']))) {echo "SELECTED";} ?>>Standard Reference Method (SRM)</option>
       <option value="EBC" <?php if (!(strcmp("EBC", $row_log['measColor']))) {echo "SELECTED";} ?>>European Brewing Convention (EBC)</option>
      </select>      </td>
      <td class="data">SRM is the more recognized standard. </td>
</tr>
<tr>
      <td class="dataLabelLeft">Bitterness Scale:</td>
      <td class="data" >
	  <select class="text_area"  name="measBitter">
       <option value="IBU" <?php if (!(strcmp("IBU", $row_log['measBitter']))) {echo "SELECTED";} ?>>International Bitterness Units (IBU)</option>
       <option value="HBU" <?php if (!(strcmp("HBU", $row_log['measBitter']))) {echo "SELECTED";} ?>>Homebrewers Bitterness Units (HBU)</option>
      </select>      </td>
      <td class="data">IBU is the more recognized standard.</td>
</tr>
<tr>
      <td class="dataLabelLeft">Pellet Factor:</td>
      <td class="data"><input name="pelletFactor" type="text" value="<?php echo $row_log['hopPelletFactor']; ?>" size="5" /></td>
      <td class="data">Represents increased utilization vs. whole or plug hops. A value of 1.06 is recommended as this reflects a 6% increase over whole hops.</td>
</tr>    
</table>

<div class="headerContentAdmin">Water and Mash Profiles</div>
<table>
<tr>
      <td class="dataLabelLeft">Manage Water Profiles with BrewBlogger?</td>
      <td class="data" nowrap>
	  <input name="waterDisplayMethod" type="radio" class="radiobutton" value="1" <?php if (!(strcmp("1", $row_log['waterDisplayMethod']))) {echo "CHECKED";} ?>> Yes&nbsp;
        <input name="waterDisplayMethod" type="radio" class="radiobutton" value="2" <?php if (!(strcmp("2", $row_log['waterDisplayMethod']))) {echo "CHECKED";} ?>> No
	  </td>
      <td class="data">"Yes" indicates that you would like to use BrewBlogger's water profiles database. You can add your local water profile to the database and  reuse it or emulate other famous brewing locations' profiles for your brews.</td>
</tr>
<tr>
      <td class="dataLabelLeft">Manage Mash Profiles with BrewBlogger?</td>
      <td class="data" nowrap>
	  <input name="mashDisplayMethod" type="radio" class="radiobutton" value="1" <?php if (!(strcmp("1", $row_log['mashDisplayMethod']))) {echo "CHECKED";} ?>> Yes&nbsp;
      <input name="mashDisplayMethod" type="radio" class="radiobutton" value="2" <?php if (!(strcmp("2", $row_log['mashDisplayMethod']))) {echo "CHECKED";} ?>> No
	  </td>
      <td class="data">"Yes" indicates that you would like to use BrewBlogger's mash profiles database. You can add your own mash profiles to the database and  reuse any one for a BrewBlog.</td>
</tr>
</table>

<div class="headerContentAdmin">Menu Link Text</div>
<table>
<tr>
      <td class="dataLabelLeft">Home Link Text:</td>
      <td class="data"><input name="menuHome" type="text" value="<?php echo $row_log['menuHome']; ?>" size="25" /></td>
</tr>
<tr>
      <td class="dataLabelLeft">BrewBlogs Link Text:</td>
      <td class="data"><input name="menuBrewBlogs" type="text" value="<?php echo $row_log['menuBrewBlogs']; ?>" size="25" /></td>
</tr>
<tr>
      <td class="dataLabelLeft">Recipes Link Text:</td>
      <td class="data"><input name="menuRecipes" type="text" value="<?php echo $row_log['menuRecipes']; ?>" size="25" /></td>
</tr>
<tr>
      <td class="dataLabelLeft">Awards Link Text:</td>
      <td class="data"><input name="menuAwards" type="text" value="<?php echo $row_log['menuAwards']; ?>" size="25" /></td>
</tr>
<tr>
      <td class="dataLabelLeft">About Link Text:</td>
      <td class="data"><input name="menuAbout" type="text" value="<?php echo $row_log['menuAbout']; ?>" size="25" /></td>
</tr>
<tr>
      <td class="dataLabelLeft">Reference Link Text:</td>
      <td class="data"><input name="menuReference" type="text" value="<?php echo $row_log['menuReference']; ?>" size="25" /></td>
</tr>
<tr>
      <td class="dataLabelLeft">Calculators Link Text:</td>
      <td class="data"><input name="menuCalculators" type="text" value="<?php echo $row_log['menuCalculators']; ?>" size="25" /></td>
</tr>
<tr>
      <td class="dataLabelLeft">Calendar Link Text:</td>
      <td class="data"><input name="menuCalendar" type="text" value="<?php echo $row_log['menuCalendar']; ?>" size="25" /></td>
</tr>
<tr>
      <td class="dataLabelLeft">Login Link Text:</td>
      <td class="data"><input name="menuLogin" type="text" value="<?php echo $row_log['menuLogin']; ?>" size="25" /></td>
</tr>
<tr>
      <td class="dataLabelLeft">Log Out Link Text:</td>
      <td class="data"><input name="menuLogout" type="text" value="<?php echo $row_log['menuLogout']; ?>" size="25" /></td>
</tr>
<?php if ($row_pref['mode'] == "2") { ?>
<tr>
      <td class="dataLabelLeft">Members Link Text:</td>
      <td class="data"><input name="menuMembers" type="text" value="<?php echo $row_log['menuMembers']; ?>" size="25" /></td>
</tr>
<?php } ?>
</table>
<div class="headerContentAdmin">Printing and File Downloads</div>
<table>
<tr>
      <td class="dataLabelLeft">Allow Visitors to Print an Entire BrewBlog?</td>
      <td class="data">
	  <input name="allowPrintLog" type="radio" class="radiobutton" value="Y" <?php if (!(strcmp("Y", $row_log['allowPrintLog']))) {echo "CHECKED";} ?>> Yes&nbsp;
        <input name="allowPrintLog" type="radio" class="radiobutton" value="N" <?php if (!(strcmp("N", $row_log['allowPrintLog']))) {echo "CHECKED";} ?>> No
	  </td>
</tr>
<tr>
      <td class="dataLabelLeft">Allow Visitors to Print Recipes?</td>
      <td class="data">
	  <input name="allowPrintRecipe" type="radio" class="radiobutton" value="Y" <?php if (!(strcmp("Y", $row_log['allowPrintRecipe']))) {echo "CHECKED";} ?>> Yes&nbsp;
        <input name="allowPrintRecipe" type="radio" class="radiobutton" value="N" <?php if (!(strcmp("N", $row_log['allowPrintRecipe']))) {echo "CHECKED";} ?>> No
	  </td>
</tr>
<tr>
      <td class="dataLabelLeft">Allow Visitors to Output Beer XML?</td>
      <td class="data">
	  <input name="allowPrintXML" type="radio" class="radiobutton" value="Y" <?php if (!(strcmp("Y", $row_log['allowPrintXML']))) {echo "CHECKED";} ?>> Yes&nbsp;
        <input name="allowPrintXML" type="radio" class="radiobutton" value="N" <?php if (!(strcmp("N", $row_log['allowPrintXML']))) {echo "CHECKED";} ?>> No
	  </td>
</tr>
</table>
<div class="headerContentAdmin">BrewBlog and Recipe Display</div>
<table>
<tr>
      <td class="dataLabelLeft">Display Specifics?</td>
      <td class="data">
	  <input name="allowSpecifics" type="radio" class="radiobutton" value="Y" <?php if (!(strcmp("Y", $row_log['allowSpecifics']))) {echo "CHECKED";} ?>> Yes&nbsp;
        <input name="allowSpecifics" type="radio" class="radiobutton" value="N" <?php if (!(strcmp("N", $row_log['allowSpecifics']))) {echo "CHECKED";} ?>> No
	  </td>
</tr>
<tr>
      <td class="dataLabelLeft">Display General Info?</td>
      <td class="data">
	  <input name="allowGeneral" type="radio" class="radiobutton" value="Y" <?php if (!(strcmp("Y", $row_log['allowGeneral']))) {echo "CHECKED";} ?>> Yes&nbsp;
        <input name="allowGeneral" type="radio" class="radiobutton" value="N" <?php if (!(strcmp("N", $row_log['allowGeneral']))) {echo "CHECKED";} ?>> No
	  </td>
</tr>
<tr>
      <td class="dataLabelLeft">Display Comments?</td>
      <td class="data">
	    <input name="allowComments" type="radio" class="radiobutton" value="Y" <?php if (!(strcmp("Y", $row_log['allowComments']))) {echo "CHECKED";} ?>> Yes&nbsp;
        <input name="allowComments" type="radio" class="radiobutton" value="N" <?php if (!(strcmp("N", $row_log['allowComments']))) {echo "CHECKED";} ?>> No
	  </td>
</tr>
<tr>
      <td class="dataLabelLeft">Display Grains, Hops, Adjuncts?</td>
      <td class="data">
	    <input name="allowRecipe" type="radio" class="radiobutton" value="Y" <?php if (!(strcmp("Y", $row_log['allowRecipe']))) {echo "CHECKED";} ?>> Yes&nbsp;
        <input name="allowRecipe" type="radio" class="radiobutton" value="N" <?php if (!(strcmp("N", $row_log['allowRecipe']))) {echo "CHECKED";} ?>> No
	  </td>
</tr>
<tr>
      <td class="dataLabelLeft">Display Mash Profile?</td>
      <td class="data">
	  <input name="allowMash" type="radio" class="radiobutton" value="Y" <?php if (!(strcmp("Y", $row_log['allowMash']))) {echo "CHECKED";} ?>> Yes&nbsp;
        <input name="allowMash" type="radio" class="radiobutton" value="N" <?php if (!(strcmp("N", $row_log['allowMash']))) {echo "CHECKED";} ?>> No
	  </td>
</tr>
<tr>
      <td class="dataLabelLeft">Display Water Profile?</td>
      <td class="data">
	    <input name="allowWater" type="radio" class="radiobutton" value="Y" <?php if (!(strcmp("Y", $row_log['allowWater']))) {echo "CHECKED";} ?>> Yes&nbsp;
        <input name="allowWater" type="radio" class="radiobutton" value="N" <?php if (!(strcmp("N", $row_log['allowWater']))) {echo "CHECKED";} ?>> No
      </td>
</tr>
<tr>
      <td class="dataLabelLeft">Display Brewing Procedure?</td>
      <td class="data">
        <input name="allowProcedure" type="radio" class="radiobutton" value="Y" <?php if (!(strcmp("Y", $row_log['allowProcedure']))) {echo "CHECKED";} ?>> Yes&nbsp;
        <input name="allowProcedure" type="radio" class="radiobutton" value="N" <?php if (!(strcmp("N", $row_log['allowProcedure']))) {echo "CHECKED";} ?>> No
	  </td>
</tr>
<tr>
      <td class="dataLabelLeft">Display Special Procedure?</td>
      <td class="data">
	    <input name="allowSpecialProcedure" type="radio" class="radiobutton" value="Y" <?php if (!(strcmp("Y", $row_log['allowSpecialProcedure']))) {echo "CHECKED";} ?>> Yes&nbsp;
        <input name="allowSpecialProcedure" type="radio" class="radiobutton" value="N" <?php if (!(strcmp("N", $row_log['allowSpecialProcedure']))) {echo "CHECKED";} ?>> No
	  </td>
</tr>
<tr>
      <td class="dataLabelLeft">Display Fermentation Schedule?</td>
      <td class="data">
	  <input name="allowFermentation" type="radio" class="radiobutton" value="Y" <?php if (!(strcmp("Y", $row_log['allowFermentation']))) {echo "CHECKED";} ?>> Yes&nbsp;
        <input name="allowFermentation" type="radio" class="radiobutton" value="N" <?php if (!(strcmp("N", $row_log['allowFermentation']))) {echo "CHECKED";} ?>> No
	  </td>
</tr>
<tr>
      <td class="dataLabelLeft">Display Bottle Label Image?</td>
      <td class="data">
	    <input name="allowLabel" type="radio" class="radiobutton" value="Y" <?php if (!(strcmp("Y", $row_log['allowLabel']))) {echo "CHECKED";} ?>> Yes&nbsp;
        <input name="allowLabel" type="radio" class="radiobutton" value="N" <?php if (!(strcmp("N", $row_log['allowLabel']))) {echo "CHECKED";} ?>> No
	  </td>
</tr>
<tr>
      <td class="dataLabelLeft">Display Related Links?</td>
      <td class="data">
		<input name="allowRelated" type="radio" class="radiobutton" value="Y" <?php if (!(strcmp("Y", $row_log['allowRelated']))) {echo "CHECKED";} ?>> Yes&nbsp;
        <input name="allowRelated" type="radio" class="radiobutton" value="N"  <?php if (!(strcmp("N", $row_log['allowRelated']))) {echo "CHECKED";} ?>> No
	  </td>
</tr>
<tr>
      <td class="dataLabelLeft">Display Tasting Reviews?</td>
      <td class="data">
        <input name="allowReviews" type="radio" class="radiobutton" value="Y" <?php if (!(strcmp("Y", $row_log['allowReviews']))) {echo "CHECKED";} ?>> Yes&nbsp;
        <input name="allowReviews" type="radio" class="radiobutton" value="N" <?php if (!(strcmp("N", $row_log['allowReviews']))) {echo "CHECKED";} ?>> No
	  </td>
</tr>
<tr>
      <td class="dataLabelLeft">Display Brew Status?</td>
      <td class="data">
        <input name="allowStatus" type="radio" class="radiobutton" value="Y" <?php if (!(strcmp("Y", $row_log['allowStatus']))) {echo "CHECKED";} ?>> Yes&nbsp;
        <input name="allowStatus" type="radio" class="radiobutton" value="N" <?php if (!(strcmp("N", $row_log['allowStatus']))) {echo "CHECKED";} ?>> No
	  </td>
</tr>
<tr>
	  <td class="dataLabelLeft">Display Upcoming Brews?</td>
      <td class="data">
        <input name="allowUpcoming" type="radio" class="radiobutton" value="Y" <?php if (!(strcmp("Y", $row_log['allowUpcoming']))) {echo "CHECKED";} ?>> Yes&nbsp;
        <input name="allowUpcoming" type="radio" class="radiobutton" value="N" <?php if (!(strcmp("N", $row_log['allowUpcoming']))) {echo "CHECKED";} ?>> No
	  </td>
</tr>
<tr>
	  <td class="dataLabelLeft">Display Awards and Competitions?</td>
      <td class="data">
        <input name="allowAwards" type="radio" class="radiobutton" value="Y" <?php if (!(strcmp("Y", $row_log['allowAwards']))) {echo "CHECKED";} ?>> Yes&nbsp;
        <input name="allowAwards" type="radio" class="radiobutton" value="N" <?php if (!(strcmp("N", $row_log['allowAwards']))) {echo "CHECKED";} ?>> No
	  </td>
</tr>
<tr>
	  <td class="dataLabelLeft">Display Calendar?</td>
      <td class="data">
        <input name="allowCalendar" type="radio" class="radiobutton" value="Y" <?php if (!(strcmp("Y", $row_log['allowCalendar']))) {echo "CHECKED";} ?>> Yes&nbsp;
        <input name="allowCalendar" type="radio" class="radiobutton" value="N" <?php if (!(strcmp("N", $row_log['allowCalendar']))) {echo "CHECKED";} ?>> No
	  </td>
</tr>
<?php if ($row_pref['mode'] == "2") {  ?>
<tr>
	  <td class="dataLabelLeft">Display News?</td>
      <td class="data">
        <input name="allowNews" type="radio" class="radiobutton" value="Y" <?php if (!(strcmp("Y", $row_log['allowNews']))) {echo "CHECKED";} ?>> Yes&nbsp;
        <input name="allowNews" type="radio" class="radiobutton" value="N" <?php if (!(strcmp("N", $row_log['allowNews']))) {echo "CHECKED";} ?>> No
	  </td>
</tr>
<tr>
	  <td class="dataLabelLeft">Display Member Profiles?</td>
      <td class="data">
        <input name="allowProfile" type="radio" class="radiobutton" value="Y" <?php if (!(strcmp("Y", $row_log['allowProfile']))) {echo "CHECKED";} ?>> Yes&nbsp;
        <input name="allowProfile" type="radio" class="radiobutton" value="N" <?php if (!(strcmp("N", $row_log['allowProfile']))) {echo "CHECKED";} ?>> No
	  </td>
</tr>
<?php } 
if ($row_pref['mode'] == "1") {  ?>
<input type="hidden" name="allowNews" value="<?php echo $row_log['allowNews']; ?>">
<input type="hidden" name="allowProfile" value="<?php echo $row_log['allowProfile']; ?>">
<input type="hidden" name="menuMembers" value="<?php echo $row_log['menuMembers']; ?>">
<?php } ?>
</table>
<?php include (ADMIN_INCLUDES.'add_edit_buttons.inc.php'); ?>