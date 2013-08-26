<div class="headerContentAdmin"><div id="help"><a href="../sections/reference.inc.php?section=color&source=log&KeepThis=true&TB_iframe=true&height=370&width=600" title="Color Reference" class="thickbox"><img src="<?php echo $imageSrc; ?>/information.png" border="0"></a></div>Color</div>
<table class="dataTable">
<tr>
  <td class="dataLabelLeft">Color:</td>
  <?php
  echo '<td class="data" width="10%"><input type="text" name="brewLovibond" size="5" tooltipText="' . $toolTip_decimal . '" value="';
  if ($action == "edit" || $action == "import" || $action == "importRecipe" || $action == "reuse") {
    echo round($row_log['brewLovibond'], 1);
  } elseif ($action == "importCalc") {
    //if ($brewLovibond < 10)
    //  echo "0";
    echo round($brewLovibond, 1);
  }
  echo '">&nbsp;' . $row_pref['measColor'] . '</td>' . "\n";
  ?>
  <td class="dataLabel" width="5%">Formula:</td>
  <td class="data">
  <select name="brewColorFormula">
    <?php
    echo '<option value="Morey" ';
    if ($action == "add") {
      if ($row_user['defaultColorFormula'] == "Morey")
	echo "SELECTED";
    } elseif ($action == "edit" || $action == "import" || $action == "importRecipe" || $action == "reuse") {
      if ($row_log['brewColorFormula'] == "Morey") {
	echo "SELECTED";
      }
    } elseif ($action == "importCalc") {
      if ($brewColorFormula == "Morey") {
	echo "SELECTED";
      }
    }
    echo '>Morey</option>' . "\n";

    echo '<option value="Daniels" ';
    if ($action == "add") {
      if ($row_user['defaultColorFormula'] == "Daniels")
	echo "SELECTED";
    } elseif ($action == "edit" || $action == "import" || $action == "importRecipe" || $action == "reuse") {
      if ($row_log['brewColorFormula'] == "Daniels") {
	echo "SELECTED";
      }
    } elseif ($action == "importCalc") {
      if ($brewColorFormula == "Daniels") {
	echo "SELECTED";
      }
    }
    echo '>Daniels</option>' . "\n";

    echo '<option value="Moser" ';
    if ($action == "add") {
      if ($row_user['defaultColorFormula'] == "Moser")
	echo "SELECTED";
    } elseif ($action == "edit" || $action == "import" || $action == "importRecipe" || $action == "reuse") {
      if ($row_log['brewColorFormula'] == "Moser") {
	echo "SELECTED";
      }
    } elseif ($action == "importCalc") {
      if ($brewColorFormula == "Moser") {
	echo "SELECTED";
      }
    }
    echo '>Moser</option>' . "\n";
    ?>
  </select>
</tr>
</table>