<?php if ($row_log['brewLink1'] != "" ) { ?>
<div id="sidebarWrapper">
  <div id="sidebarHeader"><span class="data_icon"><img src="<?php echo $imageSrc; ?>link.png" align="texttop"></span><span class="data">Related Link<?php if ($row_log['brewLink2'] != "" ) echo "s"; ?></span></div>
    <div id="sidebarInnerWrapper">
      <table>
	  	  <tr>
		     <td class="listLeftAlign"><a href="<?php echo $row_log['brewLink1']; ?>" target="_blank"><?php echo $row_log['brewLink1Name']; ?></a></td>
		  </tr>
		 <?php if ($row_log['brewLink2'] != "" ) { ?>
		  <tr>
    	     <td class="listLeftAlign"><a href="<?php echo $row_log['brewLink2']; ?>" target="_blank"><?php echo $row_log['brewLink2Name']; ?></a></td>
          </tr>
		 <?php }  ?>
	  </table>
     </div>
</div>
<?php } ?>
