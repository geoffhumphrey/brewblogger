
		<table class="dataTable">
		 <tr>
              <td class="dataHeadingList" colspan="2">Member Name&nbsp;<a href=""><img src="<?php echo $imageSrc; ?>sort_up.gif" border="0" alt="Sort Ascending"></a><a href=""><img src="<?php echo $imageSrc; ?>sort_down.gif" border="0" alt="Sort Descending"></a></td>
			  <td class="dataHeadingList" colspan="2">BrewBlogs</td>
			  <td class="dataHeadingList" colspan="2">Recipes</td>
			  <td class="dataHeadingList" colspan="2">Awards/Comps</td>
			<?php do { 
			
			$query_count1 = sprintf("SELECT * FROM brewing WHERE brewBrewerID = '%s'", $row_members['user_name']);
			$count1 = mysqli_query($connection,$query_count1) or die (mysqli_error($connection));
			$row_count1 = mysqli_fetch_assoc($count1);
			$totalRows_count1 = mysqli_num_rows($count1);
			
			
			$query_count2 = sprintf("SELECT * FROM recipes WHERE brewBrewerID = '%s'", $row_members['user_name']);
			$count2 = mysqli_query($connection,$query_count2) or die (mysqli_error($connection));
			$row_count2 = mysqli_fetch_assoc($count2);
			$totalRows_count2 = mysqli_num_rows($count2);
			
			
			$query_count3 = sprintf("SELECT * FROM awards WHERE brewBrewerID = '%s'", $row_members['user_name']);
			$count3 = mysqli_query($connection,$query_count3) or die (mysqli_error($connection));
			$row_count3 = mysqli_fetch_assoc($count3);
			$totalRows_count3 = mysqli_num_rows($count3);
			?>
            <tr <?php echo "style=\"background-color:$color\""; ?>>
               <td width="1%" 	class="dataList"><?php if ($row_members['userInfoPrivate'] == "Y") { ?><img src="<?php echo $imageSrc; ?>user.png"><?php } else echo "&nbsp;"; ?></td>
               <td width="34%" 	class="dataList"><?php if ($row_members['userInfoPrivate'] == "Y") { ?><a href="index.php?page=profile&filter=<?php echo $row_members['user_name']; ?>"><?php } echo $row_members['realFirstName']."&nbsp;".$row_members['realLastName'];  if ($row_members['userInfoPrivate'] != "") { ?></a><?php if ($row_members['userPosition'] != "") echo "<span class=\"text_9\">&nbsp;&nbsp;<em>".$row_members['userPosition']."</em></span>"; } ?></td>
			   <td 	class="dataList"><?php echo $totalRows_count1."&nbsp;&nbsp;"; ?></td>
			   <td width="25%" 	class="dataList"><?php if ($totalRows_count1 > 0) { ?><a href="index.php?page=brewblog-list&filter=<?php echo $row_members['user_name']; ?>&sort=brewDate&dir=DESC">View &raquo;</a><?php } else echo "&nbsp;"; ?></td>
			   <td 	class="dataList"><?php echo $totalRows_count2."&nbsp;&nbsp;"; ?></td>
               <td width="25%" 	class="dataList"><?php if ($totalRows_count2 > 0) { ?><a href="index.php?page=recipe-list&filter=<?php echo $row_members['user_name']; ?>">View &raquo;</a><?php } else echo "&nbsp;"; ?></td>
			   <td 	class="dataList"><?php echo $totalRows_count3; ?></td>
               <td width="25%" 	class="dataList"><?php if ($totalRows_count3 > 0) { ?><a href="index.php?page=awards-list&sort=awardBrewName&dir&ASC&filter=<?php echo $row_members['user_name']; ?>">View &raquo;</a><?php } else echo "&nbsp;"; ?></td>
			   
			</tr>
			<?php if ($color == $color1) { $color = $color2; } else { $color = $color1; } ?>
            <?php } while ($row_members = mysqli_fetch_assoc($members)); ?> 
		</table>
