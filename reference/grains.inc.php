<script type="text/javascript">
$(document).ready(function(){
    $('#sortable').DataTable( {
        "dom": "rfptip",
        "order": [[ 0, 'asc' ]],
        "pageLength": 50,
        "columns": [
            null,
            null,
            { "type": "natural", targets: 0 },
            null,
            { "type": "natural", targets: 0 },
            null
          ]
    } );
});
</script>
<h2>Grains</h2>
<table class="table table-bordered table-striped" id="sortable">
    <thead>
        <tr>
            <th>Name</th>
            <th>Color</th>
            <th class="hidden-xs hidden-sm">Origin</th>
            <th class="hidden-xs hidden-sm">Supplier</th>
            <th class="hidden-xs hidden-sm">PPG</th>
            <th width="35%">Info</th>
        </tr>
    </thead>
    <tbody>
        <?php
        foreach ($_SESSION['grains'] as $row_grains) {

          $malt_color = "";

          if (!empty($row_grains['maltLovibond'])) {

            if (strpos($row_grains['maltLovibond'],"-") !== false) {

                $explodies = explode("-", $row_grains['maltLovibond']);
                $lovibond_low = $explodies[0];
                $lovibond_high = $explodies[1];

                /*
                if ($_SESSION['measColor'] == "EBC") {
                  $lovibond_low = ebc_to_srm($lovibond_low);
                  $lovibond_high = ebc_to_srm($lovibond_high);
                }
                */

                if (!empty($lovibond_low)) {
                    $font_color_low = ($lovibond_low >= 14) ? "#ffffff" : "#000000";
                    $bk_color_low = get_display_color($lovibond_low);

                    $malt_color .= "<span class=\"hidden\">".sprintf("%06s",number_format($lovibond_low))."</span>";
                    $malt_color .= " <span class=\"badge\" style=\"font-weight: normal; background: ". $bk_color_low ."; color: ".$font_color_low.";\">".number_format($lovibond_low)."</span>";
                }

                if (!empty($lovibond_high)) {

                    $font_color_high = ($lovibond_high >= 14) ? "#ffffff" : "#000000";
                    $bk_color_high = get_display_color($lovibond_high);
                    $malt_color .= " - ";

                    $malt_color .= "<span class=\"hidden\">".sprintf("%06s",number_format($lovibond_high))."</span>";
                    $malt_color .= " <span class=\"badge\" style=\"font-weight: normal; background: ". $bk_color_high ."; color: ".$font_color_high.";\">".number_format($lovibond_high)."</span>";
                }

            }

            else {

                $lovibond = $row_grains['maltLovibond'];
                // if ($_SESSION['measColor'] == "EBC") $lovibond = ebc_to_srm($lovibond);
                $font_color = ($lovibond >= 14) ? "#ffffff" : "#000000";
                $bk_color = get_display_color($lovibond);

                $malt_color .= "<span class=\"hidden\">".sprintf("%06s",number_format($lovibond))."</span>";
                $malt_color .= " <span class=\"badge\" style=\"font-weight: normal; background: ". $bk_color ."; color: ".$font_color.";\">".number_format($lovibond)."</span>";
            }

          }

        ?>
        <tr>
            <td><?php echo $row_grains['maltName']; ?></td>
            <td><?php echo $malt_color; ?></td>
            <td class="hidden-xs hidden-sm"><?php echo $row_grains['maltOrigin']; ?></td>
            <td class="hidden-xs hidden-sm"><?php echo $row_grains['maltSupplier']; ?></td>
            <td class="hidden-xs hidden-sm"><?php echo $row_grains['maltYield']; ?></td>
            <td><?php echo strip_tags($row_grains['maltInfo']); ?></td>
        </tr>
        <?php } ?>
    </tbody>
</table>