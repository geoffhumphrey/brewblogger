<?php
$label_club_name = "Club Name";
$label_brewer_name = "Brewer Name";
$label_age = "Age";
$label_hometown = "Hometown";
$label_city = "City";
$label_favorite_styles = "Favorite Styles";
$label_method = "Method";
$label_info = "Info";
$label_other_info = "Additional Info";
$label_country = "Country";

$brewer_name = "";
if (!empty($row_name['brewerPrefix'])) $brewer_name .= $row_name['brewerPrefix']." ";
if (!empty($row_name['brewerFirstName'])) $brewer_name .= $row_name['brewerFirstName']." ";
if (!empty($row_name['brewerMiddleName'])) $brewer_name .= $row_name['brewerMiddleName']." ";
if (!empty($row_name['brewerLastName'])) $brewer_name .= $row_name['brewerLastName'];
if (!empty($row_name['brewerSuffix'])) $brewer_name .= " ".$row_name['brewerSuffix'];

$brewer_age = "";
if (!empty($row_name['brewerAge'])) $brewer_age = $row_name['brewerAge'];

$brewer_location = "";
if (!empty($row_name['brewerCity'])) $brewer_location .= $row_name['brewerCity'];
if (!empty($row_name['brewerState'])) $brewer_location .=  ", ".$row_name['brewerState'];
if (!empty($row_name['brewerCountry'])) $brewer_location .=  " ".$row_name['brewerCountry'];

$brewer_clubs = "";
if (($_SESSION['mode'] == "1") && (!empty($_SESSION['brewerClubs']))) $brewer_clubs .= $row_name['brewerClubs'];

$brewer_favorite_styles = "";
if (!empty($row_name['brewerFavStyles'])) $brewer_favorite_styles .= $row_name['brewerFavStyles'];

$brewer_method = "";
if (!empty($row_name['brewerPrefMethod'])) $brewer_method .= $row_name['brewerPrefMethod'];

$brewer_info = "";
if (!empty($row_name['brewerAbout'])) $brewer_info .= $row_name['brewerAbout'];

$brewer_other_info = "";
if(!empty($row_name['brewerOther'])) $brewer_other_info .= $row_name['brewerOther'];

$filename = LABEL_IMAGES.$row_name['brewerImage'];
$brewer_image = $base_url."label_images/".$row_name['brewerImage'];

?>

<div class="row">
	<div class="col col-sm-12 col-md-8 col-lg-9">
		<?php if (!empty($brewer_name)) { ?>
		<div class="row">
			<div class="col col-lg-2 col-md-3 col-sm-12">
				<strong><?php echo $label_brewer_name; ?></strong>
			</div>
			<div class="col col-lg-10 col-md-9 col-sm-12">
				<?php echo $brewer_name; ?>
			</div>
		</div>
		<?php } ?>
		<?php if (!empty($brewer_age)) { ?>
		<div class="row">
			<div class="col col-lg-2 col-md-3 col-sm-12">
				<strong><?php echo $label_age; ?></strong>
			</div>
			<div class="col col-lg-10 col-md-9 col-sm-12">
				<?php echo $brewer_age; ?>
			</div>
		</div>
		<?php } ?>
		<?php if (!empty($brewer_location)) { ?>
		<div class="row">
			<div class="col col-lg-2 col-md-3 col-sm-12">
				<strong><?php echo $label_hometown; ?></strong>
			</div>
			<div class="col col-lg-10 col-md-9 col-sm-12">
				<?php echo $brewer_location; ?>
			</div>
		</div>
		<?php } ?>
		<?php if (!empty($brewer_clubs)) { ?>
		<div class="row">
			<div class="col col-lg-2 col-md-3 col-sm-12">
				<strong><?php echo $label_club_name; ?></strong>
			</div>
			<div class="col col-lg-10 col-md-9 col-sm-12">
				<?php echo $brewer_clubs; ?>
			</div>
		</div>
		<?php } ?>
		<?php if (!empty($brewer_favorite_styles)) { ?>
		<div class="row">
			<div class="col col-lg-2 col-md-3 col-sm-12">
				<strong><?php echo $label_favorite_styles; ?></strong>
			</div>
			<div class="col col-lg-10 col-md-9 col-sm-12">
				<?php echo $brewer_favorite_styles; ?>
			</div>
		</div>
		<?php } ?>
		<?php if (!empty($brewer_method)) { ?>
		<div class="row">
			<div class="col col-lg-2 col-md-3 col-sm-12">
				<strong><?php echo $label_method; ?></strong>
			</div>
			<div class="col col-lg-10 col-md-9 col-sm-12">
				<?php echo $brewer_method; ?>
			</div>
		</div>
		<?php } ?>
		<?php if (!empty($brewer_info)) { ?>
		<div class="row">
			<div class="col col-lg-2 col-md-3 col-sm-12">
				<strong><?php echo $label_info; ?></strong>
			</div>
			<div class="col col-lg-10 col-md-9 col-sm-12">
				<?php echo $brewer_info; ?>
			</div>
		</div>
		<?php } ?>
		<?php if (!empty($brewer_other_info)) { ?>
		<div class="row">
			<div class="col col-lg-2 col-md-3 col-sm-12">
				<strong><?php echo $label_other_info; ?></strong>
			</div>
			<div class="col col-lg-10 col-md-9 col-sm-12">
				<?php echo $brewer_other_info; ?>
			</div>
		</div>
		<?php } ?>
	</div>
	<div class="col col-sm-12 col-md-4 col-lg-3">
		<?php if ((!empty($row_name['brewerImage'])) && (file_exists($filename))) { ?>
		<img class="img-responsive img-rounded" src="<?php echo $brewer_image; ?>">
		<?php } ?>
	</div>
</div>