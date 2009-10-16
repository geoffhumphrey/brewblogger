<div id="referenceHeader"><?php echo $row_yeast['yeastLab']." ".$row_yeast['yeastName']; if ($row_yeast['yeastProdID'] != "") echo " - ".$row_yeast['yeastProdID']; ?></div>
<table <?php if ($source == "reference") echo "style=\"margin-bottom: 10px;\"";?>>
  <tr>
	<td class="dataLabelLeft">Type:</td>
	<td width="30%" class="data"><?php echo $row_yeast['yeastType']; ?></td>
    <td class="dataLabel">Form:</td>
	<td class="data"><?php echo $row_yeast['yeastForm']; ?></td>
  </tr>
  <tr>
	<td class="dataLabelLeft">Flocculation:</td>
	<td class="data"><?php echo $row_yeast['yeastFloc']; ?></td>
    <td class="dataLabel">Attenuation:</td>
	<td class="data"><?php if ($row_yeast['yeastAtten'] != "") echo $row_yeast['yeastAtten']."%"; ?></td>
  </tr>
  <tr>
	<td class="dataLabelLeft">Temperature Range:</td>
	<td class="data"><?php if ($row_yeast['yeastMinTemp'] != "") { if ($row_pref['measTemp'] == "C") echo tempconvert($row_yeast['yeastMinTemp'], "C"); else echo $row_yeast['yeastMinTemp']; } if ($row_yeast['yeastMaxTemp'] != "") { echo "-"; if ($row_pref['measTemp'] == "C") echo tempconvert($row_yeast['yeastMaxTemp'], "C"); else echo $row_yeast['yeastMaxTemp']; } echo "&deg;".$row_pref['measTemp']; ?></td>
    <td class="dataLabel">Alcohol Tolerance:</td>
	<td class="data"><?php echo $row_yeast['yeastTolerance']; ?></td>
  </tr>
  <tr>
	<td class="dataLabelLeft">Best For:</td>
	<td class="data"><?php echo $row_yeast['yeastBestFor']; ?></td>
    <td class="dataLabel">Maximum Reuse:</td>
	<td class="data"><?php echo $row_yeast['yeastMaxReuse']; ?></td>
  </tr>
</table>