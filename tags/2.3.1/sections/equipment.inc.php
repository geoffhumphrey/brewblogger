<?php if ($row_log['brewEquipProfile'] != "") { ?>
<div id="headerContent">Equipment Profile</div>
<div id="dataContainer">
<h3><em><?php echo $row_equip_profiles['equipProfileName']; ?></em></h3>
<table class="dataTable">
<tr>
    <td class="dataLabelLeft">Batch Size:</td>
   	<td class="data" width="15%" nowrap="nowrap"><?php if (($row_pref['measFluid2'] == "liters") && ($row_equip_profiles['equipBrewerID'] == "brewblogger")) echo volumeconvert($row_equip_profiles['equipBatchSize'], "liters"); else echo $row_equip_profiles['equipBatchSize']; echo " ".$row_pref['measFluid2']; ?></td>
   	<td class="dataLabel">Boil Volume:</td>
    <td class="data" nowrap="nowrap"><?php if (($row_equip_profiles['equipBoilVolume'] !="") && ($row_pref['measFluid2'] == "liters") && ($row_equip_profiles['equipBrewerID'] == "brewblogger")) echo volumeconvert($row_equip_profiles['equipBoilVolume'], "liters"); else echo $row_equip_profiles['equipBoilVolume']; echo " ".$row_pref['measFluid2']; ?></td>
</tr>
<tr>	
    <td class="dataLabelLeft">Evaporation Rate:</td>
    <td class="data" width="15%" nowrap="nowrap"><?php if ($row_equip_profiles['equipEvapRate'] != "") echo $row_equip_profiles['equipEvapRate']."% per hour"; ?></td>
   	<td class="dataLabel">Mash Tun Dead Space:</td>
   	<td class="data"><?php if (($row_equip_profiles['equipMashTunDeadspace'] !="") && ($row_pref['measFluid2'] == "liters") && ($row_equip_profiles['equipBrewerID'] == "brewblogger")) echo volumeconvert($row_equip_profiles['equipMashTunDeadspace'], "liters"); else echo $row_equip_profiles['equipMashTunDeadspace']; echo " ".$row_pref['measFluid2']; ?></td>
</tr>
<tr>
   	<td class="dataLabelLeft">Efficiency:</td>
    <td class="data"><?php if ($row_equip_profiles['equipTypicalEfficiency'] != "") echo $row_equip_profiles['equipTypicalEfficiency']."%"; ?></td>
	<td class="dataLabel">Mash Tun Weight:</td>
   	<td class="data"><?php if (($row_equip_profiles['equipMashTunWeight'] != "") && ($row_pref['measWeight2'] == "kilograms") && ($row_equip_profiles['equipBrewerID'] == "brewblogger")) echo weightconvert($row_equip_profiles['equipMashTunWeight'], "kilograms"); else echo $row_equip_profiles['equipMashTunWeight']; echo " ".$row_pref['measWeight2'];  ?></td>
</tr>
<tr>   
    <td class="dataLabelLeft">Hop Utilization:</td>
   	<td class="data"><?php if ($row_equip_profiles['equipHopUtil'] != "") echo $row_equip_profiles['equipHopUtil']."%"; ?></td>  
   	<td class="dataLabel">Mash Tun Volume:</td>
   	<td class="data"><?php if (($row_equip_profiles['equipMashTunVolume'] !="") && ($row_pref['measFluid2'] == "liters") && ($row_equip_profiles['equipBrewerID'] == "brewblogger")) echo volumeconvert($row_equip_profiles['equipMashTunVolume'], "liters"); else echo $row_equip_profiles['equipMashTunVolume']; echo " ".$row_pref['measFluid2']; ?></td>
</tr>
<tr>
    <td class="dataLabelLeft">Loss:</td>
    <td class="data"><?php if (($row_equip_profiles['equipLoss'] !="") && ($row_pref['measFluid2'] == "liters") && ($row_equip_profiles['equipBrewerID'] == "brewblogger")) echo volumeconvert($row_equip_profiles['equipLoss'], "liters"); else echo $row_equip_profiles['equipLoss']; echo " ".$row_pref['measFluid2']; ?></td>
    <td class="dataLabel">Mash Tun Specific Heat:</td>
   	<td class="data"><?php if ($row_equip_profiles['equipMashTunSpecificHeat'] != "") echo $row_equip_profiles['equipMashTunSpecificHeat']."  Cal/gram per &deg;C"; ?></td>
</tr>
<?php if ($row_equip_profiles['equipNotes'] != "") { ?>
<tr>
    <td class="dataLabelLeft">Notes:</td>
    <td class="data" colspan="3"><?php if ($row_equip_profiles['equipNotes'] != "") echo $row_equip_profiles['equipNotes']; ?></td>
</tr>
<?php } ?>
</table>
</div>
<?php } ?>














