<?php if ((!empty($row_log['brewMisc1Name'])) && (!empty($row_log['brewMisc1Amount']))) { // hide entire set of misc rows if first is not present (4) ?>
<h3><a name="recipe" id="recipe"></a>Non-Fermentables</h3>
<table class="table table-striped">
    <thead>
        <tr>
            <th width="15%">Amount</th>
            <th>Non-Fermentable</th>
            <th width="15%">Time</th>
        </tr>
    </thead>
        <tr>
            <td><?php echo $row_log['brewMisc1Amount']; ?></td>
            <td><?php echo $row_log['brewMisc1Name'];  ?></td>
            <td><?php if (!empty($row_log['brewMisc1Time'])) echo $row_log['brewMisc1Time']." minutes"; else echo "&nbsp;"; ?></td>
        </tr>
        <?php if ($row_log['brewMisc2Name'] != "") { ?>
        <tr>
            <td><?php echo $row_log['brewMisc2Amount']; ?></td>
            <td><?php echo $row_log['brewMisc2Name'];  ?></td>
            <td><?php if (!empty($row_log['brewMisc2Time'])) echo $row_log['brewMisc2Time']." minutes"; else echo "&nbsp;"; ?></td>
        </tr>
        <?php } ?>
        <?php if ($row_log['brewMisc3Name'] != "") { ?>
        <tr>
            <td><?php echo $row_log['brewMisc3Amount']; ?></td>
            <td><?php echo $row_log['brewMisc3Name'];  ?></td>
            <td><?php if (!empty($row_log['brewMisc3Time'])) echo $row_log['brewMisc3Time']." minutes"; else echo "&nbsp;"; ?></td>
        </tr>
        <?php } ?>
        <?php if ($row_log['brewMisc4Name'] != "") { ?>
        <tr>
            <td><?php echo $row_log['brewMisc4Amount']; ?></td>
            <td><?php echo $row_log['brewMisc4Name'];  ?></td>
            <td><?php if (!empty($row_log['brewMisc4Time'])) echo $row_log['brewMisc4Time']." minutes"; else echo "&nbsp;"; ?></td>
        </tr>
        <?php } ?>
        <?php if ($action == "scale") { ?>
        <tr>
            <td colspan="3"><p class="text-danger small">* Amounts are NOT scaled in this section. Original yield is <?php echo $row_log['brewYield']."&nbsp;".$_SESSION['measFluid2']; ?>. Adjust accordingly.</p></td>
        </tr>
        <?php } ?>
</table>
<?php } // end hide Misc  ?>