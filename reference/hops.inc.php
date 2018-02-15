

<!--
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
-->
<script type="text/javascript">
$(document).ready(function(){
    $('#sortable').DataTable( {
        "dom": "rfptip",
        "order": [[ 0, 'asc' ]],
        "pageLength": 50,
        "columns": [
            null,
            null,
            null,
            { "type": "natural", targets: 0 },
            null,
            null,
            null
          ]
    } );
});
</script>
<h2>Hops</h2>
<table class="table table-bordered table-striped" id="sortable">
    <thead>
        <tr>
            <th>Name</th>
            <th class="hidden-xs hidden-sm">Origin</th>
            <th class="hidden-xs hidden-sm">Use</th>
            <th class="hidden-xs hidden-sm">AAs</th>
            <th width="15%">Substitutions</th>
            <th width="25%">Info</th>
            <th width="20%" class="hidden-xs hidden-sm">Examples</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($_SESSION['hops'] as $row_hops) {
            $aa = "";
            if (!empty($row_hops['hopsAAULow'])) $aa .= $row_hops['hopsAAULow'];
            if ((!empty($row_hops['hopsAAULow'])) && (!empty($row_hops['hopsAAUHigh']))) $aa .= " - ";
            if (!empty($row_hops['hopsAAUHigh'])) $aa .= $row_hops['hopsAAUHigh'];
            if ((!empty($row_hops['hopsAAULow'])) && (!empty($row_hops['hopsAAUHigh']))) $aa .= "%";
        ?>
        <tr>
            <td><?php echo $row_hops['hopsName']; ?><span class="hidden-md hidden-lg"> <?php echo "(".$aa." AA)"; ?></span></td>
            <td class="hidden-xs hidden-sm"><?php echo $row_hops['hopsGrown']; ?></td>
            <td class="hidden-xs hidden-sm"><?php echo rtrim($row_hops['hopsUse'],"."); ?></td>
            <td class="hidden-xs hidden-sm"><?php echo $aa; ?></td>
            <td><?php echo $row_hops['hopsSub']; ?></td>
            <td><?php echo strip_tags($row_hops['hopsInfo']); ?></td>
            <td class="hidden-xs hidden-sm"><?php echo $row_hops['hopsExample']; ?></td>
        </tr>
        <?php } ?>
    </tbody>
</table>