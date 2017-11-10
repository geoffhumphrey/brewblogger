<h2>BJCP Styles</h2>
<?php do { ?>
<h3><?php echo $row_styles['brewStyleGroup'].$row_styles['brewStyleNum']." &ndash; ".$row_styles['brewStyle']; ?> <small><em><?php echo style_category($row_styles['brewStyleGroup'],"BJCP2008"); ?></em></small></h3>
<p><?php echo $row_styles['brewStyleInfo']; ?></p>
<table class="table table-bordered table-striped">
    <tr>
        <th>OG</th>
        <th>FG</th>
        <th>ABV</th>
        <th>Bitterness</th>
        <th>Color</th>
    </tr>
    <tr>
        <td nowrap>
        <?php
			if ($row_styles['brewStyleOG'] == "") echo "Varies";
			elseif ($row_styles['brewStyleOG'] != "") echo number_format((float)$row_styles['brewStyleOG'], 3, '.', '')." &ndash; ".number_format((float)$row_styles['brewStyleOGMax'], 3, '.', '');
			else echo "&nbsp;";
		?>
		</td>
        <td nowrap>
        <?php
			if ($row_styles['brewStyleFG'] == "") echo "Varies";
			elseif ($row_styles['brewStyleFG'] != "") echo number_format((float)$row_styles['brewStyleFG'], 3, '.', '')." &ndash; ".number_format((float)$row_styles['brewStyleFGMax'], 3, '.', '');
			else echo "&nbsp;";
		?>
        </td>
        <td nowrap>
        <?php
			if ($row_styles['brewStyleABV'] == "") echo "Varies";
			elseif ($row_styles['brewStyleABV'] != "" ) echo number_format((float)$row_styles['brewStyleABV'], 1, '.', '')."% &ndash; ".number_format((float)$row_styles['brewStyleABVMax'], 1, '.', '')."%";
			else echo "&nbsp;";
		?>
        </td>
        <td nowrap>
        <?php
			  if ($row_styles['brewStyleIBU'] == "")  echo "Varies";
			  elseif ($row_styles['brewStyleIBU'] == "N/A") echo "N/A";
			  elseif ($row_styles['brewStyleIBU'] != "") echo ltrim($row_styles['brewStyleIBU'], "0")." &ndash; ".ltrim($row_styles['brewStyleIBUMax'], "0")." IBU";
			  else echo "&nbsp;";
		?>
        </td>
        <td>
        <?php
			if ($row_styles['brewStyleSRM'] == "") echo "Varies";
			elseif ($row_styles['brewStyleSRM'] == "N/A") echo "N/A";
			elseif ($row_styles['brewStyleSRM'] != "") {
				$SRMmin = round(ltrim ($row_styles['brewStyleSRM'], "0"),0);
				$SRMMinEBC = round(ltrim (srm_to_ebc($row_styles['brewStyleSRM']), "0"),0);
				$SRMmax = round(ltrim ($row_styles['brewStyleSRMMax'], "0"),0);
				$SRMmaxEBC = round(ltrim(srm_to_ebc($row_styles['brewStyleSRMMax']), "0"),0);
				if ($SRMmin >= "15") $color1 = "#ffffff"; else $color1 = "#000000";
				if ($SRMmax >= "15") $color2 = "#ffffff"; else $color2 = "#000000";
				$styleColor = "<span class=\"badge\" style=\"background-color: ".srm_color($SRMmin,"srm")."; color: ".$color1."\">&nbsp;".$SRMmin."/".$SRMMinEBC."&nbsp;</span>";
				$styleColor .= " &ndash; ";
				$styleColor .= "<span class=\"badge\" style=\"background-color: ".srm_color($SRMmax,"srm")."; color: ".$color2."\">&nbsp;".$SRMmax."/".$SRMmaxEBC."&nbsp;</span> <small class=\"text-muted\"><em>SRM/EBC</em></small>";
				echo $styleColor;
			}
			else echo "&nbsp;";
		?>
        </td>
    </tr>
</table>
<p><a href="<?php echo $row_styles['brewStyleLink']; ?>" target="_blank">More Info</a> (link to Beer Judge Certification Program Style Guidelines)</p>
<?php } while ($row_styles = mysqli_fetch_assoc($styles)); ?>