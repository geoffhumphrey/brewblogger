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
				<p><a href="<?php echo build_public_url("admin", "brewblogs", "manage", "brewing", "all", "default", $base_url); ?>">Manage</a></p>
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
				<p><a href="<?php echo build_public_url("admin", "recipes", "manage", "recipes", "all", "default", $base_url); ?>">Manage</a></p>
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
				<p>Manage</p>
				<p>Personal Defaults</p>
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
				<p><a role="button" data-toggle="collapse" href="#profileEquip" aria-expanded="false" aria-controls="profileEquip">Equipment</a></p>
				<div class="collapse bb-account-info" id="profileEquip">
					<small>Manage | Add</small>
				</div>
				<p><a role="button" data-toggle="collapse" href="#profileMash" aria-expanded="false" aria-controls="profileMash">Mash</a></p>
				<div class="collapse bb-account-info" id="profileMash">
					<small>Manage | Add</small>
				</div>
				<p><a role="button" data-toggle="collapse" href="#profileFerm" aria-expanded="false" aria-controls="profileFerm">Fermentation</a></p>
				<div class="collapse bb-account-info" id="profileFerm">
					<small>Manage | Add</small>
				</div>
				<p><a role="button" data-toggle="collapse" href="#profileWater" aria-expanded="false" aria-controls="profileWater">Water</a></p>
				<div class="collapse bb-account-info" id="profileWater">
					<small>Manage | Add</small>
				</div>
				<p><a role="button" data-toggle="collapse" href="#profileCarb" aria-expanded="false" aria-controls="profileCarb">Carbonation</a></p>
				<div class="collapse bb-account-info" id="profileCarb">
					<small>Manage | Add</small>
				</div>
				<p><a role="button" data-toggle="collapse" href="#profileStyles" aria-expanded="false" aria-controls="profileStyles">Styles</a></p>
				<div class="collapse bb-account-info" id="profileStyles">
					<small>Manage | Add</small>
				</div>
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
				<p><a role="button" data-toggle="collapse" href="#ingMalts" aria-expanded="false" aria-controls="ingMalts">Malts and Grains</a></p>
				<div class="collapse bb-account-info" id="ingMalts">
					<small>Manage | Add</small>
				</div>
				<p><a role="button" data-toggle="collapse" href="#ingExtracts" aria-expanded="false" aria-controls="ingExtracts">Extracts</a></p>
				<div class="collapse bb-account-info" id="ingExtracts">
					<small>Manage | Add</small>
				</div>
				<p><a role="button" data-toggle="collapse" href="#ingHops" aria-expanded="false" aria-controls="ingHops">Hops</a></p>
				<div class="collapse bb-account-info" id="ingHops">
					<small>Manage | Add</small>
				</div>
				<p><a role="button" data-toggle="collapse" href="#ingWater" aria-expanded="false" aria-controls="ingWater">Water</a></p>
				<div class="collapse bb-account-info" id="ingWater">
					<small>Manage | Add</small>
				</div>
				<p><a role="button" data-toggle="collapse" href="#ingYeast" aria-expanded="false" aria-controls="ingYeast">Yeast</a></p>
				<div class="collapse bb-account-info" id="ingYeast">
					<small>Manage | Add</small>
				</div>
				<p><a role="button" data-toggle="collapse" href="#ingAdjuncts" aria-expanded="false" aria-controls="ingAdjuncts">Adjuncts</a></p>
				<div class="collapse bb-account-info" id="ingAdjuncts">
					<small>Manage | Add</small>
				</div>
				<p><a role="button" data-toggle="collapse" href="#ingMisc" aria-expanded="false" aria-controls="ingMisc">Miscellaneous</a></p>
				<div class="collapse bb-account-info" id="ingMisc">
					<small>Manage | Add</small>
				</div>
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