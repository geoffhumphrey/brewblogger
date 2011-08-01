<?php 
		/* mysql_select_db($database_brewing, $brewing);
		$query_styles = sprintf("SELECT * FROM styles WHERE brewStyle='%s'", $row_recipeList['brewStyle']);
		$styles = mysql_query($query_styles, $brewing) or die(mysql_error());
		$row_styles = mysql_fetch_assoc($styles);
		$totalRows_styles = mysql_num_rows($styles);
		*/
		?>
		<div id="contentWide">
       <?php 
		 
		if ($total == 0) 
		{ ?>
		<table class="dataTable">
            <tr>
            	<td class="dataHeadingList">There are currently no recipes in the database<?php if ($filter != "all") echo " for this member"; ?>.<br><br></td>
			</tr>
		</table>
		</div>
		<?php } else { ?>
        <?php if ($totalRows_featured > 0) { if (($row_pref['mode'] == "1") ||  (($row_pref['mode'] == "2") && ($filter == "all"))) include ('featured.inc.php'); } ?>
		<?php if ($totalRows_featured > 0) { if (($row_pref['mode'] == "1") ||  (($row_pref['mode'] == "2") && ($filter == "all"))) { ?><div class="headerContentAdmin">All <?php echo $dbName; ?></div><?php } } ?> 
		<table class="dataTable">
        	<tr>
            <?php if ($style != "all") { ?>
              <td><div id="breadcrumb">Filter: <?php echo $row_recipeList['brewStyle'];?> | <a href="<?php echo "http://".$_SERVER['SERVER_NAME'].$_SERVER['SCRIPT_NAME']."?page=".$page."&filter=".$filter."&style=all&sort=".$sort."&dir=".$dir."&view=".$view."&pg=".$pg; ?>">See all styles <?php if (($row_pref['mode'] == "2")&& ($filter != "all")) echo "of recipes entered by ".$row_user2['realFirstName']; ?></a></div></td>
            <?php } ?>
			  <td><div id="paginate"><?php echo $total." ".$row_pref['menuRecipes']." Total"; if ($total > $display) echo "&nbsp;&nbsp;&nbsp;&#8226"; if ($view == "all") echo "&nbsp;&nbsp;&nbsp;&#8226;&nbsp;&nbsp;&nbsp;"; if ($total > $display) { echo "&nbsp;&nbsp;&nbsp;"; paginate($display, $pg, $total);  if ($view == "limited") { ?>&nbsp;&nbsp;&nbsp;&#8226&nbsp;&nbsp;&nbsp;<a href="?page=<?php echo $page; ?>&sort=<?php echo $sort; ?>&dir=<?php echo $dir; ?>&filter=<?php echo $filter; ?>&style=<?php echo $style; ?>&view=all">Entire List of <?php if (($row_pref['mode'] == "2") && ($filter != "all")) echo $row_user2['realFirstName']."'s "; echo $row_pref['menuRecipes']; ?></a><?php } } if  (($view == "all") && ($total < $display)) { ?><a href="?page=<?php echo $page; ?>&sort=<?php echo $sort; ?>&dir=<?php echo $dir; ?>&filter=<?php echo $filter; ?>&style=<?php echo $style; ?>&view=limited">Limited List of <?php if (($row_pref['mode'] == "2")&& ($filter != "all")) echo $row_user2['realFirstName']."'s "; echo $row_pref['menuRecipes']; ?></a><?php } ?></div></td>
              </tr>
        </table>
        <table class="dataTable">
            <tr>
              <?php if (isset($_SESSION["loginUsername"])) echo "<td class=\"dataList\" width=\"1%\"><img src=\"".$imageSrc."pencil.png\" border=\"0\" align=\"absmiddle\"></td>"; ?>
              <?php if (!checkmobile())  { ?><td class="dataHeadingList" width="1%">XML</td><?php } ?>
              <td class="dataHeadingList" width="25%"><?php echo $dbName; ?><?php if (!checkmobile())  { ?>&nbsp;<a href="?page=<?php echo $page; ?>&sort=brewName&dir=ASC&filter=<?php echo $filter; ?>&view=<?php echo $view; ?>"><img src="<?php echo $imageSrc; ?>sort_up.gif" border="0" alt="Sort Ascending"></a><a href="?page=<?php echo $page; ?>&sort=brewName&dir=DESC&filter=<?php echo $filter; ?>&view=<?php echo $view; ?>"><img src="<?php echo $imageSrc; ?>sort_down.gif" border="0" alt="Sort Descending"><?php } ?></td>
              <td class="dataHeadingList" width="25%">Style<?php if (!checkmobile())  { ?>&nbsp;<a href="?page=<?php echo $page; ?>&sort=brewStyle&dir=ASC&filter=<?php echo $filter; ?>&view=<?php echo $view; ?>"><img src="<?php echo $imageSrc; ?>sort_up.gif" border="0" alt="Sort Ascending"></a><a href="?page=<?php echo $page; ?>&sort=brewStyle&dir=DESC&filter=<?php echo $filter; ?>&view=<?php echo $view; ?>"><img src="<?php echo $imageSrc; ?>sort_down.gif" border="0" alt="Sort Descending"></a><?php } ?></td>
              <td class="dataHeadingList" width="10%">Method<?php if (!checkmobile())  { ?>&nbsp;<a href="?page=<?php echo $page; ?>&sort=brewMethod&dir=ASC&filter=<?php echo $filter; ?>&view=<?php echo $view; ?>"><img src="<?php echo $imageSrc; ?>sort_up.gif" border="0" alt="Sort Ascending"></a><a href="?page=<?php echo $page; ?>&sort=brewMethod&dir=DESC&filter=<?php echo $filter; ?>&view=<?php echo $view; ?>"><img src="<?php echo $imageSrc; ?>sort_down.gif" border="0" alt="Sort Descending"></a><?php } ?></td>
              <td class="dataHeadingList" width="10%"><?php if ($row_pref['measColor'] == "EBC") echo "EBC"; else echo "SRM"; ?><?php if (!checkmobile())  { ?>&nbsp;<a href="?page=<?php echo $page; ?>&sort=brewLovibond&dir=ASC&filter=<?php echo $filter; ?>&view=<?php echo $view; ?>"><img src="<?php echo $imageSrc; ?>sort_up.gif" border="0" alt="Sort Ascending"></a><a href="?page=<?php echo $page; ?>&sort=brewLovibond&dir=DESC&filter=<?php echo $filter; ?>&view=<?php echo $view; ?>"><img src="<?php echo $imageSrc; ?>sort_down.gif" border="0" alt="Sort Descending"></a><?php } ?></td>
              <td class="dataHeadingList" width="5%">IBU<?php if (!checkmobile())  { ?>&nbsp;<a href="?page=<?php echo $page; ?>&sort=brewBitterness&dir=ASC&filter=<?php echo $filter; ?>&view=<?php echo $view; ?>"><img src="<?php echo $imageSrc; ?>sort_up.gif" border="0" alt="Sort Ascending"></a><a href="?page=<?php echo $page; ?>&sort=brewBitterness&dir=DESC&filter=<?php echo $filter; ?>&view=<?php echo $view; ?>"><img src="<?php echo $imageSrc; ?>sort_down.gif" border="0" alt="Sort Descending"></a><?php } ?></td>
              <td class="dataHeadingList" width="5%">ABV<?php if (!checkmobile())  { ?>&nbsp;<a href="?page=<?php echo $page; ?>&sort=brewOG&dir=ASC&filter=<?php echo $filter; ?>&view=<?php echo $view; ?>"><img src="<?php echo $imageSrc; ?>sort_up.gif" border="0" alt="Sort Ascending"></a><a href="?page=<?php echo $page; ?>&sort=brewOG&dir=DESC&filter=<?php echo $filter; ?>&view=<?php echo $view; ?>"><img src="<?php echo $imageSrc; ?>sort_down.gif" border="0" alt="Sort Descending"></a><?php } ?></td>
              <?php if (($row_pref['mode'] == "2") && ($filter == "all")) { ?><td class="dataHeadingList">Contributor<?php if (!checkmobile())  { ?>&nbsp;<a href="?page=<?php echo $page; ?>&sort=brewBrewerID&dir=ASC&filter=<?php echo $filter; ?>&view=<?php echo $view; ?>"><img src="<?php echo $imageSrc; ?>sort_up.gif" border="0" alt="Sort Ascending"></a><a href="?page=<?php echo $page; ?>&sort=brewBrewerID&dir=DESC&filter=<?php echo $filter; ?>&view=<?php echo $view; ?>"><img src="<?php echo $imageSrc; ?>sort_down.gif" border="0" alt="Sort Descending"></a><?php } ?></td><?php } ?>
			  <td class="dataHeadingList center" width="1%"><img src="<?php echo $imageSrc; ?>medal_gold_3.png" border="0" alt="Awards/Competition Entires" align="baseline"></td>		
            </tr>
            <?php do {  if ($row_recipeList['brewArchive'] != "Y") { ?>
			<?php 
			// Get brew style information for all listed styles
			mysql_select_db($database_brewing, $brewing);
			$query_styles = sprintf("SELECT * FROM styles WHERE brewStyle='%s'", $row_recipeList['brewStyle']);
			$styles = mysql_query($query_styles, $brewing) or die(mysql_error());
			$row_styles = mysql_fetch_assoc($styles);
			$totalRows_styles = mysql_num_rows($styles);
			// Get real user names
			mysql_select_db($database_brewing, $brewing);
			$query_user2 = sprintf("SELECT * FROM users WHERE user_name = '%s'", $row_recipeList['brewBrewerID']);
			$user2 = mysql_query($query_user2, $brewing) or die(mysql_error());
			$row_user2 = mysql_fetch_assoc($user2);
			$totalRows_user2 = mysql_num_rows($user2);
			
			// Awards
			$awardNewID = "r".$row_recipeList['id'];
			mysql_select_db($database_brewing, $brewing);
			$query_awards2 = sprintf("SELECT * FROM awards WHERE awardBrewID='%s'", $awardNewID);
			$awards2 = mysql_query($query_awards2, $brewing) or die(mysql_error());
			$row_awards2 = mysql_fetch_assoc($awards2);
			$totalRows_awards2 = mysql_num_rows($awards2);
			
			?>
            <tr <?php echo "style=\"background-color:$color\""; ?>>
            <?php if (isset($_SESSION["loginUsername"])) { if (($row_user['userLevel'] == "1") || ($row_recipeList['brewBrewerID'] == $loginUsername)) echo "<td class=\"dataList\"><a href=\"admin/index.php?action=edit&dbTable=recipes&id=".$row_recipeList['id']."\"><img src=\"".$imageSrc."pencil.png\" alt=\"Edit ".$row_recipeList['brewName']."\" title=\"Edit ".$row_recipeList['brewName']."\" border=\"0\" align=\"absmiddle\"></a></td>";  else echo "<td>&nbsp;</td>"; } ?>
              <?php if (!checkmobile())  { ?><td class="dataList"><a href="#" onclick="window.open('includes/output_beer_xml.inc.php?id=<?php echo $row_recipeList['id']; ?>&source=<?php echo $source; ?>&brewStyle=<?php echo $row_recipeList['brewStyle']; ?>','','height=5,width=5, scrollbars=no, toolbar=no, resizable==no, menubar=no'); return false;"><img src="<?php echo $imageSrc; ?>page_white_code.png" title="Download BeerXML" align="absmiddle" border="0" /></a></td><?php } ?>
              <td class="dataList"><a href="index.php?page=<?php echo $destination; ?>&filter=<?php echo $row_recipeList['brewBrewerID']; ?>&id=<?php echo $row_recipeList['id']; ?>"><?php echo $row_recipeList['brewName']; ?></a></td>
              <td class="dataList">
			  <div id="moreInfo"><?php if (($totalRows_styles > 0) && (!checkmobile())) { ?><a href="<?php if ($style == "all") echo "http://".$_SERVER['SERVER_NAME'].$_SERVER['SCRIPT_NAME']."?page=".$page."&filter=".$filter."&style=".$row_recipeList['brewStyle']."&sort=".$sort."&dir=".$dir."&view=".$view."&pg=1"; else echo "#"; ?>" title="Filter by style: <?php echo $row_recipeList['brewStyle']; ?>"><?php } echo $row_recipeList['brewStyle']; if (($totalRows_styles > 0) && (!checkmobile()))  { ?>
			  <span>
			  <div id="wideWrapper">
			  <?php include ('reference/styles.inc.php'); ?>
			  </div>
			  </span>
			  </a>
              <?php } ?>
			  </div>
			  </td>
			  <td class="dataList"><?php if ($row_recipeList['brewMethod'] != "") { echo $row_recipeList['brewMethod']; } else echo "&nbsp;" ?></td>
              <?php if (!checkmobile()) { ?>
              <td class="dataList">
			  		<?php if ($row_recipeList['brewLovibond'] != "") { ?>
					<?php include (INCLUDES.'color.inc.php'); ?>
					<?php include (INCLUDES.'color_display.inc.php'); ?>
				   	<?php } else echo "&nbsp;"; ?>
			  </td>
			  <?php } ?>
              <td class="dataList"><?php if ($row_recipeList['brewBitterness'] != "") { echo round ($row_recipeList['brewBitterness'], 1); } else echo "&nbsp;" ?></td>
              <td class="dataList"><?php if (($row_recipeList['brewOG'] != "") && ($row_recipeList['brewFG'] != "")) { include (INCLUDES.'abv.inc.php'); echo round ($abv, 1)."%"; } else echo "&nbsp;"; ?></td>
              <?php if (($row_pref['mode'] == "2") && ($filter == "all")) { ?><td  class="dataList"><a href="?page=<?php echo $page; ?>&sort=<?php echo $sort; ?>&dir=<?php echo $dir; ?>&filter=<?php echo $row_user2['user_name']; ?>&view=limited"><?php echo $row_user2['realFirstName']."&nbsp;".$row_user2['realLastName']; ?></a></td><?php } ?>
              <td class="dataList center"><?php if ($totalRows_awards2 > 0) echo $totalRows_awards2; else echo "&nbsp;"; ?></td>
            </tr>
            <?php if ($color == $color1) { $color = $color2; } else { $color = $color1; } ?>
            <?php }   // end if ($row_recipeList['brewArchive'] != "Y")
			} while ($row_recipeList = mysql_fetch_assoc($recipeList));
			?>
            </table>
            <table class="dataTable">
        	<tr>
			  <td><div id="paginate"><?php echo $total." ".$row_pref['menuRecipes']." Total"; if ($total > $display) echo "&nbsp;&nbsp;&nbsp;&#8226"; if ($view == "all") echo "&nbsp;&nbsp;&nbsp;&#8226;&nbsp;&nbsp;&nbsp;"; if ($total > $display) { echo "&nbsp;&nbsp;&nbsp;"; paginate($display, $pg, $total);  if ($view == "limited") { ?>&nbsp;&nbsp;&nbsp;&#8226&nbsp;&nbsp;&nbsp;<a href="?page=<?php echo $page; ?>&sort=<?php echo $sort; ?>&dir=<?php echo $dir; ?>&filter=<?php echo $filter; ?>&style=<?php echo $style; ?>&view=all">Entire List of <?php if (($row_pref['mode'] == "2") && ($filter != "all")) echo $row_user2['realFirstName']."'s "; echo $row_pref['menuRecipes']; ?></a><?php } } if  (($view == "all") && ($total < $display)) { ?><a href="?page=<?php echo $page; ?>&sort=<?php echo $sort; ?>&dir=<?php echo $dir; ?>&filter=<?php echo $filter; ?>&style=<?php echo $style; ?>&view=limited">Limited List of <?php if (($row_pref['mode'] == "2")&& ($filter != "all")) echo $row_user2['realFirstName']."'s "; echo $row_pref['menuRecipes']; ?></a><?php } ?></div></td>
              </tr>
        </table>
		  </div>
		<?php } ?>