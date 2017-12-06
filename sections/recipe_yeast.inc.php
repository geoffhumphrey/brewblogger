<a name="yeasts"></a><h3>Yeasts</h3>
<?php if ((!empty($row_log['brewYeast'])) && (empty($row_log['brewYeastProfile']))) { ?>
<!-- If no yeast profile specified - legacy installations -->
<table class="table table-striped">
	<thead>
		<tr>
            <th width="25%">Name</th>
            <th>Lab/Manufacturer</th>
            <th>Form</th>
            <th width="15%">Amount</th>
        </tr>
	</thead>
    <tbody>
    	<tr>
        	<td><?php if (!empty($row_log['brewYeast'])) echo $row_log['brewYeast']; ?></td>
            <td><?php if (!empty($row_log['brewYeastMan'])) echo $row_log['brewYeastMan']; ?></td>
            <td><?php if (!empty($row_log['brewYeastForm'])) echo $row_log['brewYeastForm']; ?></td>
            <td><?php if (!empty($row_log['brewYeastAmount'])) echo $row_log['brewYeastAmount']; ?></td>
        </tr>
    </tbody>
</table>
<?php }
if (!empty($row_log['brewYeastProfile'])) { ?>
<!-- If yeast profile specified -->
<table class="table table-striped">
	<thead>
		<tr>
            <th width="25%">Name</th>
            <th>Lab/Manufacturer</th>
            <th>Product ID</th>
            <th width="15%">Amount</th>
        </tr>
	</thead>
    <tbody>
    	<tr>
        	<td><a href="#yeastModal" data-toggle="modal"><?php if (!empty($row_yeast_profiles['yeastName'])) echo $row_yeast_profiles['yeastName']; ?></a></td>
            <td><?php if (!empty($row_yeast_profiles['yeastLab'])) echo $row_yeast_profiles['yeastLab']; ?></td>
            <td><?php if (!empty($row_yeast_profiles['yeastProdID'])) echo $row_yeast_profiles['yeastProdID']; ?></td>
            <td><?php if (!empty($row_log['brewYeastAmount'])) echo $row_log['brewYeastAmount']; ?></td>
        </tr>
    </tbody>
</table>
<!-- Modal -->
<div class="modal fade" id="yeastModal" tabindex="-1" role="dialog" aria-labelledby="yeastModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="yeastModalLabel"><?php echo $row_yeast_profiles['yeastName']; ?></h4>
      </div>
      <div class="modal-body">
            <?php
			if (!empty($row_yeast_profiles['yeastLab'])) { ?>
            <div class="row bb-account-info">
                <div class="col-xs-12 col-sm-3 col-md-3"><strong>Manufacturer:</strong></div>
                <div class="col-xs-12 col-sm-9 col-md-9"><?php echo $row_yeast_profiles['yeastLab']; ?></div>
            </div>
            <?php }
            if (!empty($row_yeast_profiles['yeastProdID'])) { ?>
            <div class="row bb-account-info">
                <div class="col-xs-12 col-sm-3 col-md-3"><strong>Product ID:</strong></div>
                <div class="col-xs-12 col-sm-9 col-md-9"><?php echo $row_yeast_profiles['yeastProdID']; ?></div>
            </div>
            <?php }
            if (!empty($row_yeast_profiles['yeastType'])) { ?>
            <div class="row bb-account-info">
                <div class="col-xs-12 col-sm-3 col-md-3"><strong>Type:</strong></div>
                <div class="col-xs-12 col-sm-9 col-md-9"><?php echo $row_yeast_profiles['yeastType']; ?></div>
            </div>
            <?php }
            if (!empty($row_yeast_profiles['yeastFloc'])) { ?>
            <div class="row bb-account-info">
                <div class="col-xs-12 col-sm-3 col-md-3"><strong>Flocculation:</strong></div>
                <div class="col-xs-12 col-sm-9 col-md-9"><?php echo $row_yeast_profiles['yeastFloc']; ?></div>
            </div>
            <?php }
            if (!empty($row_yeast_profiles['yeastAtten'])) { ?>
            <div class="row bb-account-info">
                <div class="col-xs-12 col-sm-3 col-md-3"><strong>Attenuation:</strong></div>
                <div class="col-xs-12 col-sm-9 col-md-9"><?php echo $row_yeast_profiles['yeastAtten']; ?>%</div>
            </div>
            <?php }
            if (!empty($row_yeast_profiles['yeastTolerance'])) { ?>
            <div class="row bb-account-info">
                <div class="col-xs-12 col-sm-3 col-md-3"><strong>Alcohol Tolerance:</strong></div>
                <div class="col-xs-12 col-sm-9 col-md-9"><?php echo $row_yeast_profiles['yeastTolerance']; ?></div>
            </div>
            <?php }
            if (!empty($row_yeast_profiles['yeastMinTemp'])) { ?>
            <div class="row bb-account-info">
                <div class="col-xs-12 col-sm-3 col-md-3"><strong>Temperature Range:</strong></div>
                <div class="col-xs-12 col-sm-9 col-md-9"><?php if ($_SESSION['measTemp'] == "C") { echo round(((($row_yeast_profiles['yeastMinTemp'] - 32) / 9) * 5), 0)."&ndash;"; echo round(((($row_yeast_profiles['yeastMaxTemp'] - 32) / 9) * 5), 0); } else { echo $row_yeast_profiles['yeastMinTemp']."&ndash;".$row_yeast_profiles['yeastMaxTemp']; } ?>&deg;<?php echo $_SESSION['measTemp']; ?></div>
            </div>
            <?php }
            if (!empty($row_log['brewYeastAmount'])) { ?>
            <div class="row bb-account-info">
                <div class="col-xs-12 col-sm-3 col-md-3"><strong>Amount:</strong></div>
                <div class="col-xs-12 col-sm-9 col-md-9"><?php echo $row_log['brewYeastAmount']; ?></div>
            </div>
            <?php }
            if (!empty($row_yeast_profiles['yeastNotes'])) { ?>
            <div class="row bb-account-info">
                <div class="col-xs-12 col-sm-3 col-md-3"><strong>Notes:</strong></div>
                <div class="col-xs-12 col-sm-9 col-md-9"><?php echo $row_yeast_profiles['yeastNotes']; ?></div>
            </div>
            <?php } ?>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<?php } ?>
