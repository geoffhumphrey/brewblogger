<?php if (!(isset($_SESSION['loginUsername']))) { ?>
<form data-toggle="validator" role="form" class="form-horizontal" action="<?php echo $base_url; ?>includes/logincheck.inc.php" method="POST" name="form1" id="form1">
  <div class="form-group">
    <label for="" class="col-lg-2 col-md-3 col-sm-4 col-xs-12 control-label">User Name</label>
    <div class="col-lg-10 col-md-9 col-sm-8 col-xs-12">
      <div class="input-group has-warning">
        <span class="input-group-addon" id="login-addon1"><span class="fa fa-envelope"></span></span>
        <!-- Input Here -->
        <input class="form-control" name="loginUsername" type="text" value="" autofocus required data-error="Your user name is required.">
        <span class="input-group-addon" id="login-addon2"><span class="fa fa-star"></span></span>
      </div>
      <span class="help-block with-errors"></span>
    </div>
  </div><!-- Form Group -->
  <div class="form-group">
    <label for="" class="col-lg-2 col-md-3 col-sm-4 col-xs-12 control-label">Password</label>
    <div class="col-lg-10 col-md-9 col-sm-8 col-xs-12">
      <div class="input-group has-warning">
        <span class="input-group-addon" id="login-addon3"><span class="fa fa-key"></span></span>
        <!-- Input Here -->
        <input class="form-control" name="loginPassword" type="password" required data-error="A password is required.">
        <span class="input-group-addon" id="login-addon4"><span class="fa fa-star"></span></span>
      </div>
      <span class="help-block with-errors"></span>
    </div>
  </div>
  <div class="form-group">
    <div class="col-lg-offset-2 col-md-offset-3 col-sm-offset-4">
      <!-- Input Here -->
      <button name="submit" type="submit" class="btn btn-primary" >Log In <span class="fa fa-sign-in" aria-hidden="true"></span> </button>
    </div>
  </div><!-- Form Group -->
</form>
<?php } else { ?>
<p class= "lead">You are already logged in, <?php echo $_SESSION['realFirstName']; ?>.</p>
<?php } ?>