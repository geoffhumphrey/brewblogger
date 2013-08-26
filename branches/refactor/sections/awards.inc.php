<?php if  ($totalRows_awards > 0) { ?>
<div id="sidebarWrapper">
  <div id="sidebarHeader">Awards &amp; Competitions</div>
    <div id="sidebarInnerWrapper">
    <?php do { ?>
	<table width="100%" >
	 <tr>
	  <td width="5%" class="dataLabelLeft">Entry Name:</td>
	  <td width="90%" class="data"><?php echo $row_awards['awardBrewName']; ?></td>
	  <td width="5%" rowspan="5"><img src="<?php echo $imageSrc; if ($row_awards['awardPlace'] == "best") echo "award_star_gold_3.png"; elseif ($row_awards['awardPlace'] == "1") echo "medal_gold_3.png"; elseif ($row_awards['awardPlace'] == "2") echo "medal_silver_3.png"; elseif ($row_awards['awardPlace'] == "3") echo "medal_bronze_3.png"; elseif ($row_awards['awardPlace'] == "entry") echo "tag_blue.png";  else echo "star.png";  ?>" border="0"/></td>
     </tr>
     <tr>
      <td class="dataLabelLeft">Competition:</td>
	  <td class="data"><?php if ($row_awards['awardContestURL'] != "") { ?><a href="<?php echo $row_awards['awardContestURL']; ?>" target="_blank">
	    <?php } echo $row_awards['awardContest']; if ($row_awards['awardContestURL'] != "") { ?></a><?php } ?></td>
	 </tr>
	 <tr>
	  <td class="dataLabelLeft">Date:</td>
	  <td class="data"><?php  $date = $row_awards['awardDate']; $realdate = dateconvert($date,3); echo $realdate; ?></td>
	 </tr>
	 <tr>
	  <td class="dataLabelLeft">Style:</td>
	  <td class="data"><?php echo $row_awards['awardStyle']; ?></td>
	 </tr>
     <tr>
      <td class="dataLabelLeft">Place:</td>
      <td class="data"><?php if ($row_awards['awardPlace'] == "best") echo "Best In Show"; elseif ($row_awards['awardPlace'] == "1") echo "1st (Gold)"; elseif ($row_awards['awardPlace'] == "2") echo "2nd (Silver)"; elseif ($row_awards['awardPlace'] == "3") echo "3rd (Bronze)"; elseif ($row_awards['awardPlace'] == "honMen") echo "Honorable Mention";else echo "Entry Only"; ?></td>
     </tr>
     <tr>
      <td colspan="3" style="padding-bottom: .8em;"></td>
     </tr>
	</table>
    <?php } while ($row_awards = mysql_fetch_assoc($awards)); ?>
	</div>
  </div>
<?php } ?>
