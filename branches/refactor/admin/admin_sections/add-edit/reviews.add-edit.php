<table class="dataTable">
<?php if (($row_pref['mode'] == "2") && ($row_user['userLevel'] =="1")) { ?>
  <tr>
	<td class="dataLabelLeft" >Brewer ID:</td> 
	<td class="data">
	<select name="brewBrewerID">
	<option value=""></option>
    <?php do {  ?>
    <option value="<?php echo $row_users['user_name']?>" <?php if (($action == "add") && ($row_users['user_name'] == $loginUsername)) echo "SELECTED"; if (($action == "edit") || ($action=="import") || ($action == "importRecipe") || ($action=="reuse")) {  if ($row_users['user_name'] == $row_log['brewBrewerID']) echo "SELECTED"; } if ($action == "importCalc") {  if ($row_users['user_name'] ==  $filter) echo "SELECTED"; } ?>><?php echo $row_users['realFirstName']." ".$row_users['realLastName']; ?></option>
    <?php } while ($row_users = mysql_fetch_assoc($users)); $rows = mysql_num_rows($users); if($rows > 0) { mysql_data_seek($users, 0); $row_users = mysql_fetch_assoc($users); } ?>
   </select>
	</td>
  </tr>
<?php } ?>
  <tr>
   <td class="dataLabelLeft" >For BrewBlog:</td>
   <td class="data">
   			<select class="text_area" name="brewID">
    			<?php do {  ?>
     			<option value="<?php echo $row_log2['id']?>" <?php if ($action == "edit") { if ($row_log['brewID'] == $row_log2['id']) echo "SELECTED"; } ?>><?php echo $row_log2['brewName'];?></option>
      			<?php } while ($row_log2 = mysql_fetch_assoc($log2));  ?>
   			</select>
   </td>
  </tr>
  <tr>
   <td class="dataLabelLeft" >Scored By:</td>
   <td class="data"><input name="brewScoredBy" type="text" id="brewScoredBy" size="40" maxlength="100" value="<?php if ($action == "edit") echo $row_log['brewScoredBy']; ?>"></td>
  </tr>
  <tr>
    <td class="dataLabelLeft" >Scorer Is:</td>
    <td class="data">
    		 <select class="text_area"  name="brewScorerLevel">
              <option value="The Brewer" <?php if (!(strcmp("The Brewer", $row_log['brewScorerLevel']))) {echo "SELECTED";} ?>>The Brewer</option>
              <option value="Friend" <?php if (!(strcmp("Friend", $row_log['brewScorerLevel']))) {echo "SELECTED";} ?>>Friend</option>
              <option value="Relative" <?php if (!(strcmp("Relative", $row_log['brewScorerLevel']))) {echo "SELECTED";} ?>>Relative</option>
              <option value="Professional Brewer" <?php if (!(strcmp("Professional Brewer", $row_log['brewScorerLevel']))) {echo "SELECTED";} ?>>Professional Brewer</option>
              <option value="Experienced Judge [non-BJCP]" <?php if (!(strcmp("Experienced Judge [non-BJCP]", $row_log['brewScorerLevel']))) {echo "SELECTED";} ?>>Experienced Judge [non-BJCP]</option>
              <option value="BJCP Apprentice Judge" <?php if (!(strcmp("BJCP Apprentice Judge", $row_log['brewScorerLevel']))) {echo "SELECTED";} ?>>BJCP Apprentice Judge</option>
              <option value="BJCP Recognized Judge" <?php if (!(strcmp("BJCP Recognized Judge", $row_log['brewScorerLevel']))) {echo "SELECTED";} ?>>BJCP Recognized Judge</option>
              <option value="BJCP Certified Judge" <?php if (!(strcmp("BJCP Certified Judge", $row_log['brewScorerLevel']))) {echo "SELECTED";} ?>>BJCP Certified Judge</option>
              <option value="BJCP National Judge" <?php if (!(strcmp("BJCP National Judge", $row_log['brewScorerLevel']))) {echo "SELECTED";} ?>>BJCP National Judge</option>
              <option value="BJCP Grand Master Judge" <?php if (!(strcmp("BJCP Grand Master Judge", $row_log['brewScorerLevel']))) {echo "SELECTED";} ?>>BJCP Grand Master Judge</option>
              <option value="BJCP Honarary Master Judge" <?php if (!(strcmp("BJCP Honarary Master Judge", $row_log['brewScorerLevel']))) {echo "SELECTED";} ?>>BJCP Honarary Master Judge</option>
              <option value="BJCP Honarary Grand Master Judge" <?php if (!(strcmp("BJCP Honarary Grand Master Judge", $row_log['brewScorerLevel']))) {echo "SELECTED";} ?>>BJCP Honarary Grand Master Judge</option>
            </select>	
    </td>
  </tr>
  <tr>
    <td class="dataLabelLeft" >Date Scored:</td>
    <td class="data"><input name="brewScoreDate" type="text" value="<?php if ($action == "edit") echo $row_log['brewScoreDate'];  else print date ( 'Y-m-d' ); ?>" /></td>
  </tr>
  <tr>
   <td class="dataLabelLeft" >Aroma Score:</td>
   <td class="data"><select class="text_area"  name="brewAromaScore">
                    <option value="1" <?php if (!(strcmp("1", $row_log['brewAromaScore']))) {echo "SELECTED";} ?>>1</option>
                    <option value="2" <?php if (!(strcmp("2", $row_log['brewAromaScore']))) {echo "SELECTED";} ?>>2</option>
                    <option value="3" <?php if (!(strcmp("3", $row_log['brewAromaScore']))) {echo "SELECTED";} ?>>3</option>
                    <option value="4" <?php if (!(strcmp("4", $row_log['brewAromaScore']))) {echo "SELECTED";} ?>>4</option>
                    <option value="5" <?php if (!(strcmp("5", $row_log['brewAromaScore']))) {echo "SELECTED";} ?>>5</option>
                    <option value="6" <?php if (!(strcmp("6", $row_log['brewAromaScore']))) {echo "SELECTED";} ?>>6</option>
                    <option value="7" <?php if (!(strcmp("7", $row_log['brewAromaScore']))) {echo "SELECTED";} ?>>7</option>
                    <option value="8" <?php if (!(strcmp("8", $row_log['brewAromaScore']))) {echo "SELECTED";} ?>>8</option>
                    <option value="9" <?php if (!(strcmp("9", $row_log['brewAromaScore']))) {echo "SELECTED";} ?>>9</option>
                    <option value="10" <?php if (!(strcmp("10", $row_log['brewAromaScore']))) {echo "SELECTED";} ?>>10</option>
					<option value="11" <?php if (!(strcmp("11", $row_log['brewAromaScore']))) {echo "SELECTED";} ?>>11</option>
					<option value="12" <?php if (!(strcmp("12", $row_log['brewAromaScore']))) {echo "SELECTED";} ?>>12</option>
                    </select>&nbsp;out of 12   </td>
  </tr>
  <tr>
   <td class="dataLabelLeft" >Aroma Comments:</td>
   <td class="data"><textarea name="brewAromaInfo" cols="67" rows="10"><?php if ($action == "edit") echo $row_log['brewAromaInfo']; ?></textarea></td>
  </tr>
  <tr>
   <td class="dataLabelLeft" >Appearance Score:</td>
   <td class="data"><select class="text_area"  name="brewAppearanceScore">
                    <option value="1" <?php if (!(strcmp("1", $row_log['brewAppearanceScore']))) {echo "SELECTED";} ?>>1</option>
                    <option value="2" <?php if (!(strcmp("2", $row_log['brewAppearanceScore']))) {echo "SELECTED";} ?>>2</option>
                    <option value="3" <?php if (!(strcmp("3", $row_log['brewAppearanceScore']))) {echo "SELECTED";} ?>>3</option>
                    </select>&nbsp;out of 3   </td>
  </tr>
  <tr>
   <td class="dataLabelLeft" >Appearance Comments:</td>
   <td class="data"><textarea name="brewAppearanceInfo" cols="67" rows="10"><?php if ($action == "edit") echo $row_log['brewAppearanceInfo']; ?></textarea></td>
  </tr>
  <tr>
   <td class="dataLabelLeft" >Flavor Score:</td>
   <td class="data"><select class="text_area"  name="brewFlavorScore">
                    <option value="1" <?php if (!(strcmp("1", $row_log['brewFlavorScore']))) {echo "SELECTED";} ?>>1</option>
                    <option value="2" <?php if (!(strcmp("2", $row_log['brewFlavorScore']))) {echo "SELECTED";} ?>>2</option>
					<option value="3" <?php if (!(strcmp("3", $row_log['brewFlavorScore']))) {echo "SELECTED";} ?>>3</option>
					<option value="4" <?php if (!(strcmp("4", $row_log['brewFlavorScore']))) {echo "SELECTED";} ?>>4</option>
					<option value="5" <?php if (!(strcmp("5", $row_log['brewFlavorScore']))) {echo "SELECTED";} ?>>5</option>
					<option value="6" <?php if (!(strcmp("6", $row_log['brewFlavorScore']))) {echo "SELECTED";} ?>>6</option>
					<option value="7" <?php if (!(strcmp("7", $row_log['brewFlavorScore']))) {echo "SELECTED";} ?>>7</option>
					<option value="8" <?php if (!(strcmp("8", $row_log['brewFlavorScore']))) {echo "SELECTED";} ?>>8</option>

					<option value="9" <?php if (!(strcmp("9", $row_log['brewFlavorScore']))) {echo "SELECTED";} ?>>9</option>
					<option value="10" <?php if (!(strcmp("10", $row_log['brewFlavorScore']))) {echo "SELECTED";} ?>>10</option>
					<option value="11" <?php if (!(strcmp("11", $row_log['brewFlavorScore']))) {echo "SELECTED";} ?>>11</option>
					<option value="12" <?php if (!(strcmp("12", $row_log['brewFlavorScore']))) {echo "SELECTED";} ?>>12</option>
					<option value="13" <?php if (!(strcmp("13", $row_log['brewFlavorScore']))) {echo "SELECTED";} ?>>13</option>
					<option value="14" <?php if (!(strcmp("14", $row_log['brewFlavorScore']))) {echo "SELECTED";} ?>>14</option>
					<option value="15" <?php if (!(strcmp("15", $row_log['brewFlavorScore']))) {echo "SELECTED";} ?>>15</option>
					<option value="16" <?php if (!(strcmp("16", $row_log['brewFlavorScore']))) {echo "SELECTED";} ?>>16</option>
					<option value="17" <?php if (!(strcmp("17", $row_log['brewFlavorScore']))) {echo "SELECTED";} ?>>17</option>
					<option value="18" <?php if (!(strcmp("18", $row_log['brewFlavorScore']))) {echo "SELECTED";} ?>>18</option>
					<option value="19" <?php if (!(strcmp("19", $row_log['brewFlavorScore']))) {echo "SELECTED";} ?>>19</option>
					<option value="20" <?php if (!(strcmp("20", $row_log['brewFlavorScore']))) {echo "SELECTED";} ?>>20</option>
                    </select>&nbsp;out of 20                  </td>
   </tr>
   <tr>
    <td class="dataLabelLeft" >Flavor Comments:</td>
    <td class="data"><textarea name="brewFlavorInfo" cols="67" rows="10"><?php if ($action == "edit") echo $row_log['brewFlavorInfo']; ?></textarea></td>
   </tr>
   <tr>
    <td class="dataLabelLeft" >Mouthfeel Score:</td>
    <td class="data"><select class="text_area"  name="brewMouthfeelScore">
                      <option value="1" <?php if (!(strcmp($row_log['brewMouthfeelScore'], "1"))) {echo "SELECTED";} ?>>1</option>
                      <option value="2" <?php if (!(strcmp($row_log['brewMouthfeelScore'], "2"))) {echo "SELECTED";} ?>>2</option>
					  <option value="3" <?php if (!(strcmp($row_log['brewMouthfeelScore'], "3"))) {echo "SELECTED";} ?>>3</option>
					  <option value="4" <?php if (!(strcmp($row_log['brewMouthfeelScore'], "4"))) {echo "SELECTED";} ?>>4</option>
					  <option value="5" <?php if (!(strcmp($row_log['brewMouthfeelScore'], "5"))) {echo "SELECTED";} ?>>5</option>
	                </select>&nbsp;out of 5    </td>
   </tr>
   <tr>
    <td class="dataLabelLeft" >Mouthfeel Comments:</td>
    <td class="data"><textarea name="brewMouthfeelInfo" cols="67" rows="10"><?php if ($action == "edit") echo $row_log['brewMouthfeelInfo']; ?></textarea></td>
   </tr>
   <tr>
    <td class="dataLabelLeft" >Overall Impression:</td>
    <td class="data"><select class="text_area"  name="brewOverallScore">
                      <option value="1" <?php if (!(strcmp("1", $row_log['brewOverallScore']))) {echo "SELECTED";} ?>>1</option>
                      <option value="2" <?php if (!(strcmp("2", $row_log['brewOverallScore']))) {echo "SELECTED";} ?>>2</option>
                      <option value="3" <?php if (!(strcmp("3", $row_log['brewOverallScore']))) {echo "SELECTED";} ?>>3</option>
					  <option value="4" <?php if (!(strcmp("4", $row_log['brewOverallScore']))) {echo "SELECTED";} ?>>4</option>
					  <option value="5" <?php if (!(strcmp("5", $row_log['brewOverallScore']))) {echo "SELECTED";} ?>>5</option>
					  <option value="6" <?php if (!(strcmp("6", $row_log['brewOverallScore']))) {echo "SELECTED";} ?>>6</option>
					  <option value="7" <?php if (!(strcmp("7", $row_log['brewOverallScore']))) {echo "SELECTED";} ?>>7</option>
					  <option value="8" <?php if (!(strcmp("8", $row_log['brewOverallScore']))) {echo "SELECTED";} ?>>8</option>
					  <option value="9" <?php if (!(strcmp("9", $row_log['brewOverallScore']))) {echo "SELECTED";} ?>>9</option>
					  <option value="10" <?php if (!(strcmp("10", $row_log['brewOverallScore']))) {echo "SELECTED";} ?>>10</option>
                    </select>&nbsp;out of 10     </td>
     </tr>
     <tr>
      <td class="dataLabelLeft" >Overall Comments:</td>
      <td class="data"><textarea name="brewOverallInfo" cols="67" rows="10"><?php if ($action == "edit") echo $row_log['brewOverallInfo']; ?></textarea></td>
     </tr>
</table>
<?php if ($row_user['userLevel'] == "2") { ?><input name="brewBrewerID" type="hidden" value="<?php echo $loginUsername; ?>" /><?php } ?>
<?php include (ADMIN_INCLUDES.'add_edit_buttons.inc.php'); ?>