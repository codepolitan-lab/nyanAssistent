<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<title>nyanAssistent</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="nyanAssistent ~Password Management adalah apikasi sederhana untuk memengolah daftar password yang dimiliki user ">
	<meta name="author" content="Kresna Galuh D. Herlangga">
	
	<link href="<?php echo base_url().'css/bootstrap.css'; ?>" rel="stylesheet">
	<link href="<?php echo base_url().'css/bootstrap-responsive.css'; ?>" rel="stylesheet">
	<link href="<?php echo base_url().'css/main.css'; ?>" rel="stylesheet">
	
	<style>
	.label_icon {
		font-size:8pt;
		}
		
	.merah {
		color:red;
		}
		
	.user_nama {
		margin-bottom:20px;
		}
	</style>
</head>

<body id="dashboard">
	<div class="container" style="margin-top:45px;">
	
		<div class="row-fluid">
			<div class="span6">
				<a href="<?php echo site_url('dashboard'); ?>"><img src="<?php echo base_url().'img/logo4.png'; ?>"></a>
			</div>
		
			<div class="span6">
				<div class=" pull-right">
					<div class="icon_top" align="center" style="float:right; margin:5px;">
						<div><a href="<?php echo site_url('login/logout'); ?>"><img src="<?php echo base_url().'img/icon_exit.png'; ?>" width="50"></a></div>
						<div class="label_icon"><a href="<?php echo site_url('login/logout'); ?>">Logout</a></div>
					</div>
					<div class="icon_top" align="center" style="float:right; margin:5px;">
						<div><a href="<?php echo site_url('setting'); ?>"><img src="<?php echo base_url().'img/icon_setting.png'; ?>" width="50"></a></div>
						<div class="label_icon"><a href="<?php echo site_url('setting'); ?>">Setting</a></div>
					</div>
					<div class="icon_top" align="center" style="float:right; margin:5px;">
						<div><a href="<?php echo site_url('search'); ?>"><img src="<?php echo base_url().'img/icon_search.png'; ?>" width="50"></a></div>
						<div class="label_icon"><a href="<?php echo site_url('search'); ?>">Search</a></div>
					</div>
					<div class="icon_top" align="center" style="float:right; margin:5px;">
						<div><a href="<?php echo site_url('dashboard/add'); ?>"><img src="<?php echo base_url().'img/icon_add.png'; ?>" width="50"></a></div>
						<div class="label_icon"><a href="<?php echo site_url('dashboard/add'); ?>">Add</a></div>
					</div>
					<div class="icon_top" align="center" style="float:right; margin:5px;">
						<div><a href="<?php echo site_url('dashboard'); ?>"><img src="<?php echo base_url().'img/icon_home.png'; ?>" width="50"></a></div>
						<div class="label_icon"><a href="<?php echo site_url('dashboard'); ?>">Home</a></div>
					</div>
				</div>
			</div>
		</div>
		
		<hr>
		
		<?php
		$query_user = $this->user_model->get_user($this->session->userdata('id_user_nyan_active_now'));
		foreach ($query_user as $row)
		{
			echo '<div class="row-fluid user_nama" align="right">';
			echo '<span class="alert alert-info">Login user: <strong>'.$row->nama.'</strong></span>';
			echo '</div>';
		}
		?>
		
		<div class="row-fluid">
			<?php $this->load->view($content); ?>
			<div class="alert alert-info">
			<button class="close" data-dismiss="alert">&times;</button>
			<p><strong>Penting : </strong>
			Pastikan Anda telah berlangganan buletin pemrograman nyankodMagz dengan cara mengisi form berlangganan di <a href="http://nyankod.com/nyankodmagz">http://nyankod.com/nyankodmagz</a>. Santai, gratis guys!!</p>
			</div>
		</div>

		<hr>

		<footer>
			<p>Copyright &copy; 2012 <a href="http://www.nyankod.com">Nyankod</a> by <a href="http://www.kresnagaluh.com">Kresna Galuh</a> - All right reserved</p>
		</footer>

	</div>
	

<script src="<?php echo base_url().'js/jquery-1.8.2.min.js'; ?>"></script>
<script>
$(document).ready(function(){

	if ($('#dashboard').size()) {
		$.getScript(
			'<?php echo base_url().'js/jquery.passroids.min.js'; ?>',
			function() {
				$('#form_tambah').passroids({
					main : "#password"
				});
			}
		);
	}

});
</script>
	
</body>
</html>
