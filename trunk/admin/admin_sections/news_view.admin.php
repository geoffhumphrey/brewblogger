<div id="breadcrumbAdmin"><a href="index.php">Administration</a> &gt; <?php echo $row_pref['menuMembers']; ?> News</div>
<div id="subtitleAdmin"><?php echo $row_pref['menuMembers']; ?> News</div>
Check here for news for club members eyes only.<br><br>
<?php if ($totalRows_newsGen == 0) { ?>
There is no <?php echo $row_pref['menuMembers']; ?> news. Please check the <a href="../index.php?page=news&sort=newsDate&dir=DESC&view=5">public news</a>.
<?php } else { ?>
<?php do { ?>
<div id="headerContentAdmin"><?php echo $row_newsGen['newsHeadline']; ?></div>
<table class="dataTable" style="margin-bottom: 25px;">
  <tr>
  	<td width="90%">&nbsp;</td>
    <td class="text_9 right bknd_lt" nowrap>&nbsp;Posted <?php $date = $row_newsGen['newsDate']; $realdate = dateconvert($date,2); echo $realdate; ?> by <?php echo $row_newsGen['newsPoster']; ?>&nbsp;</td>
  </tr>
  <tr>
  	<td colspan="2" style="padding-top: 5px;"><?php echo $row_newsGen['newsText']; ?></td>
  </tr>
</table>
<?php  
} while ($row_newsGen = mysql_fetch_assoc($newsGen)); 
} ?>
