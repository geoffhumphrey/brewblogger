<script type="text/javascript">
$(document).ready(function(){
    $('#sortable').DataTable( {
        "dom": "rfptip",
        /*
        "columns": [
            null,
            null,
            { "type": "natural", targets: 0 },
            null,
            null,
            { "type": "natural", targets: 0 },
            { "type": "natural", targets: 0 },
            { "type": "natural", targets: 0 },
            { "type": "natural", targets: 0 },
            <?php if ($page == "admin") { ?>{ "orderable": false }<?php } else { ?>{ "type": "natural", targets: 0 }<?php } ?>
        ],
        */
        "order": [[ 0, 'asc' ]],
        "pageLength": 50,
        "columns": [
            null,
            null,
            null,
            { "type": "natural", targets: 0 },
            { "type": "natural", targets: 0 },
            { "type": "natural", targets: 0 },
            null,
            { "type": "natural", targets: 0 },
            null
          ]
    } );
});
</script>
<h2>Yeast</h2>
<table class="table table-bordered table-striped" id="sortable">
    <thead>
        <tr>
            <th>Name</th>
            <th>Type</th>
            <th>Form</th>
            <th>Flocculation</th>
            <th>Attenuation</th>
            <th>Temperature Range</th>
            <th>Alcohol Tolerance</th>
            <th>Max Reuse</th>
            <th>Best For</th>
        </tr>
    </thead>
    <tbody>
        <?php do { ?>
        <tr>
            <td><?php echo $row_yeast['yeastLab']." ".$row_yeast['yeastName']; if ($row_yeast['yeastProdID'] != "") echo " - ".$row_yeast['yeastProdID']; ?></td>
            <td><?php echo $row_yeast['yeastType']; ?></td>
            <td><?php echo $row_yeast['yeastForm']; ?></td>
            <td><?php echo $row_yeast['yeastFloc']; ?></td>
            <td><?php if ($row_yeast['yeastAtten'] != "") echo $row_yeast['yeastAtten']."%"; ?></td>
            <td><?php if ($row_yeast['yeastMinTemp'] != "") { if ($row_pref['measTemp'] == "C") echo tempconvert($row_yeast['yeastMinTemp'], "C"); else echo $row_yeast['yeastMinTemp']; } if ($row_yeast['yeastMaxTemp'] != "") { echo "-"; if ($row_pref['measTemp'] == "C") echo tempconvert($row_yeast['yeastMaxTemp'], "C"); else echo $row_yeast['yeastMaxTemp']; } echo "&deg;".$row_pref['measTemp']; ?></td>
            <td><?php echo $row_yeast['yeastTolerance']; ?></td>
            <td><?php echo $row_yeast['yeastMaxReuse']; ?></td>
            <td><?php echo $row_yeast['yeastBestFor']; ?></td>
        </tr>
        <?php } while ($row_yeast = mysqli_fetch_assoc($yeast)); ?>
    </tbody>
</table>