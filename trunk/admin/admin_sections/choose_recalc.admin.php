<div id="breadcrumbAdmin"><a href="index.php">Administration</a> &gt; <?php echo $page_title; ?></div>
<div id="subtitleAdmin"><?php echo $page_title; ?></div>
<table class="dataTable">
<tr>
<td class="dataLabel">Choose a BrewBlog:</td>
<td class="data">
<form name="form4">
<select name="menu1" onChange="MM_jumpMenu('parent',this,0)">
	<option value=""></option>
  	<?php if ($totalRows_brewBlogs > 0) do { ?>
    <option value="index.php?action=calculate&source=brewing&results=false&filter=<?php echo $row_brewBlogs['brewBrewerID']; ?>&id=<?php echo $row_brewBlogs['id']; ?>"><?php echo $row_brewBlogs['brewName']." [";  $date = $row_brewBlogs['brewDate']; $realdate = dateconvert2($date,3); echo $realdate; if ($row_pref['mode'] == "2") echo " &ndash; ".$row_brewBlogs['brewBrewerID']; echo "]"; ?></option>
	<?php } while ($row_brewBlogs = mysql_fetch_assoc($brewBlogs)); $rows = mysql_num_rows($brewBlogs);	if($rows > 0) {	mysql_data_seek($brewBlogs, 0); $row_brewBlogs = mysql_fetch_assoc($brewBlogs); } ?>
  </select>
  </form>
</td>
</tr>
<tr>
<td class="dataLabel">Choose a Recipe:</td>
<td class="data">
<form name="form5">
<select name="menu2" onChange="MM_jumpMenu('parent',this,0)">
	<option value=""></option>
  	<?php if ($totalRows_recipes > 0) do { ?>
    <option value="index.php?action=calculate&source=recipes&results=false&id=<?php echo $row_recipes['id']; ?>&filter=<?php echo $row_recipes['brewBrewerID']; ?>"><?php echo $row_recipes['brewName']; if ($row_pref['mode'] == "2") echo " [".$row_recipes['brewBrewerID']."]"; ?></option>
	<?php } while ($row_recipes = mysql_fetch_assoc($recipes)); $rows = mysql_num_rows($recipes);	if($rows > 0) {	mysql_data_seek($recipes, 0); $row_recipes = mysql_fetch_assoc($recipes); } ?>
  </select>
  </form>
</td>
</tr>
</table>