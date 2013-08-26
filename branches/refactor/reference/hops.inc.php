<div id="referenceHeader"><?php echo $row_styles['hopsName']; ?></div>
<table <?php if ($source =="reference") echo "style=\"margin-bottom: 10px;\"";?>>
  <?php if ($row_styles['hopsGrown'] != "" ) {?>
  <tr>
	<td class="dataLabelLeft">Region:</td>
	<td class="data"><?php echo $row_styles['hopsGrown']; ?></td>
  </tr>
  <?php }?>
  <?php if ($row_styles['hopsAAULow'] != "" ) {?>
  <tr>
  	<td class="dataLabelLeft">AA Range:</td>
	<td class="data"><?php { $AAUmin = ltrim ($row_styles['hopsAAULow'], "0"); $AAUmax = ltrim ($row_styles['hopsAAUHigh'], "0"); echo $AAUmin." - ".$AAUmax."%"; } ?></td>
  </tr>
  <?php }?>
  <?php if ($row_styles['hopsInfo'] != "" ) {?>
   <tr>
  	<td class="dataLabelLeft">Notes:</td>
	<td class="data"><?php echo $row_styles['hopsInfo']; ?></td>
  </tr>
  <?php }?>
  <?php if ($row_styles['hopsUse'] != "" ) {?> 
  <tr>
  	<td class="dataLabelLeft">Typical Use:</td>
	<td class="data"><?php echo $row_styles['hopsUse']; ?></td>
  </tr>
  <?php }?>
  <?php if ($row_styles['hopsSub'] != "" ) {?>
  <tr>
  	<td class="dataLabelLeft">Substitution:</td>
	<td class="data"><?php echo $row_styles['hopsSub']; ?></td>
  </tr>    
  <?php }?>
  <?php if ($row_styles['hopsExample'] != "" ) {?> 
  <tr>
  	<td class="dataLabelLeft">Example:</td>
	<td class="data"><?php echo $row_styles['hopsExample']; ?></td>
  </tr>
  <?php }?>
</table>