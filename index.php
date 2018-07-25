<?php include('srlog.php'); ?>
<?php include('srreg.php');?>
<!DOCTYPE html>
<html>
<head>
    <title>welcome</title>
	<link rel="stylesheet" type="text/css" href="styles.css">
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
</head>
<body>
<script>
$(function() {
	$('#login-form-link').click(function(e) {
    	$("#login-form").delay(100).fadeIn(100);
    	$("#register-form").fadeOut(100);
    	$('#register-form-link').removeClass('active');
    	$(this).addClass('active');
    	e.preventDefault();
	});
	$('#register-form-link').click(function(e) {
	    $("#register-form").delay(100).fadeIn(100);
	    $("#login-form").fadeOut(100);
    	$('#login-form-link').removeClass('active');
    	$(this).addClass('active');
    	e.preventDefault();
	});
});
</script>
<!-- <?php
	$firstnameErr = $lastnameErr = "";	
	if ($_SERVER["REQUEST_METHOD"] == "POST") {
		if (empty($_POST["firstname"])) {
    		$firstnameErr = "*required";
	  	}
		if (empty($_POST["lastname"])) {
    		$lastnameErr = "*required";
  		}
	} 
?> -->
<div class="container">
    	<div class="row">
			<div class="col-md-6 col-md-offset-3">
				<div class="panel panel-login">
					<div class="panel-heading">
						<div class="row">
							<div class="col-xs-6">
								<a href="#" class="active" id="login-form-link">Login</a>
							</div>
							<div class="col-xs-6">
								<a href="#" id="register-form-link">Register</a>
							</div>
						</div>
						<hr>
					</div>
					<div class="panel-body">
						<div class="row">
							<div class="col-lg-12">
								<form id="login-form" action="srlog.php" method="post" role="form" style="display: block;">
									<div class="form-group">
										<input type="text" name="logusername" id="username" tabindex="1" class="form-control" placeholder="Username" required value="<?php echo $logusername;?>">
									</div>
									<div class="form-group">
										<input type="password" name="logpass" id="password" tabindex="2" class="form-control" placeholder="Password" required value="<?php echo $logpass;?>">
									</div>
									<div class="form-group text-center">
										<input type="checkbox" tabindex="3" class="" name="remember" id="remember">
										<label for="remember"> Remember Me</label>
									</div>
									<div class="form-group">
										<div class="row">
											<div class="col-sm-6 col-sm-offset-3">
												<input type="submit" name="login" id="login-submit" tabindex="4" class="form-control btn btn-login" value="login">
											</div>
										</div>
									</div>
									<div class="form-group">
										<div class="row">
											<div class="col-lg-12">
												<div class="text-center">
													<a href="recover.php" tabindex="5" class="forgot-password">Forgot Password?</a>
												</div>
											</div>
										</div>
									</div>
								</form>
								<form id="register-form" action="srreg.php" method="post" enctype="multipart/form-data" role="form" style="display: none;">
									<div class="form-group">
										<input type="text" name="username" id="username" tabindex="1" class="form-control" placeholder="Username" required value="<?php echo $username;?>">
									</div>
                                    <div class="form-group">
										<input type="text" name="firstname" id="username" tabindex="1" class="form-control" placeholder="firstname" required value="<?php echo $firstname;?>">
									</div>
                                    <div class="form-group">
										<input type="text" name="lastname" id="username" tabindex="1" class="form-control" placeholder="lastname" required value="<?php echo $lastname;?>">
									</div>
									<div class="form-group">
										<input type="email" name="email" id="email" tabindex="1" class="form-control" placeholder="Email Address" required value="<?php echo $email;?>">
									</div>
									<div class="form-group">
										<input type="password" name="pass1" id="password" tabindex="2" class="form-control" placeholder="Password" required value="<?php echo $pass1;?>">
									</div>
									<div class="form-group">
										<input type="password" name="pass2" id="confirm-password" tabindex="2" class="form-control" placeholder="Confirm Password" required value="<?php echo $pass1;?>">
									</div>
									<div class="fprm-group">
										<input type="file" name="image">
									</div>
									<div class="form-group">
										<div class="row">
											<div class="col-sm-6 col-sm-offset-3">
												<input type="submit" name="register" id="register-submit" tabindex="4" class="form-control btn btn-register" value="Register Now">
											</div>
										</div>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</body>
</html>