<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<title>nyanAssistent</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="">
	<meta name="author" content="">
	
	<!-- Le styles -->
	<link href="<?php echo base_url().'css/bootstrap.css'; ?>" rel="stylesheet">
	<link href="<?php echo base_url().'css/bootstrap-responsive.css'; ?>" rel="stylesheet">

	
</head>

<body style="background:#ffffff;">
	<div class="container" style="max-width:320px;">
		<div style="margin-top:60px;" align="center">
			<a href="<?php echo base_url(); ?>"><img src="<?php echo base_url().'img/logo2.png'; ?>"></a>
		</div>
		<div id="form_login" style="margin-top:15px;">
			<?php
				$attributes = array('name' => 'login_form', 'class' => 'well');
				echo form_open('login/process_login', $attributes);
			?>
			
			<h2>Login User</h2>
			
			<?php echo $pesan_error; ?>
			
				<label>Username:</label>
				<input type="text" class="input-xlarge" placeholder="Username..." name="username" value="<?php echo $username; ?>">
				<label>Password:</label>
				<input type="password" class="input-xlarge" placeholder="Password..." name="password" value="<?php echo $password; ?>">
				<button type="submit" class="btn btn-primary btn-large" style="padding-left:30px; padding-right:30px;">Login</button>
			</form>
		</div>
		
		<div align="center">
			<p>Copyright &copy; 2012 <a href="http://www.nyankod.com">Nyankod</a> by <a href="http://www.kresnagaluh.com">Kresna Galuh</a></p>
		</div>
		
	</div>
	
</body>


</html>
