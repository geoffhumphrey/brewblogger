<?php if  ($totalRows_awards > 0) { ?>
<div class="panel panel-default hidden-print">
  <div class="panel-heading">
    <h4 class="panel-title">Awards &amp; Competitions</h4>
  </div>
  <div class="panel-body">
  	<?php do { ?>
  	<div class="small awards-wrapper">
        <div class="row">
            <div class="col col-lg-3 col-md-4 col-sm-4 col-xs-4">
                <strong class="text-info">Name:</strong>
            </div>
            <div class="col col-lg-9 col-md-8 col-sm-8 col-xs-8">
                <?php echo $row_awards['awardBrewName']; ?>
            </div>
        </div>
        <div class="row">
            <div class="col col-lg-3 col-md-4 col-sm-4 col-xs-4">
                <strong class="text-info">Comp:</strong>
            </div>
            <div class="col col-lg-9 col-md-8 col-sm-8 col-xs-8">
                <?php if ($row_awards['awardContestURL'] != "") { ?><a href="<?php echo $row_awards['awardContestURL']; ?>" target="_blank"><?php } echo $row_awards['awardContest']; if ($row_awards['awardContestURL'] != "") { ?></a><?php } ?>
            </div>
        </div>
        <div class="row">
            <div class="col col-lg-3 col-md-4 col-sm-4 col-xs-4">
                <strong class="text-info">Date:</strong>
            </div>
            <div class="col col-lg-9 col-md-8 col-sm-8 col-xs-8">
                <?php  $date = $row_awards['awardDate']; $realdate = dateconvert($date,3); echo $realdate; ?>
            </div>
        </div>
        <div class="row">
            <div class="col col-lg-3 col-md-4 col-sm-4 col-xs-4">
                <strong class="text-info">Style:</strong>
            </div>
            <div class="col col-lg-9 col-md-8 col-sm-8 col-xs-8">
                <?php echo $row_awards['awardStyle']; ?>
            </div>
        </div>
        <div class="row">
            <div class="col col-lg-3 col-md-4 col-sm-4 col-xs-4">
            <strong class="text-info">Place:</strong>
            </div>
            <div class="col col-lg-9 col-md-8 col-sm-8 col-xs-8">
                <?php echo display_place($row_awards['awardPlace'],2); ?>
            </div>
        </div>
    </div>
    <?php } while ($row_awards = mysqli_fetch_assoc($awards)); ?>
  </div>
</div>
<?php } ?>
