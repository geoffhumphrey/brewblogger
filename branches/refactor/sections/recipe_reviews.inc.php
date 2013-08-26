<a name="tasting" id="tasting"></a>
<div class="headerContent">Tasting Reviews</div>
<div class="data-container">
<table class="dataTable">
 <tr>
  <td class="dataLeft" width="1%"><img src="<?php echo $imageSrc; ?>page_edit.png" align="absmiddle" border="0"></td>
  <td class="data" width="10%"><?php echo $totalRows_review; ?>&nbsp;Review<?php if ($totalRows_review != 1) echo "s" ?></td>
  <td class="data" width="1%"><img src="<?php echo $imageSrc; ?>page_add.png" align="absmiddle" border="0">
  <td class="data" width="10%" nowrap><a href="sections/add_review.inc.php?id=<?php echo $row_log['id']; ?>&KeepThis=true&TB_iframe=true&height=450&width=800" title="Submit a Review for <?php echo $row_log['brewName']; ?>" class="thickbox">Submit a Review</a></td>
  <td class="data" width="1%"><img src="<?php echo $imageSrc; ?>arrow_refresh.png" align="absmiddle" border="0"></td>
  <td class="data" nowrap><a href="JavaScript:location.reload(true);">Refresh Page</a></td>
  <?php if ($totalRows_review > 5) { ?>
  <td class="data" width="1%"><img src="<?php echo $imageSrc; ?>eye.png" align="absmiddle" border="0"></td>
  <td class="data"><?php if ($view != "all") { ?><a href="<?php echo "index.php?page=".$page."&filter=".$filter."&id=".$id."&view=all#tasting"; ?>">View All</a><?php } else { ?><a href="<?php echo "index.php?page=".$page."&filter=".$filter."&id=".$id."&view=limited#tasting"; ?>">View Latest 5</a><?php } ?></td>
  <?php } ?>
 </tr>
</table>
 <?php if ($totalRows_review != 0) { ?>
<table class="text_10 dataTable">
 <tr>
  <td class="dataLeft" width="1%"><img src="<?php echo $imageSrc; ?>star.png" align="absmiddle" border="0" /></td>
  <td class="data" width="10%" nowrap>45-50 = Outstanding</td>
  <td class="data" width="1%"><img src="<?php echo $imageSrc; ?>award_star_silver_2.png" align="absmiddle" border="0" /></td>
  <td class="data" width="10%" nowrap>30-37 = Very Good</td>
  <td class="data" width="1%"><img src="<?php echo $imageSrc; ?>bell.png" align="absmiddle" border="0" /></td>
  <td class="data" nowrap>14-20 = Fair</td>
</tr>
<tr>
  <td class="dataLeft"><img src="<?php echo $imageSrc; ?>award_star_gold_2.png" align="absmiddle" border="0" /></td>
  <td class="data" nowrap>38-44 = Excellent</td>
  <td class="data"><img src="<?php echo $imageSrc; ?>award_star_bronze_2.png" align="absmiddle" border="0" /></td>
  <td class="data" nowrap>21-29 = Good</td>
  <td class="data"><img src="<?php echo $imageSrc; ?>emoticon_unhappy.png" align="absmiddle" border="0" /></td>
  <td class="data" nowrap>00-13 = Problematic</td>
</tr>
</table>

<?php do { ?>
<?php $taste_calc = ($row_review['brewAromaScore'] + $row_review['brewAppearanceScore'] + $row_review['brewFlavorScore'] + $row_review['brewMouthfeelScore'] + $row_review['brewOverallScore']); ?> 
<div id="wideWrapperReview">
<div id="referenceHeader"><span class="data-icon"><img src="<?php echo $imageSrc; ?>page_edit.png" align="absmiddle" border="0"></span><span class="data">Review by <?php echo $row_review['brewScoredBy']; if ($row_review['brewScorerLevel'] != "") echo " (".$row_review['brewScorerLevel'].")"; ?></span></div>
<table class="dataTable">
      <tr bgcolor="<?php echo $color1; ?>">
        <td class="dataLabelLeft">Aroma: </td>
        <td class="data" width="15%" nowrap><?php echo $row_review['brewAromaScore']; ?> / 12 </td>
        <td class="data" width="75%" ><?php echo $row_review['brewAromaInfo']; ?></td>
      </tr>
      <tr bgcolor="<?php echo $color2; ?>">
        <td class="dataLabelLeft">Appearance:</td>
        <td class="data"><?php echo $row_review['brewAppearanceScore']; ?> / 3 </td>
        <td class="data"><?php echo $row_review['brewAppearanceInfo']; ?></td>
      </tr>
      <tr bgcolor="<?php echo $color1; ?>">
        <td class="dataLabelLeft">Flavor:</td>
        <td class="data"><?php echo $row_review['brewFlavorScore']; ?> / 20 </td>
        <td class="data"><?php echo $row_review['brewFlavorInfo']; ?></td>
      </tr>
      <tr bgcolor="<?php echo $color2; ?>">
        <td class="dataLabelLeft">Mouthfeel:</td>
        <td class="data"><?php echo $row_review['brewMouthfeelScore']; ?> / 5 </td>
        <td class="data"><?php echo $row_review['brewMouthfeelInfo']; ?></td>
      </tr>
      <tr bgcolor="<?php echo $color1; ?>">
        <td class="dataLabelLeft">Overall Impression: </td>
        <td class="data"><?php echo $row_review['brewOverallScore']; ?> / 10</td>
        <td class="data"><?php echo $row_review['brewOverallInfo']; ?></td>
      </tr>
      <tr bgcolor="<?php echo $color2; ?>">
        <td class="dataLabelLeft">Cumulative Score:</td>
        <td class="data" nowrap><?php echo $taste_calc; ?> / 50 </td>
        <td class="data dataLabel">
		<?php 
		if ($taste_calc >= 45) { ?><span class="data-icon"><img src="<?php echo $imageSrc; ?>star.png" align="absmiddle" border="0"></span><span class="dk data">Outstanding</span><?php } 
		if ($taste_calc >= 38 && $taste_calc <= 44) { ?><span class="data-icon"><img src="<?php echo $imageSrc; ?>award_star_gold_2.png" align="absmiddle" border="0"></span><span class="dk data">Excellent</span><?php } 
		if ($taste_calc >= 30 && $taste_calc <= 37) { ?><span class="data-icon"><img src="<?php echo $imageSrc; ?>award_star_silver_2.png" align="absmiddle" border="0"></span><span class="dk data">Very Good</span><?php } 
		if ($taste_calc >= 21 && $taste_calc <= 29) { ?><span class="data-icon"><img src="<?php echo $imageSrc; ?>award_star_bronze_2.png" align="absmiddle" border="0"></span><span class="dk data">Good</span><?php } 
		if ($taste_calc >= 14 && $taste_calc <= 20) { ?><span class="data-icon"><img src="<?php echo $imageSrc; ?>bell.png" align="absmiddle" border="0"></span><span class="dk data">Fair</span><?php }
		if ($taste_calc >= 00 && $taste_calc <= 13) { ?><span class="data-icon"><img src="<?php echo $imageSrc; ?>bell_error.png" align="absmiddle" border="0"></span><span class="dk data">Problematic</span><?php }
		?>
		</td>
      </tr>
    </table>
 </div>
<?php } while ($row_review = mysql_fetch_assoc($review)); ?>             
<?php } ?>
</div>
