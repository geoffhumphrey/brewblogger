<?php if (!(isset($_SESSION['loginUsername']))) { ?>

<div class="container-xxl mt-5 mb-5" style="min-height: 70vh;">
<form data-toggle="validator" role="form" class="form-horizontal" action="<?php echo $base_url; ?>includes/logincheck.inc.php" method="POST" name="form1" id="form1">
    <div class="form-floating mb-3">
        <input name="loginUsername" type="text" class="form-control" id="loginUsername" placeholder="name@example.com" required>
        <label for="loginUsername">User Name</label>
    </div>
    <div class="form-floating">
        <input name="loginPassword" type="password" class="form-control" id="loginPassword" placeholder="Password" required>
        <label for="loginPassword">Password</label>
    </div>
    <button name="submit" type="submit" class="btn btn-primary mt-3" >Log In <span class="fa fa-sign-in" aria-hidden="true"></span> </button>
</form>
</div>











<?php } else { ?>
<p class= "lead">You are already logged in, <?php echo $_SESSION['realFirstName']; ?>.</p>
<?php } ?>