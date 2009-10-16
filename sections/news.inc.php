<?php if ($page != "news") { ?>
<div id="<?php if (($page == "brewBlogCurrent") || ($page == "brewBlogDetail") || ($page == "recipeDetail") || ($page == "about")) echo "subtitle"; else echo "subtitleWide"; ?>"><div id="icon"><img src="<?php echo $imageSrc."newspaper.png"; ?>" align="baseline"></div>Club News/Announcements</div>
<?php } ?>
<?php // echo $totalRows_newsGen; ?>
<?php if ($page == "news") { ?>
<table class="dataTable">
    <?php if ($totalRows_newsGen > 5) {	?>
    <tr>
  	<td width="90%">&nbsp;</td>
    <td width="10%" class="text_9">Limit View To&nbsp;
    <?php if (($totalRows_newsGen >= 5) && ($totalRows_newsGen < 15)) { ?><a href="index.php?page=news&sort=<?php echo $sort; ?>&dir=<?php echo $dir; ?>&view=5">5</a>&nbsp;<?php } ?>
    <?php if (($totalRows_newsGen >= 15) && ($totalRows_newsGen < 25)) { ?><a href="index.php?page=news&sort=<?php echo $sort; ?>&dir=<?php echo $dir; ?>&view=15">15</a>&nbsp;<?php } ?>
    <?php if ($totalRows_newsGen >= 25) { ?><a href="index.php?page=news&sort=<?php echo $sort; ?>&dir=<?php echo $dir; ?>&view=25">25</a>&nbsp;<?php } ?>
    News Items</td>
    </tr>
    <?php } ?>
	<?php if (($view != "all") && ($totalRows_newsGen > $view)) { ?>
    <tr>
  	<td width="90%">&nbsp;</td>
    <td width="10%" class="text_9 right"><a href="index.php?page=news&sort=<?php echo $sort; ?>&dir=<?php echo $dir; ?>&view=all">All News &gt;&gt;</a></td>
    </tr>
	<?php } ?>
</table>
<?php } ?>
<table class="dataTable" style="margin-bottom: 15px;">
  <tr>
    <td class="dataLeft">Members, <?php if ((isset($_SESSION["loginUsername"])) && ($totalRows_newsGen > 0)) { ?><a href="admin/index.php?action=view&dbTable=news">click here</a><?php } else { ?><a href="index.php?page=login">login</a><?php } ?> to view club-only news.</td>
 </tr>
</table>
<?php do { ?>
<?php if ($row_news['newsPrivate'] == "Y") { ?>
<div id="headerContent<?php if ($page == "news") echo "Admin"; ?>"><?php echo $row_news['newsHeadline']; ?></div>
<table class="dataTable" style="margin-bottom: 15px;">
  <tr>
  	<td>&nbsp;</td>
    <td class="text_9 right bknd_ultra_lt" width="10%" nowrap="nowrap">&nbsp;Posted <?php $date = $row_news['newsDate']; $realdate = dateconvert($date,2); echo $realdate; ?> by <?php echo $row_news['newsPoster']; ?>&nbsp;</td>
  </tr>
  <tr>
  	<td colspan="2" style="padding-top: 5px;"><?php if ($page == "news") echo $row_news['newsText']; else { $str = $row_news['newsText']; echo Truncate5($str); } ?></td>
  </tr>
  <?php if ($page != "news") { ?>
  <tr>
  	<td colspan="2" style="padding-top: 5px;" class="text_9"><div align="right"><a href="index.php?page=news&sort=newsDate&dir=DESC&view=5">Read the Entire Post &gt;&gt;</a></div></td>
  </tr>
  <?php } ?>
</table>
<?php } } while ($row_news = mysql_fetch_assoc($news)); 
if (($totalRows_newsGen > 2) && ($page != "news")) { ?>
<table class="dataTable">
  <tr>
  	<td width="90%">&nbsp;</td>
    <td width="10%" class="text_9"><a href="index.php?page=news&sort=newsDate&dir=DESC&view=5">More News &gt;&gt;</a></td>
</tr>
</table>
<?php } ?>