<style>
	.dashboard-sections {
		margin-bottom: 30px;
		text-align: center;
	}
	.dashboard-sections h4 {
		margin-bottom: 0;
	}
	.dashboard-section {
		margin-bottom: 20px;
	}
	.dashboard-section img {
		display: inline-block;
		border-radius: 50%;
	}
	.dashboard-section .well {
		text-align: left;
	}
</style>
<p class="lead">This updated dashboard is not yet functional. <small>Go to the <a href="<?php echo $base_url; ?>admin/index.php">legacy dashboard</a> for all admin functions.</small></p>
<div class="row dashboard-sections">
	<div class="col col-xs-12 col-sm-6 col-md-3 dashboard-section">
		<a role="button" data-toggle="collapse" href="#brewblogsMenu" aria-expanded="false" aria-controls="brewblogsMenu"><span class="fa fa-5x fa-beer"></span>
		<h4>BrewBlogs</h4>
		</a>
		<div class="collapse" id="brewblogsMenu">
			<div class="well">
				<p>Manage</p>
				<p>Add</p>
				<p>Import</p>
				<p>Review</p>
			</div>
		</div>
	</div>

	<div class="col col-xs-12 col-sm-6 col-md-3 dashboard-section">
		<a role="button" data-toggle="collapse" href="#recipesMenu" aria-expanded="false" aria-controls="recipesMenu"><span class="fa fa-5x fa-book"></span>
		<h4>Recipes</h4>
		</a>
		<div class="collapse" id="recipesMenu">
			<div class="well">
				<p>Manage</p>
				<p>Add</p>
				<p>Import</p>
			</div>
		</div>
	</div>

	<div class="col col-xs-12 col-sm-6 col-md-3 dashboard-section">
		<a role="button" data-toggle="collapse" href="#profileMenu" aria-expanded="false" aria-controls="profileMenu">
		<span class="fa fa-5x fa-user"></span>
		<h4>My Account</h4>
		</a>
		<div class="collapse" id="profileMenu">
			<div class="well">
				<p>Edit</p>
				<p>Add/Change Profile Pic</p>
			</div>
		</div>
	</div>

	<div class="col col-xs-12 col-sm-6 col-md-3 dashboard-section">
		<a role="button" data-toggle="collapse" href="#settingsMenu" aria-expanded="false" aria-controls="settingsMenu">
		<span class="fa fa-5x fa-cog"></span>
		<h4>Settings</h4>
		</a>
		<div class="collapse" id="settingsMenu">
			<div class="well">
				<p>Themes</p>
				<p>Preferences</p>
				<p>Links</p>
				<p>Mods</p>
			</div>
		</div>
	</div>

</div><!-- ./row -->

<div class="row dashboard-sections">

	<div class="col col-xs-12 col-sm-6 col-md-4 dashboard-section">
		<a role="button" data-toggle="collapse" href="#profilesMenu" aria-expanded="false" aria-controls="profilesMenu">
		<span class="fa fa-5x fa-tasks"></span>
		<h4>Profiles</h4>
		</a>
		<div class="collapse" id="profilesMenu">
			<div class="well">
				<p>Equipment</p>
				<p>Mash</p>
				<p>Water</p>
				<p>Fermentation</p>
				<p>Carbonation</p>
				<p>Style</p>
			</div>
		</div>
	</div>

	<div class="col col-xs-12 col-sm-6 col-md-4 dashboard-section">
		<a role="button" data-toggle="collapse" href="#ingredientsMenu" aria-expanded="false" aria-controls="ingredientsMenu">
		<span class="fa fa-5x fa-shopping-basket"></span>
		<h4>Ingredients</h4>
		</a>
		<div class="collapse" id="ingredientsMenu">
			<div class="well">
				<p>Malts and Grains</p>
				<p>Hops</p>
				<p>Water</p>
				<p>Yeast</p>
				<p>Miscellaneous</p>
			</div>
		</div>
	</div>

	<div class="col col-xs-12 col-sm-12 col-md-4 dashboard-section">
		<a role="button" data-toggle="collapse" href="#calcMenu" aria-expanded="false" aria-controls="calcMenu">
		<span class="fa fa-5x fa-calculator"></span>
		<h4>Calculators</h4>
		</a>
		<div class="collapse" id="calcMenu">
			<div class="well">
				<p>Bitterness</p>
				<p>Force Carbonation</p>
				<p>Priming Sugar</p>
				<p>Efficiency</p>
				<p>Hydrometer Correction</p>
				<p>Strike Water</p>
				<p>Calories and Alcohol<p>
				<p>Plato/SG/Brix</p>
			</div>
		</div>
	</div>


</div>